<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilTipeModel;

class Mobil_Tipe extends BaseController
{
	protected $mobiltipeModel;
	protected $validation;

	public function __construct()
	{
		$this->mobiltipeModel = new MobilTipeModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'mobil-tipe',
			'pageTitle' => 'Tipe Mobil',
			'situs' => $this->situs
		];
		return view('mobil/tipe', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->mobiltipeModel
			->select('*, fullname')
			->join('users', 'users.id = mobil_tipe.id_users')
			->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_mobil_tipe . ')"><i class="fa fa-pencil-alt"></i> 
			</button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_mobil_tipe . ')"><i class="fa fa-trash-alt"></i></button>';
			$data['data'][$key] = array(
				$value->id_mobil_tipe,
				$value->nama_mobil_tipe,
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
		$id = $this->request->getPost('id_mobil_tipe');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->mobiltipeModel->where('id_mobil_tipe', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_mobil_tipe'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_tipe'] = $this->request->getPost('tipeMobil');
		// $fields['username'] = $this->request->getPost('username');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_tipe' => [
				'label'  => 'Tipe Mobil',
				'rules'  => 'required|min_length[2]|max_length[30]|is_unique[mobil_tipe.nama_mobil_tipe]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobiltipeModel->insert($fields)) {
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
		$fields['id_mobil_tipe'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_tipe'] = $this->request->getPost('tipeMobil');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_tipe' => [
				'label'  => 'Tipe Mobil',
				'rules'  => 'required|min_length[2]|max_length[30]|is_unique[mobil_tipe.nama_mobil_tipe,id,{id}]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobiltipeModel->update($fields['id_mobil_tipe'], $fields)) {
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
		$id = $this->request->getPost('id_mobil_tipe');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->mobiltipeModel->where('id_mobil_tipe', $id)->delete()) {
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
