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
           <marquee style="font-family:arial; font-size:30px; color:#000000;">SELAMAT DATANG DI DASHBOARD PEMILIK GUDANG WEB</marquee>
       </div>
       </br>

       <div class="row">
           <div class="col-md-3">
           </div>
           <div class="col-md-6">
               <div class="box box-primary box-solid">
                   <div class="box-header with-border">
                   </div>

                   <!-- /.box-header -->
                   <div class="box-body">

                       <center>
                           <div class="form-group">
                               <label>Foto Profil</label>
                               <p></p>
                               <img src="<?= base_url('fotouser/' . session()->get('foto_user')) ?>" class="img-circle" id="gambar_load" width="100px" height="100px">
                           </div>
                       </center>

                       <div class="form-group">
                           <label>Nama Pengguna</label>
                           <input name="username" value="<?= session()->get('username') ?>" class="form-control" placeholder="Masukkan Nama Pengguna" required>
                       </div>

                       <div class="form-group">
                           <label>Password</label>
                           <input name="password" id="ShowPass" value="<?= session()->get('password') ?>" class="form-control" placeholder="Masukkan Kata Sandi" required>
                           <input type="checkbox" onclick="myFunction()">&nbsp; Hide Password
                       </div>

                       <div class="form-group">
                           <label>Nama Lengkap</label>
                           <input name="nama_lengkap" value="<?= session()->get('nama_lengkap') ?>" class="form-control" placeholder="Masukkan Nama Lengkap" required>
                       </div>

                       <div class="form-group">
                           <label>No Telepon User</label>
                           <input type="number" value="<?= session()->get('notelpon_user') ?>" class="form-control" placeholder="Masukkan No Telepon User" required>
                       </div>

                       <div class="form-group">
                           <label>Jobdesk User</label>
                           <input type="text" value="<?= session()->get('jobdesk_user') ?>" class="form-control" placeholder="Masukkan Jobdesk User" required>
                       </div>

                       <div class="form-group">
                           <label>Level</label>
                           <input type="text" name="jobdesk_user" value="<?php if (session()->get('level') == 1) {
                                                                                echo 'Admin';
                                                                            } else if (session()->get('level') == 2) {
                                                                                echo 'User';
                                                                            } else {
                                                                                echo 'Pemilik';
                                                                            } ?>" class="form-control">
                       </div>
                       <p></p>

                   </div>
               </div>

           </div>
           <div class="col-md-3">
           </div>
       </div>