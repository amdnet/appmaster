<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
	protected $kategoriModel;
	protected $validation;

	public function __construct()
	{
		$this->kategoriModel = new KategoriModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'kategori',
			'pageTitle' => 'Data Kategori Stall'
		];
		return view('kategori/stall', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->kategoriModel->select('id_stall, stall, username, created_at, updated_at')->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_stall . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_stall . ')"><i class="fa fa-trash-alt"></i></button>';

			$data['data'][$key] = array(
				$value->id_stall,
				$value->stall,
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
		$id = $this->request->getPost('id_stall');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->kategoriModel->where('id_stall', $id)->first();
			return $this->response->setJSON($data);
		} else {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		}
	}

	public function add()
	{
		$response = array();
		$fields['id_stall'] = $this->request->getPost('idStall');
		$fields['stall'] = $this->request->getPost('stall');
		$fields['username'] = $this->request->getPost('username');
		// $fields['created_at'] = date('Y-m-d\TH:i:s');
		$this->validation->setRules([
			'stall' => ['label' => 'Stall', 'rules' => 'required|max_length[25]'],
			'username' => ['label' => 'Username', 'rules' => 'permit_empty|max_length[25]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->kategoriModel->insert($fields)) {
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
		$fields['id_stall'] = $this->request->getPost('idStall');
		$fields['stall'] = $this->request->getPost('stall');

		$this->validation->setRules([
			'stall' => ['label' => 'Stall', 'rules' => 'required|max_length[25]'],
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->kategoriModel->update($fields['id_stall'], $fields)) {
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
		$id = $this->request->getPost('id_stall');
		if (!$this->validation->check($id, 'required|numeric')) {
			throw new \CodeIgniter\Exceptions\PageNotFoundException();
		} else {
			if ($this->kategoriModel->where('id_stall', $id)->delete()) {
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
