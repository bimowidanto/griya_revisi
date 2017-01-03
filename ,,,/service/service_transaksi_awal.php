<?php
require'../connect.php';
error_reporting(0);
$id_transaksi = @$_POST['id_transaksi'];
$id_pasien = @$_POST['id_pasien'];
$tgl_transaksi = @$_POST['tgl_transaksi'];
$id_user = @$_POST['id_user'];
	if(@$_GET['page']=='tambah_transaksi'){
		
		
		$sql_var="";
		
	
		$SQL = " INSERT INTO tbl_transaksi";
					$sql_var = $SQL . " (id_trans,id_user,id_pasien,tgl_transaksi) VALUES
					('$id_transaksi','$id_user','$id_pasien','$tgl_transaksi')";
		
		$result = mysql_query("$sql_var") or die(mysql_error());
					if ($result) { 
						echo "sukses";
					}
		
	}else if(@$_GET['page']=='ubah_transaksi')
	{
		echo "ubah";
	}
	
?>