<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilMerkModel;

class Mobil_Merk extends BaseController
{
	protected $mobilmerkModel;
	protected $validation;

	public function __construct()
	{
		$this->mobilmerkModel = new MobilMerkModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'mobil-merk',
			'pageTitle' => 'Merk Mobil',
			'situs' => $this->situs
		];
		return view('mobil/merk', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->mobilmerkModel->select('*, fullname')->join('users', 'users.id = mobil_merk.id_users')->findAll();
		// $result = $this->mobilmerkModel->select('id_mobil_merk, nama_mobil_merk, id_users, created_at, updated_at')->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_mobil_merk . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_mobil_merk . ')"><i class="fa fa-trash-alt"></i></button>';
			$data['data'][$key] = array(
				$value->id_mobil_merk,
				$value->nama_mobil_merk,
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
		$id = $this->request->getPost('id_mobil_merk');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->mobilmerkModel->where('id_mobil_merk', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_mobil_merk'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_merk'] = $this->request->getPost('merkMobil');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_merk' => [
				'label'  => 'Merk Mobil',
				'rules'  => 'required|min_length[2]|max_length[30]|is_unique[mobil_merk.nama_mobil_merk]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobilmerkModel->insert($fields)) {
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
		$fields['id_mobil_merk'] = $this->request->getPost('idMobil');
		$fields['nama_mobil_merk'] = $this->request->getPost('merkMobil');
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'nama_mobil_merk' => [
				'label'  => 'Merk Mobil',
				'rules'  => 'required|min_length[2]|max_length[30]|is_unique[mobil_merk.nama_mobil_merk,id,{id}]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobilmerkModel->update($fields['id_mobil_merk'], $fields)) {
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
		$id = $this->request->getPost('id_mobil_merk');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->mobilmerkModel->where('id_mobil_merk', $id)->delete()) {
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
