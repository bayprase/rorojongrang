<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class {{seederName}} extends Seeder
{
    public function run(){
        
        $dummy_data = {{fields}}

        foreach($dummy_data as $data){
            $this->db->table('{{tableName}}')->insert($data);
        }
    }
}
