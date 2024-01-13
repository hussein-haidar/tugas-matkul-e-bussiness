 <!-- Left side column. contains the sidebar -->
 <aside class="main-sidebar">
   <!-- sidebar: style can be found in sidebar.less -->
   <section class="sidebar">
     <!-- Sidebar user panel -->
     <div class="user-panel">
       <div class="pull-left image">
         <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="img-circle" alt="User Image">
       </div>
       <div class="pull-left info">
         <p><?= session()->get('nama_lengkap') ?></p>
         <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
       </div>
     </div>

     <!-- sidebar menu: : style can be found in sidebar.less -->
     <ul class="sidebar-menu" data-widget="tree">
       <li class="header">MAIN NAVIGATION</li>

       <?php if(session()->get('level') == 1){?>
       
       <li>
         <a href="<?= base_url('home/index') ?>">
           <i class="fa fa-dashboard"></i> <span>Dashboard</span>
         </a>

       </li>
       <?php } ?>

<?php if(session()->get('level') == 2){?>

       <li>
         <a href="<?= base_url('home/pemilik') ?>">
           <i class="fa fa-dashboard"></i> <span>Dashboard</span>
         </a>

       </li>
     <?php } ?>

<?php if(session()->get('level') == 1){?>
       <li class="header">PRODUCT NAVIGATION</li>

       <li class="treeview">
          <a href="#">
            <i class="fa fa-folder"></i>
            <span>Data Produk Batik</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="<?= base_url('motif_produk/index') ?>"><i class="fa fa-circle-o"></i>Daftar Motif Produk</a></li>
            <li><a href="<?= base_url('jenis_produk/index') ?>"><i class="fa fa-circle-o"></i>Daftar Jenis Produk</a></li>
            <li><a href="<?= base_url('produk/index') ?>"><i class="fa fa-circle-o"></i>Daftar Data Produk</a></li>
            <li><a href="<?= base_url('stok_produk/index') ?>"><i class="fa fa-circle-o"></i>Daftar Stok Produk</a></li>
          </ul>
        </li>
       <?php } ?>

       <?php if(session()->get('level') == 1){?>
       <li class="header">MUTATION NAVIGATION</li>

       <li>
         <a href="<?= base_url('mutation/index') ?>">
           <i class="fa fa-folder"></i> <span>Daftar Mutasi Produk</span>

         </a>
       </li>
       <?php } ?>

       <?php if(session()->get('level') == 1){?>

       <li class="header">BRANCH NAVIGATION</li>

       <li>
         <a href="<?= base_url('cabang/index') ?>">
           <i class="fa fa-folder"></i> <span>Daftar Data Cabang</span>

         </a>
       </li>
       <?php } ?>


       <li class="header">REPORT NAVIGATION</li>

       <?php if(session()->get('level') == 1){?>
       <li>
         <a href="<?= base_url('laporan_admin/index') ?>">
           <i class="fa fa-folder"></i> <span>Laporan Rekap Produk</span>

         </a>
       </li>
       <?php } ?>

       <?php if(session()->get('level') == 2){?>

       <li>
         <a href="<?= base_url('laporan_pemilik/index') ?>">
           <i class="fa fa-folder"></i> <span>Laporan Rekap Produk</span>

         </a>
       </li>
       <?php } ?>

       <?php if(session()->get('level') == 1){?>
       <li class="header">USERS NAVIGATION</li>

       <li>
         <a href="<?= base_url('user/index') ?>">
           <i class="fa fa-users"></i> <span>Daftar Pengguna</span>

         </a>
       </li>
       <?php } ?>

     </ul>
   </section>
   <!-- /.sidebar -->
 </aside>

 <!-- =============================================== -->

 <!-- Content Wrapper. Contains page content -->
 <div class="content-wrapper">
   <!-- Content Header (Page header) -->
   <section class="content-header">
     <h1>
       <?= $title2 ?>
       <small></small>
     </h1>
     <ol class="breadcrumb">
       <li><a href="#"><i class="fa fa-dashboard"></i> <?= $title ?></a></li>
       <li class="active"><a href="#"><?= $title2 ?></a></li>
     </ol>
   </section>

   <!-- Main content -->
   <section class="content">