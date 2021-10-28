<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $usersModel;

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

    public function add()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Form Tambah User Akun',
            'role' => $query,
            'validation' => \Config\Services::validation()
        ];
        return view('user/add', $data);
    }

    public function detail($id)
    {
        // $detail = $this->usersModel->where(['id' => $id])->first();
        $data = [
            'controller' => 'users',
            'pageTitle' => 'Detail User Account',
            'detail' => $this->usersModel->getUsers($id)
        ];
        return view('user/detail', $data);
    }

    // pembuatan user akun baru
    public function proses()
    {
        // dd($this->request->getVar());
        if (!$this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 4 Karakter.',
                    'max_length' => '{field} maksimal 100 Karakter.',
                    'is_unique' => '{field} sudah digunakan sebelumnya.'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[5]|max_length[30]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 5 Karakter.',
                    'max_length' => '{field} maksimal 30 Karakter.',
                    'is_unique' => '{field} sudah digunakan sebelumnya.'
                ]
            ],
            'photo' => [
                'label' => 'Photo',
                'rules' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
                'errors' => [
                    'max_size' => 'Maksimal ukuran {field} adalah 1 MB.',
                    'is_image' => 'Format {field} tidak valid.',
                    'mime_in' => 'File extention {field} harus berupa jpg,jpeg,gif,png.'
                ]
            ],
            'alamat' => [
                'label' => 'Alamat',
                'rules' => 'required|min_length[10]|max_length[100]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 10 Karakter.',
                    'max_length' => '{field} maksimal 100 Karakter.',
                ]
            ],
            'telp' => [
                'label' => 'No Telp/Hp',
                'rules' => 'required|min_length[6]|max_length[15]|is_unique[users.telp]',
                'errors' => [
                    'required' => '{field} wajib diisi.',
                    'min_length' => '{field} minimal 6 Karakter.',
                    'max_length' => '{field} maksimal 15 Karakter.',
                    'is_unique' => '{field} sudah digunakan sebelumnya.'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[30]',
                'errors' => [
                    'required' => '{field} harus diisi.',
                    'min_length' => '{field} minimal 8 Karakter.',
                    'max_length' => '{field} maksimal 30 Karakter.'
                ]
            ],
            'pass_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password]',
                'errors' => [
                    'matches' => 'Konfirmasi password tidak sesuai dengan password.'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // ambil photo
        $filePhoto = $this->request->getFile('photo');

        // cek tidak ada photo
        if ($filePhoto->getError() == 4) {
            $namaPhoto = 'avatar.png';
        } else {
            $filePhoto->move('public/profil');
            $namaPhoto = $filePhoto->getName();
        }

        $this->usersModel->insert([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'photo' => $namaPhoto,
            'alamat' => $this->request->getVar('alamat'),
            'telp' => $this->request->getVar('telp'),
            'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            // 'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT)
        ]);
        // return redirect()->to('/login');
        session()->setFlashdata('pesan', 'Data akun user berhasil disimpan!');
        return redirect()->back();
    }

    // user index
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
            // $ops = '<a href="users/detail/' . $value->userid . '" class="btn btn-sm btn-dark" onclick="view(' . $value->userid . ')">detail</a>';
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
}
