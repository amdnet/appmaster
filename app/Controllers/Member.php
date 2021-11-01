<?php

namespace App\Controllers;

use App\Controllers\BaseController;

use App\Models\MemberModel;

class Member extends BaseController
{

    protected $memberModel;
    protected $validation;

    public function __construct()
    {
        $this->memberModel = new MemberModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $db = db_connect();
        $query   = $db->query('SELECT id, name FROM auth_groups')->getResult();
        $data = [
            'controller' => 'member',
            'pageTitle' => 'Form Member User Akun',
            'role' => $query,
            'validation' => \Config\Services::validation()
        ];
        return view('member', $data);
    }

    public function getAll()
    {
        $result = $this->memberModel->getData();
        foreach ($result as $key => $value) {
            $ops = '<button type="button" class="btn btn-sm btn-info" onclick="view(' . $value->userid . ')"><i class="fa fa-eye"></i></button> <button type="button" class="btn btn-sm btn-success" onclick="edit(' . $value->userid . ')"><i class="fa fa-pencil-alt"></i></button> <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->userid . ')"><i class="fa fa-trash-alt"></i></button>';
            $data['data'][$key] = array(
                $value->userid,
                $value->email,
                $value->username,
                $value->name,
                $value->telp,
                $value->alamat,
                $ops,
            );
        }
        return $this->response->setJSON($data);
    }

    public function getOne()
    {
        $response = array();
        $userid = $this->request->getPost('userid');
        if ($this->validation->check($userid, 'required|numeric')) {
            $data = $this->memberModel->getData->where('userid', $userid)->first();
            return $this->response->setJSON($data);
        } else {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        }
    }
}
