<?php

namespace App\Controllers;

class Profil extends BaseController
{
    public function index()
    {
        $userInfo = new \Myth\Auth\Models\UserModel();
        $data = [
            'pageTitle' => 'Profile User',
            'userInfo' => $userInfo->findAll(),
            'situs' => $this->situs
        ];

        // $data = ['pageTitle' => 'List Data User'];
        return view('profil/index', $data);
    }
}
