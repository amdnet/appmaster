<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;
    protected $validation;
    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();

        $data = [
            'controller' => 'users',
            'pageTitle' => 'List User Account',
            'role' => $query
        ];
        return view('user/index', $data);
    }

    public function login()
    {
        $userLogin = new \Myth\Auth\Models\LoginModel();
        $data = [
            'pageTitle' => 'User Login Information',
            'userLogin' => $userLogin->findAll()
        ];
        return view('user/login', $data);
    }

    public function profil()
    {
        $agent = $this->request->getUserAgent();
        $data['pageTitle'] = 'Profil User';
        $data['ip'] = $this->request->getIPAddress();
        $data['browser'] = $agent->getBrowser();
        return view('user/profil', $data);
    }

    public function akun()
    {
        $data['pageTitle'] = 'Detail Akun User';
        return view('user/akun', $data);
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $db = db_connect();
        $builder = $db->table('users');
        $builder->select('users.id as userid, email, username, photo, created_at, updated_at, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $result = $builder->get()->getResult();
        $no = 1;

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-info" onclick="view(' . $value->userid . ')"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->userid . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->userid . ')"><i class="fa fa-trash-alt"></i></button>';
            $data['data'][$key] = array(
                // $no++,
                $value->userid,
                $value->photo,
                $value->email,
                $value->username,
                $value->name,
                $value->created_at,
                $value->updated_at,
                $ops,
            );
        }
        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();
        $id = $this->request->getPost('id');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->usersModel->where('id', $id)->first();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {
        $response = array();
        // $db = db_connect();
        // $builder = $db->table('users');
        // $builder->select('users.id as userid, email, username, password_hash, created_at, updated_at, name');
        // $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        // $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');

        $fields['role'] = $this->request->getPost('role');
        $fields['id'] = $this->request->getPost('id');
        // $fields['images'] = $this->request->getPost('images');
        $fields['username'] = $this->request->getPost('username');
        $fields['email'] = $this->request->getPost('email');
        $fields['password_hash'] = password_hash($this->request->getPost('password_hash'), PASSWORD_DEFAULT);

        $this->validation->setRules([
            // 'images' => ['label' => 'Images', 'rules' => 'permit_empty|max_length[255]'],
            // 'userid' => ['label' => 'User id', 'rules' => 'required|max_length[30]'],
            'role' => [
                'label' => 'Role',
                'rules' => 'required',
            ],
            'email' => [
                'label'  => 'Email',
                'rules'  => 'required|is_unique[users.email]|valid_email',
                'errors' => [
                    'is_unique' => 'Nama {field} tidak boleh sama dengan yang sudah ada',
                    'valid_email' => 'Format {field} tidak valid'
                ]
            ],
            'username' => [
                'label'  => 'Username',
                'rules'  => 'required|is_unique[users.username]|min_length[5]|max_length[15]',
                'errors' => [
                    'is_unique' => 'Nama {field} tidak boleh sama dengan yang sudah ada',
                    'min_length' => 'Minimal karakter {field} adalah 5 termasuk spasi',
                    'max_length' => 'Maksimal karakter {field} adalah 15 termasuk spasi'
                ]
            ],
            // 'password_hash' => ['label' => 'Password hash', 'rules' => 'required|min_length[8]'],
            'password_hash' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]',
                'error' => [
                    'min_length' => 'Minimal karakter {field} adalah 8 termasuk spasi'
                ]
            ],

            'password_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password_hash]',
                'error' => [
                    'matches' => '{field} tidak sama'
                ]
            ]
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->usersModel->insert($fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Insertion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function edit()
    {
        $response = array();
        $fields['id'] = $this->request->getPost('id');
        $fields['images'] = $this->request->getPost('images');
        $fields['username'] = $this->request->getPost('username');
        $fields['email'] = $this->request->getPost('email');
        // $fields['password_hash'] = $this->request->getPost('passwordHash');

        $this->validation->setRules([
            'images' => ['label' => 'Images', 'rules' => 'permit_empty|max_length[255]'],
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[30]'],
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[30]'],
            'password_hash' => ['label' => 'Password hash', 'rules' => 'required|max_length[30]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->usersModel->update($fields['id'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Update error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function remove()
    {
        $response = array();
        $id = $this->request->getPost('id');
        if (!$this->validation->check($id, 'required|numeric')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            if ($this->usersModel->where('id', $id)->delete()) {
                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }
        return $this->response->setJSON($response);
    }
}
