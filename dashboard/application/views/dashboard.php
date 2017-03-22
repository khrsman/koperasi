<?php


    if($this->session->userdata('level') == "3"){
        $this->load->view('new_head_anggota_kop');
    }
    else{
        $this->load->view('new_head');
    }

?>


<?php


    if($this->session->userdata('level')     == "1") {
        $this->load->view('dashboard/dashboard_admin');
    }
    else if($this->session->userdata('level') == "2"){
        $this->load->view('dashboard/dashboard_koperasi');
    }
    else if($this->session->userdata('level') == "3"){
        $this->load->view('dashboard/dashboard_anggota_koperasi');
    }
    else if($this->session->userdata('level') == "4"){
        $this->load->view('dashboard/dashboard_komunitas');
    }
    else if($this->session->userdata('level') == "5") {
        $this->load->view('dashboard/dashboard_komunitas');
    }

?>



</section><!-- /.content -->
<?php

    if($this->session->userdata('level') == "3"){
        // $this->load->view('new_head_anggota_kop');
    }
    else{
        $this->load->view('new_foot');
    }

?>
<?php
$this->load->view('template/foot');
?>
