<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    Anggota Koperasi
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Manajemen Laporan</a></li>
        <li class="active">Anggota Koperasi</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Lihat Chart Dalam Bentuk</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
            <button class="btn btn-lg btn-info ">Chart</button>
            <button class="btn btn-lg btn-info ">Pie</button>
        </div>
        <div class="box-footer">
            Footer
        </div>
    </div> -->

    <div class="box box-success table-responsive no-padding">
            <div class="box-header">
              <h3 class="box-title">Jumlah Anggota Koperasi Berdasarkan Provinsi</h3>
            </div>
            <div class="box-body">
              <canvas id="chartProvinsi" ></canvas>
            </div><!-- /.box-body -->
    </div><!-- /.box -->



    <div class="box with-border box-primary">
      <div class="box-header">
        <h3>Tabel Anggota Koperasi</h3>
      </div>
      <div class="box-body">  
        <table class="table table-responsive">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama Provinsi</th>
              <th>Jumlah Anggota</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php $no = 1; 
              foreach ($koperasi as $p) : ?>
                <tr> 
                  <td><?= $no++ ?></td>
                  <td><?= $p->nama ?></td>
                  <td><?= $p->jumlah ?></td>
                  <td style="text-align: right;"><button class="btn btn-info" onClick=location.href="<?= base_url() ?>get_anggota_kabupaten/<?= $p->id?>"><i class="fa fa-eye"></i> Lihat Kota/Kabupaten</td>
                </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
      <div class="box-footer">
        <?= $pagination ?>
      </div>
    </div>


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
          labels: [<?php foreach ($koperasi as $p) {
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
              data: [<?php foreach ($koperasi as $p) {
            if($p->jumlah == NULL){
            	$total = 0;
            }
            else{
            	$total = $p->jumlah;
            }



            	echo $total.',';
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
<?php
$this->load->view('template/foot');
?>