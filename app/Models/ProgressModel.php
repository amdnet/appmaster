<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'data_progress';
    protected $primaryKey = 'id_progress';
    protected $returnType = 'object';
    protected $allowedFields = ['id_service', 'tgl_progress', 'id_stall', 'pgs_persen', 'pgs_note', 'pgs_photo', 'id_users', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getData()
    {
        // return $this->db->table('data_progress')
        //     ->select('id_progress as p_id, data_progress.id_service as p_service, tgl_progress as p_tgl, data_progress.id_stall as p_stall, pgs_persen as p_persen, pgs_note as p_note, pgs_photo as p_photo, data_progress.id_users as p_users, data_progress.created_at as p_create, data_progress.updated_at as p_update')
        //     ->join('data_service', 'data_service.id_service = data_progress.id_service', 'left')
        //     ->join('data_stall', 'data_stall.id_stall = data_progress.id_stall')
        //     ->join('users', 'users.id = data_progress.id_users', 'left')
        //     ->select('users.fullname, data_stall.stall');

        return $this->db->table('data_progress')
            ->select('id_progress as p_id, tgl_progress as p_tgl, data_progress.id_stall as p_stall, pgs_persen as p_persen, pgs_note as p_note, pgs_photo as p_photo')
            ->join('data_service', 'data_service.id_service = data_progress.id_service', 'left')
            ->join('data_stall', 'data_stall.id_stall = data_progress.id_stall')
            ->select('data_stall.stall');
    }

    public function getDataModal()
    {
        return $this->db->table('data_progress')
            ->select('data_progress.id_stall as p_stall, pgs_photo as p_photo, pgs_persen as p_persen, pgs_note as p_note, data_progress.id_users as p_users, data_progress.created_at as p_create, data_progress.updated_at as p_update')
            ->join('users', 'users.id = data_progress.id_users', 'left')
            ->select('users.fullname');
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
