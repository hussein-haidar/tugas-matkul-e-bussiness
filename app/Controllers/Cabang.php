<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_cabang;

class Cabang extends BaseController
{
    protected $M_cabang;

    public function __construct()
    {
        return $this->M_cabang = new M_cabang();
    }
    
    public function index()
    {
        $data = [
            'title' => 'Daftar Cabang',
            'title2' => 'Data Cabang',
            'data_cabang' => $this->M_cabang->get_cabang(),
        'isi' => 'cabang/v_cabang',
        ];
    return view('layout/v_wrapper',$data);
    }
    
    public function add()
    {
        $data = array(
            'title' => 'Data Cabang',
            'title2' => 'Tambah Data Cabang',
            'isi' => 'cabang/v_add',
        );
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'nama_cabang' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon_cabang' => [
                'label' => 'No Telpon Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'alamat_cabang' => [
                'label' => 'Alamat Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'foto_cabang' => [
                'label' => 'Foto Cabang',
                'rules' => 'uploaded[foto_cabang]|max_size[foto_cabang,100024]|mime_in[foto_cabang,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'uploaded' => '{field} Wajib Diisi !!!',
                    'max_size' => '{field} Max 100024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO !!!',
                    ]
                ],
        ]))  {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_cabang');
            //Mengganti nama file foto
            $nama_file = $foto->getRandomName();
            //Jika valid
            $data = array(
                'nama_cabang' => $this->request->getPost('nama_cabang'),
                'notelpon_cabang' => $this->request->getPost('notelpon_cabang'),
                'alamat_cabang' => $this->request->getPost('alamat_cabang'),
                'foto_cabang' => $nama_file,
            );
            // File foto disimpan di folder foto_cabang
            $foto->move('fotocabang', $nama_file);
            $this->M_cabang->add($data);

            session()->setFlashdata('pesan', 'Data Cabang Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('cabang'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('cabang/add'));
        }
    }

    public function edit($id_cabang)
    {
        $data = [
            'title' => 'Data Cabang',
            'title2' => 'Edit Cabang',
            'data_cabang' => $this->M_cabang->detailCabang($id_cabang),
            'isi' => 'cabang/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_cabang)
    {
        if ($this->validate([
            'nama_cabang' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon_cabang' => [
                'label' => 'No Telpon Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'alamat_cabang' => [
                'label' => 'Alamat Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'foto_cabang' => [
                'label' => 'Foto Cabang',
                'rules' => 'max_size[foto_cabang,100024]|mime_in[foto_cabang,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 100024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO !!!',
                    ]
                ],
        ])) 
        {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_cabang');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = array(
                    'id_cabang' => $id_cabang,
                    'nama_cabang' => $this->request->getPost('nama_cabang'),
                    'notelpon_cabang' => $this->request->getPost('notelpon_cabang'),
                    'alamat_cabang' => $this->request->getPost('alamat_cabang'),
                );
                $this->M_cabang->edit($data);
            } else {
                //Menghapus foto lama
                $cabang = $this->M_cabang->detailCabang($id_cabang);
                if ($cabang['foto_cabang'] != "") {
                    unlink('fotocabang/' . $cabang['foto_cabang']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = array(
                    'id_cabang' => $id_cabang,
                    'nama_cabang' => $this->request->getPost('nama_cabang'),
                    'notelpon_cabang' => $this->request->getPost('notelpon_cabang'),
                    'alamat_cabang' => $this->request->getPost('alamat_cabang'),
                    'foto_cabang' => $nama_file,
                );
                // File foto disimpan di folder foto_cabang
                $foto->move('fotocabang', $nama_file);
                $this->M_cabang->edit($data);
            }
            session()->setFlashdata('pesan', 'Data Cabang Berhasil Di Ganti !!!');
            return redirect()->to(base_url('cabang'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('cabang/edit/' . $id_cabang));
        }
    }

     public function delete($id_cabang)
    {
       //Menghapus foto lama
       $cabang = $this->M_cabang->detailCabang($id_cabang);
       if ($cabang['foto_cabang'] != "") {
           unlink('fotocabang/' . $cabang['foto_cabang']);
       }
       $data = [
           'id_cabang' => $id_cabang,
       ];
       $this->M_cabang->delete_data($data);
       session()->setFlashdata('pesan', 'Data Cabang Berhasil Di Hapus !!!');
       return redirect()->to(base_url('cabang'));
    }
    }
