<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
<div class="box box-primary box-solid">
<div class="box-header with-border">
               </div>

            <!-- /.box-header -->
<div class="box-body">
    <?php
    $errors= session()->getFlashdata('errors');
    if (!empty($errors)) {?>
<div class="alert alert-danger" role="alert">
    <ul>
        <?php foreach ($errors as $key =>$value) {?>
                <li><?= esc($value)?></li>
        <?php } ?>
    </ul>
</div>
    <?php }?>

<?php echo form_open_multipart('jenis_produk/update/' . $jenis_produk['id_jenis']);?>

<div class="form-group">
    <label>Jenis Produk</label>
    <input name="jenis_produk" value="<?= $jenis_produk['jenis_produk']?>" class="form-control" placeholder="Masukkan Nama Produk" required>
</div>

<div class="modal-footer">
   <button type="submit" class="btn btn-success">Simpan</button>
   <a href="<?= base_url('jenis_produk')?>" class="btn btn-primary">Kembali</a>
</div>

<?php echo form_close()?>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>
