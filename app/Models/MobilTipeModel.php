<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilTipeModel extends Model
{
	protected $table = 'mobil_tipe';
	protected $primaryKey = 'id_mobil_tipe';
	protected $returnType = 'object';
	protected $allowedFields = ['nama_mobil_tipe', 'id_users', 'created_at', 'updated_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
