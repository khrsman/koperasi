 


 <link rel="stylesheet" href="<?php echo base_url();?>/web_component/summernote-master/dist/summernote.css">
 <link rel="stylesheet" href="<?php echo base_url();?>/web_component/font-awesome-4.0.3/css/font-awesome.min.css">
 <link rel="stylesheet" href="<?php echo base_url();?>/web_component/font-awesome-4.0.3/css/font-awesome.css">
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
                <small>Agenda - Lihat Agenda</small>
            </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i>  Data Konten Web</a></li>
                        <li><a href="#">Agenda</a></li>
                        <li class="active">Lihat Agenda</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
  <table border="0">
                <tr>
                <td><label for="nip">Judul Agenda</label></td>
                <td  colspan="3"><input value="<?php echo $edit_news->judul_agenda;?>" readonly type="text" class="form-control" name="judul_dok" id="judul_dok" value=""/></td>
                </tr>
                <tr>
                <td> <label for="nama">Isi Agenda</label></td>
                <td colspan="3"><p><?php echo $edit_news->isi_agenda;?></p></td>
                </tr>
                <tr>
                <td><label for="nip">Tanggal Pelaksanaan</label></td>
                <td><input type="text" value="<?php echo date('d-M-Y',strtotime($edit_news->tgl_mulai));?>" readonly class="form-control" name="tgl_dimulai" id="judul_dok" /></td><td> - </td><td><input type="text" class="form-control" readonly name="tgl_selesai" id="judul_dok" value="<?php echo date('d-M-Y',strtotime($edit_news->tgl_selesai));?>" /></td>
                </tr>
                <tr>
                <td><label for="nip">Jam Pelaksanaan</label></td>
                <td><input type="text"  value="<?php echo $edit_news->jam_mulai;?>"  readonly class="form-control" name="jam_mulai" id="judul_dok" /></td><td> - </td><td><input type="text" class="form-control" readonly name="jam_selesai" id="judul_dok" value="<?php echo $edit_news->jam_selesai;?>" /></td>
                </tr>

                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                </tr>
                
            </table>
            <br><br>
            <?php 


            $date_now = date("Y-m-d H:m:s",strtotime(''));
            $end_date = strtotime($edit_news->tgl_selesai);
            $todays_date = strtotime(date("Y-m-d H:m:s"));     
            // echo "<br>";
            // echo $todays_date = strtotime('2014-08-31 02:30:30');     
            if ($todays_date <= $end_date){
            // if ($expired_date > $date_now) {
                 if($cek->num_rows() > 0){
                    if($cek->row()->status == 'T'){
                        echo anchor('','Anda Menghadiri Agenda Ini','class="btn btn-primary" disabled="disabled"')." ".anchor('agenda/batal/'.$edit_news->id_agenda,'Tidak Hadir','class="btn btn-danger"');
                    }
                    else{
                        echo anchor('agenda/hadir/'.$edit_news->id_agenda,'Hadir','class="btn btn-primary"')." ".anchor('','Anda Tidak Menghadiri  Agenda Ini','class="btn btn-danger" disabled="disabled"');
                    }
                }
                else{
                    echo anchor('agenda/hadir/'.$edit_news->id_agenda,'Hadir','class="btn btn-primary"')." ".anchor('agenda/batal/'.$edit_news->id_agenda,'Tidak Hadir','class="btn btn-danger"');
                }
            } 
            else {
                echo "agenda sudah terlewati";
               
            }
            ?>
            </div>
            </div>
        </div>
        <div class="col-md-6">
        <div class="panel panel-default" style="max-height:500px;min-height:500px;">
            <div class="panel-heading">Peserta Agenda (<?php echo $attend->num_rows()." Peserta";?>)</div>
            <div class="panel-body">
            <div style=" width: 100%;height:400px;overflow:scroll;overflow-x:hidden;
    
    ">
                <ol>
                <?php foreach($attend->result() as $orang){ ?>
                    <li>
                    <?php 
                    echo $orang->reg_user_name."<br><font size='2' color='#2e2e2e'>".$orang->instansi." - ".$orang->jabatan."</font>";
                    ?></li>


                <?php }?>
                </ol>
            </div>
            </div>
        </div>
        <div class="clear-both"></div>
                </section><!-- /.content -->


        


  <script type="text/javascript">
            $(function() {
                //Datemask dd/mm/yyyy
                $("#datemask").inputmask("yyyy-mm-dd", {"placeholder": "dd-mm-yyyy"});
                //Money Euro
                $("[data-mask]").inputmask();

            });
        </script>


