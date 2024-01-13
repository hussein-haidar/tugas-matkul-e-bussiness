<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_produk;

use App\Models\M_motif;

use App\Models\M_jenis;

class Produk extends BaseController
{
    protected $M_produk;
    protected $M_motif;
    protected $M_jenis;

    public function __construct()
    {
        return $this->M_produk = new M_produk();
        return $this->M_motif = new M_motif();
        return $this->M_jenis = new M_jenis();
    }
    public function index()
    {
        $data = [
            'title' => 'Daftar Produk',
            'title2' => 'Data Produk',
            'data_produk' => $this->M_produk->get_produk(),
            'isi' => 'produk/v_produk',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Data Produk',
            'title2' => 'Tambah Produk',
            'motif_produk' => $this->M_produk->all_motif(),
            'jenis_produk' => $this->M_produk->all_jenis(),
            'isi' => 'produk/v_add',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama_produk' => [
                'label' => 'Nama Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'id_motif' => [
                'label' => 'Nama Motif',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'id_jenis' => [
                'label' => 'Jenis Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'deskripsi_produk' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
          
            'foto_produk' => [
                'label' => 'Foto Produk',
                'rules' => 'uploaded[foto_produk]|max_size[foto_produk,1024]|mime_in[foto_produk,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !!!',
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO !!!'
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_produk');
            //Mengganti nama file foto
            $nama_file = $foto->getRandomName();
            //Jika valid
            $data = [
                'nama_produk' => $this->request->getPost('nama_produk'),
                'id_motif' => $this->request->getPost('id_motif'),
                'id_jenis' => $this->request->getPost('id_jenis'),
                'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                'foto_produk' => $nama_file,
            ];
            // File foto disimpan di folder foto_produk
            $foto->move('fotoproduk', $nama_file);
            $this->M_produk->add($data);

            session()->setFlashdata('pesan', 'Data Produk Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('produk'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('produk/add'));
        }
    }

    public function edit($id_produk)
    {
        $data = [
            'title' => 'Data Produk',
            'title2' => 'Edit Produk',
            'data_produk' => $this->M_produk->detailProduk($id_produk),
            'motif_produk' => $this->M_produk->all_motif(),
            'jenis_produk' => $this->M_produk->all_jenis(),
            'isi' => 'produk/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_produk)
    {
        if ($this->validate([
            'nama_produk' => [
                'label' => 'Nama Produk',
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
            'id_jenis' => [
                'label' => 'Jenis Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
           
            'deskripsi_produk' => [
                'label' => 'Deskripsi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
           
            'foto_produk' => [
                'label' => 'Foto Produk',
                'rules' => 'max_size[foto_produk,100024]|mime_in[foto_produk,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 100024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO !!!',
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_produk');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = [
                    'id_produk' => $id_produk,
                    'nama_produk' => $this->request->getPost('nama_produk'),
                    'id_motif' => $this->request->getPost('id_motif'),
                    'id_jenis' => $this->request->getPost('id_jenis'),
                    'stok_produk' => $this->request->getPost('stok_produk'),
                    'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                    'tanggal_masuk_produk' => $this->request->getPost('tanggal_masuk_produk'),
                ];
                $this->M_produk->edit($data);
            } else {
                //Menghapus foto lama
                $produk = $this->M_produk->detailProduk($id_produk);
                if ($produk['foto_produk'] != "") {
                    unlink('fotoproduk/' . $produk['foto_produk']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = array(
                    'id_produk' => $id_produk,
                    'nama_produk' => $this->request->getPost('nama_produk'),
                    'id_motif' => $this->request->getPost('id_motif'),
                    'id_jenis' => $this->request->getPost('id_jenis'),
                    'stok_produk' => $this->request->getPost('stok_produk'),
                    'deskripsi_produk' => $this->request->getPost('deskripsi_produk'),
                    'foto_produk' => $nama_file,
                    'tanggal_masuk_produk' => $this->request->getPost('tanggal_masuk_produk'),
                );
                // File foto disimpan di folder foto_produk
                $foto->move('fotoproduk', $nama_file);
                $this->M_produk->edit($data);
            }
            session()->setFlashdata('pesan', 'Data Produk Berhasil Di Ganti !!!');
            return redirect()->to(base_url('produk'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('produk/edit/' . $id_produk));
        }
    }

    public function delete($id_produk)
    {
        //Menghapus foto lama
        $produk = $this->M_produk->detailProduk($id_produk);
        if ($produk['foto_produk'] != "") {
            unlink('fotoproduk/' . $produk['foto_produk']);
        }
        $data = [
            'id_produk' => $id_produk,
        ];
        $this->M_produk->delete_data($data);
        session()->setFlashdata('pesan', 'Data Produk Berhasil Di Hapus !!!');
        return redirect()->to(base_url('produk'));
    }
}
