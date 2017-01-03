<?php
require'../connect.php';
//error_reporting(0);
	if(@$_GET['page']=='insert_obat'){
		$last_id = @$_POST['last_id'];
		$kode_item = @$_POST['kode_item'];
		$jml = @$_POST['jml'];
		$stok = @$_POST['stok'];
		$sql_var="";
		$now = date("Y-m-d");
		$administrasi=@$_POST['administrasi'];
		
		$s_hrg=mysql_query("SELECT MAX(harga_jual)FROM tbl_barang_masuk WHERE kode_item='$kode_item' AND expired_date > '$now'");
		$harga_jual=mysql_fetch_row($s_hrg);
		$total=$jml*$harga_jual[0];

		try{
	
		$s=($stok-$jml);
		
		$sql_var = "UPDATE tbl_obat SET stok ='$s' WHERE kode_item = '$kode_item'";
		$result = mysql_query("$sql_var") or die(mysql_error());
		if($result){
			$result1=mysql_query("SELECT id_barang FROM tbl_barang_masuk WHERE kode_item='$kode_item'")
				or die(mysql_error());
			if($result1){
				$data=mysql_fetch_assoc($result1);
				$id_barang=$data['id_barang'];
				
				$cek=mysql_query("SELECT * FROM tbl_detail_transaksi where id_trans='$last_id'")or die(mysql_error());
				
				$row=mysql_num_rows($cek);
				if($row>0){
				while($temp=mysql_fetch_assoc($cek)){
					$t=($total+$temp['total_biaya']);
					if($temp['kode_item']==$kode_item){
					$s=($jml+$temp['jml_item']);
					
					$sql_var ="UPDATE tbl_detail_transaksi SET jml_item='$s',total_biaya='$t' WHERE kode_item='$kode_item'";
						break;
					}else if(strlen($temp['kode_item'])==0&&
							 strlen($temp['id_jasa'])!=0&&strlen($temp['id_dokter'])!=0
							||$temp['kode_item']==null &&$temp['id_jasa']!=null &&
							 $temp['id_dokter']!=null){	
							$id_jasa=$temp['id_jasa'];
							$id_dokter=$temp['id_dokter'];
							$sql_var ="UPDATE tbl_detail_transaksi SET jml_item='$jml',kode_item='$kode_item',total_biaya='$t'
							WHERE id_dokter='$id_dokter' AND id_jasa='$id_jasa' AND id_trans='$last_id'"; break;
					}else{
						if($administrasi !=null)
						{
							
						
					      $SQL = " INSERT INTO tbl_detail_transaksi";
					      $sql_var = $SQL . " (id_trans, jml_item, kode_item,biaya_administrasi,total_biaya) VALUES
					      ('$last_id','$jml','$kode_item','$administrasi','$total')";
						}
						else{
							echo "Biaya administrasi masih kosong";
						}
					}
				}
				}else{
					if($administrasi !=null)
					{
						$SQL = " INSERT INTO tbl_detail_transaksi";
					    $sql_cat = $SQL . " (id_trans,jml_item,kode_item,biaya_administrasi,total_biaya) VALUES ";
					    $sql_var = $sql_cat . "('$last_id','$jml','$kode_item','$administrasi','$total')";
					}else{
						echo "Biaya administrasi masih kosong";
					}
					
				}
				$result = mysql_query("$sql_var") or die(mysql_error());
					if ($result) { 
						echo "sukses";
					}
		}
		}
		}catch(exception $e){
			echo $e;
		}
		
		
	}else if(@$_GET['page']=='hapus_obat'){
		$last_id = @$_POST['last_id'];
		$kode_item = @$_POST['kode_item'];
		$jml = @$_POST['jml'];
		$stok = @$_POST['stok'];
		try{
	
		$s=($stok+$jml);
		$sql_var = "UPDATE tbl_obat SET stok ='$s' WHERE kode_item = '$kode_item'";
		$result = mysql_query("$sql_var") or die(mysql_error());
		if($result){
			$cek=mysql_query("SELECT id_jasa,id_dokter,total_biaya FROM tbl_detail_transaksi WHERE id_trans='$last_id' AND kode_item='$kode_item'")
				or die(mysql_error());
				
				
			if ($cek) { 
				$temp=mysql_fetch_assoc($cek);
				$temp_id = $temp['id_jasa'];
				
				$b_jasa=mysql_query("SELECT tbl_detail_transaksi.id_trans,tbl_jasa.biaya FROM tbl_detail_transaksi JOIN tbl_jasa 
				ON tbl_detail_transaksi.id_jasa=tbl_jasa.id_jasa WHERE tbl_detail_transaksi.id_trans='$last_id' AND tbl_detail_transaksi.id_jasa='$temp_id'")
				or die(mysql_error());
				
				$res_biaya = mysql_fetch_assoc($b_jasa);
				$temp_biaya = $res_biaya['biaya'];
				
				if($temp['id_jasa']!=null && $temp['id_dokter']!=null){
					$null=null;
					$sql_var ="UPDATE tbl_detail_transaksi SET jml_item='$null', kode_item='$null',total_biaya='$temp_biaya' WHERE id_trans='$last_id'
					AND kode_item='$kode_item' AND jml_item='$jml'";
				}else{
					$sql_var="DELETE FROM tbl_detail_transaksi WHERE id_trans='$last_id' AND kode_item='$kode_item' AND jml_item='$jml'";
				}
				$result=mysql_query("$sql_var")or die(mysql_error());
				if($result){
					echo "sukses";
				}
			}
		}
		}catch(exception $e){
			echo"gagal";
		}
	}else if(@$_GET['page']=='insert_jasa'){
		try{
			$id_jasa=@$_POST['id_jasa'];
			$id_dokter=@$_POST['id_dokter'];
			$last_id=@$_POST['last_id'];
			$biaya=@$_POST['biaya'];
			$administrasi=@$_POST['administrasi'];
			
			$ada=false;
			if($administrasi!=null)
			{
				$SQL = " INSERT INTO tbl_detail_transaksi";
			    $sql_cat = $SQL . " (id_trans,id_jasa,id_dokter,biaya_administrasi,total_biaya) VALUES ";
			    $sql_var = $sql_cat . "('$last_id','$id_jasa','$id_dokter','$administrasi','$biaya')";
			}
			
			$cek=mysql_query("SELECT*FROM tbl_detail_transaksi WHERE id_trans='$last_id'")or die(mysql_error());
					while($temp=mysql_fetch_assoc($cek)){
					$kode_item=$temp['kode_item'];
					$total_semua = $temp['total_biaya']+ $biaya;
						if($temp['id_jasa']==null && $temp['id_dokter']==null){
							$sql_var="UPDATE tbl_detail_transaksi SET id_dokter='$id_dokter', id_jasa='$id_jasa',total_biaya='$total_semua' WHERE kode_item='$kode_item'";
							$ada=true;
							break;
						}
				}
				$result = mysql_query("$sql_var") or die(mysql_error());
				if ($result) { 
					echo"sukses";
				}
		}catch(exception $e){
			echo"gagal";
		}
		
	}
	
else if(@$_GET['page']=='hapus_jasa'){
			$id_jasa=@$_POST['id_jasa'];
			$id_dokter=@$_POST['id_dokter'];
			$last_id=@$_POST['last_id'];
			try{
			$SQL = "SELECT kode_item,total_biaya FROM tbl_detail_transaksi where id_trans='$last_id' AND id_jasa='$id_jasa' AND id_dokter='$id_dokter'";
			$result = mysql_query("$SQL") or die(mysql_error());
			if ($result) { 
				$data=mysql_fetch_assoc($result);
				
				$s_js = "SELECT tbl_jasa.biaya,tbl_detail_transaksi.id_jasa,tbl_detail_transaksi.id_trans FROM tbl_detail_transaksi JOIN tbl_jasa ON tbl_detail_transaksi.id_jasa=tbl_jasa.id_jasa
				WHERE tbl_detail_transaksi.id_jasa='$id_jasa' AND id_trans='$last_id'";
				$res_js = mysql_query("$s_js") or die(mysql_error());
				$data_js=mysql_fetch_assoc($res_js);
				
				$kurang = ($data['total_biaya'])-($data_js['biaya']);
				
				if($data['kode_item']!=null){
					$null=null;
					$SQL="UPDATE tbl_detail_transaksi SET id_jasa='$null' ,id_dokter='$null',total_biaya='$kurang' WHERE id_jasa='$id_jasa' AND id_dokter='$id_dokter'
					AND id_trans='$last_id'";

			}else{
				$SQL="DELETE FROM tbl_detail_transaksi WHERE id_jasa='$id_jasa' AND id_dokter='$id_dokter' AND id_trans='$last_id'";
			}
				$result=mysql_query("$SQL")or die(mysql_error());
				if($result){
					echo"sukses";
				}
			}
			}catch(exception $e){
				echo"gagal";
			}
	}
?>