<?php

namespace App\Controllers;

class Crud extends BaseController
{
    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Form Tambah User Akun',
            'role' => $query,
            'situs' => $this->situs
        ];
        return view('crud', $data);
    }
}
