<table border="1">
    <tr>
    	<th>NO.</th>
		<th>NAMA ITEM</th>
		<th>SATUAN</th>
		<th>STOK</th>
		<th>TANGGAL MASUK</th>
		<th>TANGGAL EXPIRED</th>
		<th>HARGA BELI</th>
		<th>NAMA SUPPLIER</th>
	</tr>
	<?php
	require'../connect.php';
error_reporting(0);

$sql_join = mysql_query("select tbl_obat.nama_item,tbl_obat.satuan,tbl_barang_masuk.stok,tbl_barang_masuk.tgl_masuk,tbl_barang_masuk.expired_date,
					tbl_barang_masuk.harga_beli,tbl_supplier.nama_supplier from tbl_barang_masuk join tbl_obat on tbl_obat.kode_item=tbl_barang_masuk.kode_item
					join tbl_supplier on tbl_supplier.id_supplier=tbl_barang_masuk.id_supplier");
	$no = 1;
	while($data = mysql_fetch_assoc($sql_join)){
		echo '
		<tr>
			<td>'.$no.'</td>
			<td>'.$data['nama_item'].'</td>
			<td>'.$data['satuan'].'</td>
			<td>'.$data['stok'].'</td>
			<td>'.$data['tgl_masuk'].'</td>
			<td>'.$data['expired_date'].'</td>
			<td>'.$data['harga_beli'].'</td>
			<td>'.$data['nama_supplier'].'</td>
		</tr>
		';
		$no++;
	}
	?>
</table>
