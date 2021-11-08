<?php

namespace App\Models;

use CodeIgniter\Model;

class ServiceModel extends Model
{
    protected $table = 'data_service';
    protected $primaryKey = 'id_service';
    protected $returnType = 'object';
    protected $allowedFields = ['id_servis', 'kode_service', 'id_advisor', 'id_client', 'id_asuransi', 'tipe_client', 'pic_nama', 'pic_telp', 'id_mobil_jenis', 'id_mobil_merk', 'id_mobil_tipe', 'thn_rakit', 'no_pol', 'no_rangka', 'no_mesin', 'id_users', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getData()
    {
        return $this->db->table('data_service')
            ->select('*, stall, fullname')
            ->join('data_stall', 'data_stall.id_stall = data_service.id_stall')
            ->join('users', 'users.id = data_service.id_users')
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

    public function getClient()
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, fullname, alamat, telp')
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '6')
            ->get()->getResult();
    }

    public function getAsuransi() // perusahaan asuransi
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, username, fullname, telp') // surveyor = perwakilan asuransi
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '4')
            ->get()->getResult();
    }

    public function getPIC() // pic = staff bengkel
    {
        return $this->db->table('auth_groups_users')
            ->select('group_id, user_id, username, fullname, telp')
            ->join('users', 'users.id = auth_groups_users.user_id')
            ->where('group_id', '3')
            ->get()->getResult();
    }

    // public function getMobil() // MobilModel.php
    // {
    //     return $this->db->table('tbl_merk') // tabel merk mobil
    //         ->select('id_merk, nama_merk, warna_mobil')
    //         ->join('tbl_warna', 'tbl_warna.id_warna = tbl_merk.id_merk') // tabel warna mobil
    //         ->get()->getResult();
    // }
}
