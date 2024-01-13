<div class="box box-primary box-solid">
<div class="box-header">
        
<a href="<?= base_url('user/add')?>" class="btn-sm"><i class="fa fa-plus-circle" aria-hidden="true"></i>
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
                <th>Nama Pengguna</th>
                <th>Nama Lengkap</th>
                <th>No Telpon User</th>
                <th>Jobdesk User</th>
                <th>Level</th>
                <th>Foto User</th>
                <th  scope="col" width="auto">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no = 1;
            foreach ($user as $key => $value) {
            ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= $value['username']; ?></td>
                    <td><?= $value['nama_lengkap']; ?></td>
                    <td><?= $value['notelpon_user']; ?></td>
                    <td><?= $value['jobdesk_user']; ?></td>
                    <td><?php if ($value['level'] == 1){
                echo 'Admin';
              } else if ($value['level'] == 2){
                echo 'Pemilik';
              }
              ?>
                  </td>
                    <td><img src="<?= base_url('fotouser/' . $value['foto_user'])?>" class="img-circle" width="80px" height="80px"></td>
                    <td><a href="<?= base_url('user/edit/' . $value['id_user'])?>" class="btn btn-xs btn-warning"><i class="fa fa-fw fa-edit"></i>Edit</a>
                       <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_user']?>"><i class="fa fa-fw fa-trash"></i>Delete</button></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
</div>
</div>
</div>

<!-- Modal delete-->
<?php foreach ($user as $key =>$value){?>
    <div class="modal fade" id="delete<?= $value['id_user'] ?>">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Delete <?= $title ?></h4>
              </div>
              <div class="modal-body">

                <h4><p><center>Apakah Anda Ingin Menghapus Data <b><?= $value['username']?> ?</b></center></p></h4>

              </div>

              <div class="modal-footer">
                <a href="<?= base_url('user/delete/' . $value['id_user']) ?>" class="btn btn-success pull-left btn-flat"> Delete</a>
                <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
              </div>
              </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <?php } ?>

