<div class="row">
  
  <div class="col-md-8">
    <div class="box box-warning">

      <div class="box-header">
        <h3 class="box-title">Formulir Pendaftaran</h3>
      </div><!-- /.box-header -->
      
      <div class="box-body">

        <form role="form" data-toggle="validator" class="form-horizontal" 
          method="POST" action="<?php echo $action_form; ?>">
          <div class="form-group">
            <label for="nik" class="col-sm-2 control-label">No.KTP</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="nik" placeholder="No. KTP" name="nik" required
               data-error="Harus diisi dan isian berupa angka">
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-2 control-label">Nama Lengkap</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="name" placeholder="Nama Lengkap" name="name" required
              data-error="Harus diisi">
              <div class="help-block with-errors"></div>
            </div>
          </div>  

          <div class="form-group">
            <label for="jeniskelamin" class="col-sm-2 control-label">Jenis Kelamin</label>
            <div class="col-sm-10">
              <select name="gender" class="form-control" required
              data-error="Harus diisi">
                <option value="">--Pilih--</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
              </select>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="tempatlahir" class="col-sm-2 control-label">Tempat Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tempatlahir" placeholder="Tempat Lahir" name="birth_place" required
              data-error="Harus diisi"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>
            
          <div class="form-group">
            <label for="tanggallahir" class="col-sm-2 control-label">Tanggal Lahir</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="tanggallahir" placeholder="Tanggal Lahir" name="birth_date" required
              data-error="Harus diisi, format tanggal mm-dd-yyyy"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          

          <div class="form-group">
            <label for="alamat" class="col-sm-2 control-label">Alamat</label>
            <div class="col-sm-10">
              <textarea class="form-control" id="alamat" placeholder="Alamat" name="address" required
              data-error="Harus diisi"></textarea>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="phone" class="col-sm-2 control-label">No. Handphone</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" id="phone" placeholder="Nomor Telepon / Handphone" name="phone" required
              data-error="Harus diisi"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="email" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="email" placeholder="Email" name="email" required
              data-error="Harus diisi dan format email harus valid"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="reemail" class="col-sm-2 control-label">Ulangi email</label>
            <div class="col-sm-10">
              <input type="email" class="form-control" id="reemail" placeholder="Email" name="reemail" required
              data-error="Harus diisi dan sama seperti diatas"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="password" placeholder="Password" name="password" required
              data-error="Harus diisi"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>

          <div class="form-group">
            <label for="repassword" class="col-sm-2 control-label">Ulangi password</label>
            <div class="col-sm-10">
              <input type="password" class="form-control" id="repassword" placeholder="Password" name="repassword" required
              data-error="Harus diisi dan sama seperti password diatas"/>
              <div class="help-block with-errors"></div>
            </div>
          </div>
          

          
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" name="submit">Daftar</button>
            </div>
          </div>

        </form>

      </div><!-- /.box-body -->

    </div><!-- /.box -->
  </div><!-- /.col -->



  <div class="col-md-4">
    <div class="box box-success">

      <div class="box-header">
        <h3 class="box-title">Petunjuk Pengisian</h3>
      </div><!-- /.box-header -->
      
      <div class="box-body">
      Formulir ini digunakan untuk pendaftaran pemohon yang akan mengajukan pengesahan Masterplan / Siteplan.
      <ol>
        <li>Isikan Nomor KTP dengan benar.</li>
        <li>Isikan nama lengkap, jenis kelamin, tempat lahir dan tanggal lahir sesuai dengan KTP.</li>
        <li>Isikan nomor telepon seluler Anda</li>
        <li>Isikan alamat email Anda yang valid dan aktif, untuk login ke dalam sistem dan menerima pesan dari sistem</li>
        <li>Isikan Password Anda untuk login ke dalam Sistem</li>
        <li>Isikan kode keamanan yang tertera pada gambar</li>
        <li>Semua isian harus diisi</li>
      </ol>
Sebelum Anda klik tombol daftar, pastikan data Anda benar. Data EMAIL yang salah, mengakibatkan Anda tidak memperoleh link Aktivasi sehingga tidak dapat melanjutkan pada tahap berikutnya.
      </div><!-- /.box-body -->

    </div><!-- /.box -->
  </div><!-- /.col -->

  

</div>  




<script src="<?php echo base_url(); ?>assets/plugins/bootstrap-validator/dist/validator.min.js" type="text/javascript"></script>

