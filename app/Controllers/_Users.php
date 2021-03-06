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
            'pageTitle' => 'List User Account',
        ];
        return view('users/index', $data);
    }

    public function login()
    {
        $userLogin = new \Myth\Auth\Models\LoginModel();
        $data = [
            'pageTitle' => 'User Login Information',
            'userLogin' => $userLogin->findAll()
        ];
        return view('users/login', $data);
    }

    public function profil()
    {
        $agent = $this->request->getUserAgent();
        $data['pageTitle'] = 'Profil User';
        $data['ip'] = $this->request->getIPAddress();
        $data['browser'] = $agent->getBrowser();
        return view('users/profil', $data);
    }

    public function add()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Form Tambah User Akun',
            'role' => $query,
            'validation' => $this->validation
        ];
        return view('users/add', $data);
    }

    // buat user akun baru
    public function addsave()
    {
        if (!$this->validate([
            'role' => 'required',
            'email' => 'trim|required|valid_email|is_unique[users.email]',
            'username' => 'trim|required|min_length[5]|max_length[30]|is_unique[users.username]',
            'fullname' => 'trim|required|min_length[3]|max_length[30]',
            'photo' => 'max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            'telp' => 'required|min_length[6]|max_length[15]|is_unique[users.telp]|numeric',
            'alamat' => 'required|min_length[10]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[30]',
            'pass_confirm' => 'matches[password]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // ambil photo
        $filePhoto = $this->request->getFile('photo');

        // cek tidak ada photo
        if ($filePhoto->getError() == 4) {
            $namaPhoto = 'default.svg';
        } else {
            $filePhoto->move('public/profil');
            $namaPhoto = $filePhoto->getName();
        }

        $this->usersModel->insert([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'photo' => $namaPhoto,
            'telp' => $this->request->getVar('telp'),
            'alamat' => $this->request->getVar('alamat'),
            'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        $userID = $this->usersModel->insertID();

        $db = db_connect();
        $builder = $db->table('auth_groups_users');
        $builder->insert([
            'group_id' => $this->request->getVar('role'),
            'user_id' => $userID
        ]);
        session()->setFlashdata('pesan', 'Data akun user berhasil disimpan!');
        return redirect()->to('/users');
        // return redirect()->back()->withInput();
    }

    public function detail($id)
    {
        $db = db_connect();
        $query = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'controller' => 'users',
            'pageTitle' => 'Detail User Account',
            'role' => $query,
            'detail' => $this->usersModel->getUsers($id),
            'validation' => $this->validation
        ];
        return view('users/detail', $data);
    }

    public function update($id)
    {
        // single update database
        // $this->usersModel->save([
        //     'id' => $id,
        //     'email' => $this->request->getVar('email'),
        //     'username' => $this->request->getVar('username'),
        //     // 'photo' => $namaPhoto,
        //     'telp' => $this->request->getVar('telp'),
        //     'alamat' => $this->request->getVar('alamat'),
        //     // 'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        // ]);

        $emailLama = $this->usersModel->getUser($this->request->getVar('email'));
        if ($emailLama == $this->request->getVar('email')) {
            $emailRule = 'trim|required|valid_email';
        } else {
            $emailRule = 'trim|required|valid_email|is_unique[users.email,id,{id}]';
        }

        if (!$this->validate([
            'role' => 'required',
            // 'email' => $emailRule,
            'email' => 'trim|required|valid_email',
            'username' => 'required|min_length[5]|max_length[30]|is_unique[users.username]',
            'photo' => 'max_size[photo,2048]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            'telp' => 'required|min_length[6]|max_length[15]|is_unique[users.telp]|numeric',
            'alamat' => 'required|min_length[10]|max_length[100]',
            'password' => 'required|min_length[8]|max_length[30]',
            'pass_confirm' => 'matches[password]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // // ambil photo
        // $filePhoto = $this->request->getFile('photo');

        // // cek tidak ada photo
        // if ($filePhoto->getError() == 4) {
        //     $namaPhoto = 'default.svg';
        // } else {
        //     $filePhoto->move('public/profil');
        //     $namaPhoto = $filePhoto->getName();
        // }

        $this->usersModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            // 'photo' => $namaPhoto,
            'telp' => $this->request->getVar('telp'),
            'alamat' => $this->request->getVar('alamat'),
            // 'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
        ]);

        // $data = array(
        //     'group_id' => $this->request->getVar('role')
        // );
        // $db = db_connect();
        // $builder = $db->table('auth_groups_users');
        // $builder->where('user_id', $id);
        // $builder->update($data);

        // session()->setFlashdata('pesan', 'Akun user berhasil diperbaharui!');
        // // return redirect()->to('/users');
        // return redirect()->back()->withInput();
    }


    // hapus user akun
    public function remove()
    {
        // // single delete
        // $userID = $this->usersModel->delete($id);
        // $db = db_connect();
        // $builder = $db->table('auth_groups_users');
        // $builder->delete($userID);

        $response = array();
        $id = $this->request->getVar('userid');
        $userID = $this->usersModel->delete($id);
        if (!$this->validation->check($id, 'required|numeric')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            if ($this->usersModel->where('id', $id)->delete()) {
                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

                $db = db_connect();
                $builder = $db->table('auth_groups_users');
                $builder->delete($userID);
            } else {
                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function getAll()
    {
        $result = $this->usersModel->getData();
        foreach ($result as $key => $value) {
            // $ops = '<a href="' . base_url('users/detail/' . $value->userid) . '" class="btn btn-sm bg-primary">detail</a> <a href="' . base_url('users/remove/' . $value->userid) . '" class="btn btn-sm btn-danger">hapus</a>';
            $ops = '<a href="' . base_url('users/detail/' . $value->userid) . '" class="btn btn-sm bg-primary">detail</a> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->userid . ')">hapus</button>';
            $data['data'][$key] = array(
                $value->userid,
                $value->email,
                $value->username,
                $value->name,
                $value->telp,
                $value->alamat,
                $ops,
            );
        }
        return $this->response->setJSON($data);
    }
}
