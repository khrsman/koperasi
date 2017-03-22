<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
       <?php echo $title;?>
        <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#"><?php echo $title;?></a></li>
    </ol>
</section>

<!-- Main content -->
 <section class="content">
          <div class="row">
            <div class="col-xs-12">
            <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
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

                    				</td>
                    			</tr>
                    	<?php } ?>
                    </tbody>
                  </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->
        </section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
	<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/jquery.dataTables.js" type="text/javascript"></script>
    <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.js" type="text/javascript"></script>

    <script>
$(document).ready(function(){

    $('#dataUser').dataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": false,
      "info": true,
      "autoWidth": false
    });
  });
</script>
<?php
$this->load->view('template/foot');
?>