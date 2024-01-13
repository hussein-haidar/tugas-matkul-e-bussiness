<?php

namespace App\Models;

use CodeIgniter\Model;

class M_user extends Model
{
    public function get_user()
    {
        return $this->db->table('tbl_data_user')
            ->get()->getResultArray();
    }

    public function detailUser($id_user)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $id_user)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_user')
        ->insert($data);
    }

    public function edit($data)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $data['id_user'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_data_user')
            ->where('id_user', $data['id_user'])
            ->delete($data);
    }

}
