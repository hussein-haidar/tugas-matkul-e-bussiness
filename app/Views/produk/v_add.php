<div class="row">
    <div class="col-md-3">
    </div>
    <div class="col-md-6">
<div class="box box-primary box-solid">
<div class="box-header with-border">
               </div>

            <!-- /.box-header -->
<div class="box-body">
     <!-- pop up alert wrong-->
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

<?php echo form_open_multipart('produk/save');?>

<div class="form-group">
    <label>Nama Produk</label>
    <input name="nama_produk" class="form-control" placeholder="Masukkan Nama Produk" required>
</div>

<div class="form-group">
    <label>Motif Produk</label>
    <select name="id_motif" class="form-control">
    <option value="">--Pilih Motif--</option>
    <?php foreach($motif_produk as $key => $value){?>
    <option value="<?= $value['id_motif']?>"><?= $value['nama_motif']?></option>
    <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Jenis Produk</label>
    <select name="id_jenis" class="form-control">
    <option value="">--Pilih Jenis--</option>
    <?php foreach($jenis_produk as $key => $value){?>
    <option value="<?= $value['id_jenis']?>"><?= $value['jenis_produk']?></option>
    <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Deskripsi Produk</label>
    <input type="text" name="deskripsi_produk" class="form-control" placeholder="Masukkan Deskripsi Produk" required>
</div>

<!--<div class="form-group">
    <label>Foto Produk Bawaan</label><p></p>
    <img src="<?= base_url('fotodefault/default_produk.jpeg')?>" id="gambar_load" width="100px">
</div>-->

<div class="form-group">
<label>Pilih Foto Produk</label>
<input type="file" class="form-control" name="foto_produk" id="preview_gambar">
</div>

<div class="modal-footer">
   <button type="submit" class="btn btn-success">Simpan</button>
   <a href="<?= base_url('produk')?>" class="btn btn-primary">Kembali</a>
</div>

<?php echo form_close();?>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>
