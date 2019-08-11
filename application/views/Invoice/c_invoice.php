<!-- page content -->
<div class="right_col" role="main">
<div class="">
    <div class="x_panel">
        <div class="x_title">
          <h2> List Invoice</h2>
          <div class="nav navbar-right ">
            <a class="btn btn-info"><i class="fa fa-money"></i> 
              <?php foreach ($totalsemuainvoice_c as $row): ?>
              <?php echo $row->total; ?></a>
            <?php endforeach ?>
          </div>
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
                      <th>Harga</th>
                      <th>Tanggal Pembelian</th>
                      <th>Status</th>
                      <th data-priority="2">Kasir</th>
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
                      <td><?php echo $row->harga_invoice; ?></td>
                      <td><?php echo $row->tgl_invoice; $a++; ?></td>
                      <td><?php echo $row->st_invoice; ?></td>
                      <td><?php echo $row->id_user; ?></td>
                      <td>
                        <a href="<?php echo base_url()?>/invoice/d_invoice/<?php echo $row->id_invoice;?>" class="btn btn-info">Detail</a>
                        <?php if($row->status_bayar=="Belum lunas"):?>
                        <a href="<?php echo base_url()?>/invoice/d_invoice/<?php echo $row->id_invoice;?>" class="btn btn-success">Bayar</a>
                      <?php endif; ?>
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