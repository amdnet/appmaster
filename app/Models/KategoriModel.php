<?php

namespace App\Models;

use CodeIgniter\Model;

class KategoriModel extends Model
{
	protected $table = 'kat_stall';
	protected $primaryKey = 'id_stall';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['stall', 'username'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	// protected $deletedField  = 'deleted_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
