<?php

namespace App\Models;

use CodeIgniter\Model;

class StallModel extends Model
{
	protected $table = 'kat_stall';
	protected $primaryKey = 'id_stall';
	protected $returnType = 'object';
	protected $useSoftDeletes = false;
	protected $allowedFields = ['stall', 'username', 'update_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
