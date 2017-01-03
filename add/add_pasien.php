<?php
if(@$_POST['id']!=null && @$_POST['nama']!=null){
	$id = @$_POST['id'];
	$nama = @$_POST['nama'];
	$jk = @$_POST['jk'];
	$alamat = @$_POST['alamat'];
	$tlp = @$_POST['tlp'];
?>
<html><head>
<style type="text/css">
/* label color */
   .input-field label {
     color: #000;
   }
   /* label focus color */
   .input-field input[type=text]:focus + label {
     color: #000;
   }
   /* valid color */
   .input-field input[type=text].valid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* invalid color */
   .input-field input[type=text].invalid {
     border-bottom: 1px solid #000;
     box-shadow: 0 1px 0 0 #000;
   }
   /* icon prefix focus color */
   .input-field .prefix.active {
     color: #000;
   }
</style>
	</head>
	<body>
	<h5 class="blue-text">Ubah Data Pasien</h2>
<div class="row"> 
	<div class="input-field col s5">
		<i class="mdi-action-lock prefix"></i>
		<input value="<?php echo $id; ?>" type="text" id="id" class="validate" readonly="" disabled>
		
		<label class="active pink-text" for="id">Id</label>
	</div>
</div>
<div class="row"> 
	<div class=" column input-field col s5">
		<i class="mdi-action-face-unlock prefix"></i>
		<input value="<?php echo $nama; ?>" type="text" id="nama" placeholder="nama pasien" required >
		<label class="active pink-text" for="nama">Nama</label>
	</div>
	<div class=" column input-field col s5 right">
		<i class="mdi-communication-phone prefix"></i>
		<input value="<?php echo $tlp; ?>" type="tel" id="tlp" placeholder="" class="validate" >
		<label class="active pink-text" for="tlp">Telephone</label>
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
		<i class="mdi-action-home prefix"></i>
        <textarea id="alamat" class="materialize-textarea"><?php echo $alamat; ?></textarea>
        <label for="alamat" class="active pink-text">Textarea</label>
    </div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="reset" id="batal">Batal
			<i class="#fb8c00 orange darken-1  material-icons small left">highlight_off</i></button>
	</div>
	<div class=" col s3">
		<button class="btn waves-effect waves-light" id="simpanedit_pasien">Simpan
		<i class="#fb8c00 orange darken-1 material-icons Small right">cloud_upload</i></button>
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
		<i class="mdi-action-lock prefix"></i>
		<input type="text" id="id" placeholder="id Pasien" value="<?php echo ($id[0]+1);?>" disabled="disabled"/>
		<label class="active pink-text" for="id">Id </label>
	</div>
</div>
<div class="row"> 
	<div class="input-field col s5">
		<i class="mdi-action-face-unlock prefix"></i>
		<input type="text" id="nama"/>
		<label class="pink-text" for="nama">Nama Pasien</label>
	</div>
	<div class="column input-field col s5 right">
		<i class="mdi-communication-phone prefix"></i>
		<input type="tel" id="tlp">
		<label class="pink-text" for="tlp">Telephone</label>
	</div>
</div>
<div class="row"> 
	<div class="column col s5 left">
		<i class="material-icons Small prefix">wc</i>
		<label class="pink-text">Jenis Kelamin</label>
		<select id="jk" class="browser-default">
			<option value="">- Pilih -</option>
			<option value="L">Laki-Laki</option>
			<option value="P">Perempuan</option>
		</select>
		
		
	</div>
	<div class="input-field col s5 right">
		<i class="mdi-action-home prefix"></i>
        <textarea id="alamat" class="materialize-textarea" ></textarea>
        <label for="alamat" class="pink-text">Alamat Tinggal</label>
    </div>
</div>
<div class="row">
	<div class="col s3">
		<button class="btn waves-effect waves-light orange" type="reset" id="batal">Batal
			<i class="mdi-content-remove-circle-outline left"></i></button>
	</div>
	<div class="col s3">
		<button class="btn waves-effect waves-light" type="submit" id="simpantambah_pasien">Simpan
			<i class="mdi-maps-rate-review right"></i></button>
	</div>
</div>
</body>
</html>
<?php } ?>