<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        // $data = ['pageTitle' => 'Home Dashboard'];
        // return view('dashboard/index', $data);
        if (in_groups('Admin') || in_groups('Advisor')) {
            $data = ['pageTitle' => 'Home Dashboard'];
            return view('dashboard/index', $data);
        } elseif (in_groups('Asuransi')) {
            $data = ['pageTitle' => 'Asuransi Dashboard'];
            return view('dashboard/asuransi', $data);
        } elseif (in_groups('Client')) {
            $data = ['pageTitle' => 'Client Dashboard'];
            return view('dashboard/client', $data);
        }
    }

    public function error()
    {
        $data = ['pageTitle' => 'Pelanggaran Akses Data'];
        return view('404', $data);
    }
}
