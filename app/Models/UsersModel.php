<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersModel extends Model
{
    protected $table = 'users';
    // protected $returnType = 'object';
    protected $allowedFields = ['email', 'username', 'photo', 'alamat', 'telp', 'password_hash'];
    protected $useTimestamps = true;

    public function getUsers($id = false)
    {
        if ($id == false) {
            return $this->findAll();
        }

        return $this->where(['id' => $id])->first();
    }

    // protected $validationRules    = [
    //     'email' => 'required|valid_email|is_unique[users.email]',
    //     'username' => 'required|min_length[5]|max_length[30]|is_unique[users.username]',
    //     'photo' => 'max_size[photo,1024]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
    //     'alamat' => 'required|min_length[10]|max_length[100]',
    //     'telp' => 'required|min_length[6]|max_length[15]|is_unique[users.telp]',
    //     'password_hash' => 'required|min_length[8]|max_length[30]',
    //     'pass_confirm' => 'matches[password]'
    // ];

    // protected $validationMessages = [
    //     'email' => [
    //         'label' => 'Email',
    //         'errors' => [
    //             'required' => '{field} wajib diisi.',
    //             'min_length' => '{field} minimal 4 Karakter.',
    //             'max_length' => '{field} maksimal 100 Karakter.',
    //             'is_unique' => '{field} sudah digunakan sebelumnya.'
    //         ]
    //     ],
    //     'username' => [
    //         'label' => 'Username',
    //         'errors' => [
    //             'required' => '{field} wajib diisi.',
    //             'min_length' => '{field} minimal 5 Karakter.',
    //             'max_length' => '{field} maksimal 30 Karakter.',
    //             'is_unique' => '{field} sudah digunakan sebelumnya.'
    //         ]
    //     ],
    //     'photo' => [
    //         'label' => 'Photo',
    //         'errors' => [
    //             'max_size' => 'Maksimal ukuran {field} adalah 1 MB.',
    //             'is_image' => 'Format {field} tidak valid.',
    //             'mime_in' => 'File extention {field} harus berupa jpg,jpeg,gif,png.'
    //         ]
    //     ],
    //     'alamat' => [
    //         'label' => 'Alamat',
    //         'errors' => [
    //             'required' => '{field} wajib diisi.',
    //             'min_length' => '{field} minimal 10 Karakter.',
    //             'max_length' => '{field} maksimal 100 Karakter.',
    //         ]
    //     ],
    //     'telp' => [
    //         'label' => 'No Telp/Hp',
    //         'errors' => [
    //             'required' => '{field} wajib diisi.',
    //             'min_length' => '{field} minimal 6 Karakter.',
    //             'max_length' => '{field} maksimal 15 Karakter.',
    //             'is_unique' => '{field} sudah digunakan sebelumnya.'
    //         ]
    //     ],
    //     'password' => [
    //         'label' => 'Password',
    //         'errors' => [
    //             'required' => '{field} harus diisi.',
    //             'min_length' => '{field} minimal 8 Karakter.',
    //             'max_length' => '{field} maksimal 30 Karakter.'
    //         ]
    //     ],
    //     'pass_confirm' => [
    //         'label' => 'Konfirmasi Password',
    //         'errors' => [
    //             'matches' => 'Konfirmasi password tidak sesuai dengan password.'
    //         ]
    //     ]
    // ];
}
