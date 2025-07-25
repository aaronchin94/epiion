<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
include 'includes/initialization.php';

$asset = getasset('scanner', 's_id', $id, $connection, $row);
?>

<head>
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
  <script>
    function checkDelete() {
      if (confirm('Aset akan dipadam. Adakah ingin teruskan ?')) {
        window.location.href = "asset_scanner_delete.php?id=<?php echo $_GET['id'] ?>"
      }
    }
  </script>
</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Asset</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2>Paparan Maklumat Scanner</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form role="form" action="asset_scanner_edit.php?id=<?php echo $id ?>" method="post" id="registration-form"
              autocomplete="off">
              <input type="text" hidden name="s_id" value="<?= $asset['s_id'] ?>">

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Penggunaan</label>
                <div class="col-md-4 col-sm-6 ">
                  <select id="usetype" name="usetype" class="form-control" required onchange="checkusetype()" disabled>
                    <?php
                    select_options($usetype_options, $asset['penggunaan']);
                    ?>
                  </select>
                </div>
              </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama Pengguna
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="staff_id" name="staff_id" class="form-control" required="" onchange="getvalue()" disabled>
                <?php
                stafflist($asset['staff_id'], $connection, $row);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ic">Aset ID
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="asset_id" id="asset_id" required="required" class="form-control"
                value="<?php echo $asset['asset_id'] ?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="model">Model
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="model" id="model" required="required" class="form-control"
                value="<?php echo $asset['model'] ?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="tahun">Tahun Diperoleh
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="tahun" id="tahun" required="required" class="form-control"
                value="<?php echo $asset['tahun'] ?>" disabled>
            </div>
          </div>


          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="serial">No. Siri
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="serial" id="serial" required="required" class="form-control"
                value="<?php echo $asset['serial'] ?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kewpa" id="kewpa" required="required" class="form-control"
                value="<?php echo $asset['kewpa'] ?>" disabled>
            </div>
          </div>



          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Status
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="status" name="status" class="form-control" required disabled>
                <?php
                select_options($status_options, $asset['status']);
                ?>
              </select>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Jenis Perolehan
            </label>
            <div class="col-md-4 col-sm-6 ">
              <select id="jen_perolehan" name="jen_perolehan" class="form-control" required disabled>
                <?php
                select_options($jen_options, $asset['jen_perolehan']);
                ?>
              </select>
            </div>
          </div>

          <div class='form-group row'>
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="sumber">Sumber Penerimaan</label>
            <div class="col-md-4 col-sm-6 ">
              <input id="sumber" name="sumber" type="text" class="form-control" value="<?php echo $asset['sumber'] ?>"
                disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="resolution">Resolusi
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="resolution" id="resolution" class="form-control" disabled="disabled"
                value="<?php echo $asset['resolution'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="network">Network
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="network" id="network" required="required" class="form-control"
                disabled="disabled" value="<?php echo $asset['network'] ?>">
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="ipv4">IP Address
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="ipv4" id="ipv4" required="required" class="form-control"
                value="<?php echo $asset['ip_address'] ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="subnet">Subnet Mask
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="subnet" id="subnet" required="required" class="form-control"
                value="<?php echo $asset['subnet_mask'] ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="defaultgateway">Default Gateway
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="defaultgateway" id="defaultgateway" required="required" class="form-control"
                value="<?php echo $asset['def_gateway'] ?>" disabled>
            </div>
          </div>
          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="dnsserver">DNS Server
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="dnsserver" id="dnsserver" required="required" class="form-control"
                value="<?php echo $asset['dns_server'] ?>" disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
            <div class="col-md-4 col-sm-3 ">
              <button type="button" name="delete" class="btn btn-danger" onclick="return checkDelete();"
                href="asset_scanner_delete.php?id=<?php echo $id ?>">Padam</button>
              <button type="submit" name="edit" class="btn btn-success">Kemaskini</button>
            </div>
          </div>
          </form>
          <?php
          ?>
        </div>

      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- /page content -->

<script>
  // check for form input
  // const form = document.querySelector('#registration-form');
  // form.addEventListener('submit', e => {
  //   e.preventDefault();
  //   const formData = new FormData(form);
  //   console.log(Object.fromEntries(formData.entries()));
  // });
</script>
</body>

</html>