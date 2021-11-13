<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgressModel;
use App\Models\ServiceModel;
use App\Models\StallModel;

class Progress extends BaseController
{
    protected $progressModel;
    protected $validation;
    protected $serviceModel;
    protected $stallModel;

    public function __construct()
    {
        $this->progressModel = new ProgressModel();
        $this->serviceModel = new ServiceModel();
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
    }

    public function add($id)
    {
        $data = [
            'pageTitle' => 'Form Tambah Progress',
            'situs' => $this->situs,
            'validation' => $this->validation,
            'service' => $this->serviceModel->select('id_service')->where('id_service', $id)->get()->getRow(),
            'stall' => $this->stallModel->select('id_stall, stall')->get()->getResult()
        ];
        return view('progress/add', $data);
    }

    public function edit($id)
    {
        // dd($this->progressModel->editData()->where('id_progress', $id)->get()->getRow());
        $data = [
            'pageTitle' => 'Form Edit Progress',
            'situs' => $this->situs,
            'validation' => $this->validation,
            'progress' => $this->progressModel->editData()->where('id_progress', $id)->get()->getRow(),
            'stall' => $this->stallModel->select('id_stall, stall')->get()->getResult()
        ];
        return view('progress/edit', $data);
    }

    public function save()
    {
        if (!$this->validate([
            'tgl_progress' => ['label' => 'Tanggal progress', 'rules' => 'required'],
            'id_stall' => ['label' => 'Lokasi stall', 'rules' => 'required'],
            'pgs_persen' => ['label' => 'Persen progress', 'rules' => 'required'],
            'pgs_note' => ['label' => 'Catatan progress', 'rules' => 'required|min_length[10]|max_length[255]'],
            'pgs_photo' => ['label' => 'Photo progress', 'rules' => 'uploaded[pgs_photo]|max_size[pgs_photo,6114]|is_image[pgs_photo]|mime_in[pgs_photo,image/jpg,image/jpeg,image/gif,image/png]']
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $id = $this->request->getVar('id_service');
        $filePhoto = $this->request->getFile('pgs_photo');
        $namaPhoto = $filePhoto->getRandomName();
        $image = \Config\Services::image()
            ->withFile($filePhoto)
            ->resize(1080, 768, true)
            ->save(FCPATH . '/public/progress/' . $namaPhoto, 80);

        $this->progressModel->insert([
            'id_service' => $id,
            'tgl_progress' => $this->request->getVar('tgl_progress'),
            'id_stall' => $this->request->getVar('id_stall'),
            'pgs_persen' => $this->request->getVar('pgs_persen'),
            'pgs_note' => $this->request->getVar('pgs_note'),
            'pgs_photo' => $namaPhoto,
            'id_users' => user()->id
        ]);
        session()->setFlashdata('pesan', 'Data progres berhasil disimpan!');
        return redirect()->to('/service/detail/' . $id);
    }

    public function update($id)
    {
        if (!$this->validate([
            'tgl_progress' => ['label' => 'Tanggal progress', 'rules' => 'required'],
            'id_stall' => ['label' => 'Lokasi stall', 'rules' => 'required'],
            'pgs_persen' => ['label' => 'Persen progress', 'rules' => 'required'],
            'pgs_note' => ['label' => 'Catatan progress', 'rules' => 'required|min_length[10]|max_length[255]'],
            'pgs_photo' => ['label' => 'Photo progress', 'rules' => 'uploaded[pgs_photo]|max_size[pgs_photo,6114]|is_image[pgs_photo]|mime_in[pgs_photo,image/jpg,image/jpeg,image/gif,image/png]']
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $pgs = $this->request->getVar('id_progress');
        $srv = $this->request->getVar('id_service');
        $filePhoto = $this->request->getFile('pgs_photo');
        $namaPhoto = $filePhoto->getRandomName();
        $image = \Config\Services::image()
            ->withFile($filePhoto)
            ->resize(1080, 768, true)
            ->save(FCPATH . 'public/progress/' . $namaPhoto, 80);
        unlink(FCPATH . 'public/progress/' . $this->request->getVar('photoLama'));

        $this->progressModel->save([
            'id_progress' => $pgs,
            'id_service' => $srv,
            'tgl_progress' => $this->request->getVar('tgl_progress'),
            'id_stall' => $this->request->getVar('id_stall'),
            'pgs_persen' => $this->request->getVar('pgs_persen'),
            'pgs_note' => $this->request->getVar('pgs_note'),
            'pgs_photo' => $namaPhoto,
            'id_users' => user()->id
        ]);
        session()->setFlashdata('pesan', 'Data progres berhasil diperbaharui!');
        return redirect()->to('/service/detail/' . $srv);
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->progressModel->getData();

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
