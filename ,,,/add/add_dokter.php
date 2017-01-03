<?php
if(@$_POST['id']!=null && @$_POST['nama']!=null){
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
	$spesialis = @$_POST['spesialis'];
?>	
	<h5 class="blue-text">Ubah Data Dokter</h2>
<div class="row"> 
	<div class="input-field col s8">
		<label class="active pink-text">Id</label>
		<input value="<?php echo $id; ?>" type="text" id="id" class="validate" disabled>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input value="<?php echo $nama; ?>" type="text" id="nama"placeholder="nama dokter" required >
		<label class="active pink-text">Nama</label>
	</div>
</div>
<div class="row">
	<div class="input-field col s8">
		<input type="text" id="spesialis" placeholder="keahlian /spesialis" value="<?php echo $spesialis;?>" required>
		<label class="active pink-text">Speialis</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" id="simpanedit_dokter">Simpan
			<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php
}else{
?>
<h5 class="blue-text">Tambah Data Dokter</h2>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="id" placeholder="id dokter" required />
		<label class="pink-text">Id</label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s8">
		<input type="text" id="nama" placeholder="nama dokter" required/>
		<label class="pink-text">Nama</label></div>
</div>
<div class="row">
	<div class="input-field col s8">
		<input type="text" id="spesialis" placeholder="keahlian/spesialis" required>
			<label class="pink-text">Speialis</label>
	</div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="submit" id="simpantambah_dokter">Simpan
			<i class="mdi-content-send right"></i></button>
	</div>
</div>

<?php } ?>