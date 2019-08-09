<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <h2> History barang masuk dan keluar</h2>
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
                      <th>Produk</th>
                      <th>Jumlah</th>
                      <th>Keterangan</th>
                      <th>Tanggal Update</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $a=1; foreach ($gudang_detail as $row): ?>
                  <tr>
                      <td><?php echo $a; ?></td>
                      <td><?php echo $row->id_produk; ?></td>
                      <td><?php echo $row->jumlah_stok; ?></td>
                      <td><?php echo $row->keterangan; ?></td>
                      <td><?php echo $row->up_gudang; $a++; ?></td>
                  </tr>
                    <?php endforeach; ?>
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