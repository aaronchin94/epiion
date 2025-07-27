<?php
include_once 'header.php';
include_once 'includes/db.php';
include_once 'includes/secure_function.php'
?>

<?php
$query_drop = "SELECT name FROM usersold ";
$result_drop = $connection->query($query_drop);
?>
<!-- Grab all available user -->

<!-- Grab all category -->
<?php

$query_cat = "SELECT * FROM asset_category ";
$result_cat = $connection->query($query_cat);
?>
<!-- Grab all category -->
<?php

?>
<!-- page content -->

<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Aset</h3>
      </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Daftar Aset Baharu</h2>
            <div class="clearfix"></div>
          </div>
          <!--category-->
          <!--<form action="functions_insert.php" method="post">-->
          <div class="row">
            <div class="col-md-12 col-sm-12  ">
              <div class="x_panel">
                <div class="x_content">
                  <div class="field item form-group">
                    <label class="col-form-label col-md-3 col-sm-3  label-align">Kategori Aset<span
                        class="required"></span></label>
                    <div class="col-md-6 col-sm-6">
                      <select class="form-control" id="asset" name="asset">
                        <option value="-" href="asset_register.php">--Sila Pilih--</option>
                        <option value="komputer" href="asset_register_komputer.php">Desktop</option>
                        <option value="komputer" href="asset_register_laptop.php">Laptop</option>
                        <option value="monitor" href="asset_register_monitor.php">Monitor</option>
                        <option value="printer" href="asset_register_printer.php">Printer</option>
                        <option value="scanner" href="asset_register_scanner.php">Scanner</option>
                        <option value="ups" href="asset_register_ups.php">Uninterruptible Power Supply</option>
                        <option value="avr" href="asset_register_avr.php">Automatic Voltage Regulator</option>
                        <option value="lcd" href="asset_register_lcd.php">Projector</option>
                        <option value="lan" href="asset_register_lan.php">Switch</option>
                        <option value="lan" href="asset_register_tablet.php">Tablet</option>
                      </select>
                      <!--

                <div class="row">
                  <div class="col-md-12 col-sm-12  ">
                    <div class="x_panel">
                      <div class="x_content">
                        <div class="field item form-group">
                          <label class="col-form-label col-md-3 col-sm-3  label-align">Kategori Aset<span
                              class="required"></span></label>
                          <div class="col-md-6 col-sm-6">
                          <select class="form-control" id="asset">
                            <option value="-">-- Sila Pilih --</option>
                            <?php
                            foreach ($result_cat as $row) {
                              echo '<option value="' . sanitizeText($row["category"]) . '">' . sanitizeText($row["category"]) . '</option>';
                            }
                            ?>  
                            </select>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                        -->
                      <script>
                        document.getElementById('asset').onchange = function () {
                          window.location.href = this.children[this.selectedIndex].getAttribute('href');
                        }
                      </script>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
include_once 'footer.php';
?>


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



</body>

</html>