<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
<div class="box box-primary box-solid">
<div class="box-header with-border">
               </div>

            <!-- /.box-header -->
<div class="box-body">
    <!-- pop up alert -->
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

<?php echo form_open_multipart('cabang/save');?>

<div class="form-group">
    <label>Nama Cabang</label>
    <input name="nama_cabang" class="form-control" placeholder="Masukkan Nama Cabang" required>
</div>

<div class="form-group">
    <label>No Telepon Cabang</label>
    <input type="number" name="notelpon_cabang" class="form-control" placeholder="Masukkan No Telepon Cabang" required>
</div>

<div class="form-group">
    <label>Alamat Cabang</label>
    <input type="text" name="alamat_cabang" class="form-control" placeholder="Masukkan Alamat Cabang" required>
</div>

<!--<div class="form-group">
    <label>Foto Cabang Bawaan</label><p></p>
    <img src="<?= base_url('fotodefault/cabang_default.png')?>" id="gambar_load" width="100px">
</div>-->

<div class="form-group">
<label>Pilih Foto Cabang</label>
<input type="file" class="form-control" name="foto_cabang" id="preview_gambar">
</div>

<div class="modal-footer">
   <button type="submit" class="btn btn-success">Simpan</button>
   <a href="<?= base_url('cabang')?>" class="btn btn-primary">Kembali</a>
</div>

<?php echo form_close();?>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>
