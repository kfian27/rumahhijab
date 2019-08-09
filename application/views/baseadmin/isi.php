      <?php
        $a=1;
        foreach($grafik1 as $data){
          $labelnya[] = $data->year;
          $stok1[] = (float) $data->total;
          // if ($a=1){
          //   $legend1 = $data->retail_country;
          // }
        }
      ?>
          <!-- page content -->
      <div class="right_col" role="main">
        <div class="row">
          <div class="row tile_count">
            <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Permintaan Hari ini</span>
              <div class="count"><center>2500</center></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> Total Permintaan Bulan ini</span>
              <div class="count"><center>2500</center></div>
            </div>
           <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> SK yang diterbitkan Hari ini</span>
              <div class="count"><center>2500</center></div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-file"></i> SK yang diterbitkan Bulan ini</span>
              <div class="count"><center>2500</center></div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Line graph<small>Sessions</small></h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                      <li class="dropdown">
                        <ul class="dropdown-menu" role="menu">
                          <li><a href="#">Settings 1</a>
                          </li>
                          <li><a href="#">Settings 2</a>
                          </li>
                        </ul>
                      </li>
                      <li><a class="close-link"><i class="fa fa-close"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <canvas id="coba_graph"></canvas>
                  </div>
                </div>
              </div>
        <div class="clearfix"></div>
      </div>
      <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
      <script type="text/javascript">
        var ctx = document.getElementById("coba_graph");
        var config = {
            type: 'bar',
            data: {
              labels: <?php echo json_encode($labelnya);?>,
              datasets: [{
                label: "legend1",
                backgroundColor: "rgba(38, 185, 154, 0.31)",
                borderColor: "rgba(38, 185, 154, 0.7)",
                pointBorderColor: "rgba(38, 185, 154, 0.7)",
                pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
                pointHoverBackgroundColor: "#fff",
                pointHoverBorderColor: "rgba(220,220,220,1)",
                pointBorderWidth: 1,
                data: <?php echo json_encode($stok1);?>
              }]
            },
            options: {
                responsive: true,
                legend: {
                    position: 'bottom',
                },
                hover: {
                    mode: 'label'
                },
                scales: {
                    xAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Tahun'
                        }
                    }],
                    yAxes: [{
                        display: true,
                        scaleLabel: {
                            display: true,
                            labelString: 'Value'
                        }
                    }]
                },
                title: {
                    display: true,
                    text: 'Data'
                }
            }
        };
      var newChart = new Chart(ctx, config);
      </script>
      <!-- end page content -->