<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $data = ['pageTitle' => 'Dashboard Admin', 'situs' => $this->situs];
        // return view('dashboard/index', $data);
        if (in_groups([1, 2])) {
            $data = ['pageTitle' => 'Admin Dashboard', 'situs' => $this->situs];
            return view('dashboard/index', $data);
        } elseif (in_groups([3, 4])) {
            $data = ['pageTitle' => 'Asuransi Dashboard', 'situs' => $this->situs];
            return view('dashboard/asuransi', $data);
        } elseif (in_groups(5)) {
            $data = ['pageTitle' => 'Client Dashboard', 'situs' => $this->situs];
            return view('dashboard/client', $data);
        }
    }

    // public function asuransi()
    // {
    //     $data = ['pageTitle' => 'Dashboard Asuransi', 'situs' => $this->situs];
    //     return view('dashboard/asuransi', $data);
    // }

    // public function client()
    // {
    //     $data = ['pageTitle' => 'Dashboard Client', 'situs' => $this->situs];
    //     return view('dashboard/client', $data);
    // }

    public function error()
    {
        $data = ['pageTitle' => 'Pelanggaran Akses Data', 'situs' => $this->situs];
        return view('404', $data);
    }
}
