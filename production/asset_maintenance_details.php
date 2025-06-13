<?php
//include_once 'header.php';
require_once 'includes/db.php';
include 'includes/initialization.php';

function getMaintenanceRequestByToken($connection, $token)
{
  $stmt = $connection->prepare("SELECT a.* FROM maintenance a LEFT JOIN maintenance_token b ON a.maintenance_id = b.maintenance_id WHERE token = ?");
  $stmt->bind_param("s", $token);
  $stmt->execute();
  $result = $stmt->get_result();
  return $result->fetch_assoc();
}

function getPemohonById($connection, $id)
{
  $stmt = $connection->prepare("SELECT * FROM staff WHERE id = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $pemohon = $stmt->get_result();
  return $pemohon->fetch_assoc();
}


// Check if token exists in the URL
if (isset($_GET['token'])) {
  $token = $_GET['token'];
  $maintenanceRequest = getMaintenanceRequestByToken($connection, $token);
  $pemohon = getPemohonById($connection, $maintenanceRequest['RequestedBy']);

  // Check if maintenance status is not 0
  if ($maintenanceRequest && $maintenanceRequest['maintenance_status'] != 0) {
    echo "<script>";
    echo "alert('Permohonan telah diluluskan/ditolak atau pautan ini telah tamat tempoh.');";
    echo "window.close();";
    echo "</script>";
    exit;
  }

  if ($maintenanceRequest) {
    $staffId = $maintenanceRequest['staff_id'];
    $query = "SELECT name, unit FROM staff WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $staffId);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff_name = $result->fetch_assoc();
  } else {
    echo "Maintenance request not found.";
    exit;
  }
} else {
  echo "Token not provided.";
  exit;
}
?>

<style>
  .custom-span {
    border: none;
    padding: 0px;
    color: black;
    width: 300%;
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Sistem Pengurusan Inventori ICT (e-PII) | Jabatan Pertanian Sabah</title>
  <link rel="icon" type="image/x-icon" href="images/DOA_logo.png">

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>
<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div>
        <a href="index.php" class="site_title"><img src="images/DOA_logo.png" height="50"
            alt="Description of the image">
          <span style="font-size: 11.5px;"><b>e-PII Jabatan Pertanian Sabah</b></span></a>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2 style="white-space: normal;">Permohonan Pembaikan Perkakasan</h2>
            <div class="clearfix"></div>
          </div>
          <div class="x_content">
            <form role="form" action="" method="post" enctype="multipart/form-data" id="maintenance_details">
              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align" for="asset_type">Jenis Aset</label>
                <div class="col-md-3 col-sm-6 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['asset']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="ic">Aset ID</label>
                <div class="col-md-1 col-sm-3 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['asset_id']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3  col-3 label-align" for="username">Nama Pengguna</label>
                <div class="col-md-3 col-sm-6 col-3">
                  <span id="staff_name" class="custom-span">
                    <?php echo htmlspecialchars($staff_name['name']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="serial">No. Siri</label>
                <div class="col-md-2 col-sm-3 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['serial']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align">Lokasi Pejabat</label>
                <div class="col-md-3 col-sm-6 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($staff_name['unit']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="model">Model</label>
                <div class="col-md-2 col-sm-3 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['model']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align" for="maintenance_type">Jenis Permintaan</label>
                <div class="col-md-3 col-sm-6 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_type']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="maintenance_priority">Keutamaan</label>
                <div class="col-md-2 col-sm-3 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_priority']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align">Tarikh Diperlukan</label>
                <div class="col-md-3 col-sm-6 col-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_date']); ?>
                  </span>
                </div>
              </div>

              <div class="ln_solid"></div>
              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-12 label-align">Keterangan Permohonan <br>Penyelenggaraan</label>
                <div class="col-lg-3 col-md-7 col-sm-6 col-12">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_description']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-12 label-align">Sebab-Sebab Diperlukan</label>
                <div class="col-lg-3 col-md-7 col-sm-6 col-12">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_reason']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-12 label-align">Lampiran</label>
                <div class="col-md-6 col-sm-6 col-9">
                  <?php
                  // Assuming $maintenanceRequest['maintenance_files'] is a comma-separated string of file names
                  $fileNames = explode(',', $maintenanceRequest['maintenance_files']);
                  foreach ($fileNames as $fileName) {
                    $filePath = "uploads/" . trim($fileName); // Trim to remove any leading/trailing whitespace
                    // Check if the file exists before displaying it
                    if (file_exists($filePath)) {
                      $fileExtension = pathinfo($filePath, PATHINFO_EXTENSION);
                      if (strtolower($fileExtension) == 'pdf') {
                        // Display PDF file as a clickable link
                        echo '<a href="' . $filePath . '" target="_blank" style="color: blue; cursor: pointer;">' . $fileName . '</a><br>';
                      } else {
                        // Display file name as a clickable link to open modal
                        echo '<a href="#" class="file-link" data-file="' . $filePath . '" style="color: blue; cursor: pointer;">' . $fileName . '</a><br>';

                      }
                    } else {
                      echo '-';

                    }
                  }
                  ?>
                </div>
              </div>





              <!-- Bootstrap Modal -->
              <div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-labelledby="imageModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                    </div>
                  </div>
                </div>
              </div>


              <div class="ln_solid"></div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align" for="maintenance_type">Nama Pemohon</label>
                <div class="col-md-3 col-sm-6 col-9">
                  <input type="hidden" id="maintenance_id" name="maintenance_id" class="custom-span"
                    value="<?php echo htmlspecialchars($maintenanceRequest['maintenance_id']); ?>">
                  <input type="hidden" id="email_pemohon" name="email_pemohon" class="custom-span"
                    value="<?php echo htmlspecialchars($pemohon['email']); ?>">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['name']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="maintenance_priority">Unit</label>
                <div class="col-md-2 col-sm-3  col-9">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['unit']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-3 label-align" for="maintenance_type">Tarikh</label>
                <div class="col-md-3 col-sm-6 col-9">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['InsertedAt']); ?>
                  </span>
                </div>
                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="maintenance_priority">No
                  Telefon</label>
                <div class="col-md-2 col-sm-3 col-9">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['tel']); ?>
                  </span>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                <div class="col-md-4 col-sm-3 ">
                  <button type="button" name="approve_maintenance" class="btn btn-success"
                    onclick="showApproveModal('<?php echo $token; ?>')">Terima</button>
                  <button type="button" name="reject_maintenance" class="btn btn-danger"
                    onclick="showRejectModal('<?php echo $token; ?>')">Tolak</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- /page content -->

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
<!-- bootstrap-wysiwyg -->
<script src="../vendors/bootstrap-wysiwyg/js/bootstrap-wysiwyg.min.js"></script>
<script src="../vendors/jquery.hotkeys/jquery.hotkeys.js"></script>
<script src="../vendors/google-code-prettify/src/prettify.js"></script>
<!-- Select2 -->
<script src="../vendors/select2/dist/js/select2.full.min.js"></script>
<!-- Autosize -->
<script src="../vendors/autosize/dist/autosize.min.js"></script>
<!-- Custom Theme Scripts -->
<script src="../build/js/custom.min.js"></script>

<script>
  $(document).ready(function () {
    $('.file-link').click(function (e) {
      e.preventDefault(); // Prevent default link behavior
      var filePath = $(this).data('file'); // Get file path from data attribute
      var img = $('<img>').attr('src', filePath).css('max-width', '100%');
      $('.modal-body').html(img); // Set modal body with larger image
      $('#imageModal').modal('show'); // Show modal
    });
  });


  function showApproveModal(token) {
    $('#approveModal').modal('show');
  }

  function showRejectModal(token) {
    $('#rejectModal').modal('show');
  }

  function approveMaintenance(token) {
    var estimatedCompletionDate = $('#estimated_completion_date').val();
    var estimated_deliver_date = $('#estimated_deliver_date').val();

    // Perform validation if necessary
    if (!estimatedCompletionDate || !estimated_deliver_date) {
      alert('Sila nyatakan jangkaan tarikh siap dan tarikh penghantaran aset.');
      return;
    }

    $('#terimaBtn').prop('disabled', true);
    $('#terimaClose').prop('disabled', true);

    // Send data using AJAX
    $.ajax({
      type: 'POST',
      url: 'asset_maintenance_approve.php',
      data: { token: token, estimated_completion_date: estimatedCompletionDate, estimated_deliver_date: estimated_deliver_date },
      success: function (response) {
        // Handle success response if needed
        $('#approveModal').modal('hide');
        alert("Permohonan Penyelenggaraan Telah Diluluskan");
        alert("Sila Tugaskan Juruteknik Untuk Penyelenggaraan Tersebut.");
        window.location.href = "asset_maintenance_assign_token.php?token=" + token;

      },
      error: function (xhr, status, error) {
        // Handle error
        alert('Error occurred while processing your request. Please try again later.');
        console.error(xhr, status, error);
      }
    });
  }



  function rejectMaintenance(token) {
    var rejectionReason = $('#rejection_reason').val();
    var maintenanceId = $('#maintenance_id').val(); // Get the value of maintenance_id
    var emailPemohon = $('#email_pemohon').val();
    // Perform validation if necessary

    if (!rejectionReason) {
      alert('Sila nyatakan alasan penyelenggaraan ditolak.');
      return;
    }
    $('#tolakBtn').prop('disabled', true);
    $('#tolakClose').prop('disabled', true);

    // Send data using AJAX
    $.ajax({
      type: 'POST',
      url: 'asset_maintenance_reject.php',
      data: {
        token: token,
        rejection_reason: rejectionReason,
        maintenance_id: maintenanceId,  // Pass maintenance_id
        email_pemohon: emailPemohon     // Pass email_pemohon
      },
      success: function (response) {
        // Handle success response if needed
        $('#rejectModal').modal('hide');
        alert("Permohonan Penyelenggaraan Telah Ditolak");
        window.location.href = "asset_maintenance_view.php";
      },
      error: function (xhr, status, error) {
        // Handle error
      }
    });
  }

</script>



</script>


<!-- Modal for Approve -->
<div id="approveModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Luluskan Penyelenggaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="estimated_completion_date">Jangkaan Tarikh Siap:</label>
        <input type="date" id="estimated_completion_date" class="form-control">
        <br>
        <label for="estimated_deliver_date">Tarikh Penghantaraan Aset Kepada Juruteknik:</label>
        <input type="date" id="estimated_deliver_date" class="form-control">
      </div>
      <div class="modal-footer">
        <button type="button" id="terimaBtn" class="btn btn-success"
          onclick="approveMaintenance('<?php echo $token; ?>')">Terima</button>
        <button type="button" id="terimaClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Reject -->
<div id="rejectModal" class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Tolak Penyelenggaraan</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <label for="rejection_reason">Alasan Penyelenggaraan Ditolak:</label>
        <textarea id="rejection_reason" class="form-control"></textarea>
      </div>
      <div class="modal-footer">
        <button type="button" id="tolakBtn" class="btn btn-danger"
          onclick="rejectMaintenance('<?php echo $token; ?>')">Tolak</button>
        <button type="button" id="tolakClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>
</body>

</html>