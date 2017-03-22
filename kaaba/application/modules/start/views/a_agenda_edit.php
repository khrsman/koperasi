<link rel="stylesheet" href="<?php echo base_url();?>/web_component/summernote-master/dist/summernote.css">
<script type="text/javascript" src="<?php echo base_url();?>/web_component/summernote-master/dist/summernote.js"></script>
<script type="text/javascript">
   $(function() {
     $('.summernote').summernote({
       height: 200,
       codemirror: { // codemirror options
     theme: 'cosmo'
   },
   toolbar: [
   //['style', ['style']], // no style button
   ['style', ['bold', 'italic', 'underline', 'clear']],
   ['fontsize', ['fontsize']],
   ['color', ['color']],
   ['para', ['ul', 'ol', 'paragraph']],
   ['height', ['height']],
   ['insert', ['link']], // no insert buttons
   ['table', ['table']], // no table button
   //['help', ['help']] //no help button
   ]
     });
   });
</script>
<section class="content-header">
   <h1>
      Data Konten Web
      <small>Agenda - Edit Agenda</small>
   </h1>
   <ol class="breadcrumb">
      <li><a href="#"><i class="fa fa-dashboard"></i>  Data Konten Web</a></li>
      <li><a href="#">Agenda</a></li>
      <li class="active">Edit Agenda</li>
   </ol>
</section>
<!-- Main content -->
<section class="content">
   <div class="col-xs-12 col-md-12">
      <div class="box box-success" style="min-height: 210px;">
         <div class="box-body" style="text-align: justify;">
            <?php
      $attribute=array('name'=>'form','class'=>'my_form','id'=>'myForm');
      echo form_open_multipart('agenda/edit_agenda_proses/images_uploading',$attribute); ?>
            <table border="0" class="table">
               <tr>
                  <td><label for="nip">Judul Agenda</label></td>
                  <td  colspan="3"><input type="text" class="form-control" name="judul_dok" id="judul_dok" value="<?php echo $edit_news->judul_agenda;?>" ></td>
               </tr>
               <tr>
                  <td> <label for="nama">Isi Agenda</label></td>
                  <td colspan="3"><textarea id="elm3" class="form-control summernote" name="elm3"  ><?php echo $edit_news->isi_agenda;?></textarea></td>
               </tr>
               <tr>
                  <td><label for="nip">Judul Agenda Inggris</label></td>
                  <td  colspan="3"><input type="text" class="form-control" name="judul_dok_en" id="judul_dok" value="<?php echo $edit_news->judul_agenda_en;?>"></td>
               </tr>
               <tr>
                  <td> <label for="nama">Isi Agenda Inggris</label></td>
                  <td colspan="3"><textarea id="elm3" class="form-control summernote" name="elm3_en"  ><?php echo $edit_news->isi_agenda_en;?></textarea></td>
               </tr>
               <tr>
                  <td><label for="nip">Tanggal Pelaksanaan</label></td>
                  <td><input type="date" value="<?php echo $edit_news->tgl_mulai;?>"  class="form-control" name="tgl_dimulai" id="judul_dok" /></td>
                  <td> - </td>
                  <td><input type="date" class="form-control" name="tgl_selesai" id="judul_dok" value="<?php echo $edit_news->tgl_selesai;?>" /></td>
               </tr>
               <tr>
                  <td><label for="nip">Jam Pelaksanaan</label></td>
                  <td><input type="text"  value="<?php echo $edit_news->jam_mulai;?>"  class="form-control" name="jam_mulai" id="judul_dok" /></td>
                  <td> - </td>
                  <td><input type="text" class="form-control" name="jam_selesai" id="judul_dok" value="<?php echo $edit_news->jam_selesai;?>" /></td>
            </table>
            <br><br><button  type="submit" id="button" class="btn btn-success">Simpan Agenda</button>
         </div>
      </div>
   </div>
   <?php
      echo form_close();?>
</section>
<!-- /.content -->
<script type="text/javascript">
   $(function() {
       //Datemask dd/mm/yyyy
       $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "dd-mm-yyyy"});
       //Money Euro
       $("[data-mask]").inputmask();
   
   });
</script>
<div class="clear-both"></div>