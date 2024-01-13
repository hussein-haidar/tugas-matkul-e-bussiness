<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_motif;

class Motif_produk extends BaseController
{
    protected $M_motif;

    public function __construct()
    {
        return $this->M_motif = new M_motif();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Motif Produk',
            'title2' => 'Data Motif Produk',
            'motif_produk' => $this->M_motif->all_motif(),
            'isi' => 'motif_produk/v_motif_produk',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Data Motif Produk',
            'title2' => 'Tambah Motif Produk',
            'isi' => 'motif_produk/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama_motif' => [
                'label' => 'Nama Motif',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            // Jika valid
            $data = array(
                'nama_motif' => $this->request->getPost('nama_motif'),
            );
            $this->M_motif->add($data);

            session()->setFlashdata('pesan', 'Data Motif Produk Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('motif_produk'));
        } else {
            // JIka tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('motif_produk/add'));
        }
    }

    public function edit($id_motif)
    {
        $data = [
            'title' => 'Data Motif Produk',
            'title2' => 'Edit Motif Produk',
            'motif_produk' => $this->M_motif->detailMotif($id_motif),
            'isi' => 'motif_produk/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_motif)
    {
        if ($this->validate([
            'nama_motif' => [
                'label' => 'Nama Motif',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
             // Jika valid
             $data = array(
                'id_motif' => $id_motif,
                'nama_motif' => $this->request->getPost('nama_motif'),
            );
            $this->M_motif->edit($data);

            session()->setFlashdata('pesan', 'Data Motif Produk Berhasil Di Ganti !!!');
            return redirect()->to(base_url('motif_produk'));
        } else {
            // JIka tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('motif_produk/edit'));
        }
    }

    public function delete($id_motif)
    {
       $data = [
           'id_motif' => $id_motif,
       ];
       $this->M_motif->delete_data($data);
       session()->setFlashdata('pesan', 'Data Motif Produk Berhasil Di Hapus !!!');
       return redirect()->to(base_url('motif_produk'));
    }
    

}
