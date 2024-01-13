<div class="box box-primary box-solid">
    <div class="box-header">

    <a href="<?= base_url('laporan_pemilik/cetak_laporan') ?>" class="btn-sm"><i class="fa fa-print" aria-hidden="true"></i>
            Cetak Data</a>

    </div>
    <!-- /.box-header -->
    <div class="box-body">

        <div class="table-responsive">

            <table id="example1" class="table table-bordered table-striped ">

                <thead>

                    <tr>
                    <th scope="col" width="1%">No</th>
                        <th>Jumlah Stok Mutasi</th>
                        <th>Tanggal Mutasi</th>
                        <th>Nama Produk</th>
                        <th>Nama Cabang</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach ($laporan_pemilik as $key => $value) {
                    ?>
                        <tr>
                            <td><?= $no++; ?></td>
                            <td><?= $value['jumlah_mutation']; ?></td>
                            <td><?= date('d-m-Y', strtotime($value['tanggal_mutation'])); ?></td>
                            <td><?= $value['nama_produk']; ?></td>
                            <td><?= $value['nama_cabang']; ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal delete-->
<?php foreach ($laporan_pemilik as $key => $value) { ?>
    <div class="modal fade" id="delete<?= $value['id_laporan'] ?>">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Delete <?= $title ?></h4>
                </div>
                <div class="modal-body">

                    <p>
                        <center>Apakah Anda Ingin Menghapus Data <b>Laporan Produk Ini ?</b></center>
                    </p>

                </div>

                <div class="modal-footer">
                    <a href="<?= base_url('laporan_pemilik/delete/' . $value['id_laporan']) ?>" class="btn btn-success pull-left btn-flat"> Delete</a>
                    <button type="button" class="btn btn-danger btn-flat" data-dismiss="modal">Close</button>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
<?php } ?>