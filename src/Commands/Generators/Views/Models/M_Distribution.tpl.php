<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Distribution extends Model
{
    protected $table      = 'distribution';
    protected $primaryKey = 'id_distribution';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_distribution', 'id_inventory', 'id_users', 'assignee', 'a_lot', 'descriptions', 'status', 'created_at', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}