<?php
require'../connect.php';
error_reporting(0);
		$id = @$_POST['id'];
		$nama = @$_POST['nama'];
		$biaya = @$_POST['biaya'];
	if(@$_GET['page']=='tambah_jasa'){
			$sql_id = mysql_query("SELECT id_jasa FROM tbl_jasa WHERE kode_id_jasa = '$id'");
    		$res2 = mysql_num_rows($sql_id);
		if($res2==0){
			$SQL = " INSERT INTO tbl_jasa";
			$sql_cat = $SQL . " (id_jasa,deskripsi,biaya) VALUES ";
			$sql_var = $sql_cat . " ('$id ','$nama','$biaya')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if ($result) { 
				echo"sukses";
			}
		}
		
	}else if(@$_GET['page']=='ubah_jasa'){
			$sql_var ="UPDATE tbl_supplier SET deskripsi = '$nama',biaya = '$biaya' WHERE id_jasa = '$id'";
			$result=mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}else if(@$_GET['page']=='hapus_jasa'){
			$id = @$_POST['id'];
			$sql_var ="DELETE FROM tbl_supplier WHERE id_jasa = '$id'";
			$result = mysql_query("$sql_var")or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>