	<table>
		<th><a class="waves-effect waves-light" id="buat_report">Buat Report</a></th>
	</table>
	<table class="striped">
		<thead>
			<tr class="blue lighten-2 centered">
				<th>ID Transaksi</th>
				<th>Tanggal Transaksi</th>
				<th>Total Biaya</th>
			</tr>
		</thead>
		<tbody>
			<?php require'../connect.php'; 
			
$rs=mysql_query("select MAX(id) from tbl_history_report") or die(mysql_error());
$id_last=mysql_fetch_row($rs);

$s_tgl = mysql_query("select * FROM tbl_history_report WHERE id='$id_last[0]'") or die(mysql_error());
$q_res = mysql_fetch_assoc($s_tgl);
$tgl_mulai = $q_res['tgl_mulai'];
$tgl_akhir = $q_res['tgl_akhir'];

		  $result= mysql_query("SELECT COUNT(id_trans) FROM tbl_transaksi") or die(mysql_error());
		  $row = mysql_fetch_row($result);
		  $rows= $row[0];
		  $page_rows=10;
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
		 $sql="SELECT tbl_transaksi.id_trans,tbl_jasa.deskripsi, tbl_obat.kode_item,tbl_obat.nama_item, tbl_detail_transaksi.total_biaya, tbl_detail_transaksi.jml_item, tbl_transaksi.tgl_transaksi
FROM tbl_detail_transaksi JOIN tbl_obat ON tbl_obat.kode_item=tbl_detail_transaksi.kode_item JOIN tbl_jasa ON tbl_jasa.id_jasa=tbl_detail_transaksi.id_jasa JOIN tbl_transaksi ON
tbl_transaksi.id_trans=tbl_detail_transaksi.id_trans WHERE tbl_transaksi.tgl_transaksi BETWEEN '$tgl_mulai' AND '$tgl_akhir' ORDER BY tbl_transaksi.id_trans ASC $limit";	
				try{ 
					$rs_sql = mysql_query($sql) or die(mysql_error());
					$res_trans = mysql_fetch_assoc($rs_sql);
					while($data = mysql_fetch_assoc($rs_sql)){
			?>
			<tr>
			            <td><?php echo $data['id_trans'];?></td>
					    <td><?php echo $data['tgl_transaksi'];?></td>
						<td><?php echo $data['total_biaya'];?></td>
			</tr>
			<?php 
					}
			}catch(exception $e){
					echo $e->getMessage();
				}
			?>
			<tr>
			     <th class="right"><a class="btn-floating waves-effect" href="table/export_transaksi.php?id=<?php echo $res_trans['id_trans'];?>&tgl_mulai=<?php echo $tgl_mulai;?>&tgl_akhir=<?php echo $tgl_akhir;?>" target="_blank"><i class="mdi-action-print"></i></a></th>
			</tr>
		</tbody>
	</table>
<div align="center"> 		  
	<ul class="pagination">
		<?php if($last!=1){
	if($page_saatini>1){
				$prev = $page_saatini-1;?>
				 <li class="waves-effect"><a class="halaman_report" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i></a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){
		?>
				<li class="waves-effect"><a class="halaman_report" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_report" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_report" id="<?php echo $next;?>"><i class="mdi-navigation-chevron-right"></i></a></li>
			<?php
	}
}?>
  </ul>
</div>