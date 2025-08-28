<?php
include_once 'header.php';
include_once 'includes/session.php';
include 'includes/initialization.php';
include 'includes/isDaisy.php';
include_once 'includes/secure_function.php';


function getMaintenanceRequestById($connection, $id)
{
  $stmt = $connection->prepare("SELECT * FROM maintenance WHERE maintenance_id = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $result = $stmt->get_result();
  $stmt->close();
  return $result->fetch_assoc();
}

function getPemohonById($connection, $id)
{
  $stmt = $connection->prepare("SELECT * FROM staff WHERE id = ?");
  $stmt->bind_param("s", $id);
  $stmt->execute();
  $pemohon = $stmt->get_result();
  $stmt->close();
  return $pemohon->fetch_assoc();
}


// Check if token exists in the URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];
  $maintenanceRequest = getMaintenanceRequestById($connection, $id);
  $pemohon = getPemohonById($connection, $maintenanceRequest['RequestedBy']);
  if ($maintenanceRequest) {
    $staffId = $maintenanceRequest['staff_id'];
    $query = "SELECT name , unit, tel FROM staff WHERE id = ?";
    $stmt = $connection->prepare($query);
    $stmt->bind_param("i", $staffId);
    $stmt->execute();
    $result = $stmt->get_result();
    $staff_name = $result->fetch_assoc();

    $stmt->close();
  } else {
    echo "Maintenance request not found.";
    exit;
  }
} else {
  echo "Error";
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


<!-- page content -->
<div class="right_col" role="main">
  <div class="">
    <div class="page-title">
      <div class="title_left">
        <h3>Penyelenggaraan Asset</h3>
      </div>
    </div>

    <div class="clearfix"></div>
    <div class="row">
      <div class="col-md-12 col-sm-12  ">
        <div class="x_panel">
          <div class="x_title">
            <h2 style="white-space: normal;">Permohonan Pembaikan Perkakasan</h2>
            <div margin class="col-md-1 col-sm-12  float-right">
              <a href='asset_maintenance_view.php' class='btn btn-warning'>Kembali</a>
            </div>
            <div class="clearfix"></div>
          </div>
          <div class="x_panel">
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
                <div class="col-lg-6 col-md-7 col-sm-6 col-12">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['maintenance_description']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 col-12 label-align">Sebab-Sebab Diperlukan</label>
                <div class="col-lg-6 col-md-7 col-sm-6 col-12">
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
                    <div class="modal-body" id="modalGambar">
                    </div>
                  </div>
                </div>
              </div>

              <div class="ln_solid"></div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 label-align" for="maintenance_type">Nama Pemohon</label>
                <div class="col-md-3 col-sm-6">
                  <input type="hidden" id="email_pemohon" name="email_pemohon" class="custom-span"
                    value="<?php echo sanitizeEmail($pemohon['email']); ?>">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['name']); ?>
                  </span>
                </div>
                <label class="col-md-1 col-sm-3 label-align" for="maintenance_priority">Unit</label>
                <div class="col-md-2 col-sm-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['unit']); ?>
                  </span>
                </div>
              </div>

              <div class="form-group row">
                <label class="col-md-3 col-sm-3 label-align" for="maintenance_type">Tarikh</label>
                <div class="col-md-3 col-sm-6">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($maintenanceRequest['InsertedAt']); ?>
                  </span>
                </div>
                <label class="col-md-1 col-sm-3 label-align" for="maintenance_priority">No Telefon</label>
                <div class="col-md-2 col-sm-3">
                  <span class="custom-span">
                    <?php echo htmlspecialchars($pemohon['tel']); ?>
                  </span>
                </div>
              </div>
              <div class="ln_solid"></div>
              <?php
              $status = $maintenanceRequest['maintenance_status'];
              switch ($status) {
                case 0:
                  echo "<div class='form-group row'>
                <label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Status Permohonan</label>
                <div class='col-md-3 col-sm-6'>
                    <span class='badge badge-info' style='font-size: medium;'>Perlu Tindakan</span>
                </div>
            </div>";
                  break;
                // case 1:
                //     echo "<div class='form-group row'>
                //             <label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Status Permohonan</label>
                //             <div class='col-md-3 col-sm-6'>
                //                 <span class='badge badge-warning' style='font-size: medium;'>Ditangguh</span>
                //             </div>
                //         </div>";
                //     break;
                case 2:
                  echo "<div class='form-group row'>";
                  echo "<label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Status Permohonan</label>";
                  echo "<div class='col-md-3 col-sm-6'>";
                  echo "<span class='badge badge-success' style='font-size: medium;'>Diterima</span>";
                  echo "</div>";
                  echo "</div>";

                  echo "<div class='form-group row'>";
                  echo "<label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Tarikh Penghantaraan Aset</label>";
                  echo "<div class='col-md-3 col-sm-6'>";
                  echo htmlspecialchars($maintenanceRequest['estimated_deliver_date']);
                  echo "</div>";
                  echo "</div>";

                  echo "<div class='form-group row'>";
                  echo "<label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Jangkaan Tarikh Siap</label>";
                  echo "<div class='col-md-3 col-sm-6'>";
                  echo htmlspecialchars($maintenanceRequest['estimated_completion_date']);
                  echo "</div>";
                  echo "</div>";
                  break;
                case 3:
                  echo "<div class='form-group row'>";
                  echo "<label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Status Permohonan</label>";
                  echo "<div class='col-md-3 col-sm-6'>";
                  echo "<span class='badge badge-danger' style='font-size: medium;'>Ditolak</span>";
                  echo "</div>";
                  echo "</div>";

                  echo "<div class='form-group row'>";
                  echo "<label class='col-md-3 col-sm-3 label-align' for='maintenance_type'>Alasan Ditolak</label>";
                  echo "<div class='col-md-3 col-sm-6'>";
                  echo htmlspecialchars($maintenanceRequest['rejection_reason']);
                  echo "</div>";
                  echo "</div>";
                  break;
                default:
                  // Handle default case if needed
                  break;
              }
              ?>



              <div class="form-group row mb-3">
                <div class="col-md-12">
                  &nbsp;
                </div>
              </div>



              <div class="form-group row">
                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                <div class="col-md-4 col-sm-3">
                  <?php if ($maintenanceRequest['maintenance_status'] == 0 && checkIsDaisy($row['ic'])): ?> <!-- && $row['ic'] == '000719120127' -->
                    <button type="button" name="approve_maintenance" class="btn btn-success"
                      onclick="showApproveModal('<?php echo $id; ?>')">Terima</button>
                    <button type="button" name="reject_maintenance" class="btn btn-danger"
                      onclick="showRejectModal('<?php echo $id; ?>')">Tolak</button>
                  <?php endif; ?>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
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
<?php
include_once 'footer.php'
  ?>


<script>
  // JavaScript to open modal with larger image when file name is clicked
  $(document).ready(function () {
    $('.file-link').click(function (e) {
      e.preventDefault(); // Prevent default link behavior
      var filePath = $(this).data('file'); // Get file path from data attribute
      var img = $('<img>').attr('src', filePath).css('max-width', '100%');
      $('#modalGambar').html(img); // Set modal body with larger image
      $('#imageModal').modal('show'); // Show modal
    });
  });


  function showApproveModal(id) {
    $('#approveModal').modal('show');
  }

  function showRejectModal(id) {
    $('#rejectModal').modal('show');
  }

      $("#approveMaint").submit(function(event) {
        event.preventDefault(); // Prevent the default form submission
        
        var bosss = $('#approveMaint').serialize();
        console.log("BOSSS Data: ", bosss);

        $.ajax({  
          url:"asset_maintenance_approve.php",  
          method:"POST",  
          data:{action:'approveMaint', data:bosss},  
          success:function(data){   
            console.log(data);
            $('#approveModal').modal('hide');
					  const myDson = JSON.parse(data); 
            const resultt = myDson.result;  
						console.log(resultt);
            if(myDson.status == "1 Done"){
              alert("Permohonan Penyelenggaraan Telah Diluluskan");
              alert("Sila Tugaskan Juruteknik Untuk Penyelenggaraan Tersebut.");
              window.location.href = "asset_maintenance_assign.php?id=" + myDson.maintenance_id;
            } else {
              alert(resultt);
            }
          }  
        });  
        
      }); 

  function approveMaintenance(id) {
    var estimatedCompletionDate = $('#estimated_completion_date').val();
    var estimated_deliver_date = $('#estimated_deliver_date').val();
    console.log("thefx - id:"+id+"cmpltd:"+estimatedCompletionDate+"dlvrdte:"+estimated_deliver_date);
    
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
      data: { id: id, estimated_completion_date: estimatedCompletionDate, estimated_deliver_date: estimated_deliver_date },
      success: function (response) {
        // Handle success response if needed
        console.log();
        $('#approveModal').modal('hide');
        alert("Permohonan Penyelenggaraan Telah Diluluskan");
        alert("Sila Tugaskan Juruteknik Untuk Penyelenggaraan Tersebut.");
        window.location.href = "asset_maintenance_assign.php?id=" + id;

      }
    });
  }


  function rejectMaintenance(id) {
    var rejectionReason = $('#rejection_reason').val();
    var emailPemohon = $('#email_pemohon').val();

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
      data: { id: id, rejection_reason: rejectionReason, email_pemohon: emailPemohon },
      success: function (response) {
        // Handle success response if needed
        $('#rejectModal').modal('hide');
        alert("Permohonan Penyelenggaraan Telah Ditolak");
        window.location.reload(); // Reload the page or perform other actions
      },
      error: function (xhr, status, error) {
        // Handle error
      }
    });
  }

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
      <form id="approveMaint">
        <div class="modal-body">
          <input type="hidden" value='<?= intval($id)?>' name="getTheId">
          <label for="estimated_completion_date">Jangkaan Tarikh Siap:</label>
          <input type="date" name="estimated_completion_date" id="estimated_completion_date" class="form-control" required>
          <br>
          <label for="estimated_deliver_date">Tarikh Penghantaraan Aset Kepada Juruteknik:</label>
          <input type="date" name="estimated_deliver_date" id="estimated_deliver_date" class="form-control" required>
        </div>
        <div class="modal-footer">
          <button type="submit"  class="btn btn-success">Terima</button> 
          <button type="button" id="terimaClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </form>
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
        <textarea id="rejection_reason" class="form-control"></textarea required> 
      </div>
      <div class="modal-footer">
      <button type="button" id ="tolakBtn" class="btn btn-danger" onclick="rejectMaintenance('<?php echo $id; ?>')">Tolak</button>
        <button type="button" id ="tolakClose" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
      </div>
    </div>
  </div>
</div>

</body>

</html>