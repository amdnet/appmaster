<?php namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;

class Users extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('users');
        // $this->userModel = new UserModel();
		// $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $this->builder->select('users.id as userid, email, username, created_at, updated_at');
        // $this->builder->select('users.id as userid, email, username, name');
        // $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = users.id');
        // $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        
        $data['pageTitle'] = 'User List';
        $data['users'] = $query->getResult();
        return view('user/index', $data);
    }

    public function add()
    {
        $response = array();
		$fields['id'] = $this->request->getPost('idSUsers');
		$fields['email'] = $this->request->getPost('email');
		$fields['username'] = $this->request->getPost('username');

		$this->validation->setRules([
			'email' => ['label' => 'Stall', 'rules' => 'required|max_length[35]'],
			'username' => ['label' => 'Username', 'rules' => 'permit_empty|max_length[35]'],
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

    public function detail($id)
    {
        $data = ['pageTitle' => 'User Detail'];
        $this->builder->select('users.id as userid', 'username', 'email', 'name');
        $this->builder->join('auth_groups_users', 'auth_groups_users.user_id = userid');
        $this->builder->join('auth_groups', 'auth_groups.id = auth_groups_users.group_id');
        $query = $this->builder->get();
        
        $data['users'] = $query->getResult();
        return view('user/detail', $data);
    }

    public function login()
    {
        $userLogin = new \Myth\Auth\Models\LoginModel();
        $data = [
            'pageTitle' => 'User Login',
            'userLogin' => $userLogin->findAll()
        ];
        return view('user/login', $data);
    }

    public function profil()
    {
        // $data = ['pageTitle' => 'Profil User'];
        $agent = $this->request->getUserAgent();

        $data['pageTitle'] = 'Profil User';
        $data['ip'] = $this->request->getIPAddress();
        $data['browser'] = $agent->getBrowser();
        return view('user/profil', $data);
    }
}