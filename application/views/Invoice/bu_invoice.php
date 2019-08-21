<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="row tile_count">
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-money"></i> Total Pendapatan</span>
      <div class="count"><input type="" id="total1" disabled>
      </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-clock-o"></i> Transaksi</span>
      <div class="count"><input type="" id="total2" disabled>
      </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-briefcase"></i> Produk Terjual</span>
      <div class="count"><input type="" id="total3" disabled>
      </div>
    </div>
    <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
      <span class="count_top"><i class="fa fa-mail-reply"></i> Stok Masuk</span>
      <div class="count"><input type="" id="total4" disabled>
      </div>
    </div>
  </div>
    <div class="x_panel">
        <div class="x_title">
          <h2> List Invoice</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
        <form class="form-horizontal" enctype="multipart/form-data">
        <div class="form-group col-md-4 col-sm-6 col-xs-12">
              <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Tahun  </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" name="tahun" id="tahun" required="required">
                  <option value="0">-Pilih Tahun-</option>
                  <?php $tahun = 2019; for ($i=0; $i < 99; $i++) { ?>
                    <option value="<?php echo $tahun; ?>"><?php echo $tahun; ?></option>
                  <?php $tahun++; } ?>
                </select>
            </div>
        </div>
        <div class="form-group col-md-4 col-sm-6 col-xs-12">
              <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Bulan  </label>
              <div class="col-md-8 col-sm-8 col-xs-12">
                <select class="form-control" placeholder="Bulan" name="bulan" id="bulan" required="required">
                  <option value="">Pilih Bulan</option>
                  <option value="01">Januari</option>
                  <option value="02">Februari</option>
                  <option value="03">Maret</option>
                  <option value="04">April</option>
                  <option value="05">Mei</option>
                  <option value="06">Juni</option>
                  <option value="07">Juli</option>
                  <option value="08">Agustus</option>
                  <option value="09">September</option>
                  <option value="10">Oktober</option>
                  <option value="11">Nopember</option>
                  <option value="12">Desember</option>
                </select>
              </div>
          </div>
          <div class="form-group col-md-2 col-sm-2 col-xs-12">
              <a class="btn btn-success" onclick="refresh();"><i class="fa fa-refresh"></i></a>
            </div>
        </form>
          <div class="row" id="detail">
            <div class="col-sm-12 col-xs-12 col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No Struk</th>
                      <th>Pelanggan</th>
                      <th>Asal</th>
                      <th>Produk</th>
                      <th>Qty</th>
                      <th>Sub Total</th>
                      <th>Total Harga</th>
                      <th>Diskon</th>
                      <th>Tanggal</th>
                    </tr>
                  </thead>
                  <tbody id="tampil">
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      </div>
    <div class="clearfix"></div>
  </div>
<!-- end page content -->

<script>
  function refresh() {
      location.reload();
    }
  if ($('#bulan').val()==""){
    $('#tahun').change(function(){
    var tah = $('#tahun').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoiceta",
        type : 'post',
        dataType : 'json',
        data : {tah:tah},
        success : function(data)
        {
          
          // alert(JSON.stringify(data));
          var html = '';
          for (i=0; i<data.length; i++){
            html += '<tr>'+
                        '<td>'+data[i].no_invoice+'</td>'+
                        '<td>'+data[i].nm_invoice+'</td>'+
                        '<td>'+data[i].kota_invoice+'</td>'+
                        '<td>'+data[i].nm_produk+'</td>'+
                        '<td>'+data[i].qty_di+'</td>'+
                        '<td>'+data[i].total_di+'</td>'+
                        '<td>'+data[i].harga_invoice+'</td>'+
                        '<td>'+data[i].diskon_invoice+'</td>'+
                        '<td>'+data[i].tgl_invoice+'</td>'+
                        '</tr>';
          }
          $('#tampil').html(html);
        }
      });
    });
    $('#tahun').change(function(){
    var tah = $('#tahun').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoiceta1",
        type : 'post',
        dataType : 'json',
        data : {tah:tah},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total1').val(data[i].total);
          }
        }
      });
    });
    $('#tahun').change(function(){
    var tah = $('#tahun').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoiceta2",
        type : 'post',
        dataType : 'json',
        data : {tah:tah},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total2').val(data[i].total);
          }
        }
      });
    });
    $('#tahun').change(function(){
    var tah = $('#tahun').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoiceta3",
        type : 'post',
        dataType : 'json',
        data : {tah:tah},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total3').val(data[i].total);
          }
        }
      });
    });
    $('#tahun').change(function(){
    var tah = $('#tahun').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoiceta4",
        type : 'post',
        dataType : 'json',
        data : {tah:tah},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total4').val(data[i].total);
          }
        }
      });
    });
  }
  if ($('#bulan').val()!=null){  
    $('#bulan').change(function(){
    var tah = $('#tahun').val();
    var bul = $('#bulan').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicebu",
        type : 'post',
        dataType : 'json',
        data : {tah:tah,bul:bul},
        success : function(data)
        {
          
          // alert(JSON.stringify(data));
          var html = '';
          for (i=0; i<data.length; i++){
            html += '<tr>'+
                        '<td>'+data[i].no_invoice+'</td>'+
                        '<td>'+data[i].nm_invoice+'</td>'+
                        '<td>'+data[i].kota_invoice+'</td>'+
                        '<td>'+data[i].nm_produk+'</td>'+
                        '<td>'+data[i].qty_di+'</td>'+
                        '<td>'+data[i].total_di+'</td>'+
                        '<td>'+data[i].harga_invoice+'</td>'+
                        '<td>'+data[i].diskon_invoice+'</td>'+
                        '<td>'+data[i].tgl_invoice+'</td>'+
                        '</tr>';
          }
          $('#tampil').html(html);
        }
      });
    });
    $('#bulan').change(function(){
    var tah = $('#tahun').val();
    var bul = $('#bulan').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicebu1",
        type : 'post',
        dataType : 'json',
        data : {tah:tah,bul:bul},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total1').val(data[i].total);
          }
        }
      });
    });
    $('#bulan').change(function(){
    var tah = $('#tahun').val();
    var bul = $('#bulan').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicebu2",
        type : 'post',
        dataType : 'json',
        data : {tah:tah,bul:bul},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total2').val(data[i].total);
          }
        }
      });
    });
    $('#bulan').change(function(){
    var tah = $('#tahun').val();
    var bul = $('#bulan').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicebu3",
        type : 'post',
        dataType : 'json',
        data : {tah:tah,bul:bul},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total3').val(data[i].total);
          }
        }
      });
    });
    $('#bulan').change(function(){
    var tah = $('#tahun').val();
    var bul = $('#bulan').val();
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicebu4",
        type : 'post',
        dataType : 'json',
        data : {tah:tah,bul:bul},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total4').val(data[i].total);
          }
        }
      });
    });
  }
    </script>