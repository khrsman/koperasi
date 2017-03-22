<div id="blog" class="parallax parallax4" data-parallax-speed="-0.2">
            <div class="container">
                <div class="row">
                    <div class="grid_8 preffix_2">
                        <h2 class="center wow fadeInUp" data-wow-delay="0.2s">The Journey</h2>
                        <h5 class="center wow fadeInUp" data-wow-delay="0.4s" style="margin-bottom:50px;">Please Connect your VR Devices</h5>

                        <div class="owl-carousel center" >
                        <?php 

                        //KONTEN LOOPING
                        $length = count($read);
                        for($i=0;$i<$length;$i++):
                        ?>
                        

                        <div class="item" >
                            <div class="row">
                                <div class="grid_10 preffix_1">
                                        <div class="quote_photo">
                                            <img src="<?php echo base_url('assets').'/'.$read[$i]['img'];?>"  alt="" class="img-responsive"/>
                                        </div>
                                        <div class="quote_hdng"><?php echo $read[$i]['part'];?></div>
                                        <br>
                                        <div class="quote_crdts" style="height:300px;overflow:scroll;">
                                            <?php echo $read[$i]['content'];?>
                                        </div>
                                        <?php if($i >0):?>
                                        <div class="quote_crdts" >
                                            note: tap and scrol down
                                        </div>
                                        <?php endif;?>
                               
                                </div>
                            </div>
                        </div>

                        <?php endfor;?>


                        </div>






                    </div>
                        <div class="blog wow fadeInUp" data-wow-delay="0.6s">
                           <!--  <center>
                                <a class="lazy-img thumb" style="padding-bottom: 53.11688311688312%" href="javascript:void();">
                                    <img data-src="<?php echo base_url('assets');?>/images/vr.jpg" src="#" alt=""/>
                                    <span class="thumb_overlay"></span>
                                </a>
                                <h4>
                                    <a href="#"><?php echo $part;?></a>
                                </h4>
                                <p><?php echo $content;?></p>

                                
                            </center> -->
                        </div>

                    </div>


                <center>
                    <a href="<?php echo $link;?>" class="btn">Back</a>
                </center>
                </div>
            </div>
        </div>