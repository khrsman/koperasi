   <div  style="padding:10px;background:#FFC501;min-height:330px;border-bottom:7px solid #064862">
      <?php   
         $img = base_url()."assets/images/user/default.jpg";
               if($this->session->userdata('foto_user') != NULL){
                      $img =  base_url()."assets/images/user/".$this->session->userdata('foto_user');
               }
         ?>
      <center>
         <br><br>
         <img src="<?php echo $img;?>" class="img-circle" alt="User Image" width="100px;"/>
         <h3><?= $this->session->userdata('nama'); ?></h3>
         <b>
         <?php
            if($this->session->userdata('level')==1){
                echo "Admin";
            }
            else if($this->session->userdata('level')==2){
                echo "Koperasi";
            }
            else if($this->session->userdata('level')==3){
                echo "Anggota Koperasi";
            }
            else if($this->session->userdata('level')==4){
                echo "Komunitas";
            }
            else if($this->session->userdata('level')==5){
                echo "Anggota Komunitas";
            }
            ?>
         <br>
         Login Terakhir : <?php
            $date = new DateTime($this->session->userdata('last_login')); 
            echo $date->format('d M y, H:i:s'); 
            ?>
         </b>
      </center>
   </div>

      <a href="<?php echo site_url('gerai/pulsa'); ?>">
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_produk/1.png');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
      </a>

<a href="<?php echo site_url('banking'); ?>" >
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/banking.jpg');?>" class="img-responsive" width="100%" style="margin:0 0 5px 0;">
      </a>
      <a href="<?php echo site_url('gerai/'); ?>">
      <img src="<?php echo base_url('assets/compro/IMAGE/cover_dashboard/serbamurah.jpg');?>" class="img-responsive" width="100%">
      </a>
