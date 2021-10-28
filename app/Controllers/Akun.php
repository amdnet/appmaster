<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\AkunModel;

class Akun extends BaseController
{
    protected $akunModel;

    public function __construct()
    {
        $this->akunModel = new AkunModel();
    }

    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Form Tambah Akun User',
            'role' => $query,
            'validation' => \Config\Services::validation()
        ];
        return view('akun', $data);
    }

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

        $this->akunModel->insert([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'photo' => $namaPhoto,
            'alamat' => $this->request->getVar('alamat'),
            'telp' => $this->request->getVar('telp'),
            'password_hash' => password_hash($this->request->getVar('password'), PASSWORD_DEFAULT)
            // 'password_hash' => password_hash($this->request->getVar('password_hash'), PASSWORD_DEFAULT)
        ]);
        // return redirect()->to('/login');
        session()->setFlashdata('pesan', 'Data user akun berhasil disimpan!');
        return redirect()->back();
    }
}
