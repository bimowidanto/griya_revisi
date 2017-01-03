
	<table>
		<th><a class="waves-effect waves-light" id="tambah_dokter">Tambah Data - Dokter</a></th>
	</table>
	<table class="col s12 border-2 highlight">
		<thead >
			<tr class="#00b8d4 cyan accent-4 centered">
				<th >Id</th>
					<th>Nama</th>
					<th>Spesialis</th>
					<th>Aksi</th>
				</tr>
		</thead>
		<tbody>
			<?php
				require'../connect.php';
		$rs= mysql_query("SELECT COUNT(id_dokter) FROM tbl_dokter") or die(mysql_error());
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
		 $sql="SELECT id_dokter,nama_dokter,spesialis FROM tbl_dokter ORDER BY id_dokter ASC $limit";
				try{
					$rs = mysql_query($sql) or die(mysql_error());
					while($data =mysql_fetch_assoc($rs)){
					?>
					<tr>
						<td><?php echo $data['id_dokter'];?></td>
						<td><?php echo $data['nama_dokter'];?></td>
						<td><?php echo $data['spesialis'];?></td>
						<td width="100px" align="center">
							<a class="edit btn-floating waves-effect red"
							  id="<?php echo $data['id_dokter']."=".$data['nama_dokter']."=".$data['spesialis'];?>">
								<i class="mdi-editor-mode-edit #f50057 pink accent-3"></i>
							</a>
									
							<a class="hapus btn-floating waves-effect black" id="<?php echo $data['id_dokter'];?>">
								<i class="mdi-action-delete #0277bd light-blue darken-3"></i>
							</a>
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
				 <li class="waves-effect"><a class="halaman_dokter" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i>
					 </a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){
		?>
				<li class="waves-effect"><a class="halaman_dokter" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_dokter" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_dokter" id="<?php echo $next;?>"><i class="mdi-navigation-chevron-right"></i></a></li>
			<?php
	}
}?>
  </ul>
</div>