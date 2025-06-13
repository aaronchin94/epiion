<?php
// Get the total number of asset
$query = "SELECT COUNT(a.asset) AS total_asset
FROM (
  SELECT asset, staff_id FROM komputer
  UNION ALL SELECT asset, staff_id FROM laptop
  UNION ALL SELECT asset, staff_id FROM monitor
  UNION ALL SELECT asset, staff_id FROM ups
  UNION ALL SELECT asset, staff_id FROM lcd
  UNION ALL SELECT asset, staff_id FROM printer
  UNION ALL SELECT asset, staff_id FROM scanner
  UNION ALL SELECT asset, staff_id FROM avr
  UNION ALL SELECT asset, staff_id FROM lan_switch
  UNION ALL SELECT asset, staff_id FROM tablet
) AS a
JOIN staff AS s ON a.staff_id = s.id
WHERE s.active = 1 AND s.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', s.unit);
";
$result = mysqli_query($connection, $query);
$rowtotalasset = mysqli_fetch_assoc($result);
$total_asset = $rowtotalasset['total_asset'];

// Get the total number of admin
$query = "SELECT COUNT(DISTINCT id) AS total_admin FROM staff WHERE role = 'Admin'";
$result = mysqli_query($connection, $query);
$rowtotalusers = mysqli_fetch_assoc($result);
$total_admin = $rowtotalusers['total_admin'];

// Get the total number of pendaftar
$query = "SELECT COUNT(DISTINCT id) AS total_pendaftar FROM staff WHERE role = 'Pendaftar' AND  active = 1 AND unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', unit) ";
$result = mysqli_query($connection, $query);
$rowtotalpendaftar = mysqli_fetch_assoc($result);
$total_pendaftar = $rowtotalpendaftar['total_pendaftar'];

// Get the total number of kakitangan
$query = "SELECT COUNT(DISTINCT id) AS total_staff FROM staff WHERE active = 1 AND unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', unit) ";
$result = mysqli_query($connection, $query);
$rowtotalstaff = mysqli_fetch_assoc($result);
$total_staff = $rowtotalstaff['total_staff'];

// Asset Chart-Retrieve the total asset count and category counts
$query = "SELECT 
    COUNT(asset) AS total_asset, 
    IFNULL((SELECT COUNT(asset) FROM komputer LEFT JOIN staff ON komputer.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS komputer_count,
    IFNULL((SELECT COUNT(asset) FROM laptop LEFT JOIN staff ON laptop.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS laptop_count,
    IFNULL((SELECT COUNT(asset) FROM monitor LEFT JOIN staff ON monitor.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS monitor_count,
    IFNULL((SELECT COUNT(asset) FROM ups LEFT JOIN staff ON ups.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS ups_count,
    IFNULL((SELECT COUNT(asset) FROM lcd LEFT JOIN staff ON lcd.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS lcd_count,
    IFNULL((SELECT COUNT(asset) FROM printer LEFT JOIN staff ON printer.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS printer_count,
    IFNULL((SELECT COUNT(asset) FROM scanner LEFT JOIN staff ON scanner.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS scanner_count,
    IFNULL((SELECT COUNT(asset) FROM avr LEFT JOIN staff ON avr.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS avr_count,
    IFNULL((SELECT COUNT(asset) FROM lan_switch LEFT JOIN staff ON lan_switch.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS lan_switch_count,
    IFNULL((SELECT COUNT(asset) FROM tablet LEFT JOIN staff ON tablet.staff_id = staff.id WHERE staff.active = 1 AND staff.unit = IF('{$row["role"]}' = 'Pendaftar', '{$row["unit"]}', staff.unit)), 0) AS tablet_count
FROM (
    SELECT asset FROM komputer
    UNION ALL SELECT asset FROM laptop
    UNION ALL SELECT asset FROM monitor
    UNION ALL SELECT asset FROM ups
    UNION ALL SELECT asset FROM lcd
    UNION ALL SELECT asset FROM printer
    UNION ALL SELECT asset FROM scanner
    UNION ALL SELECT asset FROM avr
    UNION ALL SELECT asset FROM lan_switch
    UNION ALL SELECT asset FROM tablet
) AS assets";
$result = mysqli_query($connection, $query);
$data = mysqli_fetch_assoc($result);

// Define the chart data as an array of arrays
$chart_data = array(
  array('Asset Category', 'Count'),
  array('Desktop  ', (int)$data['komputer_count']),
  array('Laptop', (int)$data['laptop_count']),
  array('Monitor', (int)$data['monitor_count']),
  array('UPS', (int)$data['ups_count']),
  array('LCD', (int)$data['lcd_count']),
  array('Printer', (int)$data['printer_count']),
  array('Scanner', (int)$data['scanner_count']),
  array('AVR', (int)$data['avr_count']),
  array('LAN Switch', (int)$data['lan_switch_count']),
  array('Tablet', (int)$data['tablet_count'])
);

// Convert the chart data to a JSON string
$chart_data_json = json_encode($chart_data);



