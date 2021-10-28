<?php

namespace App\Models;

use CodeIgniter\Model;

class AkunModel extends Model
{
    protected $table = 'users';
    // protected $primaryKey = 'id';
    // protected $returnType = 'object';
    // protected $useSoftDeletes = false;
    protected $allowedFields = ['email', 'username', 'photo', 'alamat', 'telp', 'password_hash'];
    protected $useTimestamps = true;
    // protected $createdField  = 'created_at';
    // protected $updatedField  = 'updated_at';
    // protected $validationRules    = [];
    // protected $validationMessages = [];
    // protected $skipValidation     = true;
}
