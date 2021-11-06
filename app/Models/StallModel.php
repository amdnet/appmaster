<?php

namespace App\Models;

use CodeIgniter\Model;

class StallModel extends Model
{
	protected $table = 'data_stall';
	protected $primaryKey = 'id_stall';
	protected $returnType = 'object';
	protected $allowedFields = ['stall', 'id_users', 'created_at', 'updated_at'];
	protected $useTimestamps = true;
	protected $createdField  = 'created_at';
	protected $updatedField  = 'updated_at';
	protected $validationRules    = [];
	protected $validationMessages = [];
	protected $skipValidation     = true;
}
