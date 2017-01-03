<?php
require'../connect.php';
error_reporting(0);

$tgl_mulai = @$_POST['tgl_mulai'];
$tgl_akhir = @$_POST['tgl_akhir'];
	if(@$_GET['page']=='sort'){
		
		
		/*$sql="SELECT tbl_transaksi.id_trans,tbl_jasa.deskripsi, tbl_obat.kode_item,tbl_obat.nama_item, tbl_detail_transaksi.total_biaya, tbl_detail_transaksi.jml_item, tbl_transaksi.tgl_transaksi
FROM tbl_detail_transaksi JOIN tbl_obat ON tbl_obat.kode_item=tbl_detail_transaksi.kode_item JOIN tbl_jasa ON tbl_jasa.id_jasa=tbl_detail_transaksi.id_jasa JOIN
tbl_transaksi.id_trans=tbl_detail_transaksi.id_trans WHERE tbl_transaksi.tgl_transaksi BETWEEN '$tgl_mulai' AND '$tgl_akhir'";

$result = mysql_query("$sql") or die(mysql_error());*/

$SQL = " INSERT INTO tbl_history_report";
			$sql_cat = $SQL . " (tgl_mulai, tgl_akhir) VALUES ";
			$sql_var = $sql_cat . "('$tgl_mulai ','$tgl_akhir')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>