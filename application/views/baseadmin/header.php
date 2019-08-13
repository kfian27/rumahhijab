<!DOCTYPE html>
<html lang="en">

  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Rumah Hijab</title>
    <link rel="shortcut icon" href="<?php echo base_url();?>assets/home/images/favicon.ico">
    <!-- jQuery -->
    <script src="<?php echo base_url();?>assets/dash/vendors/jquery/dist/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/dash/vendors/moment/min/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/dash/vendors/bootstrap-datetimepicker/build/js/bootstrap-datetimepicker.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/dash/vendors/DateJS/build/date.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/dash/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Select 2 -->
    <link href="<?php echo base_url();?>assets/dash/vendors/select2/dist/css/select2.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="<?php echo base_url();?>assets/dash/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- summernote -->
    <link href="<?php echo base_url();?>assets/dash/vendors/summernote/dist/summernote.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="<?php echo base_url();?>assets/dash/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="<?php echo base_url();?>assets/dash/vendors/nprogress/nprogress.css" rel="stylesheet">
    <!-- Datatables -->
    <link href="<?php echo base_url();?>assets/dash/vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dash/vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dash/vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo base_url();?>assets/dash/vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">
    <!-- bootstrap-daterangepicker -->
    <link href="<?php echo base_url();?>assets/dash/vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
    <!-- bootstrap-datetimepicker -->
    <link href="<?php echo base_url();?>assets/dash/vendors/bootstrap-datetimepicker/build/css/bootstrap-datetimepicker.css" rel="stylesheet">
    <!-- animate.css -->
    <link href="<?php echo base_url();?>assets/dash/vendors/animate.css/animate.min.css" rel="stylesheet">
     <!-- jQuery custom content scroller -->
    <link href="<?php echo base_url();?>assets/dash/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.min.css" rel="stylesheet"/>
    <!-- Custom Theme Style -->
    <link href="<?php echo base_url();?>assets/dash/build/css/custom.min.css" rel="stylesheet">
    <!-- <script src="<?php echo base_url();?>assets/js/base.js" type="text/javascript"></script> -->
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col menu_fixed">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="<?php echo base_url();?>admin" class="site_title"><img src="<?php echo base_url();?>assets/uploads/profil/logo.jpeg" style="width: 60px; height: 40px;"><span style="font-weight: bold; font-style: italic;"> Rumah Hijab</span></a>
            </div>

            <div class="clearfix"></div>

            <!-- menu profile quick info -->
            <div class="profile clearfix">
              <div class="profile_pic">
                <img src="<?php echo base_url();?>assets/uploads/profil/<?php echo $this->session->userdata('foto'); ?>" alt="..." class="img-circle profile_img">
              </div>
              <div class="profile_info">
                <span>Welcome,</span>
                <h2><?php echo $this->session->userdata('name'); ?></h2>
              </div>
              <div>
                <p style="color: #fbfbfb; font-size: 9pt; margin: 6px">Terakhir login pada <?php echo $this->session->userdata('last'); ?></p></div>
            </div>
            <!-- /menu profile quick info -->

            <br />

            <!-- sidebar menu -->
            <?php if ($this->session->userdata('level')=="1" || $this->session->userdata('level')=="2"):?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url();?>invoice/t_invoice"><i class="fa fa-plus"></i> Tambah Invoice </a></li>
                  <li><a><i class="fa fa-book"></i> Laporan <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>invoice/c_invoice"><i class="fa fa-tasks"></i> Current Invoice</a></li>
                      <li><a href="<?php echo base_url();?>invoice/ha_invoice"><i class="fa fa-tasks"></i> Per Hari Invoice</a></li>
                      <li><a href="<?php echo base_url();?>invoice/mi_invoice"><i class="fa fa-tasks"></i> Hari-hari Invoice</a></li>
                      <li><a href="<?php echo base_url();?>invoice/bu_invoice"><i class="fa fa-tasks"></i> Bulanan Invoice</a></li>
                      <li><a href="<?php echo base_url();?>invoice/ta_invoice"><i class="fa fa-tasks"></i> Tahunan Invoice</a></li>
                      <li><a href="<?php echo base_url();?>invoice/l_invoice"><i class="fa fa-list-ul"></i> List All Invoice</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-suitcase"></i> Produk <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>gudang/b_in"><i class="fa fa-mail-reply"></i> Barang Masuk</a></li>
                      <li><a href="<?php echo base_url();?>gudang/b_out"><i class="fa fa-mail-forward"></i> Barang Keluar</a></li>
                      <li><a href="<?php echo base_url();?>gudang/list_b"><i class="fa fa-list-ul"></i> Detail Barang</a></li>
                      <li><a href="<?php echo base_url();?>master/produk"><i class="fa fa-ticket"></i> Produk</a></li>
                      <li><a href="<?php echo base_url();?>master/cat_produk"><i class="fa fa-tags"></i> Kategori Produk</a></li>
                    </ul>
                  </li>
                  <li><a><i class="fa fa-code-fork"></i> Master <span class="fa fa-chevron-down"></span></a>
                    <ul class="nav child_menu">
                      <li><a href="<?php echo base_url();?>master/pelanggan"><i class="fa fa-users"></i> Pelanggan</a></li>
                      <li><a href="<?php echo base_url();?>master/user"><i class="fa fa-user"></i> User</a></li>
                      <li><a href="<?php echo base_url();?>master/lvl"><i class="fa fa-arrows-h"></i> User level </a></li>
                    </ul>
                  </li>
                </ul>
              </div>
            </div>
            <?php elseif($this->session->userdata('level')=="3"):?>
            <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
              <div class="menu_section">
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url(); ?>"><i class="fa fa-home"></i> Home </a></li>
                </ul>
                <h3>Invoice</h3>
                <ul class="nav side-menu">
                  <li><a href="<?php echo base_url();?>invoice/t_invoice"><i class="fa fa-plus"></i> Tambah Invoice </a></li>
                   <li><a href="<?php echo base_url();?>invoice/c_invoice"><i class="fa fa-tasks"></i> Current Invoice</a></li>
                </ul>
              </div>
            </div>
            <?php endif; ?>
            <!-- /sidebar menu -->
             <!-- /menu footer buttons -->
            <div class="sidebar-footer hidden-small">
              <a data-toggle="tooltip" data-placement="top" title="Logout" href="<?php echo base_url();?>login/log_out" style="width: 100%">
                Log Out <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
              </a>
            </div>
            <!-- /menu footer buttons -->
          </div>
        </div>

        <!-- top navigation -->
        <div class="top_nav">
          <div class="nav_menu">
            <nav>
              <div class="nav toggle">
                <a id="menu_toggle"><i class="fa fa-bars"></i></a>
              </div>
              <ul class="nav navbar-nav navbar-right">
                <li class="">
                  <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <img src="<?php echo base_url();?>assets/uploads/profil/<?php echo $this->session->userdata('foto'); ?>" alt=""><?php echo $this->session->userdata('name'); ?>
                    <span class=" fa fa-angle-down"></span>
                  </a>
                  <ul class="dropdown-menu dropdown-usermenu pull-right">
                    <li><a href="<?php echo base_url();?>login/log_out"> Log Out <i class="fa fa-sign-out"></i></a></li>
                  </ul>
                </li>
              </ul>
            </nav>
          </div>
        </div>
        <!-- /top navigation -->