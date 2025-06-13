<?php
include_once 'header.php';
include_once 'includes/session.php';
require_once 'includes/db.php';
require_once 'includes/initialization.php';

$asset = getasset('tablet', 't_id', $id, $connection, $row);
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
        window.location.href = "asset_tablet_delete.php?id=<?php echo $_GET['id'] ?>"
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
            <h2>Paparan Maklumat Tablet</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">

            <form role="form" action="asset_tablet_edit.php?id=<?php echo $id ?>" method="post" id="registration-form"
              autocomplete="off">
              <input type="text" hidden name="t_id" value="<?= $asset['t_id'] ?>">

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align" for="name">Penggunaan
                </label>
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
              <input type="text" name="serial" id="serial" class="form-control" value="<?php echo $asset['serial'] ?>"
                disabled>
            </div>
          </div>

          <div class="form-group row">
            <label class="col-form-label col-md-3 col-sm-3 label-align" for="kewpa">No. KewPA
            </label>
            <div class="col-md-4 col-sm-6 ">
              <input type="text" name="kewpa" id="kewpa" class="form-control" value="<?php echo $asset['kewpa'] ?>"
                disabled>
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
            <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
            <div class="col-md-4 col-sm-3 ">
              <button type="button" name="delete" class="btn btn-danger" onclick="return checkDelete();"
                href="asset_tablet_delete.php?id=<?php echo $id ?>">Padam</button>
              <button type="submit" name="edit" class="btn btn-success">Kemaskini</button>
              <button type="button" id="QR" name="QR" class="btn btn-warning" onclick="showQRModal()">
                <i class="fa fa-qrcode"></i> &nbsp;QR Code
              </button>
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


<!-- Bootstrap Modal -->
<div class="modal fade" id="qrModal" tabindex="-1" role="dialog" aria-labelledby="qrModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="qrModalLabel">QR Code</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body d-flex justify-content-center align-items-center">
        <?php if (!empty($asset['qrcode'])): ?>
          <!-- If QR code exists, display the image -->
          <img id="qrCodeImage" src="qrcode/<?php echo $asset['qrcode']; ?>" alt="QR Code">
        <?php endif; ?>
      </div>
      <div class="modal-header d-flex justify-content-center align-items-center">
        <?php if (!empty($asset['qrcode'])): ?>
          <h2><span style="color: black;">QR ID:
              <?php echo $asset['QRId']; ?>
            </span></h2>
        <?php else: ?>
          <img id="qrCodeImage" src="" alt="">
          <!-- If no QR code found, display a message -->
          <p id="noQRMessage">No QR code found. Please generate one.</p>
        <?php endif; ?>
      </div>
      <div class="modal-footer">
        <?php if (!empty($asset['qrcode'])): ?>
          <!-- If QR code exists, provide download button -->
          <a id="downloadBtn" class="btn btn-primary" href="qrcode/<?php echo $asset['qrcode']; ?>" download>Download QR
            Code</a>
        <?php else: ?>
          <!-- If no QR code found, provide button to generate QR code -->
          <button type="button" id="generateQRBtn" class="btn btn-warning" onclick="generateQR()">Generate QR
            Code</button>
        <?php endif; ?>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

<script>
  function showQRModal() {
    $('#qrModal').modal('show'); // This will show the modal
  }


</script>

<script>
  $(document).ready(function () {
    $('#generateQRBtn').click(function () {
      // Send AJAX request to generate_qr.php
      $.ajax({
        url: 'asset_QR_update.php',
        method: 'POST',
        data: {
          id: <?php echo $id; ?>, // Pass any necessary data, such as asset ID
          asset_type: '<?php echo $asset['asset']; ?>',
          asset_id: '<?php echo $asset['asset_id']; ?>'
        },
        success: function (response) {
          // Handle success response if needed
          alert('QR code generated successfully!');
          location.reload();
        },
        error: function (xhr, status, error) {
          // Handle error if needed
          console.error(xhr.responseText);
        }
      });
    });
  });
</script>

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