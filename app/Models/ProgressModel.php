<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'data_progress';
    protected $primaryKey = 'id_progress';
    protected $returnType = 'object';
    protected $allowedFields = ['id_progress', 'id_service', 'tgl_progress', 'id_stall', 'pgs_persen', 'pgs_note', 'pgs_photo', 'id_users', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getData()
    {
        return $this->db->table('data_progress')
            ->select('*, data_service.id_service')
            ->join('data_service', 'data_service.id_service = data_progress.id_service')
            ->join('data_stall', 'data_stall.id_stall = data_progress.id_stall')
            ->join('users', 'users.id = data_progress.id_users');
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
