<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'data_service';
    protected $primaryKey = 'id_service';
    protected $returnType = 'object';
    protected $allowedFields = ['kode_service', 'id_advisor', 'id_client', 'id_asuransi', 'tipe_client', 'pic_nama', 'pic_telp', 'id_mbl_jenis', 'id_mbl_merk', 'id_mbl_tipe', 'thn_rakit', 'no_pol', 'no_rangka', 'no_mesin', 'id_users', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getData()
    {
        return $this->db->table('data_service')
            ->select('id_service, kode_service, id_client, no_pol, fullname, telp, nama_mobil_jenis')
            ->join('users', 'users.id = data_service.id_client')
            ->join('mobil_jenis', 'mobil_jenis.id_mobil_jenis = data_service.id_mbl_jenis')
            ->get()->getResult();
    }

    public function getData2()
    {
        return $this->db->table('data_service')
            ->select('id_service, id_client, fullname as namaclient')
            ->join('users', 'users.id = data_service.id_client')
            ->get()->getResult();
    }

    public function getAdvisor()
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, fullname, telp')
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '2')
            ->get()->getResult();
    }

    public function editMobil()
    {
        return $this->db->table('data_service')
            ->select('id_mbl_jenis, id_mbl_merk, id_mbl_tipe, id_mobil_jenis, nama_mobil_jenis, id_mobil_merk, nama_mobil_merk, id_mobil_tipe, nama_mobil_tipe')
            ->join('mobil_jenis', 'mobil_jenis.id_mobil_jenis = data_service.id_mbl_jenis')
            ->join('mobil_merk', 'mobil_merk.id_mobil_merk = data_service.id_mbl_merk')
            ->join('mobil_tipe', 'mobil_tipe.id_mobil_tipe = data_service.id_mbl_tipe')
            ->get()->getRow();
    }

    public function viewDetail() // Home::index + Service::detail($id)
    {
        return $this->db->table('data_service')
            ->select('id_service, kode_service, id_advisor, id_client, id_asuransi, tipe_client, pic_nama, pic_telp, id_mbl_jenis, id_mbl_merk, id_mbl_tipe, thn_rakit, no_pol, no_rangka, no_mesin, data_service.id_users as s_user, data_service.created_at as s_create, data_service.updated_at as s_update')
            ->join('users', 'users.id = data_service.id_users') // user update
            ->join('mobil_jenis', 'mobil_jenis.id_mobil_jenis = data_service.id_mbl_jenis') // jenis mobil
            ->join('mobil_merk', 'mobil_merk.id_mobil_merk = data_service.id_mbl_merk') // merk mobil
            ->join('mobil_tipe', 'mobil_tipe.id_mobil_tipe = data_service.id_mbl_tipe') // tipe mobil
            ->select('fullname, nama_mobil_jenis, nama_mobil_merk, nama_mobil_tipe');
    }

    public function viewAdvisor() // Home::index
    {
        return $this->db->table('data_service')
            ->select('id_advisor, users.fullname, users.telp') // nama & telp advisor = staff konsumen
            ->join('users', 'users.id = data_service.id_advisor');
    }

    public function viewAsuransi() // Home::index
    {
        return $this->db->table('data_service')
            ->select('id_asuransi, users.username, users.fullname, users.telp') // nama asuransi dan surveyor = perwakilan asuransi
            ->join('users', 'users.id = data_service.id_asuransi');
    }

    public function viewClient() // Service::detail($id)
    {
        return $this->db->table('data_service')
            ->select('id_client, users.username, users.fullname, users.alamat, users.telp') // nama asuransi dan surveyor = perwakilan asuransi
            ->join('users', 'users.id = data_service.id_client');
    }

    // public function viewStall()
    // {
    //     return $this->db->table('data_service')
    //         ->select('id_asuransi, users.username, users.fullname, users.telp') // nama asuransi dan surveyor = perwakilan asuransi
    //         ->join('users', 'users.id = data_service.id_asuransi');
    // }

    public function getAsuransi() // perusahaan asuransi
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, username, fullname, telp') // surveyor no.4 = perwakilan asuransi
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '3')
            ->get()->getResult();
    }

    public function getClient()
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, fullname, alamat, telp')
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '5')
            ->get()->getResult();
    }

    public function editAdvisor()
    {
        return $this->db->table('data_service')
            ->select('id_advisor, fullname, telp')
            ->join('users', 'users.id = data_service.id_advisor')
            ->get()->getRow();
    }

    public function editAsuransi()
    {
        return $this->db->table('data_service')
            ->select('id_asuransi, username, fullname, telp') // surveyor no.4 = perwakilan asuransi
            ->join('users', 'users.id = data_service.id_asuransi')
            ->get()->getRow();
    }

    public function editClient()
    {
        return $this->db->table('data_service')
            ->select('id_client, fullname, alamat, telp')
            ->join('users', 'users.id = data_service.id_client')
            ->get()->getRow();
    }



    // public function getPIC() // pic = staff bengkel
    // {
    //     return $this->db->table('auth_groups_users')
    //         ->select('group_id, user_id, username, fullname, telp')
    //         ->join('users', 'users.id = auth_groups_users.user_id')
    //         ->where('group_id', '3')
    //         ->get()->getResult();
    // }

    function getKode()
    {
        $db = db_connect();
        $query = $db->query('SELECT kode_service FROM data_service WHERE id_service IN (SELECT MAX(id_service) FROM data_service)');
        $result = $query->getresult();

        foreach ($result as $hasil) {
            $kodeServis = $hasil->kode_service;
        }

        if (empty($kodeServis)) {
            $nourut = '00';;
        } else {
            $nourut = (int) substr($kodeServis, 3, 2);
        }

        if ($nourut != $nourut) {
            $urutan = 1;
        } else {
            $urutan = $nourut;
            $urutan++;
        }

        $kodeUnik = 'AK-' . sprintf("%02s", $urutan);
        return $kodeUnik;
    }
}
