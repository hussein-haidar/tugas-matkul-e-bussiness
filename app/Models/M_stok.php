<?php

namespace App\Models;

use CodeIgniter\Model;

class M_stok extends Model
{
    protected $primaryKey = 'id_stok'; // Replace with your actual primary key

    protected $allowedFields = [
        'jumlah_stok_produk',
        'tanggal_masuk_produk',
        'id_stok',
        'id_produk',
        'id_cabang',
        // Add other fields that are allowed
    ];
    protected $table   = 'tbl_stok_produk';

    public function get_stok()
    {
        return $this->db->table('tbl_stok_produk')
            ->join('tbl_motif_produk', 'tbl_motif_produk.id_motif=tbl_stok_produk.id_motif', 'left')
            ->join('tbl_data_produk', 'tbl_data_produk.id_produk=tbl_stok_produk.id_produk', 'left')
            ->join('tbl_data_cabang', 'tbl_data_cabang.id_cabang=tbl_stok_produk.id_cabang', 'left')
            ->get()->getResultArray();
    }
    public function get_stok2()
    {
        return $this->db->table('tbl_mutation')
            ->join('tbl_data_produk', 'tbl_data_produk.id_produk=tbl_mutation.id_produk', 'left')
            ->get()->getResultArray();
    }

    public function getMutationData($id_mutation)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $id_mutation)
            ->get()
            ->getRowArray();
    }

    public function revertStock($cabangAsal, $cabangTujuan, $id_Produk, $jumlah)
    {
        // Revert stock quantity for source branch (cabang_asal)
        $this->where('id_cabang', $cabangAsal)
            ->where('id_produk', $id_Produk)
            ->set('jumlah_stok_produk', 'jumlah_stok_produk + ' . $jumlah, false)
            ->update();

        // Revert stock quantity for destination branch (cabang_tujuan)
        $this->where('id_cabang', $cabangTujuan)
            ->where('id_produk', $id_Produk)
            ->set('jumlah_stok_produk', 'jumlah_stok_produk - ' . $jumlah, false)
            ->update();
    }

    public function transferStock($cabangAsal, $cabangTujuan, $id_Produk, $jumlah)
    {
        // Update stock quantity for source branch (cabang_asal)
        $this->where('id_cabang', $cabangAsal)
            ->where('id_produk', $id_Produk)
            ->set('jumlah_stok_produk', 'jumlah_stok_produk - ' . $jumlah, false)
            ->update();

        // Update stock quantity for destination branch (cabang_tujuan)
        $this->where('id_cabang', $cabangTujuan)
            ->where('id_produk', $id_Produk)
            ->set('jumlah_stok_produk', 'jumlah_stok_produk + ' . $jumlah, false)
            ->update();
    }

    public function detailMutation($id_mutation)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $id_mutation)
            ->get()->getRowArray();
    }
    public function detailStok($id_stok)
    {
        return $this->db->table('tbl_stok_produk')
            ->where('id_stok', $id_stok)
            ->get()->getRowArray();
    }
    public function detailStok2($id_stok)
    {
        return $this->db->table('tbl_stok_produk')
            ->where('id_stok', $id_stok)
            ->get()->getRowArray();
    }
    public function add($data)
    {
        $this->db->table('tbl_stok_produk')->insert($data);
    }

    public function add2($data)
    {
        $this->db->table('tbl_mutation')->insert($data);
    }

    public function updateStock($id_cabang, $id_produk, $jumlah_stok_produk)
    {
        // Update the stock quantity in the database
        $this->set('jumlah_stok_produk', 'jumlah_stok_produk + ' . $jumlah_stok_produk, false);
        $this->where('id_produk', $id_produk);
        $this->where('id_cabang', $id_cabang);
        $this->update('tbl_stok_produk');
        // You may want to add error handling and validation here
    }
    public function saveDistribution($data)
    {
        // Insert the distribution details into the database
        $this->db->table('tbl_mutation')->insert($data);
        // You may want to add error handling and validation here
    }

    public function edit($data)
    {
        return $this->db->table('tbl_stok_produk')

            ->where('id_stok', $data['id_stok'])
            ->update($data);
    }
    public function edit2($data)
    {
        return $this->db->table('tbl_mutation')

            ->where('id_mutation', $data['id_mutation'])
            ->update($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_stok_produk')

            ->where('id_stok', $data['id_stok'])
            ->delete($data);
    }
    public function getStockQuantity($id_produk, $id_cabang)
    {
        return $this->where(['id_produk' => $id_produk, 'id_cabang' => $id_cabang])->get()->getRow('jumlah_stok_produk');
    }

    public function delete_data2($data)
    {
        return $this->db->table('tbl_mutation')
            ->where('id_mutation', $data['id_mutation'])
            ->delete($data);
    }

    //Data Motif Produk
    public function all_motif()
    {
        return $this->db->table('tbl_motif_produk')
            ->get()->getResultArray();
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
}
