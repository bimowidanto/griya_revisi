<table>
	<tr>
		<td><label class="pink-text">Tampilkan Jasa Bulan</label></td>
		<td><select id="bulan" class="browser-default waves-effect left">
				<option value="1" class="left">January</option>
				<option value="2" class="left">Fabruary</option>
				<option value="3" class="left">Maret</option>
				<option value="4" class="left">April</option>
				<option value="5" class="left">May</option>
				<option value="6" class="left">June</option>
				<option value="7" class="left">Jully</option>
				<option value="8" class="left">Agustus</option>
				<option value="9" class="left">September</option>
				<option value="10" class="left">Okctober</option>
				<option value="11" class="left">November</option>
				<option value="12" class="left">December</option>
			</select>
			</td>
			<td><label class="pink-text">Tahun</label></td>
			<td><select id="tahun" class="browser-default waves-effect left">
				<option value="2013" class="left">2013</option>
				<option value="2015" class="left">2015</option>
				<option value="2016" class="left">2016</option>
				</select>
			</td>
			<td><a class="caridetail btn-floating waves-effect black"><i class="mdi-action-search"></i></a>
			</td>
			<td>
				<label class="pink-text right">Total Jasa : 10</label><br>
				<label class="pink-text right">Total Penghasilan Rp.90.000</label>
			</td>
	</tr>
</table>
	<table class="col s12 striped">
		<thead >
			<tr class="brown lighten-2 centered">
				<th >Id-Jasa</th>
					<th>Deskripsi</th>
					<th>Biaya</th>
					<th>Tgl-Jasa</th>
					<th>Aksi</th>
				</tr>
		</thead>
		<tbody>
			<?php
			if(isset($_POST['id_dok'])){
			$id=@$_POST['id_dok'];
		  	//$nama=$_POST['nama'];
			$bulan="1";
			$tahun="2013";
			}else{
				$id="dok002";
				$bulan=$_POST['bulan'];
				$tahun=$_POST['tahun'];
			}
						/*if($bulan!=null && $tahun==null){
				$tahun="2015";
			
			}else if($tahun!=null && $bulan==null){
				$bulan="1";
			}else if($bulan==null && $tahun==null){
				$bulan="1"; $tahun="2015";
			}if($id==null){
				$id="dok002";
			}*/
			
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
		 $sql="SELECT tbl_jasa.id_jasa, tbl_jasa.deskripsi,tbl_jasa.biaya,
					tbl_transaksi.tgl_transaksi FROM tbl_jasa,tbl_transaksi
										WHERE tbl_jasa.id_dokter='$id' AND tbl_transaksi.id_dokter='$id'
										AND MONTH(tbl_transaksi.tgl_transaksi)='$bulan' AND 
										YEAR(tbl_transaksi.tgl_transaksi)='$tahun' '$limit'";	
				try{
					$rs =mysql_query($sql)  or die(mysql_error());
					while($data =mysql_fetch_assoc($rs)){
					?>
					<tr>
						<td><?php echo $data['id_jasa'];?></td>
						<td><?php echo $data['deskripsi'];?></td>
						<td><?php echo $data['biaya'];?></td>
						<td><?php echo $data['tgl_transaksi'];?></td>
						<td width="100px" align="center">
							<a class="edit_detail btn-floating waves-effect red"
							  id="<?php echo $data['id_dokter'];?>">
								<i class="mdi-editor-mode-edit"></i>
							</a>
							<a class="hapus_detail btn-floating waves-effect black" id="<?php echo $data['id_dokter'];?>">
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
				 <li class="waves-effect"><a class="halaman_dokter_detail" id="<?php echo $prev; ?>">
					 <i class="mdi-navigation-chevron-left"></i></a></li>
		<?php for($i=$page_saatini-4; $i<$page_saatini;$i++){
					if($i>0){?>
				<li class="waves-effect"><a class="halaman_dokter_detail" id="<?php echo $i; ?>"><?php echo $i; ?></a></li>
		
					<?php
					}
				}
			}
		?>
		<li class="disabled"><a><?php echo $page_saatini; ?></a></li>
			 <?php for($i=$page_saatini+1;$i<=$last;$i++){ ?>
		<li class="waves-effect"><a  class="halaman_dokter_detail" id="<?php echo $i;?>"><?php echo $i;?></a></li>
			<?php if($i>=($page_saatini+4)){
				break;
			}
			}
	if($page_saatini!=$last){
		$next=$page_saatini+1;?>
		<li class="waves-effect"><a  class="halaman_dokter_detail" id="<?php echo $next;?>"><i class="mdi-navigation-chevron-right"></i></a></li>
		<?php
	}
}?>
  </ul>
</div>