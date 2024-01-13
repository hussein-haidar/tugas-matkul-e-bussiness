<?php

namespace App\Controllers;

use CodeIgniter\Controller;

use App\Models\M_stok;

use App\Models\M_produk;

use App\Models\M_cabang;

use App\Models\M_mutation;

class Mutation extends BaseController
{
    protected $M_stok;
    protected $M_produk;
    protected $M_cabang;
    protected $M_mutation;

    public function __construct()
    {
        return $this->M_stok = new M_stok();
        return $this->M_produk = new M_produk();
        return $this->M_cabang = new M_cabang();
        return $this->M_mutation = new M_mutation();
    }

    public function index()
    {
        $data = [
            'title' => 'Mutasi Produk',
            'title2' => 'Data Mutasi',
            'data_mutasi' => $this->M_stok->get_stok2(),
            'isi' => 'mutation/v_mutation',
        ];
        return view('layout/v_wrapper', $data);
    }
    public function fetchStock()
        {
            // Get id_cabang and id_produk from the request
            $id_cabang = $this->request->getGet('id_cabang');
            $id_produk = $this->request->getGet('id_produk');

            // Fetch the available stock from your model (adjust method name accordingly)
            $availableStock = $this->M_stok->getStockAtBranch($id_produk, $id_cabang);

            // Return the result as JSON
            return $this->response->setJSON(['available_stock' => $availableStock]);
        }
        public function getStock()
    {
        $id_produk = $this->request->getVar('id_produk');
        $id_cabang = $this->request->getVar('id_cabang');

        $stokModel = new M_stok();
        $available_stock = $stokModel->getStockQuantity($id_produk, $id_cabang);
        return $this->response->setJSON(['available_stock' => $available_stock]);
    }
    public function add()
{
    $data_produk = $this->M_stok->all_produk();
    
    // Assuming you have a selected product's ID, replace 'selected_product_id' with the actual variable or value
    $selected_product_id = $this->request->getPost('id_produk');
    $selected_branch_id = $this->request->getPost('id_cabang');
    $stock_limit = $this->M_stok->getStockQuantity($selected_product_id, $selected_branch_id);

    $data = array(
        'title' => 'Mutasi Produk',
        'title2' => 'Tambah Mutasi',
        'data_produk' => $data_produk,
        'data_cabang' => $this->M_stok->all_cabang(),
        'jumlah_stok' => $stock_limit,
        'isi' => 'mutation/v_add',
    );
    
    return view('layout/v_wrapper', $data);
}

    public function save()
    {
        if ($this->validate([
            'jumlah_mutation' => [
                'label' => 'Jumlah Mutasi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_mutation' => [
                'label' => 'Tanggal Mutasi Produk',
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
            'cabang_asal' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'cabang_tujuan' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ])) {
            //Mengambil file foto dari form input
           
            //Jika valid
            $data = [
                
                'jumlah_mutation' => $this->request->getPost('jumlah_mutation'),
                'tanggal_mutation' => $this->request->getPost('tanggal_mutation'),
                'cabang_asal' => $this->request->getPost('cabang_asal'),
                'cabang_tujuan' => $this->request->getPost('cabang_tujuan'),
                'id_produk' => $this->request->getPost('id_produk'),
                
            ];

            $this->M_stok->add2($data);
            
            $this->M_stok->transferStock(
                $data['cabang_asal'],
                $data['cabang_tujuan'],
                $data['id_produk'],
                $data['jumlah_mutation'],
            );
            $successMessage = 'Stock berhasil dipindahkan sebanyak ' . $data['jumlah_mutation'] . '.';
        session()->setFlashdata('pesan', $successMessage);

            return redirect()->to(base_url('mutation'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('mutation/add'));
        }
    }
    public function edit($id_mutation)
    
    {
        $data_produk = $this->M_stok->all_produk();
    
        // Assuming you have a selected product's ID, replace 'selected_product_id' with the actual variable or value
        $selected_product_id = $this->request->getPost('id_produk');
        $selected_branch_id = $this->request->getPost('id_cabang');
        $stock_limit = $this->M_stok->getStockQuantity($selected_product_id, $selected_branch_id);
    
        $data = array(
            'title' => 'Mutasi Data',
            'title2' => 'Edit Mutasi',
            'data_produk' => $data_produk,
            'data_cabang' => $this->M_stok->all_cabang(),
            'data_mutation' => $this->M_stok->detailMutation($id_mutation),
            'jumlah_stok' => $stock_limit,
            'isi' => 'mutation/v_edit',
        );
        
        return view('layout/v_wrapper', $data);
    }

    public function update($id_mutation)
    {
        $validationRules = [
            'jumlah_mutation' => [
                'label' => 'Jumlah Mutasi Produk',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'tanggal_mutation' => [
                'label' => 'Tanggal Mutasi Produk',
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
            'cabang_asal' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
            'cabang_tujuan' => [
                'label' => 'Nama Cabang',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} Wajib Diisi !!!'
                ]
            ],
        ];
    
        if ($this->validate($validationRules)) {
            $existingData = $this->M_stok->getMutationData($id_mutation);
    
            // Revert previous stock changes
            $this->M_stok->revertStock(
                $existingData['cabang_asal'],
                $existingData['cabang_tujuan'],
                $existingData['id_produk'],
                $existingData['jumlah_mutation']
            );
    
            // Apply new changes
            $data = [
                'id_mutation' => $id_mutation,
                'jumlah_mutation' => $this->request->getPost('jumlah_mutation'),
                'tanggal_mutation' => $this->request->getPost('tanggal_mutation'),
                'cabang_asal' => $this->request->getPost('cabang_asal'),
                'cabang_tujuan' => $this->request->getPost('cabang_tujuan'),
                'id_produk' => $this->request->getPost('id_produk'),
            ];
    
            $this->M_stok->edit2($data);
            $this->M_stok->transferStock(
                $data['cabang_asal'],
                $data['cabang_tujuan'],
                $data['id_produk'],
                $data['jumlah_mutation']
            );
    
            $successMessage = 'Stock berhasil dipindahkan sebanyak ' . $data['jumlah_mutation'] . '.';
            session()->setFlashdata('pesan', $successMessage);
    
            return redirect()->to(base_url('mutation'));
        } else {
            // Jika tidak valid
            session()->setFlashdata('errors', \Config\Services::validation()->getErrors());
            return redirect()->to(base_url('mutation/edit/' . $id_mutation));
        }
    }

        public function delete($id_mutation)
            {
            
            $data = [
                'id_mutation' => $id_mutation,
            ];
            $this->M_stok->delete_data2($data);
            session()->setFlashdata('pesan', 'Data Mutasi Produk Berhasil Di Hapus !!!');
            return redirect()->to(base_url('mutation'));
            }
    }

