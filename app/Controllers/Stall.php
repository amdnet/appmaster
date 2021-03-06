<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\StallModel;

class Stall extends BaseController
{
	protected $stallModel;
	protected $validation;

	public function __construct()
	{
		$this->stallModel = new StallModel();
		$this->validation =  \Config\Services::validation();
	}

	public function index()
	{
		$data = [
			'controller' => 'stall',
			'pageTitle' => 'Data Kategori Stall',
			'situs' => $this->situs
		];
		return view('kategori/stall', $data);
	}

	public function getAll()
	{
		$response = array();
		$data['data'] = array();
		$result = $this->stallModel
			->select('*, fullname')
			->join('users', 'users.id = data_stall.id_users')
			->findAll();

		foreach ($result as $key => $value) {
			$ops = '<button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->id_stall . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->id_stall . ')"><i class="fa fa-trash-alt"></i></button>';

			$data['data'][$key] = array(
				$value->id_stall,
				$value->stall,
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
		$id = $this->request->getPost('id_stall');
		if ($this->validation->check($id, 'required|numeric')) {
			$data = $this->stallModel->where('id_stall', $id)->first();
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
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'stall' => [
				'label'  => 'Stall',
				'rules'  => 'required|is_unique[data_stall.stall]|min_length[5]|max_length[35]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->stallModel->insert($fields)) {
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
		$fields['id_users'] = user()->id;

		$this->validation->setRules([
			'id_users' => ['label' => 'id_users', 'rules' => 'required|max_length[35]'],
			'stall' => [
				'label'  => 'Stall',
				'rules'  => 'required|is_unique[data_stall.stall,id,{id}]|min_length[5]|max_length[30]'
			]
		]);

		if ($this->validation->run($fields) == FALSE) {
			$response['success'] = false;
			$response['messages'] = $this->validation->listErrors();
		} else {
			if ($this->stallModel->update($fields['id_stall'], $fields)) {
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
			if ($this->stallModel->where('id_stall', $id)->delete()) {
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
