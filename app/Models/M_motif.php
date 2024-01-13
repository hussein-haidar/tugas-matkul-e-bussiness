<?php

namespace App\Models;

use CodeIgniter\Model;

class M_motif extends Model
{
    public function all_motif()
    {
        return $this->db->table('tbl_motif_produk')
        ->get()->getResultArray();
    }

    public function detailMotif($id_motif)
    {
        return $this->db->table('tbl_motif_produk')
            ->where('id_motif', $id_motif)
            ->get()->getRowArray();
    }

    public function add($data)
    {
        $this->db->table('tbl_motif_produk')
        ->insert($data);
    }

    public function edit($data)
    {
        $this->db->table('tbl_motif_produk')
            ->where('id_motif', $data['id_motif'])
            ->update($data);
    }

    public function delete_data($data)
    {
        $this->db->table('tbl_motif_produk')
            ->where('id_motif', $data['id_motif'])
            ->delete($data);
    }

}
