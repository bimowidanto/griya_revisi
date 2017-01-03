<?php

$id=$_GET['id'];
$tgl_mulai=$_GET['tgl_mulai'];
$tgl_akhir=$_GET['tgl_akhir'];
	require'../connect.php';
$filename = "report_transaksi.xls"; // File Name

// Download file
header("Content-Disposition: attachment; filename=\"$filename\""); 
header("Content-Type: application/vnd.ms-excel");
error_reporting(0);
if($tgl_mulai!=""&&$tgl_akhir!=""){
/*
$sql_join = mysql_query("select tbl_transaksi.tgl_transaksi,tbl_transaksi.id_trans,tbl_obat.nama_item,MAX(tbl_barang_masuk.harga_beli),tbl_detail_transaksi.jml_item,tbl_detail_transaksi.biaya_administrasi,tbl_detail_transaksi.total_biaya,tbl_detail_transaksi.id_jasa FROM tbl_detail_transaksi JOIN
tbl_transaksi ON tbl_detail_transaksi.id_trans=tbl_transaksi.id_trans JOIN tbl_obat ON tbl_obat.kode_item=tbl_detail_transaksi.kode_item WHERE tbl_transaksi.tgl_transaksi BETWEEN '$tgl_mulai' AND '$tgl_akhir' GROUP BY tbl_transaksi.id_trans");
*/
	$sql_join = mysql_query("select tbl_transaksi.tgl_transaksi,tbl_transaksi.id_trans,tbl_detail_transaksi.jml_item,tbl_detail_transaksi.kode_item,tbl_detail_transaksi.biaya_administrasi,tbl_detail_transaksi.total_biaya,tbl_detail_transaksi.id_jasa FROM tbl_detail_transaksi JOIN
tbl_transaksi ON tbl_detail_transaksi.id_trans=tbl_transaksi.id_trans WHERE tbl_transaksi.tgl_transaksi BETWEEN '$tgl_mulai' AND '$tgl_akhir' GROUP BY tbl_transaksi.id_trans");
}else{
$sql_join = mysql_query("select tbl_transaksi.tgl_transaksi,tbl_transaksi.id_trans,tbl_detail_transaksi.jml_item,tbl_detail_transaksi.kode_item,tbl_detail_transaksi.biaya_administrasi,tbl_detail_transaksi.total_biaya,tbl_detail_transaksi.id_jasa FROM tbl_detail_transaksi JOIN
tbl_transaksi ON tbl_detail_transaksi.id_trans=tbl_transaksi.id_trans");
}
// Add data table
?>
<table border="1">
    <tr>
    	<th>Tanggal Transaksi</th>
		<th>No. Transaksi</th>
		<th>nama Item</th>
		<th>Jumlah Item</th>
		<th>Biaya Administrasi</th>
		<?php
		$jas=mysql_query("SELECT*FROM tbl_jasa");
		while($jasa=mysql_fetch_assoc($jas)){
			?>
		<th><?php echo $jasa['deskripsi']; ?></th>
		<?php }
	echo" </tr>";
function buatRp($angka){
				$jadi = "Rp. " . number_format($angka,2,',','.');
				return $jadi;
			}

	while($data = mysql_fetch_assoc($sql_join)){
		echo 
		'<tr>
			<td align="center">'.$data['tgl_transaksi'].'</td>
			<td align="center">'.$data['id_trans'].'</td>';
			if($data['kode_item']!=""||$data['kode_item']!=null){
				$kode=$data['kode_item'];
			$obat=mysql_query("SELECT nama_item FROM tbl_obat WHERE kode_item='$kode'");
				while($obt=mysql_fetch_assoc($obat)){
			echo '<td align="center">'.$obt['nama_item'].'</td>';
				}
			}else{
				echo '<td align="center">-</td>';
			}
			echo '<td align="center">'.$data['jml_item'].'</td>
			<td align="right">'.buatRp($data['biaya_administrasi']).'</td>';
		$jas=mysql_query("SELECT*FROM tbl_jasa");
		while($jasa=mysql_fetch_assoc($jas)){
			if($data['id_jasa']==$jasa['id_jasa']){
				echo '<td align="right">'.buatRp($jasa['biaya']).'-,</td>';
			}else{
				echo '<td align="right">Rp.0-,</td>';
		}
		}
		echo'</tr>';
		
	}
	?>
</table>