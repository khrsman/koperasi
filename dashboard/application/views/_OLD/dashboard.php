<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/morris/morris.css" rel="stylesheet" type="text/css" />
<link href="<?= base_url() ?>assets/css/gerailumrah.css" rel="stylesheet" type="text/css" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        

                  <img src="
                    <?php 
                      if($this->session->userdata('id_user') == NULL OR $this->session->userdata('id_user') == "" OR $this->session->userdata('level') == "1"){
                        echo base_url('assets/compro').'/smi-logo.png';
                      }else{
                        echo get_cover_logo();
                      }
                     ?>
                  " class="img-responsive" style="width:200px;"/>
    <!-- <small>it all starts here</small> -->
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Dashboard</a></li>
    </ol>
    <br>
    <?php  if($this->session->userdata('level')     != "1") { ?>
    
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('about'); ?>"><strong>Tentang Kami</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('agenda'); ?>"><strong>Agenda Organisasi</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('news'); ?>"><strong>Berita / Acara</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('contact'); ?>"><strong>Kontak</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('partners'); ?>"><strong>Partners</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('faq'); ?>"><strong>FAQ SMI</strong></a>
        <a class="btn btn-sm btn-primary" href="<?php echo site_url('services'); ?>"><strong>Products & Services</strong></a>
 <?php } ?>
</section>
<!-- Main content -->
<section class="content">
 <div style="max-height:300px;overflow:hidden;margin:0 0 50px 0;">
    <center>
            <?php 
            if($logo_cover['cover_foto']): ?>
            <img src="<?= SRC_COVER.$logo_cover['cover_foto'] ?>" alt="" class="img-responsive">
            <?php else: ?>
            <img src="<?php echo base_url('assets/compro/IMAGE'); ?>/cover_hero_smi.jpg" alt=""  class="img-responsive">
            <?php endif; ?>
         </center>

</div>





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
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<script src="<?= base_url() ?>assets/AdminLTE-2.0.5/plugins/chartjs/Chart.js" type="text/javascript"></script>
<!-- <script src="<?= base_url() ?>assets/AdminLTE-2.0.5/dist/js/demo.js" type="text/javascript"></script> -->
<script>
      $(function () {
        var areaChartData = {
          labels: [<?php foreach ($provinsi->result() as $p) {
            echo '"'.$p->nama.'",';
        }?>],
          datasets: [
            {
              label: "Jumlah Anggota",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php foreach ($provinsi->result() as $p) {
            echo $p->jumlah.',';
        }?>]
            }
          ]
        };
        //-------------
        //- BAR CHART -
        //-------------
        var chartProvinsiCanvas = $("#chartProvinsi").get(0).getContext("2d");
        var chartProvinsi = new Chart(chartProvinsiCanvas);
        var chartProvinsiData = areaChartData;
        chartProvinsiData.datasets[0].fillColor = "#00a65a";
        chartProvinsiData.datasets[0].strokeColor = "#00a65a";
        chartProvinsiData.datasets[0].pointColor = "#00a65a";
        var chartProvinsiOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 1,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 1,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 2,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        chartProvinsiOptions.datasetFill = false;
        chartProvinsi.Bar(chartProvinsiData, chartProvinsiOptions);
      });
    </script>


    <script>
      $(function () {
        var koperasiAnggotaChart = {
          labels: [<?php foreach ($koperasi_anggota as $p) {
            echo '"'.$p->nama.'",';
        }?>],
          datasets: [
            {
              label: "Jumlah Anggota",
              fillColor: "rgba(210, 214, 222, 1)",
              strokeColor: "rgba(210, 214, 222, 1)",
              pointColor: "rgba(210, 214, 222, 1)",
              pointStrokeColor: "#c1c7d1",
              pointHighlightFill: "#fff",
              pointHighlightStroke: "rgba(220,220,220,1)",
              data: [<?php foreach ($koperasi_anggota as $p) {
            echo $p->total_user.',';
        }?>]
            }
          ]
        };
        //-------------
        //- BAR CHART -
        //-------------
        var chartAnggotaKoperasi = $("#chartAnggotaKoperasi").get(0).getContext("2d");
        var chartAnggotaKop = new Chart(chartAnggotaKoperasi);
        var chartAnggotaKopData = koperasiAnggotaChart;
        chartAnggotaKopData.datasets[0].fillColor = "#00a65a";
        chartAnggotaKopData.datasets[0].strokeColor = "#00a65a";
        chartAnggotaKopData.datasets[0].pointColor = "#00a65a";
        var chartAnggotaKopOptions = {
          //Boolean - Whether the scale should start at zero, or an order of magnitude down from the lowest value
          scaleBeginAtZero: true,
          //Boolean - Whether grid lines are shown across the chart
          scaleShowGridLines: true,
          //String - Colour of the grid lines
          scaleGridLineColor: "rgba(0,0,0,.05)",
          //Number - Width of the grid lines
          scaleGridLineWidth: 1,
          //Boolean - Whether to show horizontal lines (except X axis)
          scaleShowHorizontalLines: true,
          //Boolean - Whether to show vertical lines (except Y axis)
          scaleShowVerticalLines: true,
          //Boolean - If there is a stroke on each bar
          barShowStroke: true,
          //Number - Pixel width of the bar stroke
          barStrokeWidth: 1,
          //Number - Spacing between each of the X value sets
          barValueSpacing: 1,
          //Number - Spacing between data sets within X values
          barDatasetSpacing: 2,
          //String - A legend template
          legendTemplate: "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].fillColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>",
          //Boolean - whether to make the chart responsive
          responsive: true,
          maintainAspectRatio: true
        };

        chartAnggotaKopOptions.datasetFill = false;
        chartAnggotaKop.Bar(chartAnggotaKopData, chartAnggotaKopOptions);
      });
    </script>
<?php
$this->load->view('template/foot');
?>