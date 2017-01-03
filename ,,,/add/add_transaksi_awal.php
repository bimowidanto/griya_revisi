<?php 
session_id();
session_start();
require'../connect.php';
		
?>
<script>

$(function() {	 
	$('#id_pasien').keydown( function(){
		var nme = $(this).val().trim(); 
		$('#show_nama').load('table/view_nama_pasien.php?id_pasien='+nme);
	});  	
  });

</script>
<?php
$username = $_SESSION['login_user'];
$sql = mysql_query("select id_user,username from tbl_user where username='".$username."'");
$result = mysql_fetch_array($sql);
if(@$_POST['id_pasien']!=null){
	$id_transaksi = @$_POST['id_transaksi'];
	$id_pasien = @$_POST['id_pasien'];
	$id_user = @$_POST['id_user'];
	$tgl_transaksi = @$_POST['tgl_transaksi'];
	
?>
<h5 class="blue-text">Edit Transaksi Pasien</h2>
	<div class="row">
	    <div class="column col s5">
			<label class=" pink-text">Id Transaksi</label>
			<input type="text" id="id_transaksi" value="<?php echo $id_transaksi?>" readonly="readonly">
		</div>
		<div class="column col s5 left">
			<label class=" pink-text">Id Pasien</label>
			<input type="text" id="id_pasien" value="<?php echo $id_pasien?>" readonly="readonly">
		</div>
	</div>
	<div id="show_nama"></div>
	<div class="row"> 
		<div class="column col s5 right">
			<label class="active pink-text">Tanggal Transaksi</label>
			<input type="text" id="tgl_transaksi" readonly="readonly" value="<?php echo date("Y-m-d");?>">
		</div>
		<div>
		<input type="hidden" id="id_user" value="<?php echo $result['id_user'];?>">
		</div>
	</div>
	<div class="row">
		<div class="col s3 center">
			<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
				<i class="mdi-content-send right"></i>
			</button>
		</div>
		<div class="col s3 center">
			<button class="btn waves-effect waves-light" id="simpanedit_transaksi_pasien">Lanjut
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</div>
<?php }else{ require'../connect.php';
$rs=mysql_query("SELECT MAX(id_trans) FROM tbl_transaksi")or die(mysql_error());
			$id=mysql_fetch_row($rs);
			
?>

<h5 class="blue-text">Tambah Transaksi Pasien</h2>
	<div class="row">
	    <div class="column col s5 left">
			<label class=" pink-text">ID Transaksi</label>
			<input type="text" id="id_transaksi" value="<?php echo ($id[0]+1);?>"readonly="readonly">
		</div>
			<div class="column input-field col s5 left">
			<label class="pink-text ">ID Pasien</label>
			<input type="number" id="id_pasien" class="validate">
			<span>Tekan enter setelah memasukkan ID Pasien</span>
		</div>
	</div>
	<div id="show_nama"></div>
	<div class="row"> 
		<div class="column col s5 left">
			<label class="active pink-text">Tanggal Transaksi</label>
			<input type="text" id="tgl_transaksi" readonly="readonly" value="<?php echo date("Y-m-d");?>">
		</div>
		<div class="column col s5 left">
		<input type="hidden" id="id_user" value="<?php echo $result['id_user'];?>">
		</div>
	</div>
	<div class="row">
		<div class="col s3 center">
			<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
				<i class="mdi-content-send right"></i>
			</button>
		</div>
		<div class="col s3 center">
			<button class="btn waves-effect waves-light" id="simpantambah_transaksi_pasien">Lanjut
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</div>
<?php } ?>
