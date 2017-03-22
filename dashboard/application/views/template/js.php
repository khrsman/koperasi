</div><!-- /.content-wrapper -->

<footer class="main-footer">
    <div class="pull-right hidden-xs">
        <b>Version</b> Alpha
    </div>
    <?php 
    // $year_created = '2016';
    // $year_now = date('Y');
    // if($year_created == $year_now){
    // 	$ket = $year_created;
    // }
    // else{
    // 	$ket = '2016 - '.$year_now;
    // }

    ?>
    <strong> 
         Powered by
        <img src="<?php echo base_url('assets/compro').'/smi-logo-lite.png'; ?>" class="img-responsives" width="50px">
         PT SANMADA MEGA INDONESIA
    </strong>. 
</footer>
</div><!-- ./wrapper -->

<!-- jQuery 2.1.3 -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/jQuery/jQuery-2.1.3.min.js') ?>"></script>
<script src="<?php echo base_url('assets/js/jquery-ui.min.js') ?>"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("li.treeview").children('a').append('<i class="fa fa-angle-left pull-right"></i>');
    })
</script>
<!-- Bootstrap 3.3.2 JS -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/bootstrap/js/bootstrap.min.js') ?>" type="text/javascript"></script>
<!-- SlimScroll -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/plugins/slimScroll/jquery.slimScroll.min.js') ?>" type="text/javascript"></script>
<!-- FastClick -->
<script src='<?php echo base_url('assets/AdminLTE-2.0.5/plugins/fastclick/fastclick.min.js') ?>'></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/AdminLTE-2.0.5/dist/js/app.min.js') ?>" type="text/javascript"></script>