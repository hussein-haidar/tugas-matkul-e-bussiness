<?php

namespace App\Models;

use CodeIgniter\Model;

class M_produk extends Model
{
    public function get_produk()
    {
        return $this->db->table('tbl_data_produk')
            ->join('tbl_motif_produk', 'tbl_motif_produk.id_motif=tbl_data_produk.id_motif', 'left')
            ->join('tbl_jenis_produk', 'tbl_jenis_produk.id_jenis=tbl_data_produk.id_jenis', 'left')
            ->get()->getResultArray();
    }

    public function detailProduk($id_produk)
    {
        return $this->db->table('tbl_data_produk')
            ->where('id_produk', $id_produk)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_data_produk')

            ->insert($data);
    }

    public function edit($data)
    {
        return $this->db->table('tbl_data_produk')

            ->where('id_produk', $data['id_produk'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_data_produk')

            ->where('id_produk', $data['id_produk'])
            ->delete($data);
    }

    //Data Motif Produk
    public function all_motif()
    {
        return $this->db->table('tbl_motif_produk')
            ->get()->getResultArray();
    }

    //Data Jenis Produk
    public function all_jenis()
    {
        return $this->db->table('tbl_jenis_produk')
            ->get()->getResultArray();
    }
}
