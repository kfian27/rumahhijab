<!-- page content -->
<div class="right_col" role="main">
<div class="">
  <div class="row tile_count">
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-money"></i> Total Pendapatan</span>
              <div class="count">
                <?php foreach ($totalsemuainvoice_c as $row){
                   echo $row->total; }?>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-clock-o"></i> Transaksi</span>
              <div class="count">
                <?php foreach ($j_tr as $key) {
                  echo $key->total;
                }?>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-briefcase"></i> Produk Terjual</span>
              <div class="count">
                <?php foreach ($totalproduk_c as $row){
                   echo $row->total; }?>
              </div>
            </div>
            <div class="col-md-3 col-sm-3 col-xs-6 tile_stats_count">
              <span class="count_top"><i class="fa fa-mail-reply"></i> Stok Masuk</span>
              <div class="count">
                <?php foreach ($produkmasuk_c as $row){
                   echo $row->total; }?>
              </div>
            </div>
          </div>
    <div class="x_panel">
        <div class="x_title">
          <h2> List Invoice</h2>
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
                      <th data-priority="1">No invoice</th>
                      <th>Nama Pembeli</th>
                      <th>Kota</th>
                      <th>Diskon</th>
                      <th>Total</th>
                      <th>Tanggal Pembelian</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $a=1; foreach ($invoice_detail_c as $row): ?>
                  <tr>
                      <td ><?php echo $a; ?></td>
                      <td><?php echo $row->no_invoice; ?></td>
                      <td><?php echo $row->nm_invoice; ?></td>
                      <td><?php echo $row->kota_invoice; ?></td>
                      <td><?php echo $row->diskon_invoice; ?></td>
                      <td><?php echo $row->harga_invoice; ?></td>
                      <td><?php echo $row->tgl_invoice; $a++; ?></td>
                      <td>
                        <a href="<?php echo base_url()?>/invoice/d_invoice/<?php echo $row->id_invoice;?>" class="btn btn-info">Detail</a>
                      </td>
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