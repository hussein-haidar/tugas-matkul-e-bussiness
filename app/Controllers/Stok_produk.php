<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_stok;

use App\Models\M_motif;

use App\Models\M_produk;

use App\Models\M_cabang;

class Stok_produk extends BaseController
{
    protected $M_stok;
    protected $M_produk;
    protected $M_motif;
    protected $M_cabang;

    public function __construct()
    {
        return $this->M_stok = new M_stok();
        return $this->M_motif = new M_motif();
        return $this->M_produk = new M_produk();
        return $this->M_cabang = new M_cabang();
    }

    public function index()
    {
        $data = [
            'title' => 'Stok Produk',
            'title2' => 'Data Stok Produk',
            'data_stok' => $this->M_stok->get_stok(),
            'isi' => 'stok_produk/v_stok',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Stok Produk',
            'title2' => 'Tambah Stok Produk',
            'data_motif' => $this->M_stok->all_motif(),
            'data_produk' => $this->M_stok->all_produk(),
            'data_cabang' => $this->M_stok->all_cabang(),
            'isi' => 'stok_produk/v_add',
        );
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'jumlah_stok_produk' => [
                'label' => 'Jumlah Stok Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_masuk_produk' => [
                'label' => 'Tanggal Masuk Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_motif' => [
                'label' => 'Nama Motif',
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
                'jumlah_stok_produk' => $this->request->getPost('jumlah_stok_produk'),
                'tanggal_masuk_produk' => $this->request->getPost('tanggal_masuk_produk'),
                'id_motif' => $this->request->getPost('id_motif'),
                'id_produk' => $this->request->getPost('id_produk'),
                'id_cabang' => $this->request->getPost('id_cabang'),
            ];
            $this->M_stok->add($data);

            session()->setFlashdata('pesan', 'Data Stok Produk Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('stok_produk'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('stok_produk/add'));
        }
    }
    public function updateStock($idGudangAsal, $idGudangTujuan, $jumlah)
    {
        // Fetch stock from the source warehouse
        $stokAsal = $this->where('id_gudang', $idGudangAsal)->first();

        // Validate if there's enough stock in the source warehouse
        if ($stokAsal['jumlah'] < $jumlah) {
            throw new \Exception('Stok produk tidak mencukupi untuk pemindahan.');
        }

        // Deduct stock from the source warehouse
        $this->update($stokAsal['id_stok'], ['jumlah' => $stokAsal['jumlah'] - $jumlah]);

        // Fetch stock from the destination warehouse
        $stokTujuan = $this->where('id_gudang', $idGudangTujuan)->first();

        // Update stock in the destination warehouse or insert if not exists
        if ($stokTujuan) {
            $this->update($stokTujuan['id_stok'], ['jumlah' => $stokTujuan['jumlah'] + $jumlah]);
        } else {
            $this->insert(['id_gudang' => $idGudangTujuan, 'jumlah' => $jumlah]);
        }
    }
    public function edit($id_stok)
    {
        $data = [
            'title' => 'Stok Produk',
            'title2' => 'Edit Stok Produk',
            'data_stok' => $this->M_stok->detailStok($id_stok),
            'data_motif' => $this->M_stok->all_motif(),
            'data_produk' => $this->M_stok->all_produk(),
            'data_cabang' => $this->M_stok->all_cabang(),
            'isi' => 'stok_produk/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_stok)
    {
        if ($this->validate([
            'jumlah_stok_produk' => [
                'label' => 'Jumlah Stok Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_masuk_produk' => [
                'label' => 'Tanggal Masuk Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_motif' => [
                'label' => 'Nama Motif',
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
            // Jika valid
            $data = array(
                'id_stok' => $id_stok,
                'jumlah_stok_produk' => $this->request->getPost('jumlah_stok_produk'),
                'tanggal_masuk_produk' => $this->request->getPost('tanggal_masuk_produk'),
                'id_motif' => $this->request->getPost('id_motif'),
                'id_produk' => $this->request->getPost('id_produk'),
                'id_cabang' => $this->request->getPost('id_cabang'),
            );
            $this->M_stok->edit($data);

            session()->setFlashdata('pesan', 'Data Stok Produk Berhasil Di Ganti !!!');
            return redirect()->to(base_url('stok_produk'));
        } else {
            // JIka tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('stok_produk/edit'));
        }
    }

    public function delete($id_stok)
    {
        $data = [
            'id_stok' => $id_stok,
        ];
        $this->M_stok->delete_data($data);
        session()->setFlashdata('pesan', 'Data Stok Produk Berhasil Di Hapus !!!');
        return redirect()->to(base_url('stok_produk'));
    }
}
