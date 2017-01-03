<?php
require'../connect.php';
error_reporting(0);
	if(@$_GET['page']=='tambah_obat'){
		$kode = @$_POST['kode_item'];
		$nama = @$_POST['nama_item'];
		$satuan = @$_POST['satuan'];
		$kategori = @$_POST['kategori'];
		$stock=2;
		$sql_id = mysql_query("SELECT kode_item FROM tbl_obat WHERE kode_item = '$kode'");
    	$res2 = mysql_num_rows($sql_id);
		if($res2 == 0){
			$SQL = " INSERT INTO tbl_obat";
			$sql_cat = $SQL . " (kode_item, nama_item,kategori, satuan) VALUES ";
			$sql_var = $sql_cat . "('$kode ','$nama','$kategori','$satuan')";
			$result = mysql_query("$sql_var") or die(mysql_error());
			if ($result) { 
				echo"sukses";
			}
		}
		
	}else if(@$_GET['page']=='ubah_obat'){
			$kode = @$_POST['kode_item'];
			$nama = @$_POST['nama_item'];
			$kategori = @$_POST['kategori'];
			$satuan = @$_POST['satuan'];
			$sql_var ="UPDATE tbl_obat SET nama_item = '$nama',kategori='$kategori', 
				satuan = '$satuan' WHERE kode_item = '$kode'";
			$result=mysql_query("$sql_var") or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}else if(@$_GET['page']=='hapus_obat'){
			$kode = @$_POST['kode_item'];
			$sql_var ="DELETE FROM tbl_obat WHERE kode_item = '$kode'";
			$result = mysql_query("$sql_var")or die(mysql_error());
			if($result){
				echo"sukses";
			}
	}
?>