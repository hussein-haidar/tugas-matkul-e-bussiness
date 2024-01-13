<div class="box box-primary box-solid">
<div class="box-header">
        
<a href="<?= base_url('mutation/add')?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
               Tambah Data</a>  

               </div>
            <!-- /.box-header -->
<div class="box-body">

<!-- alert success add data -->
<?php
    if(session()->getFlashdata('pesan')){
        echo '<div class="alert alert-success" role="alert">';
echo session()->getFlashdata('pesan');
echo '</div>';
    }
    ?>

<div class="table-responsive">
    
    <table id="example1" class="table table-bordered table-striped ">
        
        <thead>
            
            <tr>
            <th scope="col" width="1%">No</th>
                <th>Jumlah Mutasi</th>
                <th>Tanggal Mutasi</th>
                <th>Nama Produk</th>
                <th>Cabang Asal</th>
                <th>Cabang Tujuan</th>
                <th  scope="col" width="auto">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($data_mutasi as $key => $value) {
            ?>
            
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['jumlah_mutation']; ?></td>
                    <td><?= date('d-m-Y', strtotime($value['tanggal_mutation'])); ?></td>
                    <td><?= $value['nama_produk']; ?></td>
                    <td>
                      <?php
                      $branchModel = new \App\Models\M_cabang(); // Replace with your actual model name
                      $branch = $branchModel->find($value['cabang_asal']);
                      echo $branch ? $branch['nama_cabang'] : 'Unknown Branch';
                      ?>
                  </td>
                  <td>
                      <?php
                      $branchModel = new \App\Models\M_cabang(); // Replace with your actual model name
                      $branch = $branchModel->find($value['cabang_tujuan']);
                      echo $branch ? $branch['nama_cabang'] : 'Unknown Branch';
                      ?>
                  </td>
                    <td>
                      <a href="<?= base_url('mutation/edit/' . $value['id_mutation'])?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                       <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_mutation']?>"><i class="fa fa-fw fa-trash"></i>Delete</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>
<!-- Modal delete-->
<?php foreach ($data_mutasi as $key =>$value){?>
    <div class="modal fade" id="delete<?= $value['id_mutation'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete <?= $title ?></h4>
              </div>
              <div class="modal-body">

                <h4><p><center>Apakah Anda Ingin Menghapus Data <b>Mutasi Produk Ini ?</b></center></p></h4>

              </div>

              <div class="modal-footer">
              <a href="<?= base_url('mutation/delete/' . $value['id_mutation']) ?>" class="btn btn-success pull-left btn-flat"> Delete</a>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
              </div>
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php } ?>


