<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\ProgressModel;

class Service extends BaseController
{
    protected $serviceModel;
    protected $progressModel;
    protected $validation;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->progressModel = new ProgressModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        // $db = db_connect();
        // $query = $db->table('users')
        //     ->select('fullname, telp')
        // ->join('users', 'users.id = data_service.id_advisor')
        // ->whereIn('id', array('1', '2'))
        //     ->get()->getResult();
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
        // return redirect()->back()->withInput();
        return redirect()->to('/service');
    }

    //
    // fungsi tampilan detail data service dan list progress
    //

    public function detail($id)
    {
        // $db = db_connect();
        // $progress = $db->table('data_progress')
        // dd($progress);

        // $uri = new \CodeIgniter\HTTP\URI();
        // dd($this->request->uri->getSegment(3));
        // $tested = $uri->getFragment(2);
        // dd($tested);

        // $progress = $this->progressModel->getData()
        //     ->where('data_progress.id_service', $id)
        //     ->groupBy('data_progress.id_service')
        //     ->get()->getResult();

        $progress = $this->progressModel->getDataModal()
            ->where('data_progress.id_service', $id)
            ->groupBy('data_progress.id_service')
            ->get()->getRow();

        $stallModel = new \App\Models\StallModel();

        $data = [
            'controller' => 'service',
            'pageTitle' => 'Detail Data Service :: Progress',
            'detail' => $this->serviceModel->where('id_service', $id)->get()->getRow(),
            'progress' => $progress,
            'advisor' => $this->serviceModel->editAdvisor(),
            'client' => $this->serviceModel->editClient(),
            'asuransi' => $this->serviceModel->editAsuransi(),
            'mobilEdit' => $this->serviceModel->editMobil(),
            'validation' => $this->validation,
            'stall' => $stallModel->get()->getResult(),
            'situs' => $this->situs
        ];
        return view('service/detail', $data);
    }

    //
    // fungsi tampilan edit data service
    //

    public function edit($id)
    {
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
        session()->setFlashdata('pesan', 'Data service berhasil diperbaharui!');
        return redirect()->back()->withInput();
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->serviceModel->getData();

        foreach ($result as $key => $value) {
            $ops = '<a href="' . base_url('service/detail/' . $value->id_service) . '" class="btn btn-sm bg-primary"><i class="fa fa-eye"></i></a> <a href="' . base_url('service/edit/' . $value->id_service) . '" class="btn btn-sm bg-info"><i class="fa fa-pencil-alt"></i></a>
            <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_service . ')"><i class="fa fa-trash-alt"></i></button>';

            $data['data'][$key] = array(
                $value->id_service,
                $value->kode_service,
                $value->fullname,
                $value->telp,
                $value->no_pol,
                $value->nama_mobil_jenis,
                $ops
            );
        }
        return $this->response->setJSON($data);
    }

    public function getProgress()
    {
        $response = array();
        $data['data'] = array();
        $no = 1;
        $id = $this->request->uri->getSegment(3);
        $result = $this->progressModel->getData()
            ->where('data_progress.id_service', $id)
            ->groupBy('data_progress.id_service')
            ->get()->getResult();

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-success" onclick="editProgress(' . $value->p_id . ')"><i class="fa fa-pencil-alt"></i> 
			</button> <button type="button" class="btn btn-sm btn-danger" onclick="delProgress(' . $value->p_id . ')"><i class="fa fa-trash-alt"></i></button>';

            $pgs_photo = '<img src="' . base_url('public/progress/' . $value->p_photo) . '" title="' . $value->p_note . '" class="img-fluid rounded profile-user-img" style="cursor:pointer" onclick="photoProgress(' . $value->p_photo . ')" data-toggle="modal" data-target="#photoProgress" >';

            $data['data'][$key] = array(
                $no++,
                $value->p_tgl,
                $value->stall,
                $value->p_persen . ' %',
                $value->p_note,
                $pgs_photo,
                $ops
            );
        }
        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();
        $id = $this->request->getPost('id_progress');
        if ($this->validation->check($id, 'required|numeric')) {
            $data = $this->progressModel->where('id_progress', $id)->first();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }

    public function getPhoto()
    {
        $filePhoto = $this->request->getFile('pgs_photo');
        $namaPhoto = $filePhoto->getRandomName();
        $image = \Config\Services::image()
            ->withFile($filePhoto)
            ->resize(1080, 768, true)
            ->save(FCPATH . 'public/progress/' . $namaPhoto, 80);
        unlink(FCPATH . 'public/progress/' . $this->request->getPost('photoLama'));
    }



    public function editProgress()
    {
        $photoFile = $this->request->getFile('pgs_photo');
        $photoLama = $this->request->getPost('photoLama');
        $namaPhoto = $this->request->getPost('photoBaru');
        // if ($photoFile != $photoLama) {
        //     $namaPhoto = $this->request->getPost('pgs_photo');
        //     $image = \Config\Services::image()
        //         ->withFile($photoFile)
        //         ->resize(1080, 768, true)
        //         ->save(FCPATH . '/public/progress/' . $namaPhoto, 80);
        //     unlink(FCPATH . '/public/progress/' . $photoLama);
        // } else {
        //     $namaPhoto = $photoLama;
        // }

        $response = array();
        $fields['id_progress'] = $this->request->getPost('id_progress');
        $fields['tgl_progress'] = $this->request->getPost('tgl_progress');
        $fields['id_stall'] = $this->request->getPost('id_stall');
        $fields['pgs_persen'] = $this->request->getPost('pgs_persen');
        $fields['pgs_note'] = $this->request->getPost('pgs_note');
        $fields['pgs_photo'] = $photoFile;
        $fields['id_users'] = user()->id;

        $this->validation->setRules([
            'tgl_progress' => ['label'  => 'Tanggal progress', 'rules'  => 'required'],
            'id_stall' => ['label'  => 'Lokasi stall progress', 'rules'  => 'required'],
            'pgs_persen' => ['label'  => 'Persen progress', 'rules'  => 'required'],
            'pgs_note' => ['label'  => 'Catatan progres', 'rules'  => 'required'],
            'pgs_photo' => ['label'  => 'Photo progres', 'rules'  => 'uploaded[pgs_photo]'],
            // 'photoBaru' => ['label'  => 'Photo progres', 'rules'  => 'required'],
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->progressModel->update($fields['id_progress'], $fields)) {
                $response['success'] = true;
                $response['messages'] = 'Successfully updated';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Update error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function delProgress()
    {
        $response = array();
        $id = $this->request->getPost('id_progress');
        if (!$this->validation->check($id, 'required|numeric')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            if ($this->stallModel->where('id_progress', $id)->delete()) {
                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';
            } else {
                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }
        return $this->response->setJSON($response);
    }
}
