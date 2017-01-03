<?php
if(@$_POST['id']!=null && @$_POST['nama']!=null){
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
?>	
	<h5 class="blue-text">Ubah Data Supplier</h2>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $id; ?>" type="text" id="id" class="validate" readonly="" disabled>
		<label class="active pink-text">Id</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $nama; ?>" type="text" id="nama" placeholder="nama supplier" required >
		<label class="active pink-text">Nama</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class=" col s3">
		<button class="btn waves-effect waves-light" id="simpanedit_supplier">Simpan
		<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php
}else{

?>
<h5 class="blue-text">Tambah Data Supplier</h2>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="id" placeholder="id suppliers"/>
		<label class="pink-text">Id  </label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="nama" placeholder="nama supplier"/>
		<label class="pink-text">Nama</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="submit" id="simpantambah_supplier">Simpan
			<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php } ?>