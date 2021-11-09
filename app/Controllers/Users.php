<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsersModel;
use Myth\Auth\Password;

class Users extends BaseController
{
    protected $usersModel;
    protected $validation;

    public function __construct()
    {
        $this->usersModel = new UsersModel();
        $this->validation =  \Config\Services::validation();
    }

    public function index()
    {
        $data = [
            'controller' => 'users',
            'pageTitle' => 'List User Account',
            'situs' => $this->situs
        ];
        return view('users/index', $data);
    }

    public function add()
    {
        $db = db_connect();
        $query   = $db->query('SELECT * FROM auth_groups')->getResult();
        $data = [
            'pageTitle' => 'Form Tambah User Akun',
            'role' => $query,
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('users/add', $data);
    }

    public function profil($id)
    {
        // $agent = $this->request->getUserAgent();
        // $data['ip'] = $this->request->getIPAddress();
        // $data['browser'] = $agent->getBrowser();
        // $this->breadcrumb->add('Home', '/');
        // $this->breadcrumb->add('Dashboard', '/dashboard');
        // $this->breadcrumb->add('Customer', '/dashboard/customer');

        // $data['breadcrumbs'] = $this->breadcrumb->render();
        $data = [
            'pageTitle' => 'User Profile',

            'detail' => $this->usersModel->getUsers($id),
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('users/profil', $data);
    }

    public function detail($id)
    {
        $db = db_connect();
        $query = $db->query('SELECT * FROM auth_groups')->getResult();
        $data = [
            'controller' => 'users',
            'pageTitle' => 'Detail User Account',
            'role' => $query,
            'detail' => $this->usersModel->getUsers($id),
            'validation' => $this->validation,
            'situs' => $this->situs
        ];
        return view('users/detail', $data);
    }

    public function login()
    {
        $userLogin = new \Myth\Auth\Models\LoginModel();
        $data = [
            'pageTitle' => 'User Login Information',
            'userLogin' => $userLogin->findAll(),
            'situs' => $this->situs
        ];
        return view('users/login', $data);
    }

    // buat user akun baru
    public function addsave()
    {
        if (!$this->validate([
            'role' => 'required',
            'email' => 'trim|required|valid_email|is_unique[users.email]',
            'username' => 'trim|required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username]',
            'fullname' => 'trim|required|min_length[3]|max_length[30]',
            'photo' => 'max_size[photo,6114]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
            'telp' => 'trim|required|min_length[6]|max_length[15]|is_unique[users.telp]|decimal',
            'alamat' => 'required|min_length[10]|max_length[100]',
            'password' => 'trim|strong_password',
            'pass_confirm' => 'matches[password]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // ambil photo
        $filePhoto = $this->request->getFile('photo');

        //==cek tidak ada photo
        if ($filePhoto->getError() == 4) {
            $namaPhoto = $filePhoto->getRandomName() . '.png';
            $filePhoto = copy(FCPATH . '/public/img/avatar.png', FCPATH . '/public/profil/' . $namaPhoto);
        } else {
            $namaPhoto = $filePhoto->getRandomName();
            // $image = \Config\Services::image('imagick')
            $image = \Config\Services::image()
                ->withFile($filePhoto)
                ->resize(1024, 1024, true)
                ->save(FCPATH . '/public/profil/' . $namaPhoto, 80);
        }

        $password = $this->request->getVar('password');
        $this->usersModel->insert([
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'photo' => $namaPhoto,
            'telp' => $this->request->getVar('telp'),
            'alamat' => $this->request->getVar('alamat'),
            'password_hash' => Password::hash($password),
            'active' => '1'
        ]);

        $userID = $this->usersModel->insertID();

        $db = db_connect();
        $builder = $db->table('auth_groups_users');
        $builder->insert([
            'group_id' => $this->request->getVar('role'),
            'user_id' => $userID
        ]);
        session()->setFlashdata('pesan', 'Data user berhasil disimpan!');

        return redirect()->to('/users');
        // return redirect()->back()->withInput();
    }

    public function editphoto($id)
    {
        if (!$this->validate([
            'photo' => 'uploaded[photo]|max_size[photo,6114]|is_image[photo]|mime_in[photo,image/jpg,image/jpeg,image/gif,image/png]',
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        // ambil photo
        $filePhoto = $this->request->getFile('photo');
        $namaPhoto = $filePhoto->getRandomName();

        // $image = \Config\Services::image('imagick')
        $image = \Config\Services::image()
            ->withFile($filePhoto)
            ->resize(1024, 1024, true)
            ->save(FCPATH . '/public/profil/' . $namaPhoto, 80);
        unlink(FCPATH . 'public/profil/' . $this->request->getVar('photoLama'));

        // if ($filePhoto->getError() == 4) {
        //     $namaPhoto = $this->request->getVar('photoLama');
        // } else {
        //     // $filePhoto = $this->request->getFile('photo');
        //     // $image = \Config\Services::image()
        //     //     ->withFile($filePhoto)
        //     //     ->resize(1024, 1024, true, 'height')
        //     //     ->save('public/profil/' . $filePhoto->getRandomName());
        //     // $filePhoto->move('public/compress');
        //     // $namaPhoto = $filePhoto->getRandomName();
        //     // $filePhoto->move('public/profil', $namaPhoto);
        //     // unlink('public/profil/' . $this->request->getVar('photoLama'));
        //     unlink($this->request->getVar('photoLama'));
        // }

        $this->usersModel->save([
            'id' => $id,
            'photo' => $namaPhoto,
        ]);
        session()->setFlashdata('pesan', 'Photo berhasil diperbaharui!');
        return redirect()->back()->withInput();
    }

    public function editdataprofil($id)
    {
        // $emailLama = $this->usersModel->getUser($this->request->getVar('emailLama'));
        // if ($emailLama['emailLama'] == $this->request->getVar('email')) {
        //     $ruleEmail = 'trim|required|valid_email';
        // } else {
        //     $ruleEmail = 'trim|required|valid_email|is_unique[users.email]';
        // }

        if (!$this->validate([
            // 'email' => $ruleEmail,
            'email' => 'trim|required|valid_email|is_unique[users.email,id,' . $id . ']',
            'username' => 'trim|required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,' . $id . ']',
            'fullname' => 'trim|required|min_length[3]|max_length[30]',
            'telp' => 'trim|required|min_length[6]|max_length[15]|decimal',
            'alamat' => 'trim|required|min_length[10]|max_length[100]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->usersModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        session()->setFlashdata('pesan', 'Data profil berhasil diperbaharui!');
        return redirect()->back()->withInput();
    }

    public function editdatadetail($id)
    {
        if (!$this->validate([
            'role' => 'required',
            'email' => 'trim|required|valid_email|is_unique[users.email,id,' . $id . ']',
            'username' => 'trim|required|alpha_numeric_punct|min_length[3]|max_length[30]|is_unique[users.username,id,' . $id . ']',
            'fullname' => 'trim|required|min_length[3]|max_length[30]',
            'telp' => 'trim|required|min_length[6]|max_length[15]|decimal',
            'alamat' => 'trim|required|min_length[10]|max_length[100]'
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $this->usersModel->save([
            'id' => $id,
            'email' => $this->request->getVar('email'),
            'username' => $this->request->getVar('username'),
            'fullname' => $this->request->getVar('fullname'),
            'telp' => $this->request->getVar('telp'),
            'alamat' => $this->request->getVar('alamat')
        ]);

        $data = array(
            'group_id' => $this->request->getVar('role')
        );
        $db = db_connect();
        $builder = $db->table('auth_groups_users');
        $builder->where('user_id', $id);
        $builder->update($data);

        session()->setFlashdata('pesan', 'Data user berhasil diperbaharui!');
        // $array_items = ['id', 'email', 'username', 'group_id', 'user_id'];
        // session()->remove($array_items);
        return redirect()->back()->withInput();
    }

    public function editpassword($id)
    {
        if (!$this->validate([
            'password' => 'required|strong_password',
            'pass_confirm' => ['label' => 'konfirmasi sandi', 'rules' => 'matches[password]']
        ])) {
            session()->setFlashdata('error', $this->validator->listErrors());
            return redirect()->back()->withInput();
        }

        $password = $this->request->getPost('password');
        $this->usersModel->save([
            'id' => $id,
            'password_hash' => Password::hash($password)
        ]);
        session()->setFlashdata('pesan', 'Password user berhasil diperbaharui!');
        return redirect()->back()->withInput();
    }

    // hapus user akun
    public function remove()
    {
        // // single delete
        // $userID = $this->usersModel->delete($id);
        // $db = db_connect();
        // $builder = $db->table('auth_groups_users');
        // $builder->delete($userID);

        $response = array();
        $id = $this->request->getVar('userid');
        $userID = $this->usersModel->delete($id);
        if (!$this->validation->check($id, 'required|numeric')) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException();
        } else {
            if ($this->usersModel->where('id', $id)->delete()) {
                $response['success'] = true;
                $response['messages'] = 'Deletion succeeded';

                $db = db_connect();
                $builder = $db->table('auth_groups_users');
                $builder->delete($userID);
            } else {
                $response['success'] = false;
                $response['messages'] = 'Deletion error!';
            }
        }
        return $this->response->setJSON($response);
    }

    public function getAll()
    {
        $result = $this->usersModel->getData();
        foreach ($result as $key => $value) {

            if ($value->active == 1) {
                $status = 'aktif';
            } else {
                $status = 'nonaktif';
            }

            // $ops = '<a href="' . base_url('users/detail/' . $value->userid) . '" class="btn btn-sm bg-primary">detail</a> <a href="' . base_url('users/remove/' . $value->userid) . '" class="btn btn-sm btn-danger">hapus</a>';
            $ops = '<a href="' . base_url('users/detail/' . $value->userid) . '" class="btn btn-sm bg-primary"><i class="fa fa-eye"></i></a> 
            <button type="button" class="btn btn-sm btn-danger" onclick="remove(' . $value->userid . ')"><i class="fa fa-trash-alt"></i></button>';
            $data['data'][$key] = array(
                $value->userid,
                $value->email,
                $value->username,
                $value->fullname,
                $value->telp,
                $value->name,
                $status,
                $ops,
            );
        }
        return $this->response->setJSON($data);
    }

    public function grid()
    {
        $db = db_connect();
        $data = [
            'controller' => 'users',
            'pageTitle' => 'List User Account',
            // 'role' => $this->usersModel->getData(),
            'role' => $this->usersModel->get()->getResult(),
            'situs' => $this->situs
        ];
        return view('grid', $data);
    }
}
