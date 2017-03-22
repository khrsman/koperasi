	        
        <script type="text/javascript">
            $(function() {
                $('#example2').dataTable({
                    "bPaginate": true,
                    "bLengthChange": true,
                    "bFilter": true,
                    "bSort": true,
                    "bInfo": true,
                    "bAutoWidth": true,

                });
            });
        </script>
         <!-- bootstrap 3.0.2 -->
        
  
        <section class="content-header">
            <h1>
                Data Konten Web
                <small>Agenda</small>
            </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Data Konten Web</a></li>
                        <li class="active">Agenda</li>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                <div class="row">
                <div class="col-xs-8">
               	<?php 
	if($this->session->userdata('level')!='MB'){
		echo anchor('agenda/add_agenda/create','<span class="glyphicon glyphicon-plus"></span> Create agenda','class="btn btn-success"');	
	}
	?>

                </div>
                 <div class="col-xs-4" style="height:34px;">
                        <?php
                        if($this->session->flashdata('msg') !=NULL){
                            echo '<div class="alert alert-info" role="alert" style="
padding: 6px 12px;height:34px;">';
                            echo "<i class='fa fa-info-circle'></i> <strong><span style='margin-left:10px;'>".$this->session->flashdata('msg')."</span></strong>";
                            echo '</div>';
                        }?>
                        </div>
                </div>
                <br>

     <div class="box">
        <div class="box-header">
            
        </div><!-- /.box-header -->
        
        <div class="box-body table-responsive">
            <table id="example2" class="table table-bordered table-hover table-striped">
                    <thead>
                    <tr>
				<th scope="col">No</th>
		<th scope="col">Judul</th>
		<th scope="col">Tanggal Pelaksanaan</th>

		<th scope="col">Hadir</th>
        <?php if($this->session->userdata('level')!='MB'){ ?>
		<th scope="col">Tidak Hadir</th>
        <?php } ?>
		    <th scope="col">#</th>
                    </tr>
                    </thead>
                                        <tbody>
           <?php
			$i=0;
			$edit=array('class'=>'btn btn-info','title'=>"Edit Data");
			$hapus=array('class'=>'btn btn-danger','title'=>"Hapus Data");
			$lihat = array('class'=>'btn btn-default','title'=>"Lihat Data");
			if($this->session->userdata('level')!='MB'){
				foreach($all_news->result() as $news){
					echo "
					<tr>
					    <td>".++$i."</td>
					    <td>".$news->judul_agenda."</td>
					    <td>".date('d M Y',strtotime($news->tgl_mulai))." - ".date('d M Y',strtotime($news->tgl_selesai))."<br>".date('H:i',strtotime($news->jam_mulai))." - ".date('H:i',strtotime($news->jam_selesai))."</td>
					    <td>".$news->hadir."</td>
					    <td>".$news->batal."</td>

					    <td>".anchor('agenda/edit_agenda/'.$news->id_agenda,'<i class="fa fa-pencil"></i>',$edit)." ".
					    anchor('agenda/detail_agenda/'.$news->id_agenda,'<i class="fa fa-eye"></i>',$edit)." ".
					    anchor('agenda/delete_agenda/'.$news->id_agenda,'<i class="fa fa-times"></i>',
							array('class'=>'btn btn-danger','title'=>'Hapus Data',
							'onclick'=>"return confirm ('Anda yakin akan menghapus data berita bernama ".$news->judul_agenda." ?')")).
					    "</td>
					    </tr>";
				}
			}
			else{
				foreach($all_news->result() as $news){
					echo "
					<tr>
					    <td>".++$i."</td>
					    <td>".$news->judul_agenda."</td>
					    <td>".date('d M Y',strtotime($news->tgl_mulai))." - ".date('d M Y',strtotime($news->tgl_selesai))."<br>".date('H:i',strtotime($news->jam_mulai))." - ".date('H:i',strtotime($news->jam_selesai))."</td>
                        <td>".$news->hadir."</td>
					    <td>".anchor('agenda/lihat_agenda/'.$news->id_agenda,'<i class="fa fa-eye"></i>',$edit).
					    "</td>
					    </tr>";
				}
			}
				    
    ?>
                                        </tbody>
                                        <tfoot></tfoot>
                                    </table>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                </section>
















