<?php

namespace App\Models;

use CodeIgniter\Model;

class M_auth extends Model
{
    public function save_register($data)
    {
        return $this->db->table('tbl_data_user')
        ->insert($data);
    }

    public function login($username, $password)
    {
        return $this->db->table('tbl_data_user')
        ->where([
            'username' => $username,
            'password' => $password,
        ])->get()->getRowArray();
    }

}
