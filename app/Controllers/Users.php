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
        $data = [
            'controller' => 'users',
            'pageTitle' => 'List User Account'
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
        $result = $this->usersModel->select('id, email, username, images, created_at, updated_at')->findAll();

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-info" onclick="view(' . $value->id . ')"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id . ')"><i class="fa fa-trash-alt"></i></button>';

            $data['data'][$key] = array(
                $value->id,
                $value->images,
                $value->email,
                $value->username,
                $value->images,
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
        $fields['id'] = $this->request->getPost('id');
        $fields['images'] = $this->request->getPost('images');
        $fields['username'] = $this->request->getPost('username');
        $fields['email'] = $this->request->getPost('email');
        $fields['password_hash'] = $this->request->getPost('passwordHash');

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
