<?php

$id=$_GET['id'];
$tgl_mulai=$_GET['tgl_mulai'];
$tgl_akhir=$_GET['tgl_akhir'];

// Add data table
?>
<table border="1">
    <tr>
    	<th>Tanggal Transaksi</th>
		<th>No. Transaksi</th>
		<th>Biaya Administrasi</th>
		<th>Avasin</th>
		<th>Bioresonasi</th>
		<th>Cek Gula & Kolesterol</th>
		<th>Gigi</th>
	</tr>
	<?php
	require'../connect.php';
error_reporting(0);

$sql_join = mysql_query("select tbl_transaksi.tgl_transaksi,tbl_transaksi.id_trans,tbl_detail_transaksi.biaya_administrasi,tbl_jasa.biaya,tbl_jasa.deskripsi,tbl_jasa.id_jasa FROM tbl_detail_transaksi JOIN
tbl_transaksi ON tbl_detail_transaksi.id_trans=tbl_transaksi.id_trans JOIN tbl_jasa ON tbl_jasa.id_jasa=tbl_detail_transaksi.id_jasa WHERE tbl_transaksi.tgl_transaksi BETWEEN '$tgl_mulai' AND '$tgl_akhir' GROUP BY tbl_transaksi.id_trans");
	while($data = mysql_fetch_assoc($sql_join)){
		echo 
		'<tr>
			<td>'.$data['tgl_transaksi'].'</td>
			<td>'.$data['id_trans'].'</td>
			<td>'.$data['biaya_administrasi'].'</td>';
			if($data['id_jasa']=='JS0002')
			{
				'<td>'.$data['biaya'].'</td>
				<td>0</td>
				<td>0</td>
				<td>0</td>';
			}
		'</tr>';
		
	}
	?>
</table>
<?php
$filename = "report_transaksi.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
?>