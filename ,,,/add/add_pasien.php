<?php
if(@$_POST['id']!=null && @$_POST['nama']!=null){
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
	$jk = @$_POST['jk'];
	$alamat = @$_POST['alamat'];
	$tlp = @$_POST['tlp'];
?>	
	<h5 class="blue-text">Ubah Data Pasien</h2>
<div class="row"> 
	<div class="input-field col s5">
		<input value="<?php echo $id; ?>" type="text" id="id" class="validate" readonly="" disabled>
		<label class="active pink-text">Id</label>
	</div>
</div>
<div class="row"> 
	<div class=" column input-field col s5">
		<input value="<?php echo $nama; ?>" type="text" id="nama" placeholder="nama pasien" required >
		<label class="active pink-text">Nama</label>
	</div>
	<div class=" column input-field col s5 right">
		<input value="<?php echo $tlp; ?>" type="text" id="tlp" placeholder="contact person" class="validate" >
		<label class="active pink-text">No.tlp</label>
	</div>
</div>
<div class="row"> 
	<div class="column col s5">
		<h6 class="pink-text">Jenis Kelamin</h6>
		<select class="browser-default waves-effect waves-light" id="jk">
			<option value="">- Pilih -</option>
			<option value="L"<?php if(strtoupper($jk)=="L"){echo"selected";}?>>Laki-Laki</option>
			<option value="P" <?php if(strtoupper($jk)=="P"){echo"selected";}?>>Perempuan</option>
		</select>
	</div>
	<div class="input-field col s5 right">
        <textarea id="alamat" class="materialize-textarea"><?php echo $alamat; ?></textarea>
        <label for="alamat" class="active pink-text">Textarea</label>
    </div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class=" col s3">
		<button class="btn waves-effect waves-light" id="simpanedit_pasien">Simpan
		<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php
}else{
require'../connect.php';
$data=mysql_query("select MAX(id_pasien) from tbl_pasien")or die(mysql_error());
$id=mysql_fetch_array($data);
?>
<h5 class="blue-text">Tambah Data Pasien</h2>
<div class="row"> 
	<div class="input-field col s5">
		<input type="text" id="id" placeholder="id Pasien" value="<?php echo ($id[0]+1);?>" disabled="disabled"/>
		<label class="active pink-text">Id </label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s5">
		<input type="text" id="nama" placeholder="nama Pasien"/>
		<label class="pink-text">Nama</label>
	</div>
	<div class="column input-field col s5 right">
		<input type="text" id="tlp" placeholder="contact person" required >
		<label class="pink-text">No.tlp</label>
	</div>
</div>
<div class="row"> 
	<div class="column col s5">
		<h6 class="pink-text">Jenis Kelamin</h6>
		<select class="browser-default waves-effect waves-light" id="jk">
			<option value="">- Pilih -</option>
			<option value="L">Laki-Laki</option>
			<option value="P">Perempuan</option>
		</select>
	</div>
	<div class="input-field col s5 right">
        <textarea id="alamat" class="materialize-textarea" placeholder="Alamat Tempat Tinggal"></textarea>
        <label for="alamat" class="pink-text">Textarea</label>
    </div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-send right"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="submit" id="simpantambah_pasien">Simpan
			<i class="mdi-content-send right"></i></button>
	</div>
</div>
<?php } ?>