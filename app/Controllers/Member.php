<?php
// ADEL CODEIGNITER 4 CRUD GENERATOR

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MemberModel;

class Member extends BaseController
{

    protected $memberModel;
    protected $validation;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'controller' => 'member',
            'pageTitle' => 'Form Member User Akun',
            'role' => $query,
            'validation' => \Config\Services::validation()
        ];

        return view('member', $data);
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->memberModel->select('id, email, username, photo, alamat, telp')->findAll();
        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id . ')"><i class="fa fa-trash-alt"></i></button>';

            $data['data'][$key] = array(
                $value->id,
                $value->email,
                $value->username,
                $value->telp,
                $value->photo,
                $value->alamat,
                $value->telp,
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
            $data = $this->memberModel->where('id', $id)->first();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function add()
    {

        $response = array();

        $fields['id'] = $this->request->getPost('id');
        $fields['email'] = $this->request->getPost('email');
        $fields['username'] = $this->request->getPost('username');
        $fields['photo'] = $this->request->getPost('photo');
        $fields['alamat'] = $this->request->getPost('alamat');
        $fields['telp'] = $this->request->getPost('telp');
        $fields['password_hash'] = $this->request->getPost('passwordHash');
        $fields['created_at'] = $this->request->getPost('createdAt');
        $fields['updated_at'] = $this->request->getPost('updatedAt');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[255]'],
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[30]'],
            'photo' => ['label' => 'Photo', 'rules' => 'required|max_length[100]'],
            'alamat' => ['label' => 'Alamat', 'rules' => 'required|max_length[100]'],
            'telp' => ['label' => 'Telp', 'rules' => 'required|max_length[15]'],
            'password_hash' => ['label' => 'Password hash', 'rules' => 'required|max_length[255]'],
            'created_at' => ['label' => 'Created at', 'rules' => 'permit_empty|valid_date'],
            'updated_at' => ['label' => 'Updated at', 'rules' => 'permit_empty|valid_date'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->memberModel->insert($fields)) {
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
        $fields['email'] = $this->request->getPost('email');
        $fields['username'] = $this->request->getPost('username');
        // $fields['photo'] = $this->request->getPost('photo');
        $fields['alamat'] = $this->request->getPost('alamat');
        $fields['telp'] = $this->request->getPost('telp');
        $fields['password_hash'] = $this->request->getPost('passwordHash');


        $this->validation->setRules([
            'email' => ['label' => 'Email', 'rules' => 'required|max_length[255]'],
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[30]'],
            // 'photo' => ['label' => 'Photo', 'rules' => 'required|max_length[100]'],
            'alamat' => ['label' => 'Alamat', 'rules' => 'required|max_length[100]'],
            'telp' => ['label' => 'Telp', 'rules' => 'required|max_length[15]'],
            'password_hash' => ['label' => 'Password hash', 'rules' => 'required|max_length[255]'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->memberModel->update($fields['id'], $fields)) {
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
            if ($this->memberModel->where('id', $id)->delete()) {
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
