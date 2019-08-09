        <footer>
          <div class="pull-right">
            Gentelella - Bootstrap Admin Template by <a href="https://colorlib.com">Colorlib</a>
          </div>
          <div class="clearfix"></div>
        </footer>
        <!-- /footer content -->
      </div>
    </div>
    <script type="text/javascript">
      $(document).ready(function() {
        $('.summernote').summernote({
          height: 300, // set editor height
          minHeight: null, // set minimum height of editor
          maxHeight: null, // set maximum height of editor
          focus: true, // set focus to editable area after initializing summernote
          toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'italic', 'underline', 'clear']],
            ['fontname', ['fontname']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['height', ['height']],
            ['table', ['table']],
            ['insert', ['link', 'hr']],
            ['view', ['fullscreen', 'codeview']]
          ],
                          
          onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
            e.preventDefault();
            setTimeout(function () {
              document.execCommand('insertText', false, bufferText);
            }, 10);
          }
        });
      });
    </script>
    <!-- Bootstrap -->
    <script src="<?php echo base_url();?>assets/dash/vendors/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/select2/dist/js/select2.min.js"></script>
      <script type="text/javascript">
        $(document).ready(function () {
          $('select').select2({
            placeholder: "-- Pilih --"
          });
        });
      </script>
    <!-- summernote -->
    <script src="<?php echo base_url();?>assets/dash/vendors/summernote/dist/summernote.js"></script>
    <!-- FastClick -->
    <script src="<?php echo base_url();?>assets/dash/vendors/fastclick/lib/fastclick.js"></script>
    <!-- NProgress -->
    <script src="<?php echo base_url();?>assets/dash/vendors/nprogress/nprogress.js"></script>
    <!-- Datatables -->
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/jszip/dist/jszip.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/pdfmake/build/vfs_fonts.js"></script>
    <!-- Chart.js -->
    <script src="<?php echo base_url();?>assets/dash/vendors/Chart.js/dist/Chart.min.js"></script>
    <!-- jQuery Sparklines -->
    <script src="<?php echo base_url();?>assets/dash/vendors/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
    <!-- Flot -->
    <script src="<?php echo base_url();?>assets/dash/vendors/Flot/jquery.flot.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/Flot/jquery.flot.pie.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/Flot/jquery.flot.time.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/Flot/jquery.flot.stack.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/Flot/jquery.flot.resize.js"></script>
    <!-- Flot plugins -->
    <script src="<?php echo base_url();?>assets/dash/vendors/flot.orderbars/js/jquery.flot.orderBars.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/flot-spline/js/jquery.flot.spline.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/flot.curvedlines/curvedLines.js"></script>
     <!-- DateJS -->
    <script src="<?php echo base_url();?>assets/dash/vendors/DateJS/build/date.js"></script>
    <!-- bootstrap-daterangepicker -->
    <script src="<?php echo base_url();?>assets/dash/vendors/moment/min/moment.min.js"></script>
    <script src="<?php echo base_url();?>assets/dash/vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
    <!-- Sweet alert -->
    <script src="<?php echo base_url();?>assets/dash/vendors/sweetalert/sweetalert.min.js"></script>
    <!-- validator -->
    <script src="<?php echo base_url()?>assets/dash/vendors/validator/validator.js"></script>
    <!-- jQuery custom content scroller -->
    <script src="<?php echo base_url()?>assets/dash/vendors/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
    <!-- ECharts -->
    <script src="<?php echo base_url()?>assets/dash/vendors/echarts/dist/echarts.min.js"></script>
    <!-- Custom Theme Scripts -->
    <script src="<?php echo base_url();?>assets/dash/build/js/custom.min.js"></script>
  </body>
</html>