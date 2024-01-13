<?php

namespace App\Models;

use CodeIgniter\Model;

class M_home extends Model
{
    public function tot_mutasi()
    {
        return $this->db->table('tbl_mutation')->countAll();
    }

    public function tot_produk()
    {
        return $this->db->table('tbl_data_produk')->countAll();
    }

    public function tot_pengguna()
    {
        return $this->db->table('tbl_data_user')->countAll();
    }

    public function tot_cabang()
    {
        return $this->db->table('tbl_data_cabang')->countAll();
    }
}
