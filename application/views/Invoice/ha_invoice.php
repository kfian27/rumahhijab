<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <h2> List Invoice</h2>
          
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="form-group col-md-4 col-sm-4 col-xs-12" >
              <div class="input-group date col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" placeholder="yyyy-mm-dd" name="tanggal" id="tanggal">
              </div>
            </div>
          <div class="row" id="detail">
            <div class="col-sm-12 col-xs-12 col-md-12">
              <div class="table-responsive">
                <table class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>No Struk</th>
                      <th>Pelanggan</th>
                      <th>Asal</th>
                      <th>Produk</th>
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
  
    $('#tanggal').change(function(){
    var tgl = $('#tanggal').val();
     $.ajax({
        url : base_url + 'invoice/get_invoicehari',
        type : 'post',
        dataType : 'json',
        data : {tgl:tgl},
        success : function(data)
        {
          
          // alert(JSON.stringify(data));
          var html = '';
          for (i=0; i<data.length; i++){
            html += '<tr>'+
                        '<td>'+(i+1)+'</td>'+
                        '<td>'+data[i].no_invoice+'</td>'+
                        '<td>'+data[i].nm_invoice+'</td>'+
                        '<td>'+data[i].kota_invoice+'</td>'+
                        '<td>'+data[i].nm_produk+'</td>'+
                        '</tr>';
          }
          $('#tampil').html(html);
        }
      });
    });
    </script>