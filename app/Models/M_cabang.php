<?php

namespace App\Models;

use CodeIgniter\Model;

class M_cabang extends Model
{
    protected $table = 'tbl_data_cabang'; // Replace with your actual table name

    protected $primaryKey = 'id_cabang';
    
    public function get_cabang()
    {
        return $this->db->table('tbl_data_cabang')
        ->get()->getResultArray();
    }

    public function detailCabang($id_cabang)
    {
        return $this->db->table('tbl_data_cabang')
            ->where('id_cabang', $id_cabang)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_cabang')
        ->insert($data);
    }

    public function edit($data)
    {
        return $this->db->table('tbl_data_cabang')
            ->where('id_cabang', $data['id_cabang'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_data_cabang')
            ->where('id_cabang', $data['id_cabang'])
            ->delete($data);
    }

     //Data Motif Produk
     public function all_stok()
     {
         return $this->db->table('tbl_distribusi_produk')
        ->get()->getResultArray();
             
     }
}
