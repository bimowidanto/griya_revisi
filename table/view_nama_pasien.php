<?php
require'../connect.php';



$idPasien = trim(strip_tags($_GET['id_pasien']));

if (!empty($idPasien)){
	
$sql = mysql_query("SELECT id_pasien FROM tbl_pasien WHERE id_pasien = '$idPasien'");
$res = mysql_num_rows($sql);
if($res == 0){
	echo "
		<div class='column col s5 right'>
			<p class ='active pink-text'>Tidak ditemukan ID $idPasien </p>
		</div>		
	";
 }
	else{
	$sql_check = "SELECT id_pasien,nama_pasien from tbl_pasien WHERE id_pasien = '$idPasien'";
	$query = mysql_query($sql_check);
	$result = mysql_fetch_array($query);
	echo "
		 <div class='row'>
			<div class='column input-field col s5 left'>
				 <span class='pink-text'>Nama Pasien</span>
				 <input type='text' id='nama_pasien'  placeholder='Nama Pasien' value='$result[nama_pasien]' disabled='disabled'>
			</div>
		</div>
		";
	
	}
}
?>
