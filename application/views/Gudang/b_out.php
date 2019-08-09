<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <h2> List Barang yang akan dikirim</h2>
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
                      <th>Nomer Invoice</th>
                      <th data-priority="1">Nama produk</th>
                      <th>Jumlah</th>
                      <th>Tanggal Invoice</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $a=1; foreach ($out_detail as $row): ?>
                  <tr>
                      <td ><?php echo $a; ?></td>
                      <td><?php echo $row->no_invoice; ?></td>
                      <td><?php echo $row->nm_produk; ?></td>
                      <td><?php echo $row->qty_di; ?></td>
                      <td><?php echo $row->tgl_invoice; $a++; ?></td>
                      <td>
                        <?php if($row->qty_di <= $row->stok_produk){?>
                        <a href="<?php echo base_url()?>/mgudang/keluar/<?php echo $row->id_di;?>/<?php echo $row->id_produk;?>/<?php echo $row->qty_di;?>/<?php echo $row->id_invoice;?>" class="btn btn-success"> Setujui</a>
                        <?php }else{?>
                          <a class="btn btn-danger" disabled="disabled"> Tidak bisa di setujui</a>
                        <?php }?>
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