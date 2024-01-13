<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_laporan_admin;

class Laporan_admin extends BaseController
{
    protected $M_laporan_admin;

    public function __construct()
    {
        return $this->M_laporan_admin = new M_laporan_admin();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Laporan Produk',
            'title2' => 'Data Laporan  Produk',
            'laporan_admin' => $this->M_laporan_admin->get_laporan_admin(),

            'isi' => 'laporan_admin/v_laporan_admin',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Data Laporan Produk',
            'title2' => 'Tambah Laporan  Produk',
            'data_mutasi' => $this->M_laporan_admin->all_mutasi(),
            'data_produk' => $this->M_laporan_admin->all_produk(),
            'data_cabang' => $this->M_laporan_admin->all_cabang(),
            'isi' => 'laporan_admin/v_add',
        );
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'id_mutation' => [
                'label' => 'Jumlah Mutasi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_mutation' => [
                'label' => 'Tanggal Mutasi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_cabang' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            //Jika valid
            $data = [
                'id_mutation' => $this->request->getPost('id_mutation'),
                'id_mutation' => $this->request->getPost('id_mutation'),
                'id_produk' => $this->request->getPost('id_produk'),
                'id_cabang' => $this->request->getPost('id_cabang'),
            ];
            session()->setFlashdata('pesan', 'Data Laporan Produk Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('laporan_admin'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('laporan_admin/add'));
        }
    }

    public function delete($id_laporan)
    {
        $data = [
            'id_laporan' => $id_laporan,
        ];
        $this->M_laporan_admin->delete_data($data);
        session()->setFlashdata('pesan', 'Data Laporan Produk Berhasil Di Hapus !!!');
        return redirect()->to(base_url('laporan_admin'));
    }

    public function cetak_laporan()
    {
        $data = [
            'title3' => 'Cetak Laporan',
            'data_laporan_admin' => $this->M_laporan_admin->get_laporan_admin(),
            'data_mutasi' => $this->M_laporan_admin->all_mutasi(),
            'data_produk' => $this->M_laporan_admin->all_produk(),
            'data_cabang' => $this->M_laporan_admin->all_cabang(),
        ];
        return view('laporan_admin/v_cetak_laporan_admin', $data);
    }
}
