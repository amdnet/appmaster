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

    //
    // tampilan tambah data service
    //

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
            // 'pic' => $this->serviceModel->getPIC(),
            'mobilJenis' => $mobilJenis->findAll(),
            'mobilMerk' => $mobilMerk->findAll(),
            'mobilTipe' => $mobilTipe->findAll(),
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('service/add', $data);
    }

    //
    // fungsi simpan data service
    //

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

        $kode_service = $this->serviceModel->getKode();
        $this->serviceModel->insert([
            'kode_service' => $kode_service,
            'id_advisor' => $this->request->getVar('advisor'),
            'id_client' => $this->request->getVar('client'),
            'id_asuransi' => $this->request->getVar('asuransi'),
            'tipe_client' => $this->request->getVar('tipeClient'),
            'pic_nama' => $this->request->getVar('namaPIC'),
            'pic_telp' => $this->request->getVar('telpPIC'),
            'id_mbl_jenis' => $this->request->getVar('mobilJenis'),
            'id_mbl_merk' => $this->request->getVar('mobilMerk'),
            'id_mbl_tipe' => $this->request->getVar('mobilTipe'),
            'thn_rakit' => $this->request->getVar('tahunRakit'),
            'no_pol' => $this->request->getVar('noPolisi'),
            'no_rangka' => $this->request->getVar('noRangka'),
            'no_mesin' => $this->request->getVar('noMesin'),
            'id_users' => $this->request->getVar('idUsers')
        ]);
        session()->setFlashdata('pesan', 'Data service berhasil disimpan!');
        return redirect()->back()->withInput();
        // return redirect()->to('/service');
    }

    //
    // fungsi tampilan edit data service
    //

    public function edit($id)
    {
        $db = db_connect();

        $mobilJenis = new \App\Models\MobilJenisModel;
        $mobilMerk = new \App\Models\MobilMerkModel;
        $mobilTipe = new \App\Models\MobilTipeModel;

        $data = [
            'controller' => 'service',
            'pageTitle' => 'Edit Data Service Client',
            'detail' => $this->serviceModel->where('id_service', $id)->get()->getRow(),
            'advisor' => $this->serviceModel->editAdvisor(),
            'advisorMenu' => $this->serviceModel->getAdvisor(),
            'client' => $this->serviceModel->editClient(),
            'clientMenu' => $this->serviceModel->getClient(),
            'asuransi' => $this->serviceModel->editAsuransi(),
            'asuransiMenu' => $this->serviceModel->getAsuransi(),
            'mobilEdit' => $this->serviceModel->editMobil(),
            'mobilJenis' => $mobilJenis->findAll(),
            'mobilMerk' => $mobilMerk->findAll(),
            'mobilTipe' => $mobilTipe->findAll(),
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('service/edit', $data);
    }

    //
    // fungsi edit -> update data service
    //

    public function editsave($id)
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

        // $kode_service = $this->serviceModel->getKode();
        $this->serviceModel->save([
            'id_service' => $id,
            // 'kode_service' => $kode_service,
            'id_advisor' => $this->request->getPost('advisor'),
            'id_client' => $this->request->getPost('client'),
            'id_asuransi' => $this->request->getPost('asuransi'),
            'tipe_client' => $this->request->getPost('tipeClient'),
            'pic_nama' => $this->request->getPost('namaPIC'),
            'pic_telp' => $this->request->getPost('telpPIC'),
            'id_mbl_jenis' => $this->request->getPost('mobilJenis'),
            'id_mbl_merk' => $this->request->getPost('mobilMerk'),
            'id_mbl_tipe' => $this->request->getPost('mobilTipe'),
            'thn_rakit' => $this->request->getPost('tahunRakit'),
            'no_pol' => $this->request->getPost('noPolisi'),
            'no_rangka' => $this->request->getPost('noRangka'),
            'no_mesin' => $this->request->getPost('noMesin'),
            'id_users' => $this->request->getPost('idUsers')
        ]);
        session()->setFlashdata('pesan', 'Data service berhasil diperbaharui!');
        return redirect()->back()->withInput();
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
