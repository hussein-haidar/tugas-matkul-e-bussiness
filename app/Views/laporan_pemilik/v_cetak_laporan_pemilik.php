
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Gudang Web | <?= $title3 ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?= base_url()?>/template/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url()?>/template/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?= base_url()?>/template/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url()?>/template/dist/css/AdminLTE.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body onload="window.print();">
<div class="wrapper">
  <!-- Main content -->
  <section class="invoice">
    <!-- title row -->
    <div class="row">
      <div class="col-xs-12">
        <h2 class="page-header">
          <i class="fa fa-file-o"></i> Laporan Produk 
          <small class="pull-right">Tanggal Dibuat : <?= date('d-m-Y') ?></small>
        </h2>
      </div>
      <!-- /.col -->
    </div>
    <!-- info row -->
    <div class="row invoice-info">
     
    </div>
    <!-- /.row -->

    <!-- Table row -->
    <div class="row">
      <div class="col-xs-12 table-responsive">
      <table id="example1" class="table table-bordered table-striped ">

<thead>

    <tr class="label-primary">
    <th scope="col" width="1%">No</th>
        <th>Jumlah Distribusi</th>
        <th>Tanggal Distribusi</th>
        <th>Nama Produk</th>
        <th>Nama Cabang</th>
        <!--<th>Aksi</th>-->
    </tr>
</thead>
<tbody>
    <?php $no = 1;
    foreach ($data_laporan_pemilik as $key => $value) {
    ?>
        <tr>
            <td><?= $no++; ?></td>
            <td><?= $value['jumlah_mutation']; ?></td>
            <td><?= date('d-m-Y', strtotime($value['tanggal_mutation'])); ?></td>
            <td><?= $value['nama_produk']; ?></td>
            <td><?= $value['nama_cabang']; ?></td>
            <!--<td>
                <button class="btn btn-danger btn-sm btn-xs" data-toggle="modal" data-target="#delete<?= $value['id_laporan'] ?>"><i class="fa fa-fw fa-trash"></i>Delete</button>
            </td>-->
        </tr>
    <?php } ?>
</tbody>
</table>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->

    <div class="row">
      <!-- accepted payments column -->
      <div class="col-xs-4">
    
      </div>

      <div class="col-xs-4">
    
    </div>
      <!-- /.col -->
      <div class="col-xs-4">
      Pekalongan, <?= date('d-m-Y') ?> </br>
      </div>
      <!-- /.col -->
    </div>
    <!-- /.row -->
  </section>
  <!-- /.content -->
</div>
<!-- ./wrapper -->
</body>
</html>
