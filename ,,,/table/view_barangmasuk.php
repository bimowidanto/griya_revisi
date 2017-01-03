	<table>
		<th><a class="waves-effect waves-light" id="tambah_barangmasuk">Tambah Data - Barang Masuk</a></th>
		<th><input type="search" placeholder="data yang ingin di cari" id="cari_brgmasuk_value" required></th>
		<th class="right"><a class="btn-floating waves-effect" id="cari"><i class="mdi-action-search"></i></a></th>
		<th class="right"><a class="btn-floating waves-effect" href="table/export_barang.php" target="_blank"><i class="mdi-action-print"></i></a></th>
	</table>
	<table class="striped">
		<thead >
			<tr class="blue lighten-2 centered">
				<th >Id Barang</th>
				<th >Kode Item</th>
				<th >Nama Item</th>
				<th>Stok</th>
				<th>Expired</th>
				<th>Harga Beli</th>
				<th>Harga Jual</th>
				<th>Nama Supplier</th>
				<th>Tgl-Masuk</th>
				<th class="center">Aksi</th>
			</tr>
		</thead>
		<tbody>
			<?php require'../connect.php'; 
			$waktu=date("Y-m-d");
		 $rs= mysql_query("SELECT COUNT(id_barang) FROM tbl_barang_masuk") or die(mysql_error());
		  $row = mysql_fetch_row($rs);
		  $rows= $row[0];
		  $page_rows=10;
			function buatRp($angka){
				$jadi = "Rp " . number_format($angka,2,',','.');
				return $jadi;
			}
		  $last = ceil($rows/$page_rows);
		  if($last<1){
			  $last = 1;
		  }
			
		 /*if(isset($_GET['pagging'])){
			 $page_saatini = preg_replace('#[^0-9]#','',$_GET['pagging']);
		 }*/
			$page_saatini=1;
			if(isset($_POST['pagging'])){
				$page_saatini=$_POST['pagging'];
			}
		 if($page_saatini<1){
			 $page_saatini = 1;
		 }else if($page_saatini > $last){
			 $page_saatini = $last;
		 }
			
		 $limit = 'LIMIT '.($page_saatini-1)*$page_rows.','.$page_rows;
		 $sql="SELECT tbl_barang_masuk.id_barang,tbl_barang_masuk.kode_item,tbl_obat.nama_item,tbl_barang_masuk.stok,tbl_barang_masuk.expired_date,tbl_barang_masuk.harga_beli,tbl_barang_masuk.harga_jual,tbl_barang_masuk.id_supplier,tbl_supplier.nama_supplier,tbl_barang_masuk.tgl_masuk FROM tbl_barang_masuk
		 INNER JOIN tbl_obat ON tbl_barang_masuk.kode_item=tbl_obat.kode_item INNER JOIN tbl_supplier ON tbl_barang_masuk.id_supplier=tbl_supplier.id_supplier ORDER BY tbl_barang_masuk.id_barang ASC $limit";
				
				try{ 
					$rs = mysql_query($sql) or die(mysql_error());
					while($data = mysql_fetch_assoc($rs)){
						if($data['expired_date']<=$waktu){
							?>
							<tr class="red">
				<td ><?php echo $data['id_barang']; ?></td>
				<td ><?php echo $data['kode_item']; ?></td>
				<td ><?php echo $data['nama_item']; ?></td>
				<td ><?php echo $data['stok']; ?></td>
				<td ><?php echo $data['expired_date']; ?></td>
				<td><?php echo buatRp($data['harga_beli']); ?></td>
				<td><?php echo buatRp($data['harga_jual']); ?></td>
				<td ><?php echo $data['nama_supplier']; ?></td>
				<td ><?php echo $data['tgl_masuk']; ?></td>
				<td width="100px" class="center">
					<a class="edit_barangmasuk btn-floating waves-effect black"
					 	id="<?php echo $data['id_barang']."=".$data['kode_item']."=".$data['stok']."="
						.$data['expired_date']."="
						.$data['harga_beli']."=".$data['harga_jual']."=".$data['id_supplier'] ?>"><i class="mdi-editor-mode-edit"></i></a>
					<a class=" btn-floating waves-effect black" disabled="disabled">
						<i class="mdi-action-delete"></i></a>
				</td>
			</tr>
			<?php
						}else{
			?>
			<tr >
				<td ><?php echo $data['id_barang']; ?></td>
				<td><?php echo $data['kode_item']; ?></td>
				<td ><?php echo $data['nama_item']; ?></td>
				<td><?php echo $data['stok']; ?></td>
				<td><?php echo $data['expired_date']; ?></td>
				<td><?php echo buatRp($data['harga_beli']); ?></td>
				<td><?php echo buatRp($data['harga_jual']); ?></td>
				<td><?php echo $data['nama_supplier']; ?></td>
				<td><?php echo $data['tgl_masuk']; ?></td>
				<td width="100px" class="center">
					<a class="edit_barangmasuk btn-floating waves-effect red"
					 	id="<?php echo $data['id_barang']."=".$data['kode_item']."=".$data['stok']."="
						.$data['expired_date']."="
						.$data['harga_beli']."=".$data['harga_jual']."=".$data['id_supplier'] ?>"><i class="mdi-editor-mode-edit">
						</i></a>
					<a class="hapus_barangmasuk btn-floating waves-effect" id="<?php echo $data['id_barang']."=".
						$data['kode_item']."=".$data['stok'];?>">
						<i class="mdi-action-delete"></i></a>
				</td>
			</tr>
			<?php 
						}
					}
				}catch(exception $e){
					echo $e->getMessage();
				}
			?>
		</tbody>
	</table>
	<div align="center"> 		  
	<ul class="pagination">
		<?php if($last!=1){
	if($page_saatini>1){
				$prev = $page_saatini-1;
		?>
				 <li class="waves-effect"><a class="halaman_brg_masuk" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i>
					 </a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){
		?>
				<li class="waves-effect"><a class="halaman_brg_masuk" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){
		?>
		<li class="waves-effect"><a  class="halaman_brg_masuk" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;
		?>
		<li class="waves-effect"><a  class="halaman_brg_masuk" id="<?php echo $next;?>">
			<i class="mdi-navigation-chevron-right"></i></a></li>
			<?php
	}
}
		?>
  </ul>
</div>