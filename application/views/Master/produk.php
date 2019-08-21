 <style>
  #image-holder {
      margin-top: 8px;
  }

  #image-holder img {
      border: 8px solid #DDD;
      max-width:50%;
  }
</style>
  <!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="x_panel">
      <div class="x_title">
        <h2> Produk <small>form input </small></h2>
        <ul class="nav navbar-right panel_toolbox">
              <li><button id="tombol-tambah" class="btn btn-primary" onclick="javascript:tambah();"> Tambah <i class="fa fa-plus"></i></button>
              </li>
            </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <div class="row" id="detail">
          <div class="col-sm-12 col-xs-12 col-md-12">
            <div class="table-responsive">
              <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>Nama</th>
                    <th>Jenis</th>
                    <th>Harga < 3</th>
                    <th>Harga 3 - 5</th>
                    <th>Harga 6 - 9</th>
                    <th>Harga 10 - 19</th>
                    <th>Harga 20 ></th>
                    <th>Stok</th>
                    <th>Update</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $a=1; foreach ($produk_detail as $row): ?>
                <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row->nm_produk;?></td>
                    <td><?php echo $row->nm_cat;?></td>
                    <td><?php echo $row->harga_produk;?></td>
                    <td><?php echo $row->harga3_produk;?></td>
                    <td><?php echo $row->harga6_produk;?></td>
                    <td><?php echo $row->harga10_produk;?></td>
                    <td><?php echo $row->harga20_produk;?></td>
                    <td><?php echo $row->stok_produk;?></td>
                    <td><?php echo $row->up_produk; $a++; ?></td>
                    <td>
                        <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('mproduk/delete/<?php echo $row->id_produk; ?>/<?php echo $row->ft_produk; ?>');" class="btn btn-danger pull-right"> Hapus</button>
                        <button type="button" data-title='Edit' onclick="javasript:ubah('mproduk/get_detail/<?php echo $row->id_produk; ?>')" class="btn btn-primary pull-right"> Edit</button>
                    </td>
                </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
        <div class="row" id="form-tambah" style="display: none;">
        <form class="form-horizontal"  method="post" id="detail-tambah" name="detail-tambah" enctype="multipart/form-data">
          <input type="hidden" name="id_produk" id="id_produk">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Nama Produk</label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <input type="text" class="form-control" placeholder="Nama produk" name="nm_produk" id="nm_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-md-3 col-sm-3 col-xs-12 control-label"> Jenis Produk  </label>
              <div class="col-md-6 col-sm-6 col-xs-12">
                <select class="form-control" name="id_cat" id="id_cat" required="required">
                  <option value="0">-pilih jenis-</option>
                  <?php foreach ($kategori_detail as $row): ?>
                  <option value="<?php echo $row->id_cat;?>"><?php echo $row->nm_cat;?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label">Harga < 3 </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="number" class="form-control" placeholder="harga" name="harga_produk" id="harga_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label">Harga 3 - 5 </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="number" class="form-control" placeholder="harga" name="harga3_produk" id="harga3_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label">Harga 6 - 9 </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="number" class="form-control" placeholder="harga" name="harga6_produk" id="harga6_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label">Harga 10 - 19 </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="number" class="form-control" placeholder="harga" name="harga10_produk" id="harga10_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label">Harga 20 > </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="number" class="form-control" placeholder="harga" name="harga20_produk" id="harga20_produk" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Foto </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="hidden" name="fotonya" id="fotonya">
                <input type="file" accept="image/*" name="ft_produk" class="form-control" id="foto" multiple>
                        <div id="image-holder">
                          <img src="" id="imagenya">
                        </div>
                        <script>
                            $("#foto").on('change', function () {

                                //Get count of selected files
                                var countFiles = $(this)[0].files.length;

                                var imgPath = $(this)[0].value;
                                var extn = imgPath.substring(imgPath.lastIndexOf('.') + 1).toLowerCase();
                                var image_holder = $("#image-holder");
                                image_holder.empty();

                                var x = document.getElementById("foto");
                                var file = x.files[0];

                                if (extn == "png" || extn == "jpg" || extn == "jpeg" || extn == "gif") {
                                    if (typeof (FileReader) != "undefined") {

                                        //loop for each file selected for uploaded.
                                        for (var i = 0; i < countFiles; i++) {

                                            var reader = new FileReader();
                                            reader.onload = function (e) {
                                                $("<img />", {
                                                    "src": e.target.result,
                                                    "class": "thumb-image"
                                                }).appendTo(image_holder);
                                            }

                                            image_holder.show();
                                            reader.readAsDataURL($(this)[0].files[i]);
                                        }

                                    } else {
                                        alert("This browser does not support FileReader.");
                                    }
                                } else {
                                    alert("hanya boleh foto bertype PNG, JPG dan GIF");
                                    var control = $("#foto");
                                    control.replaceWith(control.val('').clone(true));
                                }
                            });
          
                        </script>
              </div>
          </div>
          <div class="ln_solid"></div>
              <div class="form-group">
                <div class="col-md-6 col-sm-6 col-xs-12 pull-right">
                  <button class="btn btn-primary" type="button" onclick="javascript:cancel();">Cancel</button>
                  <button class="btn btn-primary" type="reset">Reset</button>
                  <button type="submit" class="btn btn-success" onclick="javascript:simpan('mproduk/coba_insert');" id="save" name="save">Submit</button>
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
function tambah(){
    $('#detail').hide();
    $('#form-tambah').show();
    $('#tombol-tambah').attr('disabled',true);
    $('#id_produk').val("");
    $('#nm_produk').val("");
    $('#harga_produk').val("");
    $('#harga3_produk').val("");
    $('#harga6_produk').val("");
    $('#harga10_produk').val("");
    $('#harga20_produk').val("");
    $('#imagenya').hide();
    $('#fotonya').val("");
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
function hapus(url){
    $.ajax({
        url : "<?php echo base_url()?>" + url,
        type : 'post',
        dataType : 'json',
        success : function(data)
        {
            if(data.status == 'ok')
            {
                alert("Data berhasil dihapus");
                location.reload();
            }
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
function ubah(url){
    $.ajax({
        url : "<?php echo base_url()?>" + url ,
        type : 'post',
        dataType : 'json',
        success : function(data)
        {
            var fotomu  = data.data.ft_produk; 
            $('#detail').hide();
            // $.fillToForm("#detail-tambah", data.data);
            $('#nm_produk').val(data.data.nm_produk);
            $('#id_cat').val(data.data.id_cat);
            $('#harga_produk').val(data.data.harga_produk);
            $('#harga3_produk').val(data.data.harga3_produk);
            $('#harga6_produk').val(data.data.harga6_produk);
            $('#harga10_produk').val(data.data.harga10_produk);
            $('#harga20_produk').val(data.data.harga20_produk);
            $('#id_produk').val(data.data.id_produk);
            $('#imagenya').attr("src","<?php echo base_url();?>assets/uploads/produk/"+fotomu);
            $('#fotonya').val(data.data.ft_produk);
            $('#form-tambah').show();
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
function konfirmasi(url){
  url : url;
  swal({
  title: "Apa anda yakin ?",
  text: "Data akan terhapus secara permanen",
  icon: "warning",
  buttons: true,
  dangerMode: true,
  })
  .then((willDelete) => {
    if (willDelete) {
      swal("Data telah tehapus!", {
        icon: "success",
      });
      return hapus(url);
    } else {
      swal("Batal menghapus data!");
    }
  });
}
</script>