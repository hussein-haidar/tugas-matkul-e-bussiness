<div class="box box-primary box-solid">
<div class="box-header">
        
<a href="<?= base_url('produk/add')?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
               Tambah Data</a>  

               </div>

            <!-- /.box-header -->
<div class="box-body">
    
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
                <th>Nama Produk</th>
                <th>Nama Motif</th>
                <th>Jenis Produk</th>
                <th>Deskripsi Produk</th>
                <th>Foto Produk</th>
                <th  scope="col" width="auto">Aksi</th>
            </tr>
        </thead>
        <tbody>

            <?php $no = 1;
            foreach ($data_produk as $key => $value) {
            ?>

                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['nama_produk']; ?></td>
                    <td><?= $value['nama_motif']; ?></td>
                    <td><?= $value['jenis_produk']; ?></td>
                    <td><?= $value['deskripsi_produk']; ?></td>
                    <td><img src="<?= base_url('fotoproduk/' . $value['foto_produk'])?>" class="img-circle" width="80px" height="80px"></td>
                    <td>
                    <a href="<?= base_url('produk/edit/' . $value['id_produk'])?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                       <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_produk']?>"><i class="fa fa-fw fa-trash"></i>Delete</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>

<!-- Modal delete-->
<?php foreach ($data_produk as $key =>$value){?>
    <div class="modal fade" id="delete<?= $value['id_produk'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete <?= $title ?></h4>
              </div>
              <div class="modal-body">

                <h4><p><center>Apakah Anda Ingin Menghapus Data <b><?= $value['nama_produk']?> ?</b></center></p></h4>

              </div>

              <div class="modal-footer">
                <a href="<?= base_url('produk/delete/' . $value['id_produk']) ?>" class="btn btn-success pull-left btn-flat"> Delete</a>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
              </div>
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php } ?>

