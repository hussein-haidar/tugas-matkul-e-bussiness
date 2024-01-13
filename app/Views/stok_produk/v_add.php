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

<?php echo form_open_multipart('stok_produk/save');?>
<div class="form-group">
    <label>Nama Cabang</label>
    <select name="id_cabang" class="form-control">
    <option value="">--Pilih Cabang--</option>
    <?php foreach($data_cabang as $key => $value){?>
    <option value="<?= $value['id_cabang']?>"><?= $value['nama_cabang']?></option>
    <?php } ?>
    </select>
</div>
<div class="form-group">
    <label>Jumlah Stok Produk</label>
    <input type="number" name="jumlah_stok_produk" class="form-control" placeholder="Masukkan Jumlah Stok" required>
</div>

<div class="form-group">
    <label>Tanggal Masuk Produk</label>
    <input type="date" name="tanggal_masuk_produk" class="form-control" placeholder="Masukkan Tanggal Masuk" required>
</div>

<div class="form-group">
    <label>Nama Produk</label>
    <select name="id_produk" class="form-control">
    <option value="">--Pilih Produk--</option>
    <?php foreach($data_produk as $key => $value){?>
    <option value="<?= $value['id_produk']?>"><?= $value['nama_produk']?></option>
    <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Nama Motif</label>
    <select name="id_motif" class="form-control">
    <option value="">--Pilih Motif--</option>
    <?php foreach($data_motif as $key => $value){?>
    <option value="<?= $value['id_motif']?>"><?= $value['nama_motif']?></option>
    <?php } ?>
    </select>
</div>

<div class="modal-footer">
   <button type="submit" class="btn btn-success">Simpan</button>
   <a href="<?= base_url('stok_produk')?>" class="btn btn-primary">Kembali</a>
</div>

<?php echo form_close();?>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>
