<!-- page content -->
<?php date_default_timezone_set("asia/jakarta") ?>
<?php $this->load->model('mgudang_model');?>
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <a href="<?php echo base_url()?>/invoice/l_invoice/" class="btn btn-success"><i class="fa fa-angle-left"></i> Kembali </a>
          <div class="nav navbar-right ">
            <a class="btn btn-info" onclick="print_areannya('detail')"><i class="fa fa-print"></i> Cetak</a>
          </div>
        </div>
        <div class="x_content">
          <div class="row" id="detail">
            <?php foreach($rangking as $key=>$value){ 
              $namanya =  $this->mgudang_model->cek_nama($key);
              foreach ($namanya as $row) {
                echo $row->name." ".$value;
                echo "<br>";
              }
            }?>
        </div>
      </div>
    <div class="clearfix"></div>
  </div>
</div>
</div>
  <!-- end page content -->