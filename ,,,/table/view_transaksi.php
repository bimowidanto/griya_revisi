
	<table>
		<th><a class="waves-effect waves-light" id="tambah_transaksi">Tambah Data - Transaksi</a></th>
		<th><input type="search" placeholder="data yang ingin di cari" required></th>
		<th class="right"><a class="btn-floating waves-effect" id="cari"><i class="mdi-action-search"></i></a></th>
	</table>
	<table class="striped">
		<thead >
			<tr class="blue lighten-2 centered">
				<th>Id Transaksi</th>
				<th>Pasien</th>
				<th>Dokter</th>
				<th>Biaya Transaksi</th>
				<th>Petugas</th>
				<th>Tgl-Transaksi</th>
				<th>Print</th>
			</tr>
		</thead>
		<tbody>
			<?php require'../connect.php';
			$rs= mysql_query("SELECT COUNT(id_trans) FROM tbl_transaksi") or die(mysql_error());
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
		 $sql="SELECT tbl_transaksi.id_trans,tbl_pasien.nama_pasien,tbl_pasien.id_pasien,tbl_user.fullname,tbl_transaksi.tgl_transaksi FROM tbl_transaksi 
		 JOIN tbl_pasien ON tbl_pasien.id_pasien=tbl_transaksi.id_pasien JOIN tbl_user ON tbl_user.id_user=tbl_transaksi.id_user ORDER BY tbl_transaksi.id_trans DESC $limit";
			try{
					$rs = mysql_query($sql) or die(mysql_error());
					while($data =mysql_fetch_assoc($rs)){
						$id_trans=$data['id_trans'];
						$temp=mysql_query("SELECT total_biaya,id_dokter FROM tbl_detail_transaksi WHERE id_trans='$id_trans'");
						$total=0;
						$id_dokter="";
						$id_pasien=$data['id_pasien'];
						while($data2=mysql_fetch_assoc($temp)){
							$total+=$data2['total_biaya'];
							$id_dokter=$data2['id_dokter'];
						}
						
						$temp=mysql_query("SELECT tbl_dokter.nama_dokter,tbl_pasien.nama_pasien 
						FROM tbl_pasien,tbl_dokter WHERE tbl_pasien.id_pasien='$id_pasien'
						AND tbl_dokter.id_dokter='$id_dokter'");
						$data2=mysql_fetch_assoc($temp);
						
						$s_sum=mysql_query("SELECT SUM(total_biaya) AS value,biaya_administrasi FROM tbl_detail_transaksi WHERE id_trans='$id_trans'");
						$r_sum = mysql_fetch_assoc($s_sum);
						$sum =  "Rp " . number_format(($r_sum['value']+$r_sum['biaya_administrasi']),2,',','.');
					?>
					<tr>
						<td><?php echo $data['id_trans'];?></td>
						<td><?php echo $data['nama_pasien'];?></td>
						<td><?php echo $data2['nama_dokter'];?></td>
						<td><?php echo $sum;?></td>
						<td><?php echo $data['fullname'];?></td>
						<td><?php echo $data['tgl_transaksi'];?></td>
						<td><a class="print_transaksi btn-floating waves-effect green" href="table/nota.php?biaya=<?php echo $sum;?>&id=<?php echo $data['id_trans'];?>" target="_blank">
							<i class="mdi-action-print"></i></a></td>
					</tr>
			<?php }
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
				$prev = $page_saatini-1;?>
				 <li class="waves-effect"><a class="halaman_transaksi" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i> </a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){?>
				<li class="waves-effect"><a class="halaman_transaksi" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_transaksi" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_transaksi" id="<?php echo $next;?>">
			<i class="mdi-navigation-chevron-right"></i></a></li>
			<?php
	}
}?>
  </ul>
</div>