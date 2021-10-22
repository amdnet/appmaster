<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MobilModel;

class Mobil extends BaseController
{
	protected $mobilModel;
	protected $validation;

	public function __construct()
	{
		$this->mobilModel = new MobilModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'mobil',
			'pageTitle' => 'Data Kategori Mobil'
		];
		return view('kategori/mobil', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->mobilModel->select('id_mobil, mobil, username, created_at, updated_at')->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_mobil . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_mobil . ')"><i class="fa fa-trash-alt"></i></button>';

			$data['data'][$key] = array(
				$value->id_mobil,
				$value->mobil,
				$value->username,
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
		$id = $this->request->getPost('id_mobil');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->mobilModel->where('id_mobil', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_mobil'] = $this->request->getPost('idStall');
		$fields['mobil'] = $this->request->getPost('mobil');
		$fields['username'] = $this->request->getPost('username');
		// $fields['created_at'] = date('Y-m-d\TH:i:s');
		$this->validation->setRules([
			'mobil' => ['label' => 'Stall', 'rules' => 'required|max_length[25]'],
			'username' => ['label' => 'Username', 'rules' => 'permit_empty|max_length[25]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobilModel->insert($fields)) {
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
		$fields['id_mobil'] = $this->request->getPost('idStall');
		$fields['mobil'] = $this->request->getPost('mobil');

		$this->validation->setRules([
			'mobil' => ['label' => 'Stall', 'rules' => 'required|max_length[25]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->mobilModel->update($fields['id_mobil'], $fields)) {
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
		$id = $this->request->getPost('id_mobil');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->mobilModel->where('id_mobil', $id)->delete()) {
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
