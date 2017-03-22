<?php 
  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  $actual_link = urlencode($actual_link);
?>


<div class="row">

  <?php if($this->session->flashdata('flash_msg')==TRUE): ?>
  <div class="col-md-12">
    <div class="alert alert-<?php echo $this->session->flashdata('flash_msg_type') ?> alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
      <?php
        if ($this->session->flashdata('flash_msg_status')==TRUE) {
          echo "<i class='icon fa fa-check'></i>";
        } else{
          echo "<i class='icon fa fa-close'></i>";
        }
      ?>
      <?php echo $this->session->flashdata('flash_msg_text'); ?>
    </div>
  </div>
  <?php endif; ?>

  <div class="col-md-12">

     <div class="box">
                <div class="box-header with-border">
                  <button class="btn btn-sm btn-success" onclick=location.href="<?= base_url() ?>add_produk"><i class="fa fa-plus-circle"></i> Tambah Produk</button>
                  
                </div>
                <div class="box-body">
                  <table id="dataUser" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Harga Normal (Rp.)</th>
                        <th>Harga Jual (Rp.)</th>
                        <th>Qty</th>
                        <th>Pemilik</th>
                        <th>#</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($produk as $r) { ?>
                          <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $r->nama_produk?></td>
                            <td><?= $r->nama_kategori?></td>
                            <td style="text-align:right;"><?= number_format($r->price_n);?></td>
                            <td style="text-align:right;"><?= number_format($r->price_s);?></td>
                            <td style="text-align:right;"><?= $r->qty?></td>
                            <td style="text-align:right;"><?= $r->nama?></td>
                            <td>
                              <button class="btn btn-info" onclick=location.href="<?= base_url()?>detail_produk/<?= $r->id_produk ?>"><i class="fa fa-pencil"></i></button>

                              <a href="<?php echo base_url();?>delete_produk/<?= $r->id_produk ?>" class="btn btn-danger" title="Hapus Data" onclick="return confirm ('Anda yakin akan menghapus data produk <?php echo $r->nama_produk;?> ?')"><i class="fa fa-trash"></i></a>

                              <button class="btn btn-default" onclick=location.href="<?= base_url()?>catatan/<?= $r->id_produk ?>"><i class="fa fa-list"></i></button>
                              <?php if($this->session->userdata('level') == '1'): ?>
                              <button class="btn btn-warning" onclick=location.href="<?= base_url()?>add_peruntukan/<?= $r->id_produk ?>"><i class="fa fa-plus-circle"></i></button>
                              <?php endif; ?>
                            </td>
                          </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

  </div>
</div>


<script type="text/javascript">
  // get your select element and listen for a change event on it
  $('.select-redirect').change(function() {
    // set the window's location property to the value of the option the user has selected
    document.location = $(this).val();
  });


</script>