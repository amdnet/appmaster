<?php

namespace App\Controllers;

use App\Models\Konsumen_M;
use Config\Services;
use PHPUnit\Util\PHP\DefaultPhpProcess;

class Konsumen extends BaseController
{
    public function index()
    {
        $data = ['pageTitle' => 'List Data Konsumen'];
        return view('konsumen/index', $data);
        // return view('konsumen/index');
    }

    public function hapus()
    {
        $request = Services::request();
        $user_model = new Konsumen_M($request);
        // $user_model = $this->user_model;
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getVar('id');
            $hapus = $user_model->hapus($id_user);
            if ($hapus) {
                $this->output['sukses'] = true;
                $this->output['pesan']  = 'Data telah dihapus';
            }

            echo json_encode($this->output);
        }
    }

    public function ajaxList()
    {
        $request = Services::request();
        $datatable = new Konsumen_M($request);

        if ($request->getMethod(true) === 'POST') {
            $lists = $datatable->getDatatables();
            $data = [];
            foreach ($lists as $list) {
                $row = [];
                $row[] = $list->id;
                $row[] = $list->nama;
                $row[] = $list->telp;
                $row[] = $list->alamat;
                $row[] = $list->kota;
                $row[] = $list->kodepos;
                $row[] = '<a class="btn btn-primary  btn-sm" href="lihat/' . $list->id . '"><i class="fas fa-eye"></i></a> <a class="btn btn-success  btn-sm" href="edit/' . $list->id . '"><i class="fas fa-pencil-alt"></i></a> <a class="btn btn-danger btn-sm" href="hapus/' . $list->id . '"><i class="fas fa-trash-alt"></i></a>';
                $data[] = $row;
            }

            $output = [
                'draw' => $request->getPost('draw'),
                'recordsTotal' => $datatable->countAll(),
                'recordsFiltered' => $datatable->countFiltered(),
                'data' => $data
            ];

            echo json_encode($output);
        }
    }
}
