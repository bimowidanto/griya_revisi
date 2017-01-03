
	<table>
		<th><a class="waves-effect waves-light" id="tambah_jasa">Tambah Data - Jasa</a></th>
		<th><input type="search" placeholder="data yang ingin di cari" required></th>
		<th class="right"><a class="btn-floating waves-effect" id="cari"><i class="mdi-action-search"></i></a></th>
	</table>
	<table class="col s12 striped">
		<thead >
			<tr class="brown lighten-2 centered">
				<th >Id Jasa</th>
					<th>Nama Jasa</th>
					<th>Biaya</th>
					<th>Aksi</th>
				</tr>
		</thead>
		<tbody>
<?php
			require'../connect.php';
		$rs= mysql_query("SELECT COUNT(id_jasa) FROM tbl_jasa") or die(mysql_error());
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
		 $sql="SELECT*FROM tbl_jasa ORDER BY id_jasa DESC $limit";
			
				try{
					$rs =mysql_query($sql)  or die(mysql_error());
					while($data =mysql_fetch_assoc($rs)){
					?>
					<tr>
						<td><?php echo $data['id_jasa'];?></td>
						<td><?php echo $data['deskripsi'];?></td>
						<td><?php echo $data['biaya'];?></td>
						<td width="100px" align="center">
							<a class="edit_jasa btn-floating waves-effect red"
							  id="<?php echo $data['id_jasa']."=".$data['deskripsi']."=".$data['biaya'];?>">
								<i class="mdi-editor-mode-edit"></i>
							</a>
									
							<a class="hapus_jasa btn-floating waves-effect black" id="<?php echo $data['id_jasa'];?>">
								<i class="mdi-action-delete"></i>
							</a>
						</td>
					</tr>
			<?php }
				}catch(exception $e){
					echo $e->getMessage();
				}			?>
		</tbody>
	</table>
		<div align="center"> 		  
	<ul class="pagination">
		<?php if($last!=1){
	if($page_saatini>1){
				$prev = $page_saatini-1;?>
				 <li class="waves-effect"><a class="halaman_jasa" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i></a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){?>
				<li class="waves-effect"><a class="halaman_jasa" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
		
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a ><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_jasa" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_jasa" id="<?php echo $next;?>"><i class="mdi-navigation-chevron-right"></i></a></li>
		<?php
	}
}?>
  </ul>
</div>