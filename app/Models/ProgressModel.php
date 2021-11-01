<?php

namespace App\Models;

use CodeIgniter\Model;

class ProgressModel extends Model
{
    protected $table = 'data_progress';
    protected $primaryKey = 'pgs_id';
    protected $allowedFields = ['pgs_kode', 'pgs_client', 'pgs_mobil', 'pgs_polisi', 'pgs_tgl', 'pgs_location', 'pgs_progress', 'pgs_note', 'pgs_photo'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}
