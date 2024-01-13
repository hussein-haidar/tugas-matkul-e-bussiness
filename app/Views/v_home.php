       <!-- Pop up alert berhasil -->
       <?php
        if (session()->getFlashdata('pesan')) {
          echo '<div class="alert alert-success" role="alert">';
          echo session()->getFlashdata('pesan');
          echo '</div>';
        }
        ?>
       </br>
       <!-- Run text -->
       <div class="card-body">
         <marquee style="font-family:arial; font-size:30px; color:#000000;">SELAMAT DATANG DI DASHBOARD ADMIN GUDANG WEB</marquee>
       </div>
       </br>
       
       <!-- Small boxes (Stat box) -->
       <div class="row">
         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-aqua">
             <div class="inner">
               <h3><?= $tot_mutasi ?></h3>

               <p>Data Mutasi</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="<?= base_url('mutation/index') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-green">
             <div class="inner">
               <h3><?= $tot_produk ?></h3>

               <p>Data Produk</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="<?= base_url('produk/index') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-yellow">
             <div class="inner">
               <h3><?= $tot_pengguna ?></h3>

               <p>Daftar Pengguna</p>
             </div>
             <div class="icon">
               <i class="ion ion-person-add"></i>
             </div>
             <a href="<?= base_url('user/index') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->

         <div class="col-lg-3 col-xs-6">
           <!-- small box -->
           <div class="small-box bg-red">
             <div class="inner">
               <h3><?= $tot_cabang ?></h3>

               <p>Data Cabang</p>
             </div>
             <div class="icon">
               <i class="ion ion-stats-bars"></i>
             </div>
             <a href="<?= base_url('cabang/index') ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
           </div>
         </div>
         <!-- ./col -->
       </div>
       <!-- /.row -->