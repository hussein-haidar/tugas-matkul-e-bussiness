<?php

namespace App\Models;

use CodeIgniter\Model;

class M_laporan_admin extends Model
{
    public function get_laporan_admin()
    {
        return $this->db->table('tbl_laporan_produk')
            ->join('tbl_mutation', 'tbl_mutation.id_mutation=tbl_laporan_produk.id_mutation', 'left')
            ->join('tbl_data_produk', 'tbl_data_produk.id_produk=tbl_laporan_produk.id_produk', 'left')
            ->join('tbl_data_cabang', 'tbl_data_cabang.id_cabang=tbl_laporan_produk.id_cabang', 'left')
            ->get()->getResultArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_laporan_produk')
            ->insert($data);
    }

    public function delete_data($data)
    {
        return $this->db->table('tbl_laporan_produk')

            ->where('id_laporan', $data['id_laporan'])
            ->delete($data);
    }

      //Data Distribusi
      public function all_mutasi()
      {
          return $this->db->table('tbl_mutation')
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
