<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_profile;

class Profile extends BaseController
{
    protected $M_profile;

    public function __construct()
    {
        return $this->M_profile = new M_profile();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Profile',
            'title2' => 'My Profile',
            'user' => $this->M_profile->get_user(),
        'isi' => 'profile/v_profile',
        ];
    return view('layout/v_wrapper',$data);
    }

    public function edit($id_user)
    {
        $data = [
            'title' => 'Data Profile',
            'title2' => 'Edit Profile',
            'user' => $this->M_profile->detailProfile($id_user),
            'isi' => 'profile/v_edit',
        ];
        return view('layout/v_wrapper', $data);
    }

    public function update_profile()
{
    $session_id_user = session()->get('id_user');

    $data = [
        'id_user' => $session_id_user,
        'username' => $this->request->getPost('username'),
        'password' => $this->request->getPost('password'),
        'nama_lengkap' => $this->request->getPost('nama_lengkap'),
        'notelpon_user' => $this->request->getPost('notelpon_user'),
        'jobdesk_user' => $this->request->getPost('jobdesk_user'),
        'level' => $this->request->getPost('level'),
    ];

    $foto = $this->request->getFile('foto_user');

    if ($foto->getError() != 4) {
        // Handle logic for file upload

        // Generate a unique name for the file
        $nama_file = $foto->getRandomName();

        // Update 'foto_user' field in $data with the file name
        $data['foto_user'] = $nama_file;

        // Move the uploaded file to the specified directory
        $foto->move('fotouser', $nama_file);
    }

    $sukses = $this->M_profile->edit($session_id_user, $data);

    if ($sukses) {
        session()->setFlashdata('pesan', 'Data Profil Berhasil Diubah !!!');
        return redirect()->to(base_url('profile'));
    } else {
        // Handle errors appropriately
        session()->setFlashdata('pesan', 'Gagal Mengubah Data Profil !!!');
        return redirect()->to(base_url('profile/edit/' . $session_id_user));
    }
    }
}
