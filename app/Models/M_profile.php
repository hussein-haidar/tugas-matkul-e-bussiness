<?php

namespace App\Models;

use CodeIgniter\Model;

class M_profile extends Model
{
    protected $table = 'tbl_data_user'; // Adjust the table name accordingly
    protected $primaryKey = 'id_user'; // Adjust the primary key if necessary
    
    public function get_user()
    {
        return $this->db->table('tbl_data_user')
            ->get()->getResultArray();
    }

    public function detailProfile($id_user)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function edit($id_user, $data)
    {
        // Dapatkan instance Query Builder
        $builder = $this->db->table('tbl_data_user');
        
        // Gunakan metode where() pada instance Query Builder
        $builder->where('id_user', $id_user);
        
        // Lakukan update
        $result = $builder->update($data);
    
        if (!$result) {
            // Catat query dan pesan error
            log_message('error', 'Error saat mengupdate data pengguna: ' . $this->db->error()['message']);
            return false;
        }
    
        return true;
    }

}