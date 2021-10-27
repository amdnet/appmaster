<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;

class Akun extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Tambah User Account',
            'role' => $query
        ];
        return view('akun', $data);
    }

    public function proses()
    {
        if (!$this->validate([
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|is_unique[users.email]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 4 Karakter',
                    'max_length' => '{field} Maksimal 100 Karakter',
                    'is_unique' => '{field} sudah digunakan sebelumnya'
                ]
            ],
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[5]|max_length[30]|is_unique[users.username]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 5 Karakter',
                    'max_length' => '{field} Maksimal 30 Karakter',
                    'is_unique' => '{field} sudah digunakan sebelumnya'
                ]
            ],
            'password_hash' => [
                'label' => 'Password',
                'rules' => 'required|min_length[8]|max_length[30]',
                'errors' => [
                    'required' => '{field} Harus diisi',
                    'min_length' => '{field} Minimal 8 Karakter',
                    'max_length' => '{field} Maksimal 30 Karakter'
                ]
            ],
            'pass_confirm' => [
                'label' => 'Konfirmasi Password',
                'rules' => 'matches[password_hash]',
                'errors' => [
                    'matches' => 'Konfirmasi Password tidak sesuai dengan password'
                ]
            ]
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $users = new AkunModel();
        $users->insert([
            'email' => $this->request->getPost('email'),
            'username' => $this->request->getPost('username'),
            'password_hash' => password_hash($this->request->getPost('password_hash'), PASSWORD_DEFAULT)
        ]);
        // return redirect()->to('/login');
        return redirect()->back();
    }
}
