<table>
		<th><a class="waves-effect waves-light" id="tambah_pasien">Tambah Data - Pasien</a></th>
		<th><input type="search" placeholder="data yang ingin di cari" id="cari_pasien_value" required></th>
		<th class="right"><a class="btn-floating waves-effect" id="cari_pasien"><i class="mdi-action-search"></i></a></th>
	</table>
	<table class="striped">
		<thead >
			<tr class="blue lighten-2 centered">
				<th >Id Pasien</th>
				<th>Nama</th>
				<th>Jenis Kelamin</th>
				<th>No.tlp</th>
				<th>Alamat</th>
				<th>Aksi</th>
			</tr>
		</thead>
		<tbody>
		<?php
			require'../connect.php';
		 $rs= mysql_query("SELECT COUNT(id_pasien) FROM tbl_pasien") or die(mysql_error());
		  $row = mysql_fetch_row($rs);
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
			$sql="";
		if(@$_POST['cari_pasien']!=null || @$_POST['cari_pasien']!=""){
				$cari = @$_POST['cari_pasien'];
				 $sql="SELECT id_pasien,nama_pasien,alamat,no_telp,jenis_kelamin FROM tbl_pasien WHERE nama_pasien='$cari' $limit";
			}else{
		 $sql="SELECT id_pasien,nama_pasien,alamat,no_telp,jenis_kelamin FROM tbl_pasien ORDER BY id_pasien DESC $limit";
			}
			try{
				$rs = mysql_query($sql) or die(mysql_error());
				while($data =mysql_fetch_assoc($rs)){
		?>
					<tr>
						<td><?php echo $data['id_pasien'];?></td>
						<td><?php echo $data['nama_pasien'];?></td>
						<td><?php echo $data['jenis_kelamin'];?></td>
						<td><?php echo $data['no_telp'];?></td>
						<td><?php echo $data['alamat'];?></td>
						<td width="100px" align="center"><a class="edit_pasien btn-floating waves-effect orange"
							id="<?php echo $data['id_pasien']."=".$data['nama_pasien']."=".$data['no_telp']."=".$data['jenis_kelamin']
							."=".$data['alamat'];?>">
							<i class="mdi-editor-mode-edit"></i></a>
									
							<a class="hapus_pasien btn-floating waves-effect red" id="<?php echo $data['id_pasien'];?>">
							<i class="mdi-action-delete"></i></a>
						</td>
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
				 <li class="waves-effect"><a class="halaman_pasien" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i></a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){
		?>
				<li class="waves-effect"><a class="halaman_pasien" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_pasien" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_pasien" id="<?php echo $next;?>">
			<i class="mdi-navigation-chevron-right"></i></a></li>
			<?php
	}
}?>
  </ul>
</div>