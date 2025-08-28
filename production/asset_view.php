<!DOCTYPE html>
<?php
include_once "header.php";
include_once "includes/session.php";
include_once 'includes/secure_function.php';

?>
<?php
require_once "includes/db.php";
$query_drop = "
                            SELECT unit FROM lokasi 
                            ORDER BY unit ASC
                        ";
$result_drop = $connection->query($query_drop);
?>


    <!-- Confirm Button-->
    <script language="JavaScript" type="text/javascript">
        function checkDelete() {
            return confirm('Aset akan dipadam. Adakah ingin teruskan ?');
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script type="text/javascript" charset="utf8">
        $(document).ready(function () {
            $('.datatable-buttons').DataTable().destroy(); // destroy the previous instance
            var tables = $('.datatable-buttons').DataTable({
                dom: 'Bfrtip',
                search: {
                    regex: true,
                    caseInsensitive: true,
                    smart: true,
                    columns: [0, 1, 2, 3] // Enable search for columns 1, 2, 3, and 4 (index 0, 1, 2, 3)
                },
                buttons: [{
                    extend: 'excelHtml5',
                    text: 'Muat Turun Excel',
                    className: 'buttondownload',
                    exportOptions: {
                        columns: ':not(:eq(5))'
                    }
                }],
                columnDefs: [{
                    targets: [0, 1, 2, 3, 4, 5],
                    visible: true,
                    searchable: true
                },
                {
                    targets: '_all',
                    visible: false,
                    searchable: false
                }
                ]
            });

            // Add custom filter search button as dropdown
            var filterHtml = `
<div class="dropdown float-left"> <!-- Added "float-left" class -->
  <button class="btn buttondownload dropdown-toggle" type="button" id="filterDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Status Aset
  </button>
  <div class="dropdown-menu" aria-labelledby="filterDropdown">
    <a class="dropdown-item filter-option" data-value="">Semua</a>
    <a class="dropdown-item filter-option" data-value="Tidak Aktif">Tidak Aktif</a>
    <a class="dropdown-item filter-option" data-value="Aktif">Aktif</a>
  </div>
</div>

`;

            $('.dataTables_filter').append(filterHtml);

            // Filter based on selected option in dropdown
            $('.filter-option').on('click', function () {
                var filterValue = $(this).data('value');
                if (filterValue === '') {
                    tables.columns(4).search('').draw();
                } else if (filterValue === 'Tidak Aktif' || filterValue === 'Aktif') {
                    tables.columns(4).search('^' + filterValue + '$', true, false, true).draw();
                    // tables.columns(3).search(filterValue).draw();               

                }
            });

            // Recalculate responsive layout of all tables when tab is shown
            $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
                // Get the DataTable object for the active table
                var activeTable = $.fn.dataTable.tables({
                    visible: true,
                    api: true
                })[0];

                // Recalculate responsive layout for all tables
                tables.responsive.recalc();

                // Redraw the active table to ensure proper sizing
                if (activeTable) {
                    $(activeTable.table().node()).css('width', '100%');
                    activeTable.columns.adjust().draw();
                }
            });
        });
    </script>

<style>
    .buttondownload {
        display: inline-block;
        border-radius: 4px;
        background-color: #1ABB9C;
        color: #fff;
        text-align: center;
        font-size: 16px;
        padding: 5px;
        width: 150px;
        transition: all 0.5s;
        cursor: pointer;
        margin: 20px;
    }

    .buttondownload:hover {
        background-color: #169F85;
        color: #fff;

    }
</style>

<body>
    <!-- page content -->
    <div class="right_col" role="main">
        <div class="">
            <div class="page-title">
                <div class="title_left">
                    <h3>Aset </h3>
                </div>
            </div>
            <div class="clearfix"></div>


            <!--category-->
            <div class="row">
                <div class="col-md-12 col-sm-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Carian Aset</h2>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_panel">
                            <div class="x_content">
                                <ul class="nav nav-tabs " id="myTab" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" id="desktop-tab" data-toggle="tab" href="#desktop"
                                            role="tab" aria-controls="desktop" aria-selected="true">Desktop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="laptop-tab" data-toggle="tab" href="#laptop" role="tab"
                                            aria-controls="laptop" aria-selected="false">Laptop</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="monitor-tab" data-toggle="tab" href="#monitor"
                                            role="tab" aria-controls="monitor" aria-selected="false">Monitor</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="printer-tab" data-toggle="tab" href="#printer"
                                            role="tab" aria-controls="printer" aria-selected="false">Printer</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="scanner-tab" data-toggle="tab" href="#scanner"
                                            role="tab" aria-controls="scanner" aria-selected="false">Scanner</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="ups-tab" data-toggle="tab" href="#ups" role="tab"
                                            aria-controls="ups" aria-selected="false">Uninterruptible Power Supply</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="avr-tab" data-toggle="tab" href="#avr" role="tab"
                                            aria-controls="avr" aria-selected="false">Automatic Voltage Regulator</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="lcd-tab" data-toggle="tab" href="#lcd" role="tab"
                                            aria-controls="lcd" aria-selected="false">Projector</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="lan_switch-tab" data-toggle="tab" href="#lan_switch"
                                            role="tab" aria-controls="lan_switch" aria-selected="false">Switch</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" id="tablet-tab" data-toggle="tab" href="#tablet" role="tab"
                                            aria-controls="tablet" aria-selected="false">Tablet</a>
                                    </li>
                                </ul>
                                <div class="tab-content" id="myTabContent">
                                    <div class="tab-pane fade show active" id="desktop" role="tabpanel"
                                        aria-labelledby="desktop-tab">
                                        <table id="datatable-buttons1"
                                            class="table datatable-buttons responsive table-striped table-bordered nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                    <th scope="col">os</th>
                                                    <th scope="col">app_kerja</th>
                                                    <th scope="col">anti_v</th>
                                                    <th scope="col">processor</th>
                                                    <th scope="col">ram_gb</th>
                                                    <th scope="col">kapasiti_hd_gb</th>
                                                    <th scope="col">kad_grafik</th>
                                                    <th scope="col">network_lan</th>
                                                    <th scope="col">modem</th>
                                                    <th scope="col">ip_address</th>
                                                    <th scope="col">subnet_mask</th>
                                                    <th scope="col">def_gateway</th>
                                                    <th scope="col">dns_server</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT k.*, s.name, s.unit, s.active
FROM komputer k
JOIN staff s ON s.id = k.staff_id
WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;                        
";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowk = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowk["name"];
                                                    $asset_id = $rowk["asset_id"];
                                                    $model = $rowk["model"];
                                                    $status = $rowk["status"];
                                                    $id = $rowk["k_id"];
                                                    $unit = $rowk["unit"];


                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_Komputer.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_komputer_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_komputer_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Desktop&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowk['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['sumber']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['os']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['app_kerja']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['anti_v']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['processor']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['ram_gb']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['kapasiti_hd_gb']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['kad_grafik']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['network_lan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['modem']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['ip_address']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['subnet_mask']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['def_gateway']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowk['dns_server']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>


                                    <div class="tab-pane fade" id="laptop" role="tabpanel" aria-labelledby="laptop-tab">
                                        <table id="datatable-buttons2"
                                            class="table datatable-buttons responsive table-striped table-bordered nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                    <th scope="col">os</th>
                                                    <th scope="col">app_kerja</th>
                                                    <th scope="col">anti_v</th>
                                                    <th scope="col">processor</th>
                                                    <th scope="col">ram_gb</th>
                                                    <th scope="col">kapasiti_hd_gb</th>
                                                    <th scope="col">kad_grafik</th>
                                                    <th scope="col">network_lan</th>
                                                    <th scope="col">modem</th>
                                                    <th scope="col">ip_address</th>
                                                    <th scope="col">subnet_mask</th>
                                                    <th scope="col">def_gateway</th>
                                                    <th scope="col">dns_server</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT lp.*, s.name, s.unit, s.active
                      FROM laptop lp
                      JOIN staff s ON s.id = lp.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;                          ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowlp = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowlp["name"];
                                                    $asset_id = $rowlp["asset_id"];
                                                    $model = $rowlp["model"];
                                                    $status = $rowlp["status"];
                                                    $id = $rowlp["la_id"];
                                                    $unit = $rowlp["unit"];

                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_laptop.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_laptop_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_laptop_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Laptop&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowlp['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['sumber']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['os']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['app_kerja']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['anti_v']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['processor']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['ram_gb']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['kapasiti_hd_gb']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['kad_grafik']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['network_lan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['modem']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['ip_address']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['subnet_mask']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['def_gateway']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlp['dns_server']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="monitor" role="tabpanel"
                                        aria-labelledby="monitor-tab">
                                        <table id="datatable-buttons3"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">size</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT m.*, s.name, s.unit, s.active
FROM monitor m
JOIN staff s ON s.id = m.staff_id
WHERE s.active = 1 AND s.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;
";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowm = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowm["name"];
                                                    $asset_id = $rowm["asset_id"];
                                                    $model = $rowm["model"];
                                                    $status = $rowm["status"];
                                                    $id = $rowm["m_id"];
                                                    $unit = $rowm["unit"];


                                                    echo "<tr>";
                                                    echo "<td>$nama_pengguna</td> ";
                                                    echo "<td>$unit</td> ";
                                                    echo "<td>$asset_id</td>";
                                                    echo "<td>$model </td>";
                                                    echo "<td>$status </td>";
                                                    echo '<td>
                        <a href="asset_review_monitor.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_monitor_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_monitor_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Monitor&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowm['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowm['size']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowm['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowm['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowm['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowm['sumber']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="printer" role="tabpanel"
                                        aria-labelledby="printer-tab">
                                        <table id="datatable-buttons4"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                    <th scope="col">jen_cetakan</th>
                                                    <th scope="col">network</th>
                                                    <th scope="col">ip_address</th>
                                                    <th scope="col">subnet_mask</th>
                                                    <th scope="col">def_gateway</th>
                                                    <th scope="col">dns_server</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT p.*, s.name, s.unit, s.active
                      FROM printer p
                      JOIN staff s ON s.id = p.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowp = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowp["name"];
                                                    $asset_id = $rowp["asset_id"];
                                                    $model = $rowp["model"];
                                                    $status = $rowp["status"];
                                                    $id = $rowp["p_id"];
                                                    $unit = $rowp["unit"];


                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_printer.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_printer_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_printer_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Printer&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowp['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['sumber']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['jen_cetakan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['network']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['ip_address']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['subnet_mask']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['def_gateway']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowp['dns_server']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="scanner" role="tabpanel"
                                        aria-labelledby="scanner-tab">
                                        <table id="datatable-buttons5"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                    <th scope="col">resolution</th>
                                                    <th scope="col">network</th>
                                                    <th scope="col">ip_address</th>
                                                    <th scope="col">subnet_mask</th>
                                                    <th scope="col">def_gateway</th>
                                                    <th scope="col">dns_server</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT sc.*, s.name, s.unit, s.active
                      FROM scanner sc
                      JOIN staff s ON s.id = sc.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;   
                        ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowsc = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowsc["name"];
                                                    $asset_id = $rowsc["asset_id"];
                                                    $model = $rowsc["model"];
                                                    $status = $rowsc["status"];
                                                    $id = $rowsc["s_id"];
                                                    $unit = $rowsc["unit"];


                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_scanner.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_scanner_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_scanner_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Scanner&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowsc['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['sumber']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['resolution']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['network']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['ip_address']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['subnet_mask']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['def_gateway']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowsc['dns_server']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="ups" role="tabpanel" aria-labelledby="ups-tab">
                                        <table id="datatable-buttons6"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT ups.*, s.name, s.unit, s.active
                      FROM ups ups
                      JOIN staff s ON s.id = ups.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;                          ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowups = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowups["name"];
                                                    $asset_id = $rowups["asset_id"];
                                                    $model = $rowups["model"];
                                                    $status = $rowups["status"];
                                                    $id = $rowups["u_id"];
                                                    $unit = $rowups["unit"];

                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_UPS.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_ups_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_ups_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Uninterruptible Power Supply&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . $rowups['tahun'] . '</td>';
                                                    echo '<td>' . intval($rowups['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowups['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowups['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowups['sumber']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="avr" role="tabpanel" aria-labelledby="avr-tab">
                                        <table id="datatable-buttons7"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT avr.*, s.name, s.unit, s.active
                      FROM avr avr
                      JOIN staff s ON s.id = avr.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;                          ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowavr = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowavr["name"];
                                                    $asset_id = $rowavr["asset_id"];
                                                    $model = $rowavr["model"];
                                                    $status = $rowavr["status"];
                                                    $id = $rowavr["a_id"];
                                                    $unit = $rowavr["unit"];

                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_AVR.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_avr_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_avr_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Automatic Voltage Regulator&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowavr['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowavr['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowavr['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowavr['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowavr['sumber']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="lcd" role="tabpanel" aria-labelledby="lcd-tab">
                                        <table id="datatable-buttons8"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT lcd.*, s.name, s.unit, s.active
                      FROM lcd lcd
                      JOIN staff s ON s.id = lcd.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;   
                        ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowlcd = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowlcd["name"];
                                                    $asset_id = $rowlcd["asset_id"];
                                                    $model = $rowlcd["model"];
                                                    $status = $rowlcd["status"];
                                                    $id = $rowlcd["l_id"];
                                                    $unit = $rowlcd["unit"];


                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_lcd.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_lcd_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_lcd_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Projector&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowlcd['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlcd['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlcd['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlcd['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowlcd['sumber']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="lan_switch" role="tabpanel"
                                        aria-labelledby="lan_switch-tab">
                                        <table id="datatable-buttons9"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>

                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                    <th scope="col">bil_port</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT ls.*, s.name, s.unit, s.active
                      FROM lan_switch ls
                      JOIN staff s ON s.id = ls.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;   

                        ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowls = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowls["name"];
                                                    $asset_id = $rowls["asset_id"];
                                                    $model = $rowls["model"];
                                                    $status = $rowls["status"];
                                                    $id = $rowls["ls_id"];
                                                    $unit = $rowls["unit"];

                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_lan.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_lan_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_lan_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Switch&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';

                                                    echo '<td>' . sanitizeText($rowls['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowls['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowls['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowls['sumber']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowls['bil_port']) . '</td>';
                                                    echo "</tr>";
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="tab-pane fade" id="tablet" role="tabpanel" aria-labelledby="tablet-tab">
                                        <table id="datatable-buttons10"
                                            class="table datatable-buttons responsive table-striped table-bordered dt-responsive nowrap"
                                            cellspacing="0" width="100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nama Pengguna</th>
                                                    <th scope="col">Lokasi Pejabat</th>
                                                    <th scope="col">Aset ID</th>
                                                    <th scope="col">Model</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Tindakan</th>
                                                    <th scope="col">tahun</th>
                                                    <th scope="col">serial</th>
                                                    <th scope="col">kewpa</th>
                                                    <th scope="col">jen_perolehan</th>
                                                    <th scope="col">sumber</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <?php
                                                $query = "
                      SELECT tablet.*, s.name, s.unit, s.active
                      FROM tablet tablet
                      JOIN staff s ON s.id = tablet.staff_id
                      WHERE s.active = 1 AND s.unit = 
  IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit)
ORDER BY s.name ASC;                          ";
                                                $result = mysqli_query($connection, $query);
                                                if ($result === false) {
                                                    die (mysqli_error($connection));
                                                }
                                                while ($rowtablet = mysqli_fetch_assoc($result)) {
                                                    $nama_pengguna = $rowtablet["name"];
                                                    $asset_id = $rowtablet["asset_id"];
                                                    $model = $rowtablet["model"];
                                                    $status = $rowtablet["status"];
                                                    $id = $rowtablet["t_id"];
                                                    $unit = $rowtablet["unit"];


                                                    echo "<tr>";
                                                    echo "<td>".sanitizeText($nama_pengguna)." </td> ";
                                                    echo "<td>".sanitizeText($unit)." </td> ";
                                                    echo "<td>".sanitizeText($asset_id)."</td>";
                                                    echo "<td>".sanitizeText($model)." </td>";
                                                    echo "<td>".sanitizeText($status)." </td>";
                                                    echo '<td>
                        <a href="asset_review_tablet.php?id=' . $id . '" ><i class="fa fa-eye" style="font-size:20px;margin:0px 5px 0px 5px ;" title="Papar Maklumat"></i></a>
                        <a href="asset_tablet_edit.php?id=' . $id . '"><i class="fa fa-edit" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Kemaskini"></i></a>
                        <a href="asset_tablet_delete.php?id=' . $id . '" onclick="return checkDelete()")"><i class="fa fa-close"  style="font-size:19px;;color:red;margin:0px 5px 0px 5px "  title="Padam"></i></a>
                        <a href="asset_maintenance.php?asset_type=Tablet&id=' . $id . '"><i class="fa fa-wrench" style="font-size:17px;margin:0px 5px 0px 5px ;"  title="Penyelenggaraan"></i></a>
                        </td>';
                                                    echo '<td>' . intval($rowtablet['tahun']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowtablet['serial']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowtablet['kewpa']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowtablet['jen_perolehan']) . '</td>';
                                                    echo '<td>' . sanitizeText($rowtablet['sumber']) . '</td>';
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