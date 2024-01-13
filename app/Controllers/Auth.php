<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_auth;

class Auth extends BaseController
{
    protected $M_auth;

    public function __construct()
    {
        return $this->M_auth = new M_auth();
    }

    public function register()
    {
        $data = [
            'title' => 'Register',
            'title2' => 'Register User',
        ];
        return view('auth/v_register', $data);
    }

    public function save_register()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
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
            'level' => [
                'label' => 'Level',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'repassword' => [
                'label' => 'Retype Password',
                'rules' => 'required|matches[password]',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!',
                    'matches' => '{field} Tidak Sama !!!'
                ]
            ],
        ])) {
            // Jika valid
            $data = array(
                'username' => $this->request->getPost('username'),
                'password' => $this->request->getPost('password'),
                'nama_lengkap' => $this->request->getPost('nama_lengkap'),
                'notelpon_user' => $this->request->getPost('notelpon_user'),
                'level' => $this->request->getPost('level'),
            );
            $this->M_auth->save_register($data);

            session()->setFlashdata('pesan', 'Data User Berhasil Ditambahkan !!!');
            return redirect()->to(base_url('auth/register'));
        } else {
            // JIka tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/register'));
        }
    }

    public function login()
    {
        $data = [
            'title' => 'Login',
            'title2' => 'Gudang Web',
        ];
        return view('auth/v_login', $data);
    }

    public function cek_login()
    {
        if ($this->validate([
            'username' => [
                'label' => 'Nama Pengguna',
                'rules' => 'required',
                'error' => [
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
        ])) {
            // Jika valid
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');
            $cek = $this->M_auth->login($username, $password);
            if ($cek) {
                // Jika data cocok
                $userData = [
                    'id_user' => $cek['id_user'],
                    'username' => $cek['username'],
                    'password' => $cek['password'],
                    'nama_lengkap' => $cek['nama_lengkap'],
                    'jobdesk_user' => $cek['jobdesk_user'],
                    'notelpon_user' => $cek['notelpon_user'],
                    'level' => $cek['level'],
                    'foto_user' => $cek['foto_user'],
                ];
    
                // Set data pengguna ke dalam sesi
                session()->set('log', true);
                session()->set($userData);
    
                session()->setFlashdata('pesan', 'Login Berhasil !!!');
                return redirect()->to(base_url('home'));
            } else {
                // Jika data tidak cocok
                session()->setFlashdata('pesan', 'Login Gagal, Username Atau Password Salah !!!');
                return redirect()->to(base_url('auth/login'));
            }
        } else {
            // Jika data tidak cocok
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('auth/login'));
        }
    }

    public function logout()
    {
        session()->remove('log');
        session()->remove('username');
        session()->remove('password');
        session()->remove('nama_lengkap');
        session()->remove('jobdesk_user');
        session()->remove('notelpon_user');
        session()->remove('level');
        session()->remove('foto_user');
        session()->setFlashdata('pesan', 'Logout Sukses');
        return redirect()->to(base_url('auth/login'));
    }
}
