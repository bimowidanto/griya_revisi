

                            <div class="col-md-8 column box table_border">
                                <form role="form" class="form-group"  name="form_input_obat" method="post" action="">
                                <fieldset>
                                 <legend><h3 align="center">Form Data Obat Klinik Griya Sehat Natura</h3></legend>
								 
                                	<div class="col-md-6">
									<div class="input-group">
										<span class="input-group-addon"><span class="">Kode Item</span></span>
										<input type="text" name="kd_item" id="kd_item" onChange='checkNum(this)' class="form-control" placeholder="Kode Item" required>
									</div>
									</div>
									
									
									<div class="col-md-6">
                                        <div class="input-group">
                                          <span class="input-group-addon"><span class="">Nama Item</span></span>
											<input type="text" id="nama_item" name="nama_item" onChange='checkNum(this)' class="form-control" placeholder="Nama Item" required="required">  
                                        </div>
                                    </div>
									<div class="col-md-6">
                                        <div class="input-group">
                                          <span class="input-group-addon"><span class="">Merk</span></span>
											<input type="text" id="merk" name="merk" onChange='checkNum(this)' class="form-control" placeholder="Merk" required="required">  
                                        </div>
                                    </div>
									<div class="col-md-6">
                                        <div class="input-group">
                                          <span class="input-group-addon"><span class="">Satuan</span></span>
											<input type="text" id="satuan" name="satuan" onChange='checkNum(this)' class="form-control" placeholder="Satuan" required="required">  
                                        </div>
                                    </div>
									<br>
                                    <div class="col-md-3 input-group">
                                     <button type="submit" name="submit" class="btn btn-primary btn-block" value="submit">Submit</button>
                                    </div>
                                     <div class="col-md-3 input-group">
                                     <button type="reset" class="btn btn-warning btn-block">Reset</button>
                                    </div>
                                    </fieldset>
                                </form>
                            </div>
							

<?php
include "connect.php";
if(isset($_POST['submit']))
{
	$kd_item = $_POST['kd_item'];
	$nama_item = $_POST['nama_item'];
	$merk = $_POST['merk'];
	$satuan = $_POST['satuan'];
	
	$sql_id = mysql_query("SELECT kode_item FROM tbl_obat WHERE kode_item = '$kd_item'");
    $res2 = mysql_num_rows($sql_id);
	
	if($res2 == 0)
	{
		$SQL = " INSERT INTO tbl_obat";
			$sql_cat = $SQL . " (kode_item, nama_item, merk,satuan) VALUES ";
			$sql_var = $sql_cat . " ('$kd_item', '$nama_item','$merk','$satuan')";
			$result = mysql_query("$sql_var");
		
			if (!$result) { 
				echo"<script>alert('saving failed!');javascript:history.go(0);</script>";
			}
				else{
						echo"<script>alert('saving success!');javascript:history.go(0);</script>";
					}
	}
}
?>
