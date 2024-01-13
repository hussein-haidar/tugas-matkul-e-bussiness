<?php

namespace App\Models;

use CodeIgniter\Model;

class M_mutation extends Model
{
    protected $table = 'tbl_mutation'; // Adjust the table name accordingly
    protected $primaryKey = 'id_mutation'; // Adjust the primary key if necessary
    protected $allowedFields = ['cabang_asal', 'cabang_tujuan', 'jumlah_mutation', 'tanggal_mutation', 'id_produk'];


    public function get_mutation()
    {
        return $this->db->table('tbl_stok_produk')
            ->join('tbl_data_produk', 'tbl_data_produk.id_produk=tbl_stok_produk.id_produk', 'left')
            ->join('tbl_data_cabang', 'tbl_data_cabang.id_cabang=tbl_stok_produk.id_cabang', 'left')
            ->get()->getResultArray();
    }

    public function detailStok($id_mutation)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $id_mutation)
            ->get()->getRowArray();
    }
    public function detailMutation($id_mutation)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $id_mutation)
            ->get()->getRowArray();
    }
    
    public function add($data)
    {
       $this->db->table('tbl_mutation')->insert($data);
    }
    

    public function edit($data)
    {
        return $this->db->table('tbl_stok_produk')

            ->where('id_stok', $data['id_stok'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $data['id_mutation'])
            ->delete($data);
    }

    //Data Produk
    public function all_produk()
    {
        return $this->db->table('tbl_data_produk')
            ->get()->getResultArray();
    }

    //Data Produk
    public function all_cabang()
    {
        return $this->db->table('tbl_data_cabang')
            ->get()->getResultArray();
    }

    //Data Stok
    public function all_stok()
    {
        return $this->db->table('tbl_stok_produk')
            ->get()->getResultArray();
    }
}
