<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilMerkModel extends Model
{
	protected $table = 'mobil_merk';
	protected $primaryKey = 'id_mobil_merk';
	protected $returnType = 'object';
	protected $allowedFields = ['nama_mobil_merk', 'id_users', 'created_at', 'updated_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
}
