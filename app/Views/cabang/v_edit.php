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

<?php echo form_open_multipart('cabang/update/' . $data_cabang['id_cabang']);?>

<div class="form-group">
    <label>Nama Cabang</label>
    <input name="nama_cabang" value="<?= $data_cabang['nama_cabang']?>" class="form-control" placeholder="Masukkan Nama Cabang" required>
</div>

<div class="form-group">
    <label>No Telepon Cabang</label>
    <input name="notelpon_cabang" value="<?= $data_cabang['notelpon_cabang']?>" class="form-control" placeholder="Masukkan No Telepon Cabang" required>
</div>

<div class="form-group">
    <label>Alamat Cabang</label>
    <input type="text" name="alamat_cabang" value="<?= $data_cabang['alamat_cabang']?>" class="form-control" placeholder="Masukkan Alamat Cabang" required>
</div>

<div class="form-group">
    <label>Foto Cabang Terkini</label><p></p>
    <img src="<?= base_url('fotocabang/' . $data_cabang['foto_cabang'])?>" id="gambar_load" width="100px">
</div>

<div class="form-group">
<label>Pilih Foto Produk Baru</label><p></p>
<input type="file" class="form-control" name="foto_cabang" id="preview_gambar">
</div>

<div class="modal-footer">
   <button type="submit" class="btn btn-success">Simpan</button>
   <a href="<?= base_url('cabang')?>" class="btn btn-primary">Kembali</a>
</div>

<?php echo form_close()?>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>
