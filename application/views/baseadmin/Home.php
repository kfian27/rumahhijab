<?php $this->load->model('login_model'); ?>
<?php $this->load->model('mgudang_model');?>
<div class="right_col" role="main" id="view">
  <div class="">
    <div class="row top_tiles">
      <a href="<?php echo base_url();?>invoice/c_invoice">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats" style="background-color: #2d6aa0; border-color: #2d6aa0;">
            <div class="icon" style="color: #fbfbfb"><i class="fa fa-file-o"></i></div>
            <div class="count" style="color: #fbfbfb"><?php
              foreach ($j_tr as $key) {
                echo $key->total;
              }
            ?></div>
            <h3 style="color: #fbfbfb">Transaksi baru</h3>
            <p style="color: #fbfbfb">Transaksi Hari ini</p>
          </div>
        </div>
      </a>
    <?php foreach ($j_proses as $key): ?>
      <a href="">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats" style="background-color: #2d6aa0; border-color: #2d6aa0;">
            <div class="icon" style="color: #fbfbfb"><i class="fa fa-institution"></i></div>
            <div class="count" style="color: #fbfbfb"><?php echo $key->gudangnya;?></div>
            <h3 style="color: #fbfbfb">Proses</h3>
            <p style="color: #fbfbfb">Gudang</p>
          </div>
        </div>
      </a>
      <a href="">
        <div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">
          <div class="tile-stats" style="background-color: #2d6aa0; border-color: #2d6aa0;">
            <div class="icon" style="color: #fbfbfb"><i class="fa fa-truck"></i></div>
            <div class="count" style="color: #fbfbfb"><?php echo $key->kirimnya;?></div>
            <h3 style="color: #fbfbfb">Proses</h3>
            <p style="color: #fbfbfb">Pengiriman</p>
          </div>
        </div>
      </a>
      <?php endforeach; ?>
    </div>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_content">
            <div class="col-md-9 col-sm-12 col-xs-12">
              <h2>Grafik Penjualan <small>Dalam satu tahun</small></h2>
              <div class="clearfix"></div>
              <div class="demo-container" style="height:300px">
                <canvas id="grafik_p"></canvas>
              </div>
            </div>
            <div class="col-md-3 col-sm-12 col-xs-12" style="border-left:1px solid blue;">
              <div class="x_title">
                <h2>Produk Terbanyak Terjual</h2>
                <div class="clearfix"></div>
              </div>
              <ul class="list-unstyled top_profiles scroll-view">
                <?php foreach ($m_brg as $key): ?>
                <li class="media event">
                  <div class="profile_pic">
                    <!-- <img src="<?php echo base_url();?>assets/uploads/produk/<?php echo $key->ft_produk; ?>" alt="..." class="img-circle profile_img"> -->
                  </div>
                  <div class="media-body">
                    <a class="title" href="#" style="font-size: 14pt"><?php echo $key->nm_produk;?></a>
                    <p style="font-size: 12pt">Terjual sebanyak <strong><?php echo $key->jumlah_stoknya;?> </strong> </p>
                  </div>
                </li>
                <?php endforeach; ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
 <?php
    for ($b=1; $b < 13 ; $b++) { 
      $dash_selesai = $this->login_model->grafik($b);
      if (!$dash_selesai) {
        $datanya[] = 0;
      }
      else{
        foreach ($dash_selesai as $row) {
          $datanya[] = (float) $row->jumlah;
        }
      }
    }
?>
<script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
<script type="text/javascript">
  var randomScalingFactor = function() {
      return Math.round(Math.random() * 1000);
  }
  var ctx = document.getElementById("grafik_p");
  var config = {
    type: 'line',
    data: {
      labels: ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"],
      datasets: [{
      label: "Data penjualan",
      borderColor: "rgba(38, 185, 154, 0.7)",
      pointBorderColor: "rgba(38, 185, 154, 0.7)",
      pointBackgroundColor: "rgba(38, 185, 154, 0.7)",
      pointHoverBackgroundColor: "#fff",
      pointHoverBorderColor: "rgba(220,220,220,1)",
      pointBorderWidth: 3,
      data:  <?php echo json_encode($datanya);?>
      }]
    },
  };
  var newChart = new Chart(ctx, config);
</script>