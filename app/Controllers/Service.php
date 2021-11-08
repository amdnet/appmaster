<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;

class Service extends BaseController
{
    protected $serviceModel;
    protected $validation;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'controller' => 'service',
            'pageTitle' => 'Data Recent Service',
            'situs' => $this->situs
        ];
        return view('service/index', $data);
    }

    public function add()
    {
        // $db = db_connect();
        // $query = $db->query('SELECT * FROM auth_groups')->getResult();
        // $mobilJenis = $Mobiljenis->getResult();
        $mobilJenis = new \App\Models\MobilJenisModel;
        $mobilMerk = new \App\Models\MobilMerkModel;
        $mobilTipe = new \App\Models\MobilTipeModel;
        $data = [
            'controller' => 'service',
            'pageTitle' => 'Tambah Data Service Client',
            'advisor' => $this->serviceModel->getAdvisor(),
            'client' => $this->serviceModel->getClient(),
            'asuransi' => $this->serviceModel->getAsuransi(),
            'pic' => $this->serviceModel->getPIC(),
            'mobilJenis' => $mobilJenis->findAll(),
            'mobilMerk' => $mobilMerk->findAll(),
            'mobilTipe' => $mobilTipe->findAll(),
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('service/add', $data);
    }

    public function addsave()
    {
        $cekCLient = $this->request->getVar('tipeClient');
        if ($cekCLient == 1) {
            $namaPIC = ['label' => 'nama PIC', 'rules' => 'required|min_length[3]|max_length[30]'];
            $telpPIC = ['label' => 'telephone PIC', 'rules' => 'trim|required|min_length[6]|max_length[15]'];
        } else {
            $namaPIC = 'permit_empty';
            $telpPIC = 'permit_empty';
        }

        if (!$this->validate([
            'advisor' => ['label' => 'service advisor', 'rules' => 'required'],
            'client' => ['label' => 'nama konsumen', 'rules' => 'required'],
            'asuransi' => ['label' => 'perusahaan asuransi', 'rules' => 'required'],
            'tipeClient' => ['label' => 'tipe client', 'rules' => 'required'],
            'namaPIC' => $namaPIC,
            'telpPIC' => $telpPIC,
            'mobilJenis' => ['label' => 'jenis mobil', 'rules' => 'required'],
            'mobilMerk' => ['label' => 'merk mobil', 'rules' => 'required'],
            'mobilTipe' => ['label' => 'tipe mobil', 'rules' => 'required'],
            'tahunRakit' => ['label' => 'tahun rakit', 'rules' => 'required|min_length[4]|max_length[5]'],
            'noPolisi' => ['label' => 'nomor polisi', 'rules' => 'required|min_length[3]|max_length[10]'],
            'noRangka' => ['label' => 'nomor rangka', 'rules' => 'required|min_length[3]|max_length[30]'],
            'noMesin' => ['label' => 'nomor mesin', 'rules' => 'required|min_length[3]|max_length[30]']
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // $this->usersModel->insert([
        //     'email' => $this->request->getVar('email'),
        //     'username' => $this->request->getVar('username'),
        //     'fullname' => $this->request->getVar('fullname'),
        //     'telp' => $this->request->getVar('telp'),
        //     'alamat' => $this->request->getVar('alamat'),
        //     'active' => '1'
        // ]);

        // $userID = $this->usersModel->insertID();

        // $db = db_connect();
        // $builder = $db->table('auth_groups_users');
        // $builder->insert([
        //     'group_id' => $this->request->getVar('role'),
        //     'user_id' => $userID
        // ]);
        // session()->setFlashdata('pesan', 'Data user berhasil disimpan!');

        // return redirect()->to('/service');
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->serviceModel->getData();
        // $result = $this->serviceModel
        //     ->select('*, stall')
        //     ->join('data_stall', 'data_stall.id_stall = data_service.id_stall')
        //     ->findAll();

        foreach ($result as $key => $value) {
            $no = 1;
            $poto = '<a href="' . base_url('public/service/' . $value->pgs_photo) . '" data-toggle="modal" data-target="#photoProfil">
        <img src="' . base_url('public/service/' . $value->pgs_photo) . '" title="' . $value->pgs_note . '" class="img-fluid profile-user-img img-rounded"></a>';

            $data['data'][$key] = array(
                $no++,
                $value->id_servis,
                $value->tgl_service,
                $value->stall,
                $value->fullname,
                $value->pgs_note,
                $poto
            );
        }
        return $this->response->setJSON($data);
    }
}
