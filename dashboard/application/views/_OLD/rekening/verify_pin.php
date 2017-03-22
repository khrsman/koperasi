<?php 
$this->load->view('template/head');
?>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/style.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/bootstrap-select.min.css"/>
<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/css/ajax-bootstrap-select.css"/>
<style>
.bootstrap-select {
    width: 100% !important;
}
</style>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Main content -->
<section class="content lockscreen" style="background: none">
  <div class="lockscreen-wrapper">
    <div class="lockscreen-logo">
      <a><b>Masukan</b> PIN</a>
    </div>
    <div class="lockscreen-name"><?= $this->session->userdata('nama'); ?></div>
    <div class="lockscreen-item">
      <div class="lockscreen-image">
        <img src="<?php if($this->session->userdata('foto_user') == NULL){ echo base_url()."assets/images/user/default.jpg"; } else {  echo base_url()."assets/images/user/".$this->session->userdata('foto_user'); } ?>" alt="User Image">
      </div>
      <form class="lockscreen-credentials" id="form_verify_pin">
        <div class="input-group">
          <input type="password" class="form-control" placeholder="PIN" name="pin" id="pin">
          <div class="input-group-btn">
            <button type="submit" class="btn"><i class="fa fa-arrow-right text-muted"></i></button>
          </div>
        </div>
      </form>
    </div>
    <div class="help-block text-center" id="notification_status">
      Masukan pin Anda untuk mengakses halaman ini
    </div>
    <div class="text-center">
      <a href="<?php echo base_url() ?>">Kembali ke Halaman Dashboard</a>
    </div>
  </div>
</section><!-- /.content -->
<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script>
  $(document).ready(function(){
     $("#form_verify_pin").bind('submit', function(e){
        var $this = $(this);
        var json_data = $this.serializeObject();
        $.ajax({
            url: '<?php echo base_url() ?>rekening/ajax_verify_pin',
            data: json_data,
            dataType: 'JSON',
            type: 'POST',
            success: function(data){
                if(data.errorcode > 0){
                    $("#notification_status").html(data.msg);
                    $this.find('button[type=submit]').removeAttr('disabled');
                } else {
                    $("#notification_status").html("Mohon tunggu...");
                    $this.find('button[type=submit]').removeAttr('disabled');
                    window.location.reload();
                }
            },
            beforeSend: function(data){
                $("#notification_status").html("Memverifikasi PIN...");
                $this.find('button[type=submit]').attr('disabled', 'disabled');
            }
        });

        return false;
    });
  });
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};
</script>
<?php
$this->load->view('template/foot');
?>