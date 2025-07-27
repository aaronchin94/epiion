<?php
include_once 'header.php';
include_once 'includes/session.php';
//include_once 'includes/adminonly.php';
include 'includes/initialization.php';



function getMaintenanceRequestById($connection, $id)
{
    $stmt = $connection->prepare("SELECT m.*, mw.*, jv.* FROM maintenance AS m 
    JOIN maintenance_work AS mw ON m.maintenance_id = mw.maintenance_id 
    JOIN staff AS jv ON mw.technician_id = jv.id 
    WHERE m.maintenance_id = ?");
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

    // Check if any technician is already assigned to this maintenance request
    $assignedQuery = "SELECT * FROM maintenance_work WHERE maintenance_id = ? AND work_status = 0";
    $stmt = $connection->prepare($assignedQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    $maintenanceRequest = getMaintenanceRequestById($connection, $id);
    $pemohon = getPemohonById($connection, $maintenanceRequest['RequestedBy']);
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
    echo "Error";
    exit;
}

//tambah condition that if alrdy assigned juruteknik, then can view assigned one only.  

if ($maintenanceRequest['maintenance_status'] == 0 || $maintenanceRequest['maintenance_status'] == 1) {
    echo '<script>alert("Sila ambil tindakan terhadap permohonan penyelenggaran terlebih dahulu"); window.location.href = "asset_maintenance_review.php?id=' . $id . '";</script>';
    exit;
} elseif ($maintenanceRequest['maintenance_status'] == 3) {
    echo '<script>alert("Permohonan penyelenggaraan yang ditolak tidak boleh tugaskan juruteknik"); window.location.href = "asset_maintenance_view.php";</script>';
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
                        <h2>Tugasan Kerja Kepada Juruteknik</h2>
                        <div margin class="col-md-1 col-sm-12  float-right">
                            <a href='asset_maintenance_work.php' class='btn btn-warning'>Kembali</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_panel">
                        <form method="post" enctype="multipart/form-data" id="work_manage_form">
                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align" for="asset_type">Jenis Aset</label>
                                <div class="col-md-3 col-sm-6">
                                    <input type="hidden" id="staff_id" name="staff_id" class="custom-span"
                                        value="<?php echo htmlspecialchars($asset['staff_id']); ?>">
                                    <input type="hidden" id="maintenance_id" name="maintenance_id" class="custom-span"
                                        value="<?php echo htmlspecialchars($maintenanceRequest['maintenance_id']); ?>">
                                    <input type="hidden" id="work_id" name="work_id" class="custom-span"
                                        value="<?php echo htmlspecialchars($maintenanceRequest['work_id']); ?>">
                                    <input type="hidden" id="email_pemohon" name="email_pemohon" class="custom-span"
                                        value="<?php echo htmlspecialchars($pemohon['email']); ?>">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['asset']); ?>
                                    </span>
                                </div>
                                <label class="col-md-1 col-sm-3 label-align" for="ic">Aset ID</label>
                                <div class="col-md-1 col-sm-3 ">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['asset_id']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align" for="username">Nama Pengguna</label>
                                <div class="col-md-3 col-sm-6">
                                    <span id="staff_name" class="custom-span">
                                        <?php echo htmlspecialchars($staff_name['name']); ?>
                                    </span>
                                </div>
                                <label class="col-md-1 col-sm-3 label-align" for="serial">No. Siri</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['serial']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align">Lokasi Pejabat</label>
                                <div class="col-md-3 col-sm-6">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($staff_name['unit']); ?>
                                    </span>
                                </div>
                                <label class="col-md-1 col-sm-3 label-align" for="model">Model</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['model']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align" for="maintenance_type">Jenis
                                    Permintaan</label>
                                <div class="col-md-3 col-sm-6">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_type']); ?>
                                    </span>
                                </div>
                                <label class="col-md-1 col-sm-3 label-align"
                                    for="maintenance_priority">Keutamaan</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_priority']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align">Tarikh Diperlukan</label>
                                <div class="col-md-3 col-sm-6">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_date']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="ln_solid"></div>


                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align">Keterangan Permohonan
                                    <br>Penyelenggaraan</label>
                                <div class="col-md-6 col-sm-6">
                                    <span class="custom-span"
                                        style="display: inline-block; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_description']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align">Sebab-Sebab Diperlukan</label>
                                <div class="col-md-6 col-sm-6">
                                    <span class="custom-span"
                                        style="display: inline-block; max-width: 100%; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_reason']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align">Lampiran</label>
                                <div class="col-md-6 col-sm-6">
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
                                                echo '<a href="' . sanitizeText($filePath) . '" target="_blank" style="color: blue; cursor: pointer;">' . sanitizeText($fileName) . '</a><br>';
                                            } else {
                                                // Display file name as a clickable link to open modal
                                                echo '<a href="#" class="file-link" data-file="' . sanitizeText($filePath) . '" style="color: blue; cursor: pointer;">' . sanitizeText($fileName) . '</a><br>';

                                            }
                                        } else {
                                            echo 'Tiada Lampiran';
                                        }
                                    }
                                    ?>
                                </div>
                            </div>

                            <!-- Bootstrap Modal -->
                            <div class="modal fade" id="imageModal" tabindex="-1" role="dialog"
                                aria-labelledby="imageModalLabel" aria-hidden="true">
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
                                <label class="col-md-1 col-sm-3 label-align" for="maintenance_priority">No
                                    Telefon</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($pemohon['tel']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="ln_solid"></div>


                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align" for="technician_name">Nama Juruteknik
                                    Ditugaskan</label>
                                <div class="col-md-3 col-sm-6">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['name']); ?>
                                    </span>
                                </div>

                            </div>
                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 label-align" for="technician_phone">Tarikh
                                    Ditugaskan</label>
                                <div class="col-md-3 col-sm-6">
                                    <span class="custom-span">
                                        <?php
                                        if ($maintenanceRequest['assignment_date'] === null) {
                                            echo 'Belum Ditugaskan';
                                        } else {
                                            echo htmlspecialchars($maintenanceRequest['assignment_date']);
                                        }
                                        ?>
                                    </span>
                                </div>
                                <label class="col-md-1 col-sm-3 label-align" for="technician_phone">Tarikh Siap</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php
                                        if ($maintenanceRequest['completion_date'] === null) {
                                            echo 'Belum Siap';
                                        } else {
                                            echo htmlspecialchars($maintenanceRequest['completion_date']);
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <?php
                            if ($maintenanceRequest['work_status'] == 0) {
                                echo '<div class="form-group row">';
                                echo '    <label class="col-md-3 col-sm-6 label-align" for="remark">Catatan Tugas</label>';
                                echo '    <div class="col-md-6 col-sm-6">';
                                echo '        <textarea class="form-control" id="remark" name="remark"></textarea>';
                                echo '    </div>';
                                echo '</div>';
                                echo '<div class="form-group row">';
                                echo '    <label class="col-form-label col-md-3 col-sm-3 label-align"></label>';
                                echo '    <div class="col-md-4 col-sm-3 ">';
                                echo '        <button type="submit" id="ready_pickup" class="btn btn-success">Sedia Untuk Pickup/Diambil</button>';
                                echo '    </div>';
                                echo '</div>';
                            } else {
                                echo '<div class="form-group row">';
                                echo '    <label class="col-md-3 col-sm-6 label-align" for="remark">Catatan Tugas</label>';
                                echo '<div class="col-md-3 col-sm-6">';
                                echo '    <span class="custom-span">';
                                echo '        ' . htmlspecialchars($maintenanceRequest['remarks']) . '';
                                echo '    </span>';
                                echo '</div>';
                                echo '<input type="hidden" id="remark" name="remark" class="custom-span" value="' . htmlspecialchars($maintenanceRequest['remarks']) . '">';
                                echo '</div>';

                                // Add image input
                                echo '<div class="form-group row">';
                                echo '    <label class="col-md-3 col-sm-6 label-align" for="proof_pickup">Bukti Pengambilan Aset</label>';
                                echo '    <div class="col-md-3 col-sm-6">';
                                echo '        <input type="file" id="proof_pickup" name="proof_pickup" class="form-control-file" accept="image/*" capture="camera">';
                                echo '    </div>';
                                echo '</div>';

                                echo '<div class="form-group row">';
                                echo '    <label class="col-md-3 col-sm-6 label-align"></label>';
                                echo '    <div class="col-md-3 col-sm-6">';
                                echo '        <img id="imagePreview" src="#" alt="Image Preview" style="display: none; max-width: 300px;">';
                                echo '    </div>';                         
                                echo '</div>';

                                echo '<div class="form-group row">';
                                echo '    <label class="col-form-label col-md-3 col-sm-3 label-align"></label>';
                                echo '    <div class="col-md-4 col-sm-3 ">';
                                echo '        <button type="submit" id="pickup_completed" class="btn btn-success">Selesai Kerja</button>';
                                echo '    </div>';
                                echo '</div>';

                            }
                            ?>


                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>



                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Javascript functions	-->


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

        $('#proof_pickup').on('change', function() {
        var file = this.files[0];
        if (file) {
            // Read the file as a data URL
            var reader = new FileReader();
            reader.onload = function(e) {
                // Set the src attribute of the image to the data URL
                $('#imagePreview').attr('src', e.target.result).show();
            };
            reader.readAsDataURL(file);
        }
    });

        $('#ready_pickup').on('click', function (e) {
            e.preventDefault(); // Prevent default button click behavior

            if ($('#remark').val().trim() === '') {
                alert("Sila Isi Catatan Tugas Yang Telah Dilakukan.");
                return; // Exit function if remark is empty
            }
            // Disable the button
            $(this).prop('disabled', true);

            // Serialize form data (if needed)
            var formData = $('#work_manage_form').serialize();

            // AJAX request
            $.ajax({
                url: 'asset_maintenance_readypickup.php', // Replace with your backend endpoint
                type: 'POST',
                data: formData, // or any other data you want to send
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    alert("Pemohon Telah Dimaklumkan Untuk Mengambil Aset.");
                    window.location.href = "asset_maintenance_work.php";
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });

        $('#pickup_completed').on('click', function (e) {
            e.preventDefault(); // Prevent default button click behavior

            // Check if the proof_pickup file input has a file selected
            if ($('#proof_pickup')[0].files.length === 0) {
                alert("Sila Memuatnaik Gambar Bukti Pengambilan Aset.");
                return; // Exit function if proof_pickup file is not selected
            }

            // Get the proof_pickup file
            var proofPickupFile = $('#proof_pickup')[0].files[0];

            // Validate file type
            if (!proofPickupFile.type.match('image.*')) {
                alert("Sila pilih fail imej yang sah.");
                return; // Exit function if file type is not an image
            }

            // Validate file extension (excluding gif)
            var fileName = proofPickupFile.name;
            var fileExtension = fileName.split('.').pop().toLowerCase();
            if (fileExtension === 'gif') {
                alert("Fail GIF tidak dibenarkan. Sila pilih fail imej yang lain.");
                return; // Exit function if file extension is gif
            }

            // Disable the button
            $(this).prop('disabled', true);

            // Create FormData object
            var formData = new FormData();

            // Append the proof_pickup file to the FormData object
            formData.append('proof_pickup', proofPickupFile);

            // Serialize form data (if needed) and append to FormData object
            var serializedData = $('#work_manage_form').serializeArray();
            $.each(serializedData, function (index, obj) {
                formData.append(obj.name, obj.value);
            });

            // AJAX request
            $.ajax({
                url: 'asset_maintenance_workdone.php', // Replace with your backend endpoint
                type: 'POST',
                data: formData, // Send FormData object
                processData: false, // Prevent jQuery from processing the data
                contentType: false, // Set content type to false for FormData
                success: function (response) {
                    // Handle success response
                    console.log(response);
                    alert("Kerja Telah Siap!");
                    window.location.href = "asset_maintenance_work.php";
                },
                error: function (xhr, status, error) {
                    // Handle error
                    console.error(xhr.responseText);
                }
            });
        });



    });



</script>

</body>

</html>