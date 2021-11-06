<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilJenisModel;

class Mobil_Jenis extends BaseController
{
	protected $mobiljenisModel;
	protected $validation;

	public function __construct()
	{
		$this->mobiljenisModel = new MobilJenisModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'mobil-jenis',
			'pageTitle' => 'Jenis Mobil',
			'situs' => $this->situs
		];
		return view('mobil/jenis', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->mobiljenisModel
			->select('*, fullname')
			->join('users', 'users.id = mobil_jenis.id_users')
			->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_mobil_jenis . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_mobil_jenis . ')"><i class="fa fa-trash-alt"></i></button>';
			$data['data'][$key] = array(
				$value->id_mobil_jenis,
				$value->nama_mobil_jenis,
				$value->fullname,
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
		$id = $this->request->getPost('id_mobil_jenis');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->mobiljenisModel->where('id_mobil_jenis', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_mobil_jenis'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_jenis'] = $this->request->getPost('jenisMobil');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_jenis' => [
				'label'  => 'Jenis Mobil',
				'rules'  => 'required|min_length[2]|max_length[30]|is_unique[mobil_jenis.nama_mobil_jenis]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobiljenisModel->insert($fields)) {
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
		$fields['id_mobil_jenis'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_jenis'] = $this->request->getPost('jenisMobil');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_jenis' => [
				'label'  => 'Jenis Mobil',
				'rules'  => 'required|is_unique[mobil_jenis.nama_mobil_jenis,id,{id}]|min_length[2]|max_length[30]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobiljenisModel->update($fields['id_mobil_jenis'], $fields)) {
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
		$id = $this->request->getPost('id_mobil_jenis');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->mobiljenisModel->where('id_mobil_jenis', $id)->delete()) {
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
