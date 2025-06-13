<?php
include_once "header.php";
include_once 'includes/adminonly.php';
include_once 'includes/firstlogincheck.php';
?>
<?php
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>

<head>
        <!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- bootstrap-wysiwyg -->
	<link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
	<!-- Select2 -->
	<link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
	<!-- Switchery -->
	<link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
	<!-- starrr -->
	<link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
	<!-- bootstrap-daterangepicker -->
	<link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  
  
  <!-- Datatables -->
    <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
  <!-- Confirm Buttion-->
  <script language="JavaScript" type="text/javascript">
function checkDelete(){
    return confirm('Pendaftar akan dipadam. Adakah ingin teruskan ?');
}
</script>
  </head>

<!-- page content -->
<div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Pendaftar</h3>
              </div>
            </div>
            <div class="clearfix"></div>


            <!--category-->
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_content">
                    <div class="x_title">
                      <h2>Carian Pendaftar</h2>
                      <div class="clearfix"></div>
                    </div>
                    <!--<form id="demo-form2" method="Post" data-parsley-validate class="form-horizontal form-label-left">
                      <div class="item form-group">
                        <label class="col-form-label col-md-2 col-sm-2 label-align" for="unit">Bahagian/Seksyen/Unit</label>
                        <div class="col-md-2 col-sm-3 ">
                          <select id="unit" class="form-control" required="" >
                            <option value="">-- Sila Pilih --</option>
                            <?php foreach ($result_drop as $row) {
                                echo '<option value="' .
                                    $row["unit"] .
                                    '">' .
                                    $row["unit"] .
                                    "</option>";
                            } ?>  
                          </select>
                        </div>
                        <label class="col-form-label col-md-1 col-sm-1 label-align" for="nama">Nama
                        </label>
                        <div class="col-md-3 col-sm-1 ">
                          <input type="text" id="nama" class="form-control" name="nama">
                        </div>
                        <div class="col-md-2 col-sm-12">
                          <button class="btn btn-primary" type="reset">Reset</button>
                          <button type="submit" class="btn btn-success" action="">Submit</button>
                        </div>
                      </div>
                      </form>
                </div>
              </div>
              </div>
            </div>-->

            <!--carian pengguna-->
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_content" style="display: block;">


                    <div class="x_content" style="display: block;">
                    <!--<table id="example" class="table product-table">--
                    <table id="datatable" class="table table-striped table-bordered" style="width:100%">-->
                    <table id="datatable-responsive" class="table table-striped table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                    <thead>
      <tr>
        <th scope="col">Nama Penuh</th>
        <th scope="col">Jawatan</th>
        <th scope="col">Lokasi</th>
        <th scope="col">Bahagian/Seksyen/Unit</th>
        <th scope="col">Tindakan</th>


      </tr>
    </thead>
    <tbody>

      <?php
      $query = "SELECT * FROM staff WHERE access = 1";
      $result = mysqli_query($connection, $query);
      if ($result === false) {
          die(mysqli_error($connection));
      }
      $i = 0;
      while ($row = mysqli_fetch_assoc($result)) {

          $i = $i + 1;
          $id = $row["id"];
          $name = $row["name"];
        
       
          $jawatan = $row["jawatan"];
          $lokasi = $row["lokasi"];
          $unit = $row["unit"];

          echo "<tr>";
          echo "<td>$name <span class='badge badge-info'>". $row['role'] ."</span> </td> ";
          echo "<td>$jawatan</td>";
          echo "<td>$lokasi</td>";
          echo "<td>$unit </td>";
	echo '<td>
                        <a href="user-review.php?id='.$id.'" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="user-edit.php?id='.$id.'" ><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="user-delete.php?id='.$id.'" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        </td>';
                        echo "</tr>";
                      }
                      ?>
                    </tbody>
         	  </table>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- /page content -->


 
<?php include_once "footer.php"; ?>

<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- bootstrap-progressbar -->
	<script src="../vendors/bootstrap-progressbar/bootstrap-progressbar.min.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- bootstrap-daterangepicker -->
	<script src="../vendors/moment/min/moment.min.js"></script>
	<script src="../vendors/bootstrap-daterangepicker/daterangepicker.js"></script>
	<!-- bootstrap-wysiwyg -->
	<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
	<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
	<script src="../vendors/google-code-prettify/src/prettify.js"></script>
	<!-- jQuery Tags Input -->
	<script src="../vendors/jquery.tagsinput/src/jquery.tagsinput.js"></script>
	<!-- Switchery -->
	<script src="../vendors/switchery/dist/switchery.min.js"></script>
	<!-- Select2 -->
	<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Autosize -->
	<script src="../vendors/autosize/dist/autosize.min.js"></script>
	<!-- jQuery autocomplete -->
	<script src="../vendors/devbridge-autocomplete/dist/jquery.autocomplete.min.js"></script>
	<!-- starrr -->
	<script src="../vendors/starrr/dist/starrr.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
  <!-- Datatables -->
  <script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
    <script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
    <script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
    <script src="../vendors/jszip/dist/jszip.min.js"></script>
    <script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
    <script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

</body>
</html>