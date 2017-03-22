<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/datatables/dataTables.bootstrap.css" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>

<style type="text/css">
  .error-page>.headline {
    float: none;
    font-size: 100px;
    font-weight: 300;
}

</style>
        <!-- Main content -->
        <section class="content"> 
          <div class="error-page">
            <h2 class="headline text-yellow"> 404</h2>
              <h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>
              <p>
                We could not find the page you were looking for.
                Meanwhile, you may <a href='home'>return to dashboard</a> or try using the search form.
              </p>

          </div><!-- /.error-page -->
        </section><!-- /.content -->

<?php 
  $this->load->view('template/js');
  $this->load->view('template/foot');
?>