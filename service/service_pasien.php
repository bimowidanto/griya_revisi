<?php
require'../connect.php';
error_reporting(0);
	if(@$_GET['page']=='tambah_pasien'){
		$nama = @$_POST['nama'];
		$jk = @$_POST['jk'];
		$alamat = @$_POST['alamat'];
		$tlp = @$_POST['tlp'];
			$SQL = " INSERT INTO tbl_pasien";
			$sql_cat = $SQL . " (nama_pasien,jenis_kelamin,no_telp,alamat) VALUES ";
			$sql_var = $sql_cat . " ('$nama','$jk','$tlp','$alamat')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if ($result) { 
				echo"sukses";
			}		
	}else if(@$_GET['page']=='ubah_pasien'){
			$id = @$_POST['id'];
			$nama = @$_POST['nama'];
			$jk = @$_POST['jk'];
			$alamat = @$_POST['alamat'];
			$tlp = @$_POST['tlp'];
			$sql_var ="UPDATE tbl_pasien SET nama_pasien = '$nama', jenis_kelamin = '$jk', no_telp = '$tlp' , alamat = '$alamat'
			WHERE id_pasien = '$id'";
			$result=mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}else if(@$_GET['page']=='hapus_pasien'){
			$id = @$_POST['id'];
			$sql_var ="DELETE FROM tbl_pasien WHERE id_pasien = '$id'";
			$result = mysql_query("$sql_var")or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>