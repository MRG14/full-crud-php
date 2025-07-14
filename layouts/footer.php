<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.2.0
    </div>
</footer>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery UI 1.11.4 -->
<script src="assets-template/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="assets-template/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="assets-template/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="assets-template/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="assets-template/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="assets-template/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="assets-template/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="assets-template/plugins/moment/moment.min.js"></script>
<script src="assets-template/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="assets-template/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="assets-template/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="assets-template/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="assets-template/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="assets-template/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="assets-template/dist/js/pages/dashboard.js"></script>

<!-- DataTables  & Plugins -->
<script src="assets-template/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="assets-template/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets-template/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets-template/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="assets-template/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="assets-template/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="assets-template/plugins/jszip/jszip.min.js"></script>
<script src="assets-template/plugins/pdfmake/pdfmake.min.js"></script>
<script src="assets-template/plugins/pdfmake/vfs_fonts.js"></script>
<script src="assets-template/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="assets-template/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="assets-template/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


<!--load font awsome-->
<script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>

<!--Load ckeditor cdn-->
<script src="https://cdn.ckeditor.com/4.19.0/full/ckeditor.js"></script>

<script>
    CKEDITOR.replace('alamat', {
        filebrowserBrowseUrl: 'assets/ckfinder/ckfinder.html',
        filebrowserUploadUrl: 'assets/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
        height: '400px'
    });
</script>

<!-- datatable client side -->
<script>
    $(function () {
        $('#table').DataTable();
    });
</script>

<!-- datatable serverside -->
<script>
    $(document).ready(function() {
        $('#serverside').DataTable({
            processing: true,
            serverSide: true,
            ajax: {
                "url": "mahasiswa_serverside.php?action=table_data",
                "datatype": "json",
                "type": "POST"
            },
            columns: [
                {"data": "no"},
                {"data": "nama_mahasiswa"},
                {"data": "prodi_mahasiswa"},
                {"data": "jk_mahasiswa"},
                {"data": "nomor_telepon"},
                {"data": "aksi"},
            ]
        });
    });
</script>

</body>

</html>