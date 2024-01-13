<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_laporan_pemilik ;

class Pemilik extends BaseController
{
    protected $M_laporan_pemilik ;

    public function __construct()
    {
        return $this->M_laporan_pemilik = new M_laporan_pemilik ();
    }

    public function index()
    {
        $data = [
            'title' => 'Pemilik',
            'title2' => 'Dashboard',
            'laporan_pemilik' => $this->M_laporan_pemilik->get_laporan_pemilik(),
        'isi' => 'v_pemilik',
        ];
    return view('layout/v_wrapper',$data);
    }

}
