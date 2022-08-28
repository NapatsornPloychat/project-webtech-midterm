<html>
  <head>
    {{-- https://www.gstatic.com/charts/loader.js  backup --}}
    <script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);


      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['หมวดหมู่ของปัญหา', 'จำนวนปัญหา'],
          <?php echo $chartData; ?>
        ]);

        var options = {
          title: 'รายงานปัญหาทั้งหมด',
          is3D:true,
        };

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
        setTimeout(() => {

        }, 1000);
      }


    </script>
  </head>
  <body onload="init()">
    <div id="piechart" style="width: 2400px; height: 1000px;"></div>
  </body>
</html>
