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
          <div class="form-group" >
              <div class="input-group col-md-3 col-sm-3 col-xs-12">
                <input type="text" class="form-control" placeholder="Masukkan Tanggal" name="tanggal" id="tanggal">
              </div>
            </div>
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
  $(function () {
        $('#tanggal').datetimepicker({
          format: 'YYYY-MM-DD'
        });
      });
  
    $('#tanggal').on('dp.change',function(e){
    var tgl = $('#tanggal').val();
    // alert(tgl);
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicehari",
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
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
    $('#tanggal').on('dp.change',function(e){
    var tgl = $('#tanggal').val();
    // alert(tgl);
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicehari1",
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total1').val(data[i].total);
          }
        }
      });
    });
    $('#tanggal').on('dp.change',function(e){
    var tgl = $('#tanggal').val();
    // alert(tgl);
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicehari2",
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total2').val(data[i].total);
          }
        }
      });
    });
    $('#tanggal').on('dp.change',function(e){
    var tgl = $('#tanggal').val();
    // alert(tgl);
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicehari3",
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total3').val(data[i].total);
          }
        }
      });
    });
    $('#tanggal').on('dp.change',function(e){
    var tgl = $('#tanggal').val();
    // alert(tgl);
     $.ajax({
        url : "<?php echo base_url();?>invoice/get_invoicehari4",
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
        success : function(data)
        {
          for (i=0; i<data.length; i++){
            $('#total4').val(data[i].total);
          }
        }
      });
    });
    </script>