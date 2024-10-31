<?php

namespace App\Models;

use CodeIgniter\Model;

class M_Inventory extends Model
{
    protected $table      = 'inventory';
    protected $primaryKey = 'id_inventory';

    protected $useAutoIncrement = true;
    protected $allowedFields = ['id_inventory', 'type', 'brand', 'image', 'stock', 'status', 'created_at', 'updated_at'];

    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
}