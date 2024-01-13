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

    <form onsubmit="return checkStockMutation()" action="<?= base_url('mutation/save') ?>" method="post">
<div class="form-group">
    <label>Cabang Asal</label>
    <select name="cabang_asal" id="cabang_asal" class="form-control" onchange="updateAvailableStock()">
        <option value="">--Pilih Cabang--</option>
        <?php foreach($data_cabang as $key => $value){ ?>
            <option value="<?= $value['id_cabang']?>"><?= $value['nama_cabang']?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Nama Produk</label>
    <select name="id_produk" id="id_produk" class="form-control" onchange="updateAvailableStock()">
        <option value="">--Pilih Produk--</option>
        <?php foreach($data_produk as $key => $value){ ?>
            <option value="<?= $value['id_produk']?>"><?= $value['nama_produk']?></option>
        <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Jumlah Stok Yang Tersedia</label>
    <input type="text" id="jumlah_stok" class="form-control" readonly>
</div>
<div class="form-group">
    <label>Jumlah Mutasi Produk</label>
    <input type="number" name="jumlah_mutation" class="form-control" placeholder="Masukkan Jumlah Mutasi" required>
</div>
<div class="form-group">
    <label>Nama Cabang Tujuan</label>
    <select name="cabang_tujuan" class="form-control">
    <option value="">--Pilih Cabang--</option>
    <?php foreach($data_cabang as $key => $value){?>
    <option value="<?= $value['id_cabang']?>"><?= $value['nama_cabang']?></option>
    <?php } ?>
    </select>
</div>

<div class="form-group">
    <label>Tanggal Mutasi Produk</label>
    <input type="date" name="tanggal_mutation" class="form-control" placeholder="Masukkan Tanggal Mutasi" required>
</div>

<div class="modal-footer">
        <button type="submit" class="btn btn-success">Simpan</button>
        <a href="<?= base_url('mutation') ?>" class="btn btn-primary">Kembali</a>
    </div>

</form>

</div>
</div>

</div>
<div class="col-md-3">
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>
    function updateAvailableStock() {
        var cabangAsal = document.getElementById('cabang_asal').value;
        var idProduk = document.getElementById('id_produk').value;

        // Use base_url() to get the base URL of your CodeIgniter application
        var baseUrl = '<?= base_url() ?>';

        // Concatenate the specific route to get stock quantity
        var url = baseUrl + 'getStock';

        // Use fetch with method 'POST' and set headers
        fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            // Encode parameters in the request body
            body: 'id_produk=' + encodeURIComponent(idProduk) + '&id_cabang=' + encodeURIComponent(cabangAsal),
        })
        .then(response => response.json())
        .then(data => {
            document.getElementById('jumlah_stok').value = data.available_stock;
        })
        .catch(error => console.error('Error:', error));
    }
</script>
<script>
    function checkStockMutation() {
        var availableStock = parseInt(document.getElementById('jumlah_stok').value);
        var stockMutation = parseInt(document.getElementsByName('jumlah_mutation')[0].value);

        if (isNaN(availableStock) || isNaN(stockMutation)) {
            alert('Invalid stock values. Please check again.');
            return false; // Prevent form submission
        }

        if (stockMutation > availableStock) {
            alert('Jumlah Stok Mutasi melebihi batas Jumlah Stok yang tersedia!');
            return false; // Prevent form submission
        }

        return true; // Allow form submission
    }
</script>
