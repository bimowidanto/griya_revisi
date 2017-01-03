<?php require'../connect.php';
$rs=mysql_query("select MAX(id_trans) from tbl_transaksi") or die(mysql_error());
$id_last=mysql_fetch_row($rs);
$id_pasien="";
$nama_pasien="";
$tgl_sekarang=date("Y-m-d");
$kode_duplicate="";
function buatRp($angka){
	$jadi = "Rp " . number_format($angka,2,',','.');
return $jadi;
}
?>
<h5 class="blue-text">Tambah Data Transaksi</h2>
<div class="row">

<div class="input-field col s5 left">
		<input  id="administrasi" type="number" placeholder="Biaya Administrasi" required>
		<label class="pink-text">Biaya Administrasi</label>
</div>
</diV>
<div class="row">
			<div class="column col s3 left">
			<h6 class="pink-text">Nama Item</h6>
			
		</div>
		
		<div class="column col s3 ">
			<h6 class="pink-text">Jumlah</h6>
		</div>		

		
		<div class="column col s3 ">
			<h6 class="pink-text">Jenis Pengobatan</h6>
		</div>
				<div class="column col s2 ">
			<h6 class="pink-text">Dokter</h6>
		</div>	
</div>
<div class="row">
		<div class="column col s3 left">
			<select class="browser-default waves-effect waves-light" id="kode_item">
				<option value="">- Pilih -</option>
				<?php require'../connect.php';
					try{
						$rs = mysql_query("SELECT tbl_obat.kode_item,tbl_obat.nama_item,tbl_obat.stok,tbl_barang_masuk.expired_date FROM tbl_barang_masuk JOIN tbl_obat
						ON tbl_obat.kode_item = tbl_barang_masuk.kode_item WHERE tbl_barang_masuk.expired_date > '$tgl_sekarang' AND
						tbl_obat.stok > 0 GROUP BY tbl_obat.nama_item")or die(mysql_error());
						/*$rs = mysql_query("SELECT tbl_obat.kode_item,tbl_obat.nama_item,tbl_obat.stok,tbl_barang_masuk.expired_date FROM tbl_barang_masuk JOIN tbl_obat
						ON tbl_obat.kode_item = tbl_barang_masuk.kode_item WHERE tbl_barang_masuk.expired_date > '$tgl_sekarang' AND
						tbl_obat.stok > 0 AND (SELECT MAX(tbl_barang_masuk.harga_jual)FROM tbl_barang_masuk) GROUP BY tbl_obat.nama_item")or die(mysql_error());*/
						while($data =mysql_fetch_assoc($rs)){
							if($kode_duplicate!=$data['kode_item']){
				?>
				<option value="<?php echo $data['kode_item']."=".$data['stok'];?>">
					<?php echo $data['nama_item']; ?></option>
				
				<?php }
								$kode_duplicate=$data['kode_item'];
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				?>
			</select>
			
	</div>
		<div class="column col s1">
		<input  id="jml" type="number" class="validate">
				</div>
			<div class="column col s2">
		<button  id="add_obat" type="submit" value="<?php echo $id_last[0];?>">Add</button>
				</div>
	

	
	<div class="column col s3">
			<select class="browser-default waves-effect waves-light" id="id_jasa">
				<option >- Pilih -</option>
				<?php require'../connect.php';
					try{
						$rs = mysql_query("SELECT * FROM tbl_jasa") or die(mysql_error());
						while($data =mysql_fetch_assoc($rs)){
				?>
				<option value="<?php echo $data['id_jasa']."=".$data['biaya'];?>">
					<?php echo $data['deskripsi']; ?></option>
				
				<?php
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				?>
			</select>
		</div>
		<div class="column col s2">
			<select class="browser-default waves-effect waves-light" id="id_dok">
				<option>- Pilih -</option>
				<?php require'../connect.php';
					try{
						$rs = mysql_query("SELECT * FROM tbl_dokter") or die(mysql_error());
						while($data =mysql_fetch_assoc($rs)){
				?>
				<option value="<?php echo $data['id_dokter'];?>">
					<?php echo $data['nama_dokter']; ?></option>
				
				<?php
						}
					}catch(exception $e){
						echo $e->getMessage();
					}
				?>
			</select>
	</div>
			<div class="column col s0 right">
		<button  id="add_jasa" type="submit" value="<?php echo $id_last[0];?>">Add</button>
				</div>
	</div>
	

<div class="row">
	<div clas="column col s6 left">
		<table class="striped col s6 left">
		<thead >
			<tr class="pink lighten-4">
				<th>Nama Obat</th>
				<th>Harga</th>
				<th>Jml</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php  require'../connect.php';
			$biayaObat=0;
			$jml=0;

			try{
			$rs=mysql_query("SELECT  kode_item ,jml_item from tbl_detail_transaksi WHERE id_trans ='$id_last[0]'")or die(mysql_error());
			while($data = mysql_fetch_assoc($rs)){
				$kode_item=$data['kode_item'];
				/*$result=mysql_query("select DISTINCT tbl_obat.nama_item,tbl_obat.stok,tbl_barang_masuk.harga_jual from tbl_obat,tbl_barang_masuk
				where tbl_barang_masuk.kode_item='$kode_item' AND tbl_obat.kode_item='$kode_item' limit 0,1");*/
				$result=mysql_query("select tbl_obat.nama_item,tbl_obat.stok,tbl_barang_masuk.harga_jual from tbl_obat,tbl_barang_masuk
				where tbl_barang_masuk.kode_item='$kode_item' AND tbl_obat.kode_item='$kode_item' ORDER BY tbl_barang_masuk.harga_jual DESC limit 1");
				while($temp=mysql_fetch_assoc($result)){
?>			<tr>
				<td><?php echo $temp['nama_item']?></td>
				<td align="right"><?php echo buatRp($temp['harga_jual']);?></td>
				<td class="col s4"><input type="number" value="<?php $jml=$data['jml_item']; echo $jml;?>" id="jml_obat"/></td>
			<td >
				<a class="hapus_obat btn-floating waves-effect green" id="<?php 
				echo $data['kode_item']."=".$jml."=".$temp['stok'];?>">Hapus</a></td>
			</tr>
				<?php
				$biayaObat+=$temp['harga_jual']*$jml;
						}
			}
					}catch(exception $e){
				$e->getMessage();
			}
				?>
		</tbody>
	</table>
</div>
	
		
<div clas="column col s6">
		<table class="striped col s6 right">
		<thead >
			<tr class="blue lighten-4">
				<th >Dokter</th>
				<th >Jenis Pengobatan</th>
				<th>Harga</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
<?php  require'../connect.php';
			$biayaJasa=0;
			try{
			$rs=mysql_query("SELECT id_jasa,id_dokter from tbl_detail_transaksi WHERE id_trans = '$id_last[0]'")or die(mysql_error());
			while($data = mysql_fetch_assoc($rs)){
				$id_jasa=$data['id_jasa'];
				$id_dokter=$data['id_dokter'];
				$result=mysql_query("select tbl_jasa.deskripsi,tbl_jasa.biaya,tbl_dokter.nama_dokter
				from tbl_jasa,tbl_dokter where tbl_jasa.id_jasa='$id_jasa' AND tbl_dokter.id_dokter='$id_dokter'");
				while($temp1=mysql_fetch_assoc($result)){
?>			<tr>
			<td><?php echo $temp1['nama_dokter']?></td>
				<td><?php echo $temp1['deskripsi']?></td>
				<td><?php echo buatRp($temp1['biaya']);?></td>
			<td >
				<a class="hapus_jasa btn-floating waves-effect green" id="<?php
				echo $data['id_jasa']."=".$data['id_dokter']."=".$temp1['biaya'];?>">Hapus</a></td>
			</tr>
				<?php
				$biayaJasa+=$temp1['biaya'];
						}
			}
					}catch(exception $e){
				$e->getMessage();
			}
				?>
		</tbody>
	</table>
	</div>
</div>
		
<div clas="row">
		<table class="striped">
		<thead >
			<tr class="green lighten-4">
				<th>Nama Pasien</th>
				<th>Biaya Administrasi</th>
				<th>Total Biaya Obat</th>
				<th>Total Biaya Jasa</th>
				<th>Total Bayar</th>
				<th>Batal Transaksi</th>
				<th class="center">Cetak Transaksi</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<?php 
				//$rs=mysql_query("SELECT id_pasien,nama_pasien FROM tbl_pasien ORDER BY id_pasien DESC limit 0,1")or die(mysql_error());
				$rs=mysql_query("SELECT tbl_pasien.nama_pasien,tbl_pasien.id_pasien,tbl_detail_transaksi.biaya_administrasi FROM tbl_transaksi
				JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien JOIN tbl_detail_transaksi ON tbl_detail_transaksi.id_trans=tbl_transaksi.id_trans
				WHERE tbl_transaksi.id_trans='$id_last[0]'")or die(mysql_error());
				$pasien=mysql_fetch_assoc($rs);
				$biaya_admin=$pasien['biaya_administrasi'];
				$biaya = $biayaJasa+$biayaObat;
				?>
				<td class="green"><b><?php echo $pasien['nama_pasien'];?></b></td>
				<td class="green"><b><?php echo buatRp($biaya_admin);?></b></td>
				<td class="green"><b><?php echo buatRp($biayaObat);?></b></td>
				<td class="green"><b><?php echo buatRp($biayaJasa);?></b></td>
				<td class="green"><b><?php echo buatRp(ceil($biayaJasa+$biayaObat+$biaya_admin));?></b></td>
				<td class="green center"><a class="batal_transaksi" id="<?php echo $pasien['id_pasien']."=".$id_last[0];?>">
					Batal</a></td>
				<td class="green center"><a id="<?php echo $pasien['id_pasien']."=".$biaya."=".$id_last[0]."=".(date("Y-m-d"));?> "
				class="transaksi_simpan  btn-floating waves-effect red" href="table/nota.php?biaya=<?php echo buatRp(ceil($biayaJasa+$biayaObat+$biaya_admin));?>&id=<?php echo $id_last[0];?>" target="_blank"><i class="mdi-action-print"></i></a>
				</td>
			</tr>
		</tbody>
	</table>
	</div>