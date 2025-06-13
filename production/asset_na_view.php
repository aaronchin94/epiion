<!DOCTYPE html>
<?php
include_once "header.php";
include_once "includes/session.php";

?>
<?php
require_once "includes/db.php";
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
  <!-- Confirm Button-->
  <script language="JavaScript" type="text/javascript">
    function checkDelete() {
      return confirm('Aset akan dipadam. Adakah ingin teruskan ?');
    }
  </script>
  <script src="https://code.jquery.com/jquery-1.11.0.js"></script>
  <script type="text/javascript" charset="utf8">
    $(document).ready(function () {
      $(".datatable-buttons").DataTable({
        dom: 'B<"clear">lfrtip',
        buttons: true,
        fixedHeader: {
          header: true
        }
      });
    });
  </script>
</head>

<body>
  <!-- page content -->
  <div class="right_col" role="main">
    <div class="">
      <div class="page-title">
        <div class="title_left">
          <h3>Aset</h3>
        </div>
      </div>
      <div class="clearfix"></div>


      <!--category-->
      <div class="row">
        <div class="col-md-12 col-sm-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Carian Aset Tidak Digunakan</h2>
              <div class="clearfix"></div>
            </div>
            <div class="x_content">
              <ul class="nav nav-tabs bar_tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link active" id="desktop-tab" data-toggle="tab" href="#desktop" role="tab"
                    aria-controls="desktop" aria-selected="true">Desktop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="laptop-tab" data-toggle="tab" href="#laptop" role="tab" aria-controls="laptop"
                    aria-selected="false">Laptop</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="monitor-tab" data-toggle="tab" href="#monitor" role="tab"
                    aria-controls="monitor" aria-selected="false">Monitor</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="printer-tab" data-toggle="tab" href="#printer" role="tab"
                    aria-controls="printer" aria-selected="false">Printer</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="scanner-tab" data-toggle="tab" href="#scanner" role="tab"
                    aria-controls="scanner" aria-selected="false">Scanner</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="ups-tab" data-toggle="tab" href="#ups" role="tab" aria-controls="ups"
                    aria-selected="false">Uninterruptible Power Supply</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="avr-tab" data-toggle="tab" href="#avr" role="tab" aria-controls="avr"
                    aria-selected="false">Automatic Voltage Regulator</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="lcd-tab" data-toggle="tab" href="#lcd" role="tab" aria-controls="lcd"
                    aria-selected="false">LCD Projector</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="lan_switch-tab" data-toggle="tab" href="#lan_switch" role="tab" aria-controls="lan_switch"
                    aria-selected="false">Switch</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="desktop" role="tabpanel" aria-labelledby="desktop-tab">
                  <table id="datatable-buttons1" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                          SELECT k.*, s.name, s.active
FROM komputer k
JOIN staff s ON s.id = k.staff_id
WHERE s.active = 1
ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["k_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_komputer_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_komputer_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="laptop" role="tabpanel" aria-labelledby="laptop-tab">
                  <table id="datatable-buttons2" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT lp.*, s.name, s.active
                      FROM laptop lp
                      JOIN staff s ON s.id = lp.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["la_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_laptop.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_laptop.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_laptop_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_laptop_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="monitor" role="tabpanel" aria-labelledby="monitor-tab">
                  <table id="datatable-buttons3" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT m.*, s.name, s.active
                      FROM monitor m
                      JOIN staff s ON s.id = m.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["m_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_monitor.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_monitor.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_monitor_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_monitor_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="printer" role="tabpanel" aria-labelledby="printer-tab">
                  <table id="datatable-buttons4" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT p.*, s.name, s.active
                      FROM printer p
                      JOIN staff s ON s.id = p.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["p_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_printer.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_printer.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_printer_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_printer_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="scanner" role="tabpanel" aria-labelledby="scanner-tab">
                  <table id="datatable-buttons5" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT sc.*, s.name, s.active
                      FROM scanner sc
                      JOIN staff s ON s.id = sc.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["s_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_scanner.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_scanner.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_scanner_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_scanner_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="ups" role="tabpanel" aria-labelledby="ups-tab">
                  <table id="datatable-buttons6" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT ups.*, s.name, s.active
                      FROM ups ups
                      JOIN staff s ON s.id = ups.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["u_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_ups.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_ups.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_ups_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_ups_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="avr" role="tabpanel" aria-labelledby="avr-tab">
                  <table id="datatable-buttons7" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT avr.*, s.name, s.active
                      FROM avr avr
                      JOIN staff s ON s.id = avr.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["a_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_avr.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_avr.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_review_avr.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_avr_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="lcd" role="tabpanel" aria-labelledby="lcd-tab">
                  <table id="datatable-buttons8" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT lcd.*, s.name, s.active
                      FROM lcd lcd
                      JOIN staff s ON s.id = lcd.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["nama_pengguna"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["l_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_lcd.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_lcd.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_lcd_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_lcd_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
                      }
                      ?>
                    </tbody>
                  </table>
                </div>
                <div class="tab-pane fade" id="lan_switch" role="tabpanel" aria-labelledby="lan_switch-tab">
                  <table id="datatable-buttons9" class="table table-striped table-bordered datatable-buttons"
                    style="width:100%">
                    <thead>
                      <tr>
                        <th scope="col">Nama Pengguna</th>
                        <th scope="col">Asset ID</th>
                        <th scope="col">Model</th>
                        <th scope="col">Status</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>

                      <?php
                      $query = "
                      SELECT ls.*, s.name, s.active
                      FROM lan_switch ls
                      JOIN staff s ON s.id = ls.staff_id
                      WHERE s.active = 1
                      ORDER BY s.name ASC;
                        ";
                      $result = mysqli_query($connection, $query);
                      if ($result === false) {
                        die(mysqli_error($connection));
                      }
                      while ($row = mysqli_fetch_assoc($result)) {
                        $nama_pengguna = $row["name"];
                        $asset_id = $row["asset_id"];
                        $model = $row["model"];
                        $status = $row["status"];
                        $varname = $row["ls_id"];

                        echo "<tr>";
                        echo "<td>$nama_pengguna</td> ";
                        echo "<td>$asset_id</td>";
                        echo "<td>$model </td>";
                        echo "<td>$status </td>";
                        echo '
                          <td>
                            <div class="btn-group">
                              <a href="asset_review_lan_switch.php?varname=' . $varname . '" type="button" class="btn btn-success btn-sm " href="asset_review_lan_switch.php?varname=' . $varname . '">Papar</a>
                              <button type="button" class="btn btn-success btn-sm  dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                              </button>
                              <div class="dropdown-menu" x-placement="bottom-start" style="position: absolute; will-change: transform; top: 0px; left: 0px; transform: translate3d(69px, 38px, 0px);">
                                <a class="dropdown-item" href="asset_lan_edit.php?varname=' . $varname . '">Kemaskini</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="asset_lan_delete.php?varname=' . $varname . '" onclick="return checkDelete()")">Padam</a>
                              </div>
                            </div>
                          </td>';
                        ?>
                        <?php echo "</tr>";
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