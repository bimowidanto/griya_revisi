<?php
if(@$_POST['tgl_mulai']!=null && @$_POST['tgl_akhir']!=null){
?>
<?php
}else{
?>
<h5 class="blue-text">Report Kas Bulanan</h2>
		<div class="row"> 
			
		<div class="input-field col s5 left">
			<input  type="date" id="tgl_mulai" placeholder="Tanggal Mulai"> 
			<label class="active pink-text">Tanggal Mulai</label>
		</div>
		<div class="input-field col s5 right">
			<input  type="date" id="tgl_akhir" placeholder="Tanggal Akhir">
			<label class="active pink-text">Tanggal Akhir</label>
		</div>
		</div>
		<div class="row">
			<div class=" column col s3 center">
				<button class="btn waves-effect waves-light" type="submit" id="submit">Simpan
					<i class="mdi-content-send right"></i>
				</button>
			</div>
		</div>
<?php } ?>