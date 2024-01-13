<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_user;

class User extends BaseController
{
    protected $M_user;

    public function __construct()
    {
        return $this->M_user = new M_user();
    }

    public function index()
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'title2' => 'Data Pengguna',
            'user' => $this->M_user->get_user(),
            'isi' => 'user/v_user',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function add()
    {
        $data = array(
            'title' => 'Daftar Pengguna',
            'title2' => 'Tambah Pengguna',
            'isi' => 'user/v_add',
        );
        return view('layout/v_wrapper', $data);
    }

    public function save()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required|is_unique[tbl_data_user.username]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'is_unique' => '{field} Sudah Ada, Input {field} Lain !!!'
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon_user' => [
                'label' => 'No Telepon Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jobdesk_user' => [
                'label' => 'Jobdesk User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto User',
                'rules' => 'uploaded[foto_user]|max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!',
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_user');
            //Mengganti nama file foto
            $nama_file = $foto->getRandomName();
            //Jika valid
            $data = array(
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'notelpon_user' => $this->request->getPost('notelpon_user'),
                'jobdesk_user' => $this->request->getPost('jobdesk_user'),
                'level' => $this->request->getPost('level'),
                'foto_user' => $nama_file,
            );
            // File foto disimpan di folder foto_user
            $foto->move('fotouser', $nama_file);
            $this->M_user->add($data);

            session()->setFlashdata('pesan', 'Data Pengguna Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('user'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/add'));
        }
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'Daftar Pengguna',
            'title2' => 'Edit Pengguna',
            'user' => $this->M_user->detailUser($id_user),
            'isi' => 'user/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update($id_user)
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                ]
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'nama_lengkap' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'notelpon_user' => [
                'label' => 'No Telepon Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'jobdesk_user' => [
                'label' => 'Jobdesk User',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Dipilih !!!'
                ]
            ],
            'foto_user' => [
                'label' => 'Foto User',
                'rules' => 'max_size[foto_user,1024]|mime_in[foto_user,image/png,image/jpg,image/jpeg,image/gif,image/ico]',
                'errors' => [
                    'max_size' => '{field} Max 1024 KB !!!',
                    'mime_in' => 'Format {field} Wajib PNG, JPG, JPEG, GIF, ICO!!!'
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
            $foto = $this->request->getFile('foto_user');

            if ($foto->getError() == 4) {
                //Jika foto tidak diganti
                $data = array(
                    'id_user' => $id_user,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'notelpon_user' => $this->request->getPost('notelpon_user'),
                    'jobdesk_user' => $this->request->getPost('jobdesk_user'),
                    'level' => $this->request->getPost('level'),
                );
                $this->M_user->edit($data);
            } else {
                //Menghapus foto lama
                $user = $this->M_user->detailUser($id_user);
                if ($user['foto_user'] != "") {
                    unlink('fotouser/' . $user['foto_user']);
                }
                //Mengganti nama file foto
                $nama_file = $foto->getRandomName();
                // Jika valid
                $data = array(
                    'id_user' => $id_user,
                    'username' => $this->request->getPost('username'),
                    'password' => $this->request->getPost('password'),
                    'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                    'notelpon_user' => $this->request->getPost('notelpon_user'),
                    'jobdesk_user' => $this->request->getPost('jobdesk_user'),
                    'level' => $this->request->getPost('level'),
                    'foto_user' => $nama_file,
                );
                // File foto disimpan di folder foto_produk
                $foto->move('fotouser', $nama_file);
                $this->M_user->edit($data);
            }
            session()->setFlashdata('pesan', 'Data User Berhasil Di Ganti !!!');
            return redirect()->to(base_url('user'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('user/edit/' . $id_user));
        }
    }

    public function delete($id_user)
    {
        //Menghapus foto lama
        $user = $this->M_user->detailUser($id_user);
        if ($user['foto_user'] != "") {
            unlink('fotouser/' . $user['foto_user']);
        }
        $data = [
            'id_user' => $id_user,
        ];
        $this->M_user->delete_data($data);
        session()->setFlashdata('pesan', 'Data Pengguna Berhasil Di Hapus !!!');
        return redirect()->to(base_url('user'));
    }
}
