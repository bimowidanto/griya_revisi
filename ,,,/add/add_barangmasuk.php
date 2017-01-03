<script>
//ajax
 $(function() {	 
	$('#harga').keydown( function(){
		var nme = $(this).val().trim();
        var untung = parseFloat(nme)*0.2;	
        var hrg_jual = parseFloat(untung) + parseFloat(nme);
		$('#show_jual').text(hrg_jual);
		
	});  	
  });

</script>
<?php

if(@$_POST['id_barang']!=null && @$_POST['kode_item']!=null && @$_POST['stok']!=null && @$_POST['harga_beli']!=null){
	$id = @$_POST['id_barang'];
	$kode = @$_POST['kode_item'];
	$stok = @$_POST['stok'];
	$harga = @$_POST['harga_beli'];
	$expired = @$_POST['expired_date'];
	$supplier =  @$_POST['id_supplier'];
	$harga_jual = @$_POST['harga_jual'];
	
	try{
		error_reporting(0);
		require'../connect.php';
		$rs = mysql_query("SELECT id_supplier FROM tbl_supplier") or die(mysql_error());
	}catch(exception $e){
		echo $e->getMessage();
	}
?>
<h5 class="blue-text">Edit Barang Masuk</h2>
	<div class="row">
		<div class="column col s5">
			<label class=" pink-text">Id Barang</label>
			<input type="text" id="id_barang" value="<?php echo $id?>" readonly="readonly">
		</div>
			<div class="column input-field col s5 right">
			<label class="active pink-text ">Stok</label>
			<input type="number" id="stok" value="<?php echo $stok?>" class="validate">
		</div>
	</div>
	<div class="row"> 
		<div class="input-field col s5">
			<label class="active pink-text">Kode Item</label>
			<input type="text" id="kode_item" value="<?php echo $kode?>" class="validate">
		</div>
		<div class="column col s5 right">
			<h6 class="pink-text" >ID Supplier</h6>
			<select class="browser-default waves-effect waves-light" id="id_supplier">
				<option value="<?php echo $supplier; ?>"><?php echo $supplier; ?></option>
						<?php require'../connect.php';
				while($data =mysql_fetch_assoc($rs)){
				?>
				<option value="<?php echo $data['id_supplier'];?>">
						 <?php if($supplier != $data['id_supplier']){echo $data['id_supplier']; }?></option>
				<?php
						}
				?>
			</select>
		</div>
	</div>
	<div class="row"> 
		<div class="input-field col s5">
			<input  type="date" id="expired" placeholder="Tgl-Expired" value="<?php echo $expired; ?>">
			<label class="active pink-text">Expired</label>
		</div>
		<div class="column col s5 right">
			<label class="active pink-text">Tgl-Masuk</label>
			<input type="text" id="tgl_masuk" readonly="readonly" value="<?php echo date("Y-m-d");?>">
		</div>
	</div>
	<div class="row">
		<div class="column input-field col s5">
			<input type="number" id="harga" placeholder="Harga Beli" value="<?php echo $harga; ?>" required>
			<label class="active pink-text">Harga Beli</label>
		</div>
		<div class="column col s5 right">
			<input type="number" id="harga_jual" placeholder="Harga Jual" value="<?php echo $harga_jual; ?>" required>
			<label class="active pink-text">Harga Jual</label>
		</div>
	</div>
	<div class="row">
		<div class="col s3 center">
			<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
				<i class="mdi-content-send right"></i>
			</button>
		</div>
		<div class="col s3 center">
			<button class="btn waves-effect waves-light" id="simpanedit_barangmasuk">Simpan
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</div>
<?php }else{ require'../connect.php';
$rs=mysql_query("SELECT LAST_INSERT_ID(id_barang) FROM tbl_barang_masuk")or die(mysql_error());
			$id=mysql_fetch_row($rs);
?>

<h5 class="blue-text">Tambah Barang Masuk</h2>
	<div class="row">
		<div class="column col s5">
			<h6 class="pink-text">Nama Item</h6>
			<select class="browser-default waves-effect waves-light" id="kode_item">
				<option value="">- Pilih -</option>
				<?php require'../connect.php';
					try{
						$sql = mysql_query("SELECT kode_item,nama_item FROM tbl_obat") or die(mysql_error());
						while($data_obat =mysql_fetch_assoc($sql)){
				?>
				<option value="<?php echo $data_obat['kode_item']; ?>"><?php echo $data_obat['nama_item']; ?></option>
				<?php
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				?>
			</select>
		</div>
			<div class="column input-field col s5 right">
			<label class="pink-text ">Stok</label>
			<input type="number" id="stok" class="validate">
		</div>
	</div>
	<div class="row"> 
		<div class="column col s5 right">
			<h6 class="pink-text">ID Supplier</h6>
			<select class="browser-default waves-effect waves-light" id="id_supplier">
				<option value="">- Pilih -</option>
				<?php require'../connect.php';
					try{
						$rs = mysql_query("SELECT * FROM tbl_supplier") or die(mysql_error());
						while($data =mysql_fetch_assoc($rs)){
				?>
				<option value="<?php echo $data['id_supplier']; ?>"><?php echo $data['nama_supplier']; ?></option>
				<?php
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				?>
			</select>
		</div>
	</div>
	<div class="row"> 
		<div class="input-field col s5">
			<input  type="date" id="expired" placeholder="Tgl-Expired">
			<label class="active pink-text">Expired</label>
		</div>
		<div class="column col s5 right">
			<label class="active pink-text">Tgl-Masuk</label>
			<input type="text" id="tgl_masuk" readonly="readonly" value="<?php echo date("Y-m-d");?>">
		</div>
	</div>
	<div class="row">
		<div class="column input-field col s5">
			<input type="number" id="harga" placeholder="Hraga Beli" required>
			<label class="pink-text">Harga Beli</label>
		</div>
		<div class="column col s5 right">
			<input type="number" id="harga_jual" placeholder="Harga Jual" required>
			<label class="active pink-text">Harga Jual</label>
		</div>
	</div>
	<div class="row">
		<div class="col s3 center">
			<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
				<i class="mdi-content-send right"></i>
			</button>
		</div>
		<div class="col s3 center">
			<button class="btn waves-effect waves-light" id="simpantambah_barangmasuk">Simpan
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</div>
<?php } ?>