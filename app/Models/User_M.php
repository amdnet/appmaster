<?php namespace App\Models;

use CodeIgniter\Model;

class User_M extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['email', 'username', 'images'];
}
