<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProgressModel;

class Progress extends BaseController
{
    protected $progressModel;
    protected $validation;

    public function __construct()
    {
        $this->progressModel = new ProgressModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'controller' => 'progress',
            'pageTitle' => 'Data Recent Progress'
        ];
        return view('progress/index', $data);
    }

    public function getAll()
    {
        $response = array();
        $data['data'] = array();
        $result = $this->progressModel->findAll();
        $no = 1;

        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->pgs_id . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->pgs_id . ')"><i class="fa fa-trash-alt"></i></button>';
            $data['data'][$key] = array(
                $no++,
                $value->pgs_kode,
                $value->pgs_client,
                $value->pgs_mobil,
                $value->pgs_polisi,
                $value->pgs_tgl,
                $value->pgs_location,
                $value->pgs_progress,
                $value->pgs_note,
                $value->pgs_photo,
                $value->created_at,
                $value->updated_at,
                $ops,
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

    public function add()
    {
        $response = array();
        $fields['id_progress'] = $this->request->getPost('idProgress');
        $fields['progress'] = $this->request->getPost('progress');
        $fields['username'] = $this->request->getPost('username');

        $this->validation->setRules([
            'progress' => [
                'label'  => 'Progress',
                'rules'  => 'required|is_unique[kat_progress.progress]|min_length[5]|max_length[35]',
                'errors' => [
                    'is_unique' => 'Nama {field} tidak boleh sama dengan yang sudah ada',
                    'min_length' => 'Minimal karakter {field} adalah 5 termasuk spasi',
                    'max_length' => 'Maksimal karakter {field} adalah 35 termasuk spasi'
                ]
            ]
        ]);

        if ($this->validation->run($fields) == FALSE) {
            $response['success'] = false;
            $response['messages'] = $this->validation->listErrors();
        } else {
            if ($this->progressModel->insert($fields)) {
                $response['success'] = true;
                $response['messages'] = 'Data has been inserted successfully';
            } else {
                $response['messages'] = 'Insertion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function edit()
    {
        $response = array();
        $fields['id_progress'] = $this->request->getPost('idProgress');
        $fields['progress'] = $this->request->getPost('progress');
        $fields['username'] = $this->request->getPost('username');

        $this->validation->setRules([
            'username' => ['label' => 'Username', 'rules' => 'required|max_length[35]'],
            'progress' => [
                'label'  => 'Progress',
                'rules'  => 'required|is_unique[kat_progress.progress]|min_length[5]|max_length[35]',
                'errors' => [
                    'is_unique' => 'Nama {field} tidak boleh sama dengan yang sudah ada',
                    'min_length' => 'Minimal karakter {field} adalah 5 termasuk spasi',
                    'max_length' => 'Maksimal karakter {field} adalah 35 termasuk spasi'
                ]
            ]
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

    public function remove()
    {
        $response = array();
        $id = $this->request->getPost('id_progress');
        if (!$this->validation->check($id, 'required|numeric')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            if ($this->progressModel->where('id_progress', $id)->delete()) {
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
