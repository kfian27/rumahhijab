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
        <h2> User <small>form input </small></h2>
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
                    <th>Level</th>
                    <th>Cabang</th>
                    <th>Username</th>
                    <th>Terakhir Login</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $a=1; foreach ($user_detail as $row): ?>
                <tr>
                    <td><?php echo $a; ?></td>
                    <td><?php echo $row->id_lvl;?></td>
                    <td><?php echo $row->id_cabang;?></td>
                    <td><?php echo $row->username;?></td>
                    <td><?php echo $row->last_user; $a++; ?></td>
                    <td>
                        <button type="button" data-title='Delete' data-toggle='modal' onclick="javascript:hapus('muser/delete/<?php echo $row->id_user; ?>/<?php echo $row->ft_user; ?>');" class="btn btn-danger pull-right"> Hapus</button>
                        <button type="button" data-title='Edit' onclick="javasript:ubah('muser/get_detail/<?php echo $row->id_user; ?>')" class="btn btn-primary pull-right"> Edit</button>
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
          <input type="hidden" name="id_user" id="id_user">
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Username </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Password </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Cabang </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <select class="form-control" name="id_cabang" id="id_cabang" required="required">
                  <option value="0">-pilih cabang-</option>
                  <?php foreach ($cabang_detail as $row): ?>
                  <option value="<?php echo $row->id_cabang;?>"><?php echo $row->nm_cabang;?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Level </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <select class="form-control" name="id_lvl" id="id_lvl" required="required">
                  <option value="0">-pilih level-</option>
                  <?php foreach ($level_detail as $row): ?>
                  <option value="<?php echo $row->id_lvl;?>"><?php echo $row->nm_lvl;?></option>
                  <?php endforeach; ?>
                </select>
              </div>
          </div>
          <div class="col-md-12 col-sm-12 col-xs-12 form-group">
              <label for="tiga" class="col-sm-2 control-label"> Foto </label>
              <div class="col-md-10 col-sm-10 col-xs-10">
                <input type="hidden" name="fotonya" id="fotonya">
                <input type="file" accept="image/*" name="ft_user" class="form-control" id="foto" multiple>
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
                  <button type="submit" class="btn btn-success" onclick="javascript:simpan('muser/coba_insert');" id="save" name="save">Submit</button>
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
    $('#id_user').val("");
    $('#id_lvl').val("");
    $('#id_cabang').val("");
    $('#username').val("");
    $('#password').val("");
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
            var fotomu  = data.data.ft_user; 
            $('#detail').hide();
            // $.fillToForm("#detail-tambah", data.data);
            $('#id_lvl').val(data.data.id_lvl);
            $('#id_cabang').val(data.data.id_cabang);
            $('#username').val(data.data.username);
            $('#id_user').val(data.data.id_user);
            $('#imagenya').attr("src","<?php echo base_url();?>assets/uploads/profil/"+fotomu);
            $('#fotonya').val(data.data.ft_user);
            $('#form-tambah').show();
            $('#password').attr('disabled',true)
        },
        error : function(res)
        {
            show_message('Gagal',(res.responseText));
        }
    });
}
</script>