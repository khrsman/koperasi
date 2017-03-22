<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
   
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
             <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
        <div class="box-header with-border">
            <h3 class="box-title">Edit Data Produk</h3>
        </div>
        <form method="post" action="update_produk">
        <div class="box-body">
        <?= validation_errors() ?>
          <div class="form-group ">
            <label for="nama">Nama</label>
            <input type="text" class="form-control" value="<?= $produk['nama'] ?>"  name="nama"/>
          </div>
          <div class="form-group ">
            <label for="nama">Deskripsi</label>
            <textarea class="form-control" value="" name="deskripsi" style="height:200px;" ><?= $produk['desk'] ?></textarea>
          </div>
          <div class="form-group ">
            <label for="nama">Warna</label>
            <input type="text" class="form-control" value="<?= $produk['warna'] ?>" name="warna"/>
          </div>
          <div class="form-group ">
            <label for="nama">Tipe</label>
            <input type="text" class="form-control" value="<?= $produk['tipe'] ?>" name="tipe"/>
          </div>
          <div class="form-group ">
            <label for="nama">Kategori</label>
            <select class="form-control" name="kategori">
              <?php
                  foreach ($kategori as $r) { ?>
                    <option value="<?= $r->id_kategori ?>" <?php if($produk['id_kategori'] == $r->id_kategori)
                                                                 echo "selected"; ?>><?= $r->nama ?></option>
                <?php }  ?>
            </select>
          </div>
          <div class="form-group ">
            <label for="nama">Berat</label>
            <div class="input-group">
                    <input type="text" class="form-control" value="<?= $produk['berat'] ?>" name="berat"/>
                    <span class="input-group-addon">Kg</span>
            </div>
          </div>

          <div class="form-group ">
            <label for="nama">Harga Normal</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk['price_n'] ?>" name="price_n" />
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Harga Diskon</label>
            <div class="input-group">
                    <span class="input-group-addon">Rp</span>
                    <input type="text" class="form-control" value="<?= $produk['price_s'] ?>" name="price_s"/>
            </div>
          </div>
          <div class="form-group ">
            <label for="nama">Jumlah stock</label>
            <input type="text" class="form-control" value="<?= $produk['qty'] ?>" name="qty"/>
          </div>
        <!--   <div class="form-group ">
            <label for="nama">Jumlah Terjual</label>
            <input type="text" class="form-control" value="<?= $produk['terjual'] ?>" name="terjual"/>
          </div>
          <div class="form-group ">
            <label for="nama">User</label>
            <input type="text" class="form-control" value="<?= $produk['user_nama'] ?>" />
          </div> -->
          
          </form>

          <div class="box-footer">
            <button type="submit" class="btn btn-success"><i class="fa fa-pencil"></i> Simpan Perubahan</button>
          </div>
    </div><!-- /.box -->

    <div class="box">
      <div class="box-header with-border">
        <h3>Gambar Produk</h3>
      </div>
      <div class="box-body">
         <form method="post" action="<?= base_url().'upload_produk_foto'; ?>" enctype="multipart/form-data">
              <?= $this->session->userdata('error'); ?>
                  <div class="form-group ">
                    <label for="nama">Nama</label>
                    <input type="file" class="form-control" name="photo" accept="image/*"/>
                  </div>
                   <button class="btn btn-default" type="submit"> TAMBAH PHOTO</button>
            </form>
              <hr>

         <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Photos</th>
                        <th>Tanggal Upload</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($photo as $r) { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td> <img src="<?= base_url()."assets/images/produk/".$r->foto_path ?>" class="img-responsive" style="width:100px; height: 100px"></td>
                            <td><?= $r->service_time?></td>
                            <td>
                            <a href="<?php echo base_url();?>delete_produk_foto/<?= $r->id_foto ?>" class="btn btn-danger" title="Hapus Data" onclick="return confirm ('Anda yakin akan menghapus data foto <?php echo $produk['nama'];?> ?')"><i class="fa fa-trash"></i></a>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                  </table>
      </div>
    </div>

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>