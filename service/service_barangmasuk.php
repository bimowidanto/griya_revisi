<?php
require'../connect.php';
error_reporting(0);
		$id = @$_POST['id_barang'];
		$kode = @$_POST['kode_item'];
		$expired = @$_POST['expired'];
		$harga = @$_POST['harga'];
		$harga_jual = @$_POST['harga_jual'];
		$stok = @$_POST['stok'];
		$tgl_masuk = @$_POST['tgl_masuk'];
		$id_supplier = @$_POST['id_supplier'];
		//$untung = $harga*0.2;
		//$h = $untung + $harga;
		$sql_id = mysql_query("SELECT stok FROM tbl_obat WHERE kode_item = '$kode'") or die(mysql_error());
    	$result = mysql_num_rows($sql_id);
		if($result == 1){
			$data = mysql_fetch_assoc($sql_id);
			if(@$_GET['page']=='tambah_data'){
				$s=($data['stok']+$stok);
				$sql_var = "UPDATE tbl_obat SET stok ='$s' WHERE kode_item = '$kode'";
				$result = mysql_query("$sql_var") or die(mysql_error());
				if($result){
					$SQL = " INSERT INTO tbl_barang_masuk";
					$sql_cat = $SQL . " (kode_item, stok, expired_date, harga_beli, harga_jual, id_supplier, tgl_masuk) VALUES ";
					$sql_var = $sql_cat . "('$kode ','$stok',' $expired','$harga','$harga_jual','$id_supplier','$tgl_masuk')";
					$result = mysql_query("$sql_var") or die(mysql_error());
					if ($result) { 
						echo "sukses";
					}

				}	
			}else if(@$_GET['page']=='ubah_data'){
					$temp = mysql_query("SELECT stok FROM tbl_barang_masuk WHERE id_barang = '$id'") or die(mysql_error());
					$temp2 = mysql_fetch_assoc($temp);
					if($stok >= $temp2['stok']){
						$s = $data['stok']+($stok-$temp2['stok']);
					}else{
						$s = $data['stok']-($temp2['stok']-$stok);
					}
					$sql_var = "UPDATE tbl_obat SET stok ='$s' WHERE kode_item = '$kode'";
					$result = mysql_query("$sql_var") or die(mysql_error());
					if($result){
						$sql_var ="UPDATE tbl_barang_masuk SET kode_item = '$kode', stok = '$stok', expired_date = '$expired',
						harga_beli = '$harga',harga_jual='$harga_jual', id_supplier = '$id_supplier', tgl_masuk = '$tgl_masuk'
						WHERE id_barang ='$id'";
						$result=mysql_query("$sql_var") or die(mysql_error());
						if($result){
							echo"sukses";
						}
					}
			}else if(@$_GET['page']=='hapus_data'){
					$s = ($data['stok']-$stok);
					$sql_var = "UPDATE tbl_obat SET stok ='$s' WHERE kode_item = '$kode'";
					$result = mysql_query("$sql_var") or die(mysql_error());
					if($result){
						$sql_var ="DELETE FROM tbl_barang_masuk WHERE id_barang = '$id'";
						$result = mysql_query("$sql_var")or die(mysql_error());
						if($result){
							echo"sukses";
						}
					}
				}
			}
?>