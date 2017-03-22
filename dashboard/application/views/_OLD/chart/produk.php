<?php
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<link href="<?= base_url() ?>assets/select2-4.0.2/dist/css/select2.min.css" rel="stylesheet" />
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
  <h1>
  Data Penjualan Produk
  <!-- <small>it all starts here</small> -->
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Data Penjualan Produk</a></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
    <div class="row">
      <div class="col-xs-12">
        <div class="col-md-12">
        <div class="box box-success table-responsive no-padding">
          <div class="box-header">
            <h3 class="box-title">Data Penjualan Produk</h3>
          </div>
          <div class="box-body">
            <canvas id="chartProvinsi" ></canvas>
            </div><!-- /.box-body -->
            </div><!-- /.box -->
          </div>
        </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <div class="col-md-12">
          <div class="box">
            <div class="box-header with-border">
              <h3 class="box-title">Data Produk</h3>
              </div><!-- /.box-header -->
              <div class="box-body">
                <table id="table-1" class="table table-bordered table-consended table-hover">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama Produk</th>
                      <th>Jumlah Barang Terjual</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php if(!empty($produk)): ?>
                    <?php $no = 1; ?>
                    <?php foreach ($produk as $k):?>
                    <tr>
                      <td><?php echo $no++; ?></td>
                      <td><?php echo ucwords(strtolower($k->nama)); ?></td>
                      <td><?php echo $k->total_penjualan; ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php endif; ?>
                    
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Jumlah Barang Terjual</th>
                  </tr>
                  </tfoot>
                </table>
                <?php echo $pagination; ?>
                </div><!-- /.box-body -->
                </div><!-- /.box -->
              </div>
              
            </div>
            </div><!-- /.row -->
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
          labels: [<?php foreach ($produk as $p) {
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
              data: [<?php foreach ($produk as $p) {
            echo $p->total_penjualan.',';
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