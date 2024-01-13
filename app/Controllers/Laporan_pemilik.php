<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_laporan_pemilik;

class Laporan_pemilik extends BaseController
{
    protected $M_laporan_pemilik;

    public function __construct()
    {
        return $this->M_laporan_pemilik = new M_laporan_pemilik();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Laporan Produk',
            'title2' => 'Data Laporan  Produk',
            'laporan_pemilik' => $this->M_laporan_pemilik->get_laporan_pemilik(),
            'isi' => 'laporan_pemilik/v_laporan_pemilik',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function cetak_laporan()
    {
        $data = [
            'title3' => 'Cetak Laporan',
            'data_laporan_pemilik' => $this->M_laporan_pemilik->get_laporan_pemilik(),
            'data_mutasi' => $this->M_laporan_pemilik->all_mutasi(),
            'data_produk' => $this->M_laporan_pemilik->all_produk(),
            'data_cabang' => $this->M_laporan_pemilik->all_cabang(),
        ];
        return view('laporan_pemilik/v_cetak_laporan_pemilik', $data);
    }
}
