<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilJenisModel extends Model
{
	protected $table = 'mobil_jenis';
	protected $primaryKey = 'id_mobil_jenis';
	protected $returnType = 'object';
	protected $allowedFields = ['nama_mobil_jenis', 'id_users', 'created_at', 'updated_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
