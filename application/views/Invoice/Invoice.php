<!-- page content -->
<div class="right_col" role="main" id="view">
  <div class="">
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <div class="x_title">
            <h2>invoice</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content" id="detail">
            <form action="<?=base_url()?>invoice/action" method="post" class="form-horizontal form-label-left" novalidate>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="pelanggan">Pelanggan <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="input-group">
                  <select id="pelanggan" name="pelanggan" class="form-control col-md-12 col-sm-12 col-xs-12" style="width: 100%;" required="required">
                    <option></option>
                    <?php foreach ($pelanggan_detail as $key): ?>
                      <option value="<?php echo $key->id_plg; ?>"><?php echo $key->nm_plg ?></option>
                    <?php endforeach; ?>
                  </select>
                  <span class="input-group-btn">
                    <button id="tombol-tambah" class="btn btn-primary" onclick="javascript:tambah();"><i class="fa fa-plus"></i></button>
                  </span>
                </div>
                </div>
              </div>
              <div class="plg" style="display: none;">
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alm_plg">Nama Toko</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="nm_plg" name="nm_plg" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="alm_plg">Alamat</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="alm_plg" name="alm_plg" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                <div class="item form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kota_plg">Kota</label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                    <input type="text" id="kota_plg" name="kota_plg" class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="produk">produk <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <select id="produk" name="produk" class="form-control col-md-12 col-sm-12 col-xs-12" style="width: 100%;">
                    <option></option>
                    <?php foreach ($produk_detail as $key): ?>
                      <option value="<?php echo $key->id_produk; ?>" 
                        harga="<?php echo $key->harga_produk; ?>"
                        harga3="<?php echo $key->harga3_produk; ?>"
                        harga6="<?php echo $key->harga6_produk; ?>"
                        harga10="<?php echo $key->harga10_produk; ?>"
                        harga20="<?php echo $key->harga20_produk; ?>"
                        ><?php echo $key->nm_produk; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="item form-group" >
                <label class="control-label col-md-5 col-sm-5 col-xs-12" style="display: none;" id="notif"><p style="color: red;">STOK TIDAK CUKUP</p></label>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="ekspedisi">Quantity <span class="required">*</span>
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <div class="input-group" >
                    <input type="number" id="qty" name="qty" class="form-control" data-validate-minmax="1, 999">
                    <span class="input-group-btn">
                      <button id="add_produk" type="button" class="btn btn-info ">Submit dan Tambah Item</button>
                    </span>
                  </div>
                </div>
              </div>
              <div class="item form-group table-responsive col-sm-12 col-xs-12 col-md-12">
                <table id="jual" class="table table-bordered">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Nama produk</th>
                      <th>Harga (satuan)</th>
                      <th>Quantity</th>
                      <th>Jumlah</th>
                      <th>Hapus</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berat">Tagihan Awal
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" id="totalHidden" name="totalHidden" class="form-control col-md-7 col-xs-12">
                  <input type="text" id="total" name="total" class="form-control col-md-7 col-xs-12" disabled>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berat">Diskon (Rp.)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" id="diskon" name="diskon" placeholder="Diskon dalam bentuk bilangan rupiah. Contoh 5000" class="form-control col-md-7 col-xs-12" required>
                  <span class="form-control-feedback right" aria-hidden="true">.00</span>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="berat">Tagihan Akhir
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" id="harga_invoice" name="harga_invoice" class="form-control col-md-7 col-xs-12">
                  <input type="text" id="grandtotal" name="grandtotal" class="form-control col-md-7 col-xs-12" disabled>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="bayar">Tunai (Rp.)
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="number" id="bayar" name="bayar" data-validate-minmax="1000,100000000" class="form-control col-md-7 col-xs-12" required>
                  <span class="form-control-feedback right" aria-hidden="true">.00</span>
                </div>
              </div>
              <div class="item form-group">
                <label class="control-label col-md-3 col-sm-3 col-xs-12" for="kembali">Kembalian
                </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="hidden" id="kembaliHidden" name="kembaliHidden" class="form-control col-md-7 col-xs-12" disabled>
                  <input type="text" id="kembali" name="kembali" class="form-control col-md-7 col-xs-12" disabled>
                </div>
              </div>
              <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-3 col-md-offset-3">
                  <button id="simpan" type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </form>
          </div>
          <div class="clearfix"></div>
          <div class="row" id="form-tambah" id="form-tambah" style="display: none;">
          <form class="form-horizontal"  method="post" id="detail-tambah" name="detail-tambah" enctype="multipart/form-data">
            <input type="hidden" name="id_plg" id="id_plg">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Nama Pelanggan </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" placeholder="Nama Toko" name="nm_plg" id="nm_plg" required>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Alamat </label>
                <div class="col-md-6 col-sm-6 col-xs-12">
                  <input type="text" class="form-control" placeholder="Alamat" name="alm_plg" id="alm_plg" required>
                </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Kota </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" placeholder="Kota" name="kota_plg" id="kota_plg" required>
                <!-- <select class="form-control" name="kota_plg" id="kota_plg" required="required">
                  <option value="0">-pilih produk-</option>
                </select> -->
              </div>
            </div>
            <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                    <button class="btn btn-primary" type="button" onclick="javascript:cancel();">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success" onclick="javascript:simpan('mplg/coba_insert');" id="save" name="save">Submit</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function tambah(){
  $('#detail').hide();
  $('#form-tambah').show();
  $('#tombol-tambah').attr('disabled',true);
}
function cancel(){
  $('#detail').show();
  $('#form-tambah').hide();
  $('#tombol-tambah').attr('disabled',false);
}
function simpan(url){
  $('#save').val('saving . . ');
  $('#save').attr('disabled',true);
  $("#detail-tambah").click(function(evt){
      evt.preventDefault();
      var formData = new FormData($(this)[0]);
      $.ajax({
          url: "<?php echo base_url()?>" + url,
          type: 'POST',
          data: formData,
          async: false,
          cache: false,
          contentType: false,
          enctype: 'multipart/form-data',
          processData: false,
          success: function (response) {
            swal("Data telah tersimpan", {
              icon: "success",
              buttons: true
            });
            location.reload();
          }
      });
      return false;
  });
}

 $('#qty').keyup(function(){
    var produk = $('#produk').val();
    var qtynya = parseInt($('#qty').val());
    // alert(qtynya);
     $.ajax({
        url : "<?php echo base_url();?>mproduk/get_detail/"+produk,
        type : 'post',
        dataType : 'json',
        // data : {produk:produk},
        success : function(data)
        {
          // alert(data.data.stok_produk);
          var stoknya = parseInt(data.data.stok_produk);
           // $('#coba').val(data.data.stok_produk);
            if (qtynya > stoknya) {
                $('#notif').show();
                $('#simpan').attr('disabled',true);
                $('#add_produk').attr('disabled',true);
            }
            if (qtynya <= stoknya){
              $('#notif').hide();
              $('#simpan').attr('disabled',false);
              $('#add_produk').attr('disabled',false);
            }
        }
    });
  });

  $(document).ready(function(){
    fill_table();
    fill_subttl();
  });
  function to_rupiah(angka){
    var rev     = parseInt(angka, 10).toString().split('').reverse().join('');
    var rev2    = '';
    for(var i = 0; i < rev.length; i++){
        rev2  += rev[i];
        if((i + 1) % 3 === 0 && i !== (rev.length - 1)){
            rev2 += '.';
        }
    }
    return 'Rp. ' + rev2.split('').reverse().join('');
  }
  $('#pelanggan').change(function(){
    id_plg = $(this).val();
    if(id_plg != '')
    {
        $.ajax({
            url:"<?php echo base_url(); ?>mplg/get_by_id",
            method:"POST",
            data:{id_plg:id_plg},
            dataType:"json",
            success:function(data)
            {
                $('#nm_plg').val(data.nm_plg);
                $('#alm_plg').val(data.alm_plg);
                $('#kota_plg').val(data.kota_plg);
                $('.plg').show();
            },
            error : function(res)
            {
                show_message('Gagal',(res.responseText));
            }
        })
    }
  });

  $('#add_produk').click(function(){
    var id_produk = $('#produk').val();
    var qty = $('#qty').val();
    if (qty < 3){
      var harga_produk = $('#produk option:selected').attr("harga");
    }if (qty >= 3 && qty < 6){
      var harga_produk = $('#produk option:selected').attr("harga3");
    }if (qty >= 6 && qty < 10){
      var harga_produk = $('#produk option:selected').attr("harga6");
    }if (qty >= 10 && qty < 20){
      var harga_produk = $('#produk option:selected').attr("harga10");
    }if (qty >= 20){
      var harga_produk = $('#produk option:selected').attr("harga20");
    }
    if(id_produk && qty)
    {
        $.ajax({
            url:"<?php echo base_url(); ?>invoice/save_tmp",
            method:"POST",
            data:{id_produk:id_produk, qty:qty, harga_produk:harga_produk},
            //dataType:"json",
            success:function(data)
            {
                fill_table();
                fill_subttl();
                fill_ttl();
                $('#produk').val(null).trigger('change');
                $('#qty').val('');
                clearInput();
            }
        })
    }
  });

  $(document).on('click', '#del', function(){
    id_di = $(this).attr('dt-id');
    $.ajax({
        url:"<?php echo base_url(); ?>invoice/del_tmp",
        method:"POST",
        data:{id_di:id_di},
        success : function(data)
        {
            fill_table();
            fill_subttl();
            fill_ttl()
            clearInput();
        }
    });
  });

  function fill_table(){
    $.ajax({
        url:"<?php echo base_url(); ?>invoice/get_tmp",
        method:"POST",
        success:function(data)
        {   
            $('#jual > tbody').empty();
            $('#jual').append(data);
        }
    })
  }

  function fill_subttl(){
    $.ajax({
        url:"<?php echo base_url(); ?>invoice/get_harga",
        method:"POST",
        dataType:"json",
        success:function(data)
        {
            if (data.DT_TOTAL != null){
                $('#totalHidden').val(data.DT_TOTAL);
                $('#total').val(to_rupiah(data.DT_TOTAL));
                $('#diskon').val("0");
                fill_ttl();
            }else{
                $('#total').val('Rp. 0');
            }
            
        }
    })
  }

  $('#diskon').keyup(function(){
    fill_ttl();
  });

  function fill_ttl(){
    // subttl = Number($('#totalHidden').val())-(Number($('#totalHidden').val())* Number($('#diskon').val())/100);
    subttl = Number($('#totalHidden').val())-Number($('#diskon').val());
    if (subttl != null){
        $('#harga_invoice').val(subttl);
        $('#grandtotal').val(to_rupiah(subttl));
    }else{
        $('#grandtotal').val('Rp. 0');
    }
  }

   $('#bayar').keyup(function(){
    grandttl = Number($('#harga_invoice').val());
    bayar = Number($('#bayar').val());
    if (grandttl != null){
        $('#kembaliHidden').val(bayar - grandttl);
        $('#kembali').val(to_rupiah(bayar - grandttl));
    }else{
        $('#kembali').val('Rp. 0');
    }
  });

  function clearInput(){
    $('#bayar').val('');
    $('#harga_invoice').val('');
    $('#grandtotal').val('');
    $('#kembaliHidden').val('');
    $('#kembali').val('');
  }
</script>
<!-- /page content -->