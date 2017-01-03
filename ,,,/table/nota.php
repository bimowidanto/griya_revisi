<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title> GRIYA SEHAT NATURA </title>
<link href="img/icon.png" rel="icon" type="image/png">
</head>
<body onload="window.print();">

<form name="jform" method="post" action="">
<fieldset>
<table width="100%" border="0" style="border-collapse:collapse; margin-top:30px; font-size:12px">
<div>
<tr>
<td width="100%" align="center"><strong>INVOICE</strong><br><br><br><br></td>
</tr>
<tr>
<td colspan="2" align="justify">
<table style="font-size:12px" width="90%" align="center">
<?php
require'../connect.php';
$id = $_GET['id'];
$biaya = $_GET['biaya'];
$s_nama = mysql_query("select tbl_pasien.nama_pasien,tbl_user.fullname FROM tbl_transaksi JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien
JOIN tbl_user ON tbl_user.id_user=tbl_transaksi.id_user WHERE tbl_transaksi.id_trans='$id'");
$s_c = mysql_fetch_array($s_nama);
$nama_pasien = $s_c['nama_pasien'];
$nama_petugas = $s_c['fullname'];

$sql="select tbl_detail_transaksi.id_trans,tbl_transaksi.id_pasien,tbl_transaksi.id_user,tbl_transaksi.tgl_transaksi,tbl_obat.nama_item,tbl_jasa.deskripsi,tbl_detail_transaksi.total_biaya
from tbl_detail_transaksi JOIN tbl_transaksi ON tbl_transaksi.id_trans=tbl_detail_transaksi.id_trans JOIN tbl_obat ON tbl_obat.kode_item=tbl_detail_transaksi.kode_item
JOIN tbl_jasa ON tbl_jasa.id_jasa=tbl_detail_transaksi.id_jasa JOIN tbl_dokter ON tbl_dokter.id_dokter=tbl_detail_transaksi.id_dokter WHERE tbl_transaksi.id_trans='$id'";
$rs = mysql_query($sql) or die(mysql_error());

$s_obat = "SELECT tbl_obat.nama_item,tbl_detail_transaksi.kode_item FROM tbl_detail_transaksi JOIN tbl_obat ON tbl_detail_transaksi.kode_item=tbl_obat.kode_item
WHERE tbl_detail_transaksi.id_trans='$id'";
$res= mysql_query($s_obat) or die(mysql_error());

$s_jasa = "SELECT tbl_jasa.deskripsi,tbl_detail_transaksi.id_jasa FROM tbl_detail_transaksi JOIN tbl_jasa ON tbl_detail_transaksi.id_jasa=tbl_jasa.id_jasa
WHERE tbl_detail_transaksi.id_trans='$id'";
$res_jasa= mysql_query($s_jasa) or die(mysql_error());

$data = mysql_fetch_assoc($rs);
									
echo " 
<tr><td width='20%'>No. Transaksi</td><td>:</td><td>$data[id_trans]</td></tr>
<tr><td width='20%'>Tanggal Transaksi</td><td>:</td><td>$data[tgl_transaksi]</td></tr>
<tr><td width='20%'>Nama Pasien</td><td>:</td><td>$nama_pasien</td></tr>
<tr><td width='20%'>Deskripsi Jasa</td><td>:</td><td>";
while($data_jasa = mysql_fetch_assoc($res_jasa)){									
echo "-" .$data_jasa['deskripsi'];
echo "<br>";
}
echo
"</td></tr><br>
<tr><td width='20%'>Nama Item</td><td>:</td><td>";
while($data_item = mysql_fetch_assoc($res)){									
echo "-" .$data_item['nama_item'];
echo "<br>";
}
echo
"</td></tr><tr><td width='20%'>Total Biaya</td><td>:</td><td>$biaya</td></tr>";
?>
</table>
<br><br>
</td>
</tr>
<table style="font-size:12px" width="90%" align="center">
<tr>
<td>
<td>Terima Kasih Atas Kunjungan Anda.</td>
</td>
</tr>
</table>
<br><br><br>
<tr>
<td>
<table style="font-size:12px" width="90%" align="center">
<tr><td>Petugas,</td></tr>
<tr><td><br><br><br></td></tr>
<tr><td><u>_____________________________</u></td></tr>
<tr><td><b><?php echo $nama_petugas;?></b><br><br><br><br><br><br></td></tr>
</table>
</td>
</tr>
</table>
</div>
</fieldset>
</form>
</body>
</html>