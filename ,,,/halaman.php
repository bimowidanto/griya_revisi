<?php
include('session.php');
?>
<html>
<head>
	<link rel="stylesheet" href='matrializer/css/materialize.css'/>
		<script type="text/javascript" src="matrializer/js/jquery1.js"></script>
	<script type="text/javascript" src="matrializer/js/materialize.js"></script>
	<script type="text/javascript" src="matrializer/js/materialize.min.js"></script>
</head>
<body >

	<?php include'page_control.php';?>
	<div class="row">
		<div id="control" class="column col s3">
        <!-- Grey navigation panel -->
			<ul class="collection">
				<a id="barangmasuk" class="collection-item">Data Barang-Masuk</a>
        		<a id="dokter" class="collection-item">Data Dokter</li>
        		<a id="medicine" class="collection-item">Data Obat</a>
				<a id="pasien" class="collection-item">Data Pasien</a>
				<a id="supplier" class="collection-item">Data Supplier</a>
				<a id="transaksi" class="collection-item">Data Transaksi</a>
				<a id="jasa" class="collection-item">Data Jasa</a>
				<a id="report" class="collection-item">Report</a>
				
      		</ul>
	  		<ul id="nav-mobile" class="side-nav">
				<a href="./">Back Home</a>
				<a href="">Data Supplier</a>
				<a href="">Data Medicine</a>
	 		</ul>
      </div>
	   <div class="column col s8">
			    <b id="welcome">Welcome : <i><?php echo $login_session; ?></i></b>
                <b id="logout"><a href="logout.php">Log Out</a></b>
	   </div>
	  <div class="column col s8">
		<div id="cruddata" class="row">inii halaman crud</div>
		<div id="viewdata" class="row"></div>
		  <div id="cari" class="row"></div>
      </div>
	</div>
	<script type="text/javascript">
			$("#control").on("click","#transaksi",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_transaksi.php");
		});
		
		//############################################################################
		// event untuk report
		$("#control").on("click","#report",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_report.php");
		});
		//############################################################################
		//event untukjasa
		$("#control").on("click","#jasa",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_jasa.php");
		});
		
		$("#viewdata").on("click","#tambah_jasa",function(){
					$.ajax({
					url:'add/add_jasa.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		/*$("#cruddata").on("keypress","#biaya",function(){
			$("#biaya").val("hahha");
		});*/
		$("#cruddata").on("click","#simpantambah_jasa",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			var biaya=$("#biaya").val();
			alert(biaya);
			$.ajax({
				url:'service/service_jasa.php?page=tambah_jasa',
				type:'post',
				data:'id='+id+'&nama='+nama+'&biaya='+biaya,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_jasa.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});
		
		
		$("#viewdata").on("click",".edit_jasa",function(){
			var data1 =$(this).attr('id').split('=');
				$.ajax({
					url:'add/add_jasa.php',
					type:'post',
					data:'id='+data1[0]+'&nama='+data1[1]+'&biaya='+data1[2],
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#viewdata").on("click",".hapus_jasa",function(){
			var id = $(this).attr("id");
			$.ajax({
				url:'service/service_jasa.php?page=hapus_jasa',
				type:'post',
				data:'id='+id,
				success:function(msg){
					if(msg=='sukses'){
						$("#viewdata").load("table/view_jasa.php");
						alert("okeee");
					}else{
						alert("Gagal Menghapus Data");
					}
				}	
			});
		});
		
		
		//event untuk barang masuk
		$("#control").on("click","#barangmasuk",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_barangmasuk.php");
		});
		
		$("#viewdata").on("click","#cari",function(){
			var cari = $("#cari_brgmasuk").val();
		});
		
		$("#viewdata").on("click",".edit_barangmasuk",function(){
			var data = $(this).attr("id").split('=');
			alert(data[0]+" "+data[1]+" "+data[2]+" "+data[3]+" "+data[4]+" "+data[5]+" "+data[6]);
					$.ajax({
					url:'add/add_barangmasuk.php',
					type:'post',
					data:'id_barang='+data[0]+'&kode_item='+data[1]+'&stok='+data[2]+'&expired_date='+data[3]
						+'&harga_beli='+data[4]+'&harga_jual='+data[5]+'&id_supplier='+data[6],
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#viewdata").on("click","#tambah_barangmasuk",function(){
					$.ajax({
					url:'add/add_barangmasuk.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
					});
		});
		
		$("#cruddata").on("click","#simpantambah_barangmasuk",function(){
			var id_suplier = $("#id_supplier").val();
			var kode = $("#kode_item").val();
			var expired = $("#expired").val();
			var harga = $("#harga").val();
			var harga_jual = $("#harga_jual").val();
			var stock = $("#stok").val();
			var tgl_masuk = $("#tgl_masuk").val();
			alert(id_suplier+" "+kode+" "+expired+" "+harga+" "+" "+tgl_masuk+" "+stock+" "+harga_jual);
					$.ajax({
					url:'service/service_barangmasuk.php?page=tambah_data',
					type:'post',
					data:'id_supplier='+id_suplier+'&kode_item='+kode+'&expired='+expired+
						"&harga="+harga+"&harga_jual="+harga_jual+"&stok="+stock+"&tgl_masuk="+tgl_masuk,
					success:function(msg){
						if(msg == 'sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_barangmasuk.php");
					}else{
						alert("gagal menambah data "+msg);
					}
					}
					});
		});
		$("#cruddata").on("click","#simpanedit_barangmasuk",function(){
			var id_suplier = $("#id_supplier").val();
			var kode = $("#kode_item").val();
			var expired = $("#expired").val();
			var harga = $("#harga").val();
			var harga_jual = $("#harga_jual").val();
			var stock = $("#stok").val();
			var id_barang = $("#id_barang").val();
			var tgl_masuk = $("#tgl_masuk").val();
			alert(id_suplier+" "+kode+" "+expired+" "+harga+" "+" "+tgl_masuk+" "+stock+" "+harga_jual);
					$.ajax({
					url:'service/service_barangmasuk.php?page=ubah_data',
					type:'post',
					data:'id_barang='+id_barang+'&id_supplier='+id_suplier+'&kode_item='+kode+'&expired='+expired+
						"&harga="+harga+"&harga_jual="+harga_jual+"&stok="+stock+"&tgl_masuk="+tgl_masuk,
					success:function(msg){
						if(msg == 'sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_barangmasuk.php");
					}else{
						alert("gagal edit data "+msg);
					}
					}
					});
		});
		
		
			
		$("#viewdata").on("click",".hapus_barangmasuk",function(){
			var data = $(this).attr("id").split('=');
			alert(data[0]+" "+data[1]+" "+data[2]);
					$.ajax({
					url:'service/service_barangmasuk.php?page=hapus_data',
					type:'post',
					data:'id_barang='+data[0]+'&kode_item='+data[1]+'&stok='+data[2],
					success:function(msg){
						if(msg=='sukses'){
						$("#viewdata").load("table/view_barangmasuk.php");
						}else{
							alert("gagal menghapus data");
						}
					}
				});
		});
		//###############################################################################
		//event untuk obat
		
		$("#control").on("click","#medicine",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_obat.php");
		});
		
		$("#viewdata").on("click","#cari_obat",function(){
			var cari = $("#cari_obat_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_obat.php',
					type:'post',
					data:'cari_obat='+cari,
					success:function(msg){
						$("#cari").fadeIn(1000).html(msg);
						$("#viewdata").hide();
					}
			});
		});
		
		$("#cari").on("click","#cari_obat",function(){
			var cari = $("#cari_obat_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_obat.php',
					type:'post',
					data:'cari_obat='+cari,
					success:function(msg){
						$("#viewdata").fadeIn(1000).html(msg);
						$("#cari").hide();
					}
			});
		});
		
		$("#viewdata").on("click","#tambah_obat",function(){
					$.ajax({
					url:'add/add_obat.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#viewdata").on("click",".edit_obat",function(){
			var data = $(this).attr("id").split('=');
			alert(data[0]+" "+data[1]+" "+data[2]+" "+data[3]+" "+data[4]+" "+data[5]);
			$.ajax({
				url:'add/add_obat.php',
				type:'post',
				data:'kode_item='+data[0]+'&nama_item='+data[1]+'&kategori='+data[2]+'&barcode='+data[3]+'&merk='+data[4]
				+'&satuan='+data[5],
				success:function(msg){
					$("#cruddata").fadeIn(1000).html(msg);
				}
			});
			
		})
		
			$("#cruddata").on("click","#simpantambah_obat",function(){
			var kode=$("#kode_item").val();
			var nama=$("#nama_item").val();
			var satuan=$("#satuan").val();
			var kategori =$("#kategori").val();
					alert(kode+" "+nama+" "+kategori+" "+satuan);
			$.ajax({
				url:'service/service_obat.php?page=tambah_obat',
				type:'post',
				data:'kode_item='+kode+'&nama_item='+nama+'&kategori='+kategori+'&satuan='+satuan,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_obat.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});
	
		
		$("#cruddata").on("click","#simpanedit_obat",function(){
			var kode=$("#kode_item").val();
			var nama=$("#nama_item").val();
			var satuan=$("#satuan").val();
			var kategori =$("#kategori").val();
					alert(kode+" "+nama+" "+satuan+" "+kategori);
			$.ajax({
				url:'service/service_obat.php?page=ubah_obat',
				type:'post',
				data:'kode_item='+kode+'&nama_item='+nama+'&kategori='+kategori+'&satuan='+satuan,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_obat.php");												
					}else{
						alert("Gagal Mengubah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click",".hapus_obat",function(){
			var id = $(this).attr("id");
			$.ajax({
				url:'service/service_obat.php?page=hapus_obat',
				type:'post',
				data:'kode_item='+id,
				success:function(msg){
					if(msg=='sukses'){
						$("#viewdata").load("table/view_obat.php");
						alert("okeee");
					}else{
						alert("Gagal Menghapus Data");
					}
				}	
			});
		});
		//################################################################################
		//event untuk supplier
		$("#control").on("click","#supplier",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_supplier.php");
		});
	
		$("#viewdata").on("click","#cari_sup",function(){
			var cari = $("#cari_sup_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_supplier.php',
					type:'post',
					data:'cari_sup='+cari,
					success:function(msg){
						$("#cari").fadeIn(1000).html(msg);
						$("#viewdata").hide();
					}
			});
		});
		
		$("#cari").on("click","#cari_sup",function(){
			var cari = $("#cari_sup_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_supplier.php',
					type:'post',
					data:'cari_sup='+cari,
					success:function(msg){
						$("#viewdata").fadeIn(1000).html(msg);
						$("#cari").hide();
					}
			});
		});
		
		$("#viewdata").on("click","#tambah_supplier",function(){
					$.ajax({
					url:'add/add_supplier.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		
		
		$("#cruddata").on("click","#simpantambah_supplier",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			$.ajax({
				url:'service/service_supplier.php?page=tambah_supplier',
				type:'post',
				data:'id='+id+'&nama='+nama,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_supplier.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click",".edit_supplier",function(){
			var data1 =$(this).attr('id').split('=');
				$.ajax({
					url:'add/add_supplier.php',
					type:'post',
					data:'id='+data1[0]+'&nama='+data1[1],
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#cruddata").on("click","#simpanedit_supplier",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			$.ajax({
				url:'service/service_supplier.php?page=ubah_supplier',
				type:'post',
				data:'id='+id+'&nama='+nama,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_supplier.php");												
					}else{
						alert("Gagal Mengubah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click",".hapus_supplier",function(){
			var id = $(this).attr("id");
			$.ajax({
				url:'service/service_supplier.php?page=hapus_supplier',
				type:'post',
				data:'id='+id,
				success:function(msg){
					if(msg=='sukses'){
						$("#viewdata").load("table/view_supplier.php");
						alert("okeee");
					}else{
						alert("Gagal Menghapus Data");
					}
				}	
			});
		});
		
		//########################################################################################
		//event untuk dokter
		$("#control").on("click","#dokter",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_dokter.php");
		});
		
	 $("#viewdata").on("click","#tambah_dokter",function(){
					$.ajax({
					url:'add/add_dokter.php',
					type:'post',
					data:'id='+''+'&nama='+''+'&spesialis='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#cruddata").on("click","#simpantambah_dokter",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			var spesialis=$("#spesialis").val();
			$.ajax({
				url:'service/service_dokter.php?page=tambah_dokter',
				type:'post',
				data:'id='+id+'&nama='+nama+'&spesialis='+spesialis,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_dokter.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});
	
		$("#viewdata").on("click",".edit",function(){
			var data =$(this).attr('id').split('=');
				$.ajax({
					url:'add/add_dokter.php',
					type:'post',
					data:'id='+data[0]+'&nama='+data[1]+'&spesialis='+data[2],
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#cruddata").on("click","#simpanedit_dokter",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			var spesialis=$("#spesialis").val();
			$.ajax({
				url:'service/service_dokter.php?page=ubah_dokter',
				type:'post',
				data:'id='+id+'&nama='+nama+'&spesialis='+spesialis,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_dokter.php");												
					}else{
						alert("Gagal Mengubah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click",".hapus",function(){
			var id = $(this).attr("id");
			$.ajax({
				url:'service/service_dokter.php?page=hapus_dokter',
				type:'post',
				data:'id='+id,
				success:function(msg){
					if(msg=='sukses'){
						$("#viewdata").load("table/view_dokter.php");
						alert("okeee");
					}else{
						alert("Gagal Menghapus Data");
					}
				}	
			});
		});
		//########################################################################################
		
		
		//pagging
		$("#cruddata").on("click","#batal",function(){
			$("#cruddata").hide();
		});
		
		$("#viewdata").on("click",".halaman_obat",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_obat.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		$("#viewdata").on("click",".halaman_report",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_report.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		
			$("#viewdata").on("click",".halaman_dokter",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_dokter.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		
		$("#viewdata").on("click",".halaman_supplier",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_supplier.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		$("#viewdata").on("click",".halaman_brg_masuk",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_barangmasuk.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
			$("#viewdata").on("click",".halaman_transaksi",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_transaksi.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
			$("#viewdata").on("click",".halaman_dokter_detail",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_supplier.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		$("#viewdata").on("click",".halaman_pasien",function(){
			var i = $(this).attr("id");
			alert(i);
			$.ajax({
				url:'table/view_pasien.php',
				type:'post',
				data:'pagging='+i,
				success:function(msg){
					$("#viewdata").fadeIn(100).html(msg);
				}
			});
		});
		
		//############################################################################
// event untuk transaksi
		$("#control").on("click","#transaksi",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_transaksi.php");
		});
		
		$("#viewdata").on("click","#tambah_transaksi",function(){
					$.ajax({
					url:'add/add_transaksi_awal.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});


		$("#cruddata").on("click","#add_obat",function(){
			var kode_item=$("#kode_item").val().split("=");
			var id_last =$("#add_obat").val();
			var jml=$("#jml").val();
			var administrasi=$("#administrasi").val();
			
			if((kode_item[1]-jml)>=0 && id_last!=null && kode_item[0]!=null){
			alert(kode_item[0]+" "+kode_item[1]+" "+id_last+" "+jml+" "+administrasi);
			$.ajax({
				url:'service/service_transaksi.php?page=insert_obat',
				type:'post',
				data:'kode_item='+kode_item[0]+'&stok='+kode_item[1]+'&last_id='+id_last+'&jml='+jml+'&administrasi='+administrasi,
				success:function(msg){
				if(msg=="sukses"){
					$("#cruddata").load("add/add_transaksi.php");
				}else{
					alert("gagal menambah data "+msg);
				}
			}
			});
				
			}
			
		});
		
		
		
		$("#cruddata").on("click",".hapus_obat",function(){
			var data = $(this).attr("id").split("=");
			var id_last =$("#add_obat").val();
			alert(data[0]+" "+data[1]+" "+data[2]+" "+id_last);
			if(data[0]!=null && data[1]!=null && data[2]!=null &&id_last!=null){
			$.ajax({
				url:'service/service_transaksi.php?page=hapus_obat',
				type:'post',
				data:'kode_item='+data[0]+'&jml='+data[1]+'&stok='+data[2]+'&last_id='+id_last,
				success:function(msg){
					if(msg=="sukses"){
					$("#cruddata").load("add/add_transaksi.php");
					}else{
						alert("gagal menghapus data "+msg);
					}
				}
			});
			}			
		});
		
			$("#cruddata").on("click","#transaksi_simpan",function(){
			var kode=$(this).attr("id").split("=");
			var id_last=$("#id_last").val();
			var biaya=$("#biaya").val();
			alert(kode[0]+" "+kode[1]+" "+id_last+" "+biaya);
			/*$.ajax({
				url:'service/service_transaksi.php?page=tambah_transaksi',
				type:'post',
				data:'id_pasien='+kode[0]+'&tgl='+kode[1],
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_transaksi.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});*/
		});
	

			$("#cruddata").on("click","#add_jasa",function(){
			var id_jasa=$("#id_jasa").val().split("=");
			var id_last =$("#add_jasa").val();
			var id_dokter=$("#id_dok").val();
			var administrasi=$("#administrasi").val();
			alert(id_jasa[0]+" "+id_jasa[1]+" "+id_last+" "+id_dokter);
				if(id_jasa[0]!=null && id_last!=null && id_dokter!=null&&id_jasa[1]!=null){
					$.ajax({
						url:'service/service_transaksi.php?page=insert_jasa',
						type:'post',
						data:'id_jasa='+id_jasa[0]+'&last_id='+id_last+'&id_dokter='+id_dokter+'&biaya='+id_jasa[1]+'&administrasi='+administrasi,
						success:function(msg){
						if(msg=="sukses"){
							$("#cruddata").load("add/add_transaksi.php");
						}else{
							alert("gagal menambah data "+msg);
						}
						}
					});
				}
		});
		
		
		$("#cruddata").on("click",".hapus_jasa",function(){
			var data = $(this).attr("id").split("=");
			var id_last =$("#add_jasa").val();
			alert(data[0]+" "+data[1]+" "+id_last);
			if(data[0]!=null && data[1]!=null&&id_last!=null&&data[2]!=null){
			$.ajax({
				url:'service/service_transaksi.php?page=hapus_jasa',
				type:'post',
				data:'id_jasa='+data[0]+'&id_dokter='+data[1]+'&last_id='+id_last+"&biaya="+data[2],
				success:function(msg){
					if(msg=="sukses"){
					$("#cruddata").load("add/add_transaksi.php");
					}else{
						alert("gagal menghapus data "+msg);
					}
				}
			});
			}			
		});
		
		$("#cruddata").on("click",".batal_transaksi",function(){
			var data = $(this).attr("id").split("=");
				alert(data[0]+" "+data[1]);
			if(data[0]!=null && data[1]!=null){
			$.ajax({
				url:'service/service_transaksi.php?page=batal',
				type:'post',
				data:'id_pasien='+data[0]+'&id_trans='+data[1],
				success:function(msg){
					$("#cruddata").hide();
				}
			});
			}			
		});
		
		
		// end event transaksi
		
		///#####################################################################################
		//event pasien
		$("#control").on("click","#pasien",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_pasien.php");
		});
		
		
			$("#viewdata").on("click","#cari_pasien",function(){
			var cari = $("#cari_pasien_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_pasien.php',
					type:'post',
					data:'cari_pasien='+cari,
					success:function(msg){
						$("#cari").fadeIn(1000).html(msg);
						$("#viewdata").hide();
					}
			});
		});
		
		$("#cari").on("click","#cari_pasien",function(){
			var cari = $("#cari_pasien_value").val();
			alert(cari);
			$.ajax({
				url:'table/view_pasien.php',
					type:'post',
					data:'cari_pasien='+cari,
					success:function(msg){
						$("#viewdata").fadeIn(1000).html(msg);
						$("#cari").hide();
					}
			});
		});
	 $("#viewdata").on("click","#tambah_pasien",function(){
					$.ajax({
					url:'add/add_pasien.php',
					type:'post',
					data:'id='+''+'&nama='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#cruddata").on("click","#simpantambah_pasien",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			var jk=$("#jk").val();
			var alamat=$("#alamat").val();
			var tlp = $("#tlp").val();
			alert(id+" "+nama+" "+tlp+" "+alamat+" "+jk);
			$.ajax({
				url:'service/service_pasien.php?page=tambah_pasien',
				type:'post',
				data:'nama='+nama+'&jk='+jk+'&tlp='+tlp+'&alamat='+alamat,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_pasien.php");
					}else{
						alert("Gagal Menambah Data");
					}
				}
			});
		});
	
		$("#viewdata").on("click",".edit_pasien",function(){
			var data =$(this).attr('id').split('=');
			alert(data[0]+" "+data[1]+" "+data[2]+" "+data[3]+" "+data[4]);
				$.ajax({
					url:'add/add_pasien.php',
					type:'post',
					data:'id='+data[0]+'&nama='+data[1]+'&tlp='+data[2]+'&jk='+data[3]+'&alamat='+data[4],
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		
		$("#cruddata").on("click","#simpanedit_pasien",function(){
			var id =$("#id").val();
			var nama=$("#nama").val();
			var jk=$("#jk").val();
			var alamat=$("#alamat").val();
			var tlp = $("#tlp").val();
			alert(id+" "+nama+" "+tlp+" "+alamat+" "+jk);
			$.ajax({
				url:'service/service_pasien.php?page=ubah_pasien',
				type:'post',
				data:'id='+id+'&nama='+nama+'&jk='+jk+'&tlp='+tlp+'&alamat='+alamat,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_pasien.php");												
					}else{
						alert("Gagal Mengubah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click",".hapus_pasien",function(){
			var id = $(this).attr("id");
			$.ajax({
				url:'service/service_pasien.php?page=hapus_pasien',
				type:'post',
				data:'id='+id,
				success:function(msg){
					if(msg=='sukses'){
						$("#viewdata").load("table/view_pasien.php");
						alert("okeee");
					}else{
						alert("Gagal Menghapus Data");
					}
				}	
			});
		});
		
		// event untuk transaksi awal
		
		$("#control").on("click","#transaksi_pembayaran",function(){
			$("#cruddata").hide();
			$("#viewdata").load("add/add_transaksi_awal.php");
		});
		
	
		$("#cruddata").on("click","#simpantambah_transaksi_pasien",function(){
			var id_transaksi=$("#id_transaksi").val();
			var id_pasien =$("#id_pasien").val();
			var id_user=$("#id_user").val();
			var tgl_transaksi=$("#tgl_transaksi").val();
			alert(id_pasien+" "+id_user+" "+tgl_transaksi);
			$.ajax({
				url:'service/service_transaksi_awal.php?page=tambah_transaksi',
				type:'post',
				data:'id_transaksi='+id_transaksi+'&id_pasien='+id_pasien+'&id_user='+id_user+'&tgl_transaksi='+tgl_transaksi,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").load("add/add_transaksi.php");
					}else{
						alert("Gagal Menambah Data");
					}
				}
			});
		});
	
		$("#cruddata").on("click","#simpanedit_transaksi_pasien",function(){
			var id_transaksi=$("#id_transaksi").val();
			var id_pasien=$("#id_pasien").val();
			var id_user=$("#id_user").val();
			var tgl_transaksi =$("#tgl_transaksi").val();
					alert(id_transaksi+" "+id_user+" "+id_pasien+" "+tgl_transaksi);
			$.ajax({
				url:'service/service_transaksi_awal.php?page=ubah_transaksi',
				type:'post',
				data:'id_transaksi='+id_transaksi+'&id_pasien='+id_pasien+'&id_user='+id_user+'&tgl_transaksi='+tgl_transaksi,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_transaksi.php");												
					}else{
						alert("Gagal Mengubah Data");
					}
				}	
			});
		});
		
		$("#viewdata").on("click","#buat_report",function(){
					$.ajax({
					url:'add/add_report.php',
					type:'post',
					data:'id='+'',
					success:function(msg){
						$("#cruddata").fadeIn(1000).html(msg);
					}
				});
		});
		/*$("#cruddata").on("click",".submit_report",function(){
			var tgl_mulai=$("#tgl_mulai").val();
			var tgl_akhir=$("#tgl_akhir").val();
					alert(tgl_mulai);
			$.ajax({
				url:'service/service_report.php?page=sort',
				type:'post',
				data:'tgl_mulai='+tgl_mulai+'&tgl_akhir='+tgl_akhir,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_report.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});*/
		$("#cruddata").on("click","#submit",function(){
			var tgl_mulai=$("#tgl_mulai").val();
			var tgl_akhir=$("#tgl_akhir").val();
			
					alert(tgl_akhir);
			$.ajax({
				url:'service/service_report.php?page=sort',
				type:'post',
				data:'tgl_mulai='+tgl_mulai+'&tgl_akhir='+tgl_akhir,
				success:function(msg){
					if(msg=='sukses'){
						$("#cruddata").hide();
						$("#viewdata").load("table/view_report.php");												
					}else{
						alert("Gagal Menambah Data");
					}
				}	
			});
		});
		//#######################################################################################
		
	 	$('.button-collapse').sideNav({
		  	menuWidth: 150, // Default is 240
		  	edge: 'left', // Choose the horizontal origin
		  	closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
			}
  		);
	</script>
	</body>
</html>