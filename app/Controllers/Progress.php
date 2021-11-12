<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgressModel;
use App\Models\StallModel;

class Progress extends BaseController
{
    protected $progressModel;
    protected $validation;
    protected $stallModel;

    public function __construct()
    {
        $this->progressModel = new ProgressModel();
        $this->stallModel = new StallModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'controller' => 'progress',
            'pageTitle' => 'Data Recent Progress',
            'situs' => $this->situs
        ];
        return view('progress/index', $data);

        // $result = $this->progressModel->getData();
        // dd($result);
    }

    public function add()
    {
        // $db = db_connect();
        // $query = $db->query('SELECT * FROM auth_groups')->getResult();
        // $mobilJenis = $Mobiljenis->getResult();
        // dd($this->stallModel->select('id_stall, stall')->get()->getResult());
        $mobilJenis = new \App\Models\MobilJenisModel;
        $mobilMerk = new \App\Models\MobilMerkModel;
        $mobilTipe = new \App\Models\MobilTipeModel;
        $data = [
            'pageTitle' => 'Form Tambah Progress',
            'validation' => $this->validation,
            'stall' => $this->stallModel->select('id_stall, stall')->get()->getResult(),
            'situs' => $this->situs
        ];
        return view('progress/add', $data);
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->progressModel->getData();
        // $result = $this->progressModel
        //     ->select('*, stall')
        //     ->join('data_stall', 'data_stall.id_stall = data_progress.id_stall')
        //     ->findAll();

        foreach ($result as $key => $value) {
            $no = 1;
            $poto = '<a href="' . base_url('public/progress/' . $value->pgs_photo) . '" data-toggle="modal" data-target="#photoProfil">
        <img src="' . base_url('public/progress/' . $value->pgs_photo) . '" title="' . $value->pgs_note . '" class="img-fluid profile-user-img img-rounded"></a>';

            $data['data'][$key] = array(
                $no++,
                $value->id_servis,
                $value->tgl_progress,
                $value->stall,
                $value->fullname,
                $value->pgs_note,
                $poto
            );
        }
        return $this->response->setJSON($data);
    }
}
