<?php namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $data = ['pageTitle' => 'Home Dashboard'];
        return view('admin/index', $data);
    }
}
