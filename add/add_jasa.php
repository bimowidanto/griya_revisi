<?php
if(@$_POST['id']!=null && @$_POST['nama']!=null){
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
	$biaya = @$_POST['biaya'];
?>	
	<h5 class="blue-text">Ubah Data Jasa</h2>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $id; ?>" type="text" id="id" class="validate" readonly="" disabled>
		<label class="active pink-text">Id Jasa</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $nama; ?>" type="text" id="nama" placeholder="nama jasa" required >
		<label class="active pink-text">Nama Jasa</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $biaya; ?>" type="text" id="biaya" placeholder="biaya" required >
		<label class="active pink-text">Biaya</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class=" col s3">
		<button class="btn waves-effect waves-light" id="simpanedit_jasa">Simpan
		<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php
}else{

?>
<h5 class="blue-text">Tambah Data Jasa</h2>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="id" placeholder="id Jasa"/>
		<label class="pink-text">Id Jasa</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="nama" placeholder="nama Jasar"/>
		<label class="pink-text">Nama Jasa</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="biaya" placeholder="Biaya"/>
		<label class="pink-text">Biaya</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="submit" id="simpantambah_jasa">Simpan
			<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php } ?>