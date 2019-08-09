<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <h2> Barang Masuk <small>form input </small></h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="clearfix"></div>
          <div class="row" id="form-tambah">
          <form class="form-horizontal"  method="post" id="detail-tambah" name="detail-tambah" enctype="multipart/form-data">
            <input type="hidden" name="id_gudang" id="id_gudang">
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Produk </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <select class="form-control" name="id_produk" id="id_produk" required="required">
                  <option value="0">-pilih produk-</option>
                  <?php foreach ($produk_detail as $row): ?>
                  <option value="<?php echo $row->id_produk;?>"><?php echo $row->nm_produk;?></option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
            <div class="col-md-12 col-sm-12 col-xs-12 form-group">
                <label for="tiga" class="col-sm-2 control-label"> Jumlah </label>
                <div class="col-md-10 col-sm-10 col-xs-10">
                  <input type="number" class="form-control" placeholder="number" name="jumlah_stok" id="jumlah_stok" required>
                </div>
            </div>
            <div class="ln_solid"></div>
                <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                    <button class="btn btn-primary" type="button" onclick="javascript:cancel();">Cancel</button>
                    <button class="btn btn-primary" type="reset">Reset</button>
                    <button type="submit" class="btn btn-success" onclick="javascript:simpan('mgudang/coba_insert/masuk');" id="save" name="save">Submit</button>
                  </div>
                </div>
            </form>
          </div>
        </div>
        </div>
      </div>
    <div class="clearfix"></div>
  </div>
<!-- end page content -->
<script type="text/javascript">
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
</script>