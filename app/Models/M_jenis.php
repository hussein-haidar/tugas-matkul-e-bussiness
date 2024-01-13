<?php

namespace App\Models;

use CodeIgniter\Model;

class M_jenis extends Model
{
    public function all_jenis()
    {
        return $this->db->table('tbl_jenis_produk')
        ->get()->getResultArray();
    }

    public function detailJenis($id_jenis)
    {
        return $this->db->table('tbl_jenis_produk')
            ->where('id_jenis', $id_jenis)
            ->get()->getRowArray();
    }


    public function add($data)
    {
      return  $this->db->table('tbl_jenis_produk')
        ->insert($data);
    }

    public function edit($data)
    {
        return $this->db->table('tbl_jenis_produk')
            ->where('id_jenis', $data['id_jenis'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_jenis_produk')
            ->where('id_jenis', $data['id_jenis'])
            ->delete($data);
    }

}
