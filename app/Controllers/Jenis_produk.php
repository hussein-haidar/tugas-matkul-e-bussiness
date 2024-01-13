<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_jenis;


class Jenis_produk extends BaseController
{
    protected $M_jenis;

    public function __construct()
    {
        return $this->M_jenis = new M_jenis();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Jenis Produk',
            'title2' => 'Data Jenis Produk',
            'jenis_produk' => $this->M_jenis->all_jenis(),
            'isi' => 'jenis_produk/v_jenis_produk',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Data Jenis Produk',
            'title2' => 'Tambah Jenis Produk',
            'isi' => 'jenis_produk/v_add',
        );
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'jenis_produk' => [
                'label' => 'Jenis Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ]))  {
            //Jika valid
            $data = array(
                'jenis_produk' => $this->request->getPost('jenis_produk'),
            );
            
            $this->M_jenis->add($data);

            session()->setFlashdata('pesan', 'Data Jenis Produk Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('jenis_produk'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('jenis_produk/add'));
        }
    }

    public function edit($id_jenis)
    {
        $data = [
            'title' => 'Data Jenis Produk',
            'title2' => 'Edit Jenis Produk',
            'jenis_produk' => $this->M_jenis->detailJenis($id_jenis),
            'isi' => 'jenis_produk/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_jenis)
    {
        if ($this->validate([
            'jenis_produk' => [
                'label' => 'Jenis Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
             // Jika valid
             $data = array(
                'id_jenis' => $id_jenis,
                'jenis_produk' => $this->request->getPost('jenis_produk'),
            );
            $this->M_jenis->edit($data);

            session()->setFlashdata('pesan', 'Data Jenis Produk Berhasil Di Ganti !!!');
            return redirect()->to(base_url('jenis_produk'));
        } else {
            // JIka tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('jenis_produk/edit'));
        }
    }

    public function delete($id_jenis)
    {
      
       $data = [
           'id_jenis' => $id_jenis,
       ];
       $this->M_jenis->delete_data($data);
       session()->setFlashdata('pesan', 'Data Jenis Produk Berhasil Di Hapus !!!');
       return redirect()->to(base_url('jenis_produk'));
    }
    
    }

