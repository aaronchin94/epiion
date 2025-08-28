<?php
include_once 'header.php';
include_once 'includes/session.php';
include_once 'includes/adminonly.php';
include 'includes/initialization.php';
include_once 'includes/secure_function.php';



function Jurutekniklist($technician_id, $connection)
{
    $query_technician = "
    SELECT * FROM staff where role like 'Juruteknik%' AND `active` = '1' ORDER BY name ASC ";

    $technician_list = $connection->query($query_technician);

    echo '<option value="">-- Sila Pilih --</option>';
    foreach ($technician_list as $technician) {
        if ($technician_id == $technician['id']) {
            echo '<option value="' . intval($technician["id"]) . '" selected>' . sanitizeText($technician["name"]) . '</option>';
        } else {
            echo '<option value="' . intval($technician["id"]) . '">' . sanitizeText($technician["name"]) . '</option>';
        }
    }
}


function getMaintenanceRequestById($connection, $id)
{
    $stmt = $connection->prepare("SELECT * FROM maintenance WHERE maintenance_id = ?");
    $stmt->bind_param("s", $id);
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
if (isset ($_GET['id'])) {
    $id = $_GET['id'];

    // Check if any technician is already assigned to this maintenance request
    $assignedQuery = "SELECT * FROM maintenance_work WHERE maintenance_id = ?";
    $stmt = $connection->prepare($assignedQuery);
    $stmt->bind_param("s", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    // If there are assigned technicians, redirect to work details page
    if ($result->num_rows > 0) {
        echo "<script>window.location.href='asset_maintenance_workdetails.php?id=$id'</script>";

    }
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
                            <a href='asset_maintenance_view.php' class='btn btn-warning'>Kembali</a>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">
                        <form role="form" action="asset_maintenance_juruteknik.php?id=<?php echo intval($id) ?>" method="post"
                            enctype="multipart/form-data" id="maintenance_details">
                            <div class="form-group row">
                                <label class="col-md-3 col-sm-3 col-3 label-align" for="asset_type">Jenis Aset</label>
                                <div class="col-md-3 col-sm-6 col-3">
                                    <input type="hidden" id="staff_id" name="staff_id" class="custom-span"
                                        value="<?php echo htmlspecialchars($maintenanceRequest['staff_id']); ?>">
                                    <input type="hidden" id="maintenance_id" name="maintenance_id" class="custom-span"
                                        value="<?php echo htmlspecialchars($maintenanceRequest['maintenance_id']); ?>">
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
                                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align" for="serial">No.
                                    Siri</label>
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
                                <label class="col-md-3 col-sm-3 col-3 label-align" for="maintenance_type">Jenis
                                    Permintaan</label>
                                <div class="col-md-3 col-sm-6 col-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($maintenanceRequest['maintenance_type']); ?>
                                    </span>
                                </div>
                                <label class="col-lg-1 col-md-2 col-sm-3 col-3 label-align"
                                    for="maintenance_priority">Keutamaan</label>
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
                                <label class="col-md-3 col-sm-3 col-12 label-align">Keterangan Permohonan
                                    <br>Penyelenggaraan</label>
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
                                        <div class="modal-body">
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
                                <label class="col-md-1 col-sm-3 label-align" for="maintenance_priority">No
                                    Telefon</label>
                                <div class="col-md-2 col-sm-3">
                                    <span class="custom-span">
                                        <?php echo htmlspecialchars($pemohon['tel']); ?>
                                    </span>
                                </div>
                            </div>

                            <div class="ln_solid"></div>

                            <div class="row">
                                <div class="col-md-12 col-sm-12 col-12 ">
                                    <div>
                                        <div class="x_content" style="display: block;">
                                            <div class="x_content" style="display: block; text-align: center;">
                                                <div class="table-responsive">
                                                    <table id="datatable-responsive"
                                                        class="table table-striped table-bordered dt-responsive nowrap"
                                                        cellspacing="0" width="100%"
                                                        style="width: auto; margin: 0 auto;">
                                                        <thead>
                                                            <tr>
                                                                <th scope="col">Nama Juruteknik</th>
                                                                <th scope="col">Jawatan </th>
                                                                <th scope="col">Lokasi </th>
                                                                <th scope="col">Unit </th>
                                                                <th scope="col">Bilangan Kerja</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            $query_juruteknik = "SELECT * FROM staff where role like 'Juruteknik%' order by name";
                                                            $result = mysqli_query($connection, $query_juruteknik);

                                                            if ($result === false) {
                                                                die (mysqli_error($connection));
                                                            }

                                                            while ($rowk = mysqli_fetch_assoc($result)) {
                                                                $technicianid = $rowk['id'];
                                                                $workload_query = "SELECT COUNT(*) AS total_workload FROM maintenance_work WHERE technician_id = $technicianid";
                                                                $workload_result = mysqli_query($connection, $workload_query);
                                                                $workload_row = mysqli_fetch_assoc($workload_result);
                                                                $total_workload = $workload_row['total_workload'];

                                                                echo "<tr>";
                                                                echo '<td>' . sanitizeText($rowk['name']) . '</td>';
                                                                echo '<td>' . sanitizeText($rowk['jawatan']) . '</td>';
                                                                echo '<td>' . sanitizeText($rowk['lokasi']) . '</td>';
                                                                echo '<td>' . sanitizeText($rowk['unit']) . '</td>';
                                                                echo '<td>' . $total_workload . '</td>';
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

                            <div class="form-group row mb-3">
                                <div class="col-md-12">
                                    &nbsp;
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align" for="username">Nama
                                    Juruteknik
                                    <span class="required">*</span>
                                </label>
                                <div class="col-md-4 col-sm-6 ">
                                    <select id="technician_id" name="technician_id" class="form-control" required=""
                                        onchange="getvalue()">
                                        <?php
                                        Jurutekniklist($technician_id, $connection);
                                        ?>
                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-form-label col-md-3 col-sm-3 label-align"></label>
                                <div class="col-md-4 col-sm-3 ">
                                    <button type="submit" id="work_assign" class="btn btn-success" onclick="disableButton()">Tugaskan
                                        Juruteknik</button>
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
            $('.modal-body').html(img); // Set modal body with larger image
            $('#imageModal').modal('show'); // Show modal
        });
    });

    function disableButton() {
        var form = document.getElementById("maintenance_details");
        if (form.checkValidity()) {
            document.getElementById("work_assign").disabled = true;
            form.submit();
        } else {
            return false;
        }
    }
</script>

</body>

</html>