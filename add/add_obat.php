<?php
if(@$_POST['kode_item']!=null && @$_POST['nama_item']!=null){
	$kode = @$_POST['kode_item'];
	$nama = @$_POST['nama_item'];
	$satuan = @$_POST['satuan'];
	$kategori = @$_POST['kategori'];
?>	
	<h5 class="blue-text">Ubah Data Obat</h2>
	<div class="row"> 
		<div class="input-field col s5">
			<label class="active pink-text">Kode Item</label>
			<input value="<?php echo $kode; ?>" type="text" id="kode_item" class="validate" disabled>
		</div>
	</div>
	<div class="row"> 
		<div class="input-field col s5">
			<input value="<?php echo $nama; ?>" type="text" id="nama_item"placeholder="nama obat" required >
			<label class="active pink-text">Nama Item</label>
		</div>
	</div>
	<div class="row">
	<div class="column col s5 left">
			<h6 class="pink-text">Satuan</h6>
			<select class="browser-default waves-effect waves-light" id="satuan">
				<option value="">- Pilih -</option>
				<option value="pieces"<?php if($satuan=="pieces"){echo"selected";}?>>Pieces</option>
				<option value="dus" <?php if($satuan=="dus"){echo"selected";}?>>Dust</option>
				<option value="kaplet" <?php if($satuan=="kaplet"){echo"selected";}?>>Kaplet</option>
				<option value="kapsul" <?php if($satuan=="kapsul"){echo"selected";}?>>Kapsul</option>
				<option value="botol" <?php if($satuan=="botol"){echo"selected";}?>>Botol</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="column col s5 left">
			<h6 class="pink-text">Kategori</h6>
			<select class="browser-default waves-effect waves-light" id="kategori">
				<option value="">- Pilih -</option>
				<option value="herbal"<?php if($kategori=="herbal"){echo"selected";}?>>Herbal</option>
				<option value="racikan"<?php  if($kategori=="racikan"){echo"selected";}?>>Racikan</option>
				<option value="umum" <?php  if($kategori=="umum"){echo"selected";}?>>Umum</option>
			</select>
		</div>
	</div>
	<div class="row">
		<div class="col s3 center">
			<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
				<i class="mdi-content-send right"></i>
			</button>
		</div>
		<div class="col s3 center">
			<button class="btn waves-effect waves-light" id="simpanedit_obat">Simpan
				<i class="mdi-content-send right"></i>
			</button>
		</div>
	</div>
<?php
}else{
?>
<h5 class="blue-text">Tambah Data Obat</h2>
		<div class="row"> 
			<div class="input-field col s5">
				<input type="text" id="kode_item" placeholder="kode_item" required />
				<label class="pink-text">Kode Item</label>
			</div>
		</div>
		<div class="row">
		<div class="input-field col s5">
				<input type="text" id="nama_item" placeholder="nama_dokter" required/>
				<label class="pink-text">Nama Item</label>
		</div>
		</div>
		<div class="row"> 
			<div class="column col s5 left">
				<h6 class="pink-text">Satuan</h6>
				<select class="browser-default waves-effect waves-light" id="satuan">
						<option value="">- Pilih -</option>
						<option value="pices">Pieces</option>
						<option value="botol">Botol</option>
						<option value="kaplet">Tablet</option>
						<option value="kapsul">Kapsul</option>
				</select>
			</div>
		</div>
		<div class="row">
		<div class="column col s5 left">
			<h6 class="pink-text">Kategori</h6>
			<select class="browser-default waves-effect waves-light" id="kategori">
				<option value="">- Pilih -</option>
				<option value="herbal">Herbal</option>
				<option value="racikan">Racikan</option>
				<option value="umum">Umum</option>
				
			</select>
		</div>
		</div>
		<div class="row">
			<div class="column col s3 center">
				<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
					<i class="mdi-content-send right"></i>
				</button>
			</div>
			<div class=" column col s3 center">
				<button class="btn waves-effect waves-light" type="submit" id="simpantambah_obat">Simpan
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
<?php } ?>