<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Users extends Model
{
    protected $table      = 'users';
    protected $primaryKey = 'id_users';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_users', 'fullname', 'username', 'nisn', 'nis', 'password', 'role', 'created_at', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}