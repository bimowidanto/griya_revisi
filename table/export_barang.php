<?php

$filename = "report data obat.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");

// Add data table
include 'print_barang.php';
?>