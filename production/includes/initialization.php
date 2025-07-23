<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}

$usetype_options = ['Individu', 'Gunasama'];
$status_options = ['Aktif', 'Tidak Aktif', 'Penyelenggaraan'];
$jen_options = ['Negeri(JPKN)', 'Negeri(Jabatan Pertanian Sabah)', 'Negeri(Lain-lain)', 'Persekutuan', 'Derma'];
$os_options = ['Windows 7', 'Windows 8', 'Windows 10 Home', 'Windows 10 Pro', 'Windows 11', 'MacOS'];
$cetakan_options = ['Laser', 'Ink', 'Ribbon'];
$ram_options = ['4GB', '8GB', '12GB', '16GB', '32GB', '64GB', '128GB'];
$yesno_options = ['Ada', 'Tidak'];
$lan_options = ['PCI Card', 'Onboard'];
$required = 'Semua maklumat peralatan mikrokomputer bertanda * adalah wajib diisi and sekiranya maklumat tidak dapat dikesan, nyatakan "ND" (Not Detected).';
$maintenance_type = ['Pembaikan (Error)', 'Peningkatan (Upgrade)', 'Maklumat (Backup)'];
$maintenance_priority = ['Sangat Penting', 'Penting', 'Biasa'];


function stafflist($staff_id, $connection, $row)
{
    $query_staff = "
        SELECT name, id FROM staff
        WHERE unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', unit)
        ORDER BY name ASC
        ";
    $stafflist = $connection->query($query_staff);

    echo '<option value="">-- Sila Pilih --</option>';
    foreach ($stafflist as $staff) {
        if ($staff_id == $staff['id']) {
            echo '<option value="' . htmlspecialchars(trim(strip_tags($staff["id"])), ENT_QUOTES, 'UTF-8') . '" selected>' . htmlspecialchars(trim(strip_tags($staff["name"])), ENT_QUOTES, 'UTF-8') . '</option>';
        } else {
            echo '<option value="' . htmlspecialchars(trim(strip_tags($staff["id"])), ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars(trim(strip_tags($staff["name"])), ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
}

function getasset($asset, $idtype, $id, $connection, $row)
{
    $query_drop = "
        SELECT *
        FROM staff
        JOIN $asset ON staff.id = $asset.staff_id
        WHERE unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', unit) && $idtype = '$id';
    ";
    $result_drop = $connection->query($query_drop);
    if (mysqli_num_rows($result_drop) == 0) {
        $redirect_url = 'index.php';
        echo "<script>window.location.href = '$redirect_url';</script>";
        die(mysqli_error($connection));
    } else {
        $asset = mysqli_fetch_assoc($result_drop);
    }

    return $asset;
}

function select_options($options, $edit_option)
{
    echo '<option value="">-- Sila Pilih --</option>';
    foreach ($options as $option) {
        if ($edit_option == $option) {
            echo '<option value="' . htmlspecialchars(trim(strip_tags($option)), ENT_QUOTES, 'UTF-8') . '" selected>' . htmlspecialchars(trim(strip_tags($option)), ENT_QUOTES, 'UTF-8') . '</option>';
        } else {
            echo '<option value="' . htmlspecialchars(trim(strip_tags($option)), ENT_QUOTES, 'UTF-8') . '">' . htmlspecialchars(trim(strip_tags($option)), ENT_QUOTES, 'UTF-8') . '</option>';
        }
    }
}

function getkewpa($asset, $connection)
{
    $kewpa = [];
    $kewpa_query = "
    SELECT kewpa FROM $asset
    ";
    $kewpa_result = $connection->query($kewpa_query);
    if ($kewpa_result !== false) {
        foreach ($kewpa_result as $result) {
            $kewpa[] = $result['kewpa'];
        }
    }
    return json_encode($kewpa);
}

function getemail($connection)
{
    $email = [];
    $email_query = "
    SELECT email FROM staff
    ";
    $email_result = $connection->query($email_query);
    if ($email_result !== false) {
        foreach ($email_result as $result) {
            $email[] = $result['email'];
        }
    }
    return json_encode($email);
}

function tooltip($type)
{
    $tooltip = '';

    switch ($type) {
        case 'usetype':
            $tooltip = 'Individu: Bagi peralatan yang dikendalikan oleh individu tertentu sahaja.
Gunasama: Bagi peralatan yang tidak dikhususkan kepada individu tertentu.
            ';
            break;
        case 'sumber':
            $tooltip = 'Sila nyatakan sumber peralatan yang diterima. Contoh: JPKN Sandakan, Seksyen Belanjawan, Pejabat ADUN Membakut dsb.';
            break;
        case 'app_kerja':
            $tooltip = 'Sila nyatakan perisian kerja yang terdapat pada peralatan. Contoh: OpenOffice, Microsoft Office, WPS dsb.';
            break;
        case 'anti_v':
            $tooltip = 'Sila nyatakan antivirus dalam peralatan. Contoh: TrendMicro, Kaspersky, Avira, dsb.';
            break;
        case 'processor':
            $tooltip = 'Sila nyatakan jenis dan generasi processor pada peralatan. Contoh: i3-3rd gen, i5-11th gen, Ryzen 5-5th gen dsb.';
            break;
        case 'status':
            $tooltip = 'Aktif: Peralatan ICT yang masih digunakan.
Tidak Aktif: Peralatan ICT dalam simpanan pejabat, pada masa semasa tidak digunakan tetapi belum dilupuskan.
Penyelenggaraan: Peralatan ICT yang telah dihantar dan masih berada di tempat pembaikan/ penyelenggaraan.';
            break;
    }

    echo '<i class="fa fa-info-circle" style="font-size:15px;margin:0px 05px 0px 0px ;" title="' . $tooltip . '"></i>';
}
?>