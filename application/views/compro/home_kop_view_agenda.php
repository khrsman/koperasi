<link rel="stylesheet" type="text/css" href="<?php echo base_url() ?>assets/compro/compro.css">
<div class="clearfix"></div>
<div class=" bumper_image">
   <center>
      <img src="<?php echo base_url('assets/compro/landing_page/koperasi.jpg');?>" class="img-responsive" style="">
   </center>
</div>
<div class="clearfix"></div>
<div class="main_about_us" style="padding: 10px 0;border-bottom:1px solid #D4D4D4;background: #064862;color: white;font-size: 18px;">
   <div class="container">
      <div class="row">
         <div class="col-md-12 col-xs-12">
            <div class="text-center">
               <marquee>
                  <b>MEMBANGUN JARINGAN KERJASAMA BISNIS KOPERASI INDONESIA</b>
               </marquee>
            </div>
         </div>
      </div>
   </div>
</div>
<section class="white-wrapper" style="padding: 20px 0;">
  <div class="compro-canvas">
    <div class="cover-koperasi"<?php echo $koperasi->cover_foto ? ' style="background-image: url('.base_url('dashboard/assets/images/cover/'. $koperasi->cover_foto).')"' : "" ?>>
      <div class="logo-koperasi"><img src="<?php echo base_url('dashboard/assets/images/user/'. $koperasi->foto) ; ?>"></div>
    </div>
    <div class="compro-nav">
      <ul>
        <li><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/berita') ?>"<?php echo $this->uri->segment(4) == "berita" || !$this->uri->segment(4) ? " class='active'" : "" ?>>BERITA</a></li>
        <li><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/agenda') ?>"<?php echo $this->uri->segment(4) == "agenda" ? " class='active'" : "" ?>>AGENDA</a></li>
        <li><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/event') ?>"<?php echo $this->uri->segment(4) == "event" ? " class='active'" : "" ?>>EVENT</a></li>
        <li><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/info') ?>"<?php echo $this->uri->segment(4) == "info" ? " class='active'" : "" ?>>INFO</a></li>
      </ul>
    </div>
    <div class="row no-margin">
      <div class="col-xs-12 col-md-4 col-lg-3 no-padding">
        <div class="compro-profile">
          <div class="profile-name"><?php echo $koperasi->nama ?></div>
          <div class="profile-desc"><?php echo character_limiter(strip_tags($koperasi->keterangan_koperasi), 150) ?></div>
          <div class="profile-caption">
            <div class="caption-header">Alamat</div>
            <div class="caption-content"><?php echo $koperasi->alamat ?></div>
          </div>
          <div class="profile-caption">
            <div class="caption-header">No. Telepon</div>
            <div class="caption-content"><?php echo $koperasi->telp ?></div>
          </div>
          <div class="profile-caption">
            <div class="caption-header">Email</div>
            <div class="caption-content"><?php echo $koperasi->email ?></div>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-md-8 col-lg-9 no-padding">
        <div class="box-content">
          <ul id="list_agenda"></ul>
          <div class="load-more hide">
            <button type="">Lihat Lebih Banyak</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<!-- end container -->
<div class="clearfix"></div>
<script type="text/x-tmpl" id="tmpl-list-agenda">
{% for(var x=0; res=o[x]; x++) { %}
  <li class="list-agenda" id="agenda-{%= res.id %}" data-time="{%= res.time %}">
    <div class="row no-margin">
      {% if(res.thumbnail) { %}
      <div class="col-xs-12 col-md-4 col-lg-3 no-padding">
        <div class="list-thumbnail" style="background-image: url(<?php echo base_url('dashboard/assets/images/agenda') ; ?>/{%= res.thumbnail %})"></div>
      </div>
      <div class="col-xs-12 col-md-8 col-lg-9 no-padding">
      {% } else { %}
      <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
      {% } %}
        <div class="list-content">
          <div class="list-title"><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/agenda') ?>{%= "/" + res.id + "/" + convert_to_url(res.title_raw) %}">{%# res.title %}</a></div>
          <div class="list-time">{%= res.time_caption %}</div>
          <div class="list-desc">{%# res.content %}</div>
          <div class="list-more"><a href="<?php echo base_url('koperasi/'.$koperasi->id_koperasi.'/'.convert_to_url($koperasi->nama).'/agenda') ?>{%= "/" + res.id + "/" + convert_to_url(res.title_raw) %}">Baca Selengkapnya</a></div>
        </div>
      </div>
    </div>
  </li>
{% } %}
</script>
<script type="text/x-tmpl" id="tmpl-list-empty">
  <li>
    <div class="row no-margin">
      <div class="col-xs-12 col-md-12 col-lg-12 no-padding">
        <div class="list-content empty">
          Tidak Ada Agenda yang Dapat Ditampilkan
        </div>
      </div>
    </div>
  </li>
</script>
<script type="text/javascript" src="<?php echo base_url() . 'dashboard/assets/js/tmpl.min.js' ?>"></script>
<script>
  $(document).ready(function(){
    $(".load-more > button").unbind().bind('click', function(){
      var last_time = $("#list_agenda").find('li:last-child').attr('data-time');
      load_agenda(last_time);
    });
    var load_agenda = function(last){
      var json_data = {
        id_koperasi: "<?php echo $koperasi->id_koperasi ?>",
        last: last ? last : null 
      };
      $.ajax({
        url: "<?php echo base_url() ?>home/ajax_get_agenda",
        data: json_data,
        dataType: 'JSON',
        type: 'POST',
        success: function(data){
          $(".load-more").removeClass('hide');
          if(data.data.length > 0){
            $("#list_agenda").append(tmpl('tmpl-list-agenda', data.data));
          } else {
            $(".load-more").addClass('hide');
            if($("#list_agenda").find('li.list-agenda').length == 0){
              $("#list_agenda").html(tmpl('tmpl-list-empty'));
            }
          }
          $(".load-more").find('button').removeAttr('disabled');
        },
        beforeSend: function(){
          $(".load-more").find('button').attr('disabled', 'disabled');
        }
      })
    };
    load_agenda();
  });

</script>




