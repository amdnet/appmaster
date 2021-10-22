<?php namespace App\Controllers;

class Crud extends BaseController
{
    public $user_model;
    public $output = [
        'sukses'    => false,
        'pesan'     => '',
        'data'      => []
    ];

    public function __construct()
    {
        $this->user_model = new \App\Models\Crud_M();
    }

    public function index()
    {
        return view('crud');
    }

    public function tambah()
    {
        $user_model = $this->user_model;
        if ($this->request->isAJAX()) {
            $data = [
                'nama_user' => $this->request->getVar('nama_user'),
                'alamat'    => $this->request->getVar('alamat')
            ];

            $simpan = $user_model->tambah($data);
            if ($simpan) {
                $this->output['sukses'] = true;
                $this->output['pesan']  = 'Data ditemukan';
            }

            echo json_encode($this->output);
        }
    }

    public function edit()
    {
        $user_model = $this->user_model;
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getVar('id_user');
            $result = $user_model->edit($id_user);
            if ($result) {
                $this->output['sukses'] = true;
                $this->output['pesan']  = 'Data ditemukan';
                $this->output['data']   = $result;
            }

            echo json_encode($this->output);
        }
    }

    public function update()
    {
        $user_model = $this->user_model;
        if ($this->request->isAJAX()) {
            $data = [
                'nama' => $this->request->getVar('nama'),
                'telp'    => $this->request->getVar('telp')
            ];
            $id_user = $this->request->getVar('id');
            $simpan = $user_model->ubah($data, $id_user);
            if ($simpan) {
                $this->output['sukses'] = true;
                $this->output['pesan']  = 'Data diupdate';
            }

            echo json_encode($this->output);
        }
    }

    public function hapus()
    {
        $user_model = $this->user_model;
        if ($this->request->isAJAX()) {
            $id_user = $this->request->getVar('id_user');
            $hapus = $user_model->hapus($id_user);
            if ($hapus) {
                $this->output['sukses'] = true;
                $this->output['pesan']  = 'Data telah dihapus';
            }

            echo json_encode($this->output);
        }
    }

    public function dt_users()
    {
        $user_model = $this->user_model;
        $where = ['id !=' => 0];
        $column_order   = array('', 'nama', 'telp');
        $column_search  = array('nama', 'telp');
        $order = array('nama' => 'ASC');
        $list = $user_model->get_datatables('konsumen', $column_order, $column_search, $order, $where);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $lists) {
            $no++;
            $row    = array();
            $row[]  = $no;
            $row[]  = $lists->nama_user;
            $row[]  = $lists->alamat;
            $row[]  = '<a class="btn btn-primary  btn-sm" href="lihat/'. $list->id .'"><i class="fas fa-eye"></i></a> <a class="btn btn-success  btn-sm" href="edit/'. $list->id .'"><i class="fas fa-pencil-alt"></i></a> <a class="btn btn-danger btn-sm" href="hapus/'. $list->id .'"><i class="fas fa-trash-alt"></i></a>';

            $data[] = $row;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $user_model->count_all('konsumen', $where),
            "recordsFiltered" => $user_model->count_filtered('konsumen', $column_order, $column_search, $order, $where),
            "data" => $data,
        );

        echo json_encode($output);
    }

    //--------------------------------------------------------------------

}

