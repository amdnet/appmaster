<?php

namespace App\Models;

use CodeIgniter\Model;

class MobilModel extends Model
{
	protected $table = 'kat_mobil';
	protected $primaryKey = 'id_mobil';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['mobil', 'username'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
