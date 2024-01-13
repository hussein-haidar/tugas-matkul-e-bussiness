<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_home;

class Home extends BaseController
{
    protected $M_home;

    public function __construct()
    {
        return $this->M_home = new M_home();
    }

    public function index()
    {
        $data = [
            'title' => 'Administrator',
            'title2' => 'Dashboard',
            'tot_mutasi' => $this->M_home->tot_mutasi(),
            'tot_produk' => $this->M_home->tot_produk(),
            'tot_pengguna' => $this->M_home->tot_pengguna(),
            'tot_cabang' => $this->M_home->tot_cabang(),
        'isi' => 'v_home',
        ];
    return view('layout/v_wrapper',$data);
    }

    public function pemilik()
    {
        $data = [
            'title' => 'Pemilik',
            'title2' => 'Dashboard',
        'isi' => 'v_pemilik',
        ];
    return view('layout/v_wrapper',$data);
    }
}
