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

    // public function getData()
    // {
    //     return $this->db->table('data_service')
    //         ->select('*, stall, fullname')
    //         ->join('data_stall', 'data_stall.id_stall = data_service.id_stall')
    //         ->join('users', 'users.id = data_service.id_users')
    //         ->get()->getResult();
    // }

    public function getAdvisor()
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, fullname, telp')
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '2')
            ->get()->getResult();
    }

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

    public function editMobil()
    {
        return $this->db->table('data_service')
            ->select('id_mbl_jenis, id_mbl_merk, id_mbl_tipe, id_mobil_jenis, nama_mobil_jenis, id_mobil_merk, nama_mobil_merk, id_mobil_tipe, nama_mobil_tipe')
            ->join('mobil_jenis', 'mobil_jenis.id_mobil_jenis = data_service.id_mbl_jenis')
            ->join('mobil_merk', 'mobil_merk.id_mobil_merk = data_service.id_mbl_merk')
            ->join('mobil_tipe', 'mobil_tipe.id_mobil_tipe = data_service.id_mbl_tipe')
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
