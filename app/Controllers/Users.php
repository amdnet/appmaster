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
    }

    public function index()
    {
        $data = [
            'controller' => 'users',
            'pageTitle' => 'List User Account',
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
        $builder->select('users.id as userid, email, username, images, created_at, updated_at, name');
        $builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        $builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $result = $builder->get()->getResult();
        $no = 1;

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-info" onclick="view(' . $value->userid . ')"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->userid . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->userid . ')"><i class="fa fa-trash-alt"></i></button>';
            $data['data'][$key] = array(
                $no++,
                // $value->userid,
                $value->images,
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
