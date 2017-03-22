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