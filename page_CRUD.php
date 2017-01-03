<html>
<head>
	<link rel="stylesheet" href='matrializer/css/materialize.css'/>
</head>
<body>
	<div id="control"><?php include"page_control.php";?></div>
	
	<div id="cruddata">crud</div>
	<div id="viewdata">view</div>
	
	<script type="text/javascript" src="matrializer/js/jquery1.js"></script>
	<script type="text/javascript" src="matrializer/js/materialize.js"></script>
	<script type="text/javascript" src="matrializer/js/materialize.min.js"></script>
	<script type="text/javascript">
		//################################################################################
		//event untuk supplier
		$("#control").on("click","#supplier",function(){
			$("#cruddata").hide();
			$("#viewdata").load("table/view_supplier.php");
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
		
		
		
		$("#cruddata").on("click","#batal",function(){
			$("#cruddata").hide().fadeOut(1000);
		});
		
		
	
		
		
		
		
	 	$('.button-collapse').sideNav({
		  	menuWidth: 150, // Default is 240
		  	edge: 'left', // Choose the horizontal origin
		  	closeOnClick: true // Closes side-nav on <a> clicks, useful for Angular/Meteor
			}
  		);
	</script>
</body>
</html>