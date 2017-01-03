<?php
require'../connect.php';
error_reporting(0);
	if(@$_GET['page']=='tambah_supplier'){
		$id = @$_POST['id'];
		$nama = @$_POST['nama'];
		$sql_id = mysql_query("SELECT id_supplier FROM tbl_supplier WHERE id_supplier = '$id'");
    	$res2 = mysql_num_rows($sql_id);
		if($res2 == 0){
			$SQL = " INSERT INTO tbl_supplier";
			$sql_cat = $SQL . " (id_supplier,nama_supplier) VALUES ";
			$sql_var = $sql_cat . " ('$id ','$nama')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if ($result) { 
				echo"sukses";
			}
		}
		
	}else if(@$_GET['page']=='ubah_supplier'){
			$id = @$_POST['id'];
			$nama = @$_POST['nama'];
			$sql_var ="UPDATE tbl_supplier SET nama_supplier = '$nama' WHERE id_supplier = '$id'";
			$result=mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}else if(@$_GET['page']=='hapus_supplier'){
			$id = @$_POST['id'];
			$sql_var ="DELETE FROM tbl_supplier WHERE id_supplier = '$id'";
			$result = mysql_query("$sql_var")or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>