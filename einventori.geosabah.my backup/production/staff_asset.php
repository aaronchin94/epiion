<?php
include_once 'header.php';
include_once 'includes/session.php';
include_once 'includes/adminonly.php';
?>

<?php
require_once 'includes/db.php';
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>


        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Kakitangan</h3>
              </div>
            </div>
            <div class="clearfix"></div>
            <div class="row">
              <div class="col-md-12 col-sm-12  ">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Aset Kakitangan</h2>
                    <div margin class="col-md-1 col-sm-12  float-right">
                                    <a href='staff_view.php' class='btn btn-warning'>Kembali</a>
                                </div> 
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                  <?php
if (isset($_GET['id'])) {
    $user_id = mysqli_real_escape_string($connection, $_GET['id']);
    $query = "SELECT * FROM staff WHERE id='$user_id' ";
    $query_run = mysqli_query($connection, $query);
    if (mysqli_num_rows($query_run) > 0) {
        $user = mysqli_fetch_array($query_run);
    }
}
?>


                    <h6>Maklumat Kakitangan</h6>
                    <br>
                    <label class="col-form-label col-md-1 col-sm-1 label-align">Nama</label>
                    <div class="col-md-2 col-sm-1 ">
                      <input type="text" id="nama" class="form-control" name="nama" readonly="readonly" placeholder="<?php
echo $user['name'];
?>">
                    </div>

                    <label class="col-form-label col-md-1 col-sm-1 label-align">Jawatan</label>
                    <div class="col-md-2 col-sm-1 ">
                      <input type="text" id="jawatan" class="form-control" name="nama" readonly="readonly" placeholder="<?php
echo $user['jawatan'];
?>">
                    </div>

                    <label class="col-form-label col-md-2 col-sm-1 label-align">Bahagian/Seksyen/Unit</label>
                    <div class="col-md-3 col-sm-1 ">
                      <input type="text" id="unit" class="form-control" name="unit" readonly="readonly" placeholder="<?php
echo $user['unit'];
?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!--senarai computer pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Desktop</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM komputer WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $k_id = $row["k_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_komputer.php?id=$k_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai komputer pengguna-->

                

                <!--senarai monitor pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai Monitor</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

<?php
$query = "SELECT * FROM monitor WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $m_id = $row["m_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_monitor.php?id=$m_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai monitor pengguna-->

              
            <!--senarai laptop pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Laptop</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM laptop WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $la_id = $row["la_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_laptop.php?id=$la_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai laptop pengguna-->

                

                <!--senarai Scanner pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai Scanner</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

<?php
$query = "SELECT * FROM scanner WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $s_id = $row["s_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_scanner.php?id=$s_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai scanner pengguna-->








              <!--senarai Printer pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Printer</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM printer WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $p_id = $row["p_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_printer.php?id=$p_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai Printer pengguna-->

                <!--senarai Scanner pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai Projector</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

                        <?php
$query = "SELECT * FROM lcd WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $l_id = $row["l_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_lcd.php?id=$l_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai scanner pengguna-->

              <!--senarai UPS pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai UPS</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM ups WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $u_id = $row["u_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_ups.php?id=$u_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai UPS pengguna-->

                <!--senarai AVR pengguna-->
              
                <div class="col-md-6">
                  <div class="x_panel">
                    <div class="x_title">
                      <h2>Senarai AVR</h2>
                      <ul class="nav navbar-right panel_toolbox">
                        <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                        </li>
                      </ul>
                      <div class="clearfix"></div>
                    </div>
                    <div class="x_content" style="display: block; width:100%">
                      <table class="table table-striped">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>Aset ID</th>
                            <th>Model</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>

<?php
$query = "SELECT * FROM avr WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $a_id = $row["a_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_avr.php?id=$a_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              
              <!--/senarai AVR pengguna-->

              <!--senarai lan switch pengguna-->
            <div class="row">
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai LAN Switch</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM lan_switch WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $ls_id = $row["ls_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_lan.php?id=$ls_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
                <!--/senarai lan switch pengguna-->

                <!--senarai tablet pengguna-->
              <div class="col-md-6">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>Senarai Tablet</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content" style="display: block; width:100%">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Aset ID</th>
                          <th>Model</th>
                          <th>Status</th>
                          <th>Tindakan</th>
                        </tr>
                      </thead>
                      <tbody>

<?php
$query = "SELECT * FROM tablet WHERE staff_id = $user_id";
$result = mysqli_query($connection, $query);
if ($result === false) {
    die(mysqli_error($connection));
}
$i = 0;
while ($row = mysqli_fetch_assoc($result)) {
    $i = $i + 1;
    $assetid = $row["asset_id"];
    $model = $row["model"];
    $status = $row["status"];
    $asset = $row["asset"];
    $t_id = $row["t_id"];
    echo "<tr>";
    echo "<th scope='row'>$i</th>";
    echo "<td>$assetid</td> ";
    echo "<td>$model</td>";
    echo "<td>$status</td>";
    echo "<td>";
    echo "<a href='asset_review_tablet.php?id=$t_id' class='badge btn-success'>Papar</a>";
    echo "</td>";
?>
       <?php
    echo "</tr>";
}
?>
</tbody>
                    </table>
                  </div>
                </div>
              </div>
              </div>
                <!--/senarai tablet pengguna-->

            </div>
          </div>
          <!-- /page content -->

          <?php
include_once ('footer.php');
?>

        </div>
      </div>

      <!-- jQuery -->
      <script src="../vendors/jquery/dist/jquery.min.js"></script>
      <!-- Bootstrap -->
      <script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
      <!-- FastClick -->
      <script src="../vendors/fastclick/lib/fastclick.js"></script>
      <!-- NProgress -->
      <script src="../vendors/nprogress/nprogress.js"></script>

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