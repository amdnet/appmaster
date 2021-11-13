<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ServiceModel;
use App\Models\ProgressModel;

class Home extends BaseController
{
    protected $serviceModel;
    protected $progressModel;

    public function __construct()
    {
        $this->serviceModel = new ServiceModel();
        $this->progressModel = new ProgressModel();
    }

    public function index($id)
    {
        $cekID = user()->id;
        if (in_groups([1, 2])) {
            $data = ['pageTitle' => 'Admin Dashboard', 'situs' => $this->situs];
            return view('dashboard/index', $data);
        } elseif (in_groups([3, 4])) {
            $data = ['pageTitle' => 'Asuransi Dashboard', 'situs' => $this->situs];
            return view('dashboard/asuransi', $data);
        } elseif (in_groups(5)) {
            if ($cekID !== $id) {
                return redirect()->to('home/error');
            };
            $stallModel = new \App\Models\StallModel();

            $data = [
                'pageTitle' => 'Client Dashboard',
                'controller' => 'home',
                'situs' => $this->situs,
                'detail' => $this->serviceModel->viewDetail()->where('id_client', $id)->get()->getRow(),
                'advisor' => $this->serviceModel->viewAdvisor()->where('id_client', $id)->get()->getRow(),
                'asuransi' => $this->serviceModel->viewAsuransi()->where('id_client', $id)->get()->getRow(),
            ];
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

    // public function client($id)
    // {
    //     $idClient = $this->request->getVar('idClient');
    //     $cekID = user()->id;
    //     if ($cekID !== $id) {
    //         return redirect()->to('home/error');
    //     };
    //     $stallModel = new \App\Models\StallModel();
    //     $data = [
    //         'pageTitle' => 'Client Dashboard',
    //         'situs' => $this->situs,
    //         // 'detail' => $this->usersModel->getUsers($id),
    //         'detail' => $this->serviceModel->where('id_client', $id)->get()->getRow(),
    //         'advisor' => $this->serviceModel->editAdvisor(),
    //         'client' => $this->serviceModel->editClient(),
    //         'asuransi' => $this->serviceModel->editAsuransi(),
    //         'mobilEdit' => $this->serviceModel->editMobil(),
    //         'stall' => $stallModel->get()->getResult()
    //     ];
    //     return view('dashboard/client', $data);
    // }

    public function clientData()
    {
        $response = array();
        $data['data'] = array();
        $no = 1;
        // $iid = $this->request->uri->getSegment(2);
        // $uud = $this->serviceModel->select('id_service')->where('id_client', $iid)->get()->getRow();
        // $result = $this->progressModel->viewData()->where('data_progress.id_service', $uud)->get()->getResult();

        // $id = $this->request->getPost('id_service');
        $id = $this->request->uri->getSegment(3);
        $result = $this->progressModel->getData()
            ->where('data_progress.id_service', $id)
            ->get()->getResult();

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-primary" onclick="viewProgress(' . $value->p_id . ')"> detail </button>';
            $pgs_photo = '<img src="' . base_url('public/progress/' . $value->p_photo) . '" title="' . $value->p_note . '" class="img-fluid rounded profile-user-img" style="cursor:pointer" onclick="photoProgress(' . $value->p_id . ')">';

            $data['data'][$key] = array(
                $no++,
                $value->p_tgl,
                $value->stall,
                $value->p_persen . ' %',
                $value->p_note,
                $pgs_photo,
                $ops,
                $value->p_create,
                $value->p_update,
                $value->fullname
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

    public function error()
    {
        $data = ['pageTitle' => 'Pelanggaran Akses Data', 'situs' => $this->situs];
        return view('404', $data);
    }
}
