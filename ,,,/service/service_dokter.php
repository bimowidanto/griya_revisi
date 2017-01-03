<?php
require'../connect.php';
error_reporting(0);
	if(@$_GET['page']=='tambah_dokter'){
		$id = @$_POST['id'];
		$nama = @$_POST['nama'];
		$spesialis = @$_POST['spesialis'];
		$sql_id = mysql_query("SELECT id_supplier FROM tbl_dokter WHERE id_dokter = '$id'");
    	$res2 = mysql_num_rows($sql_id);
		if($res2 == 0){
			$SQL = " INSERT INTO tbl_dokter";
			$sql_cat = $SQL . " (id_dokter,nama_dokter,spesialis) VALUES ";
			$sql_var = $sql_cat . " ('$id','$nama','$spesialis')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if ($result) { 
				echo"sukses";
			}
		}
		
	}else if(@$_GET['page']=='ubah_dokter'){
			$id = @$_POST['id'];
			$nama = @$_POST['nama'];
			$spesialis = @$_POST['spesialis'];
			$sql_var ="UPDATE tbl_dokter SET nama_dokter = '$nama', spesialis = '$spesialis' WHERE id_dokter = '$id'";
			$result=mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}else if(@$_GET['page']=='hapus_dokter'){
			$id = @$_POST['id'];
			$sql_var ="DELETE FROM tbl_dokter WHERE id_dokter = '$id'";
			$result = mysql_query("$sql_var")or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>