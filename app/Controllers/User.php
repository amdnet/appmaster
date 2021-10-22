<?php namespace App\Controllers;

class User extends BaseController
{
    protected $db, $builder;

    public function __construct()
    {
        $this->db = db_connect();
        $this->builder = $this->db->table('users');
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
        $data = ['pageTitle' => 'Profil User'];
        return view('user/profil', $data);
    }
}