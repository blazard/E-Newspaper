<?php 
session_start();
include('../includes/functions.php');
error_reporting(5);
if (!isset($_SESSION['username'])) {
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
			dirname($_SERVER['PHP_SELF']) . "/login.php");
			exit();
} 
?>
<style>
	#newscontainer table tr td{
		border:none;
	}
</style>
<!-- <meta HTTP-EQUIV="refresh" CONTENT="1"> -->
<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="../styles/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../styles/news.css" />
<!-- Add News Content Start -->
<div id="newscontainer">
	<form method="post" action="" enctype="multipart/form-data" style="padding:5px;">
	<table class="table">
		<tr><td colspan="2">
			<?php
				if(isset($_GET['id'])){
					$id=$_GET['id'];
				}else{
					echo 'Invalid Id';
				}
				if(isset($_POST['edit_epaper'])){
					$status=$_POST['estatus'];
					$epaperRes=updateEpaper($status,$id);
					if($epaperRes['bool']==true){
						echo 'Epaper has been updated';
					}else{
						echo $epaperRes['msg'];
					}
				}
				$epaperRes=getEpapers($id);
			?>
		</td></tr>
		<tr>
			<td>Add News Date</td><td><input type="text" readonly name="epaper_date" value="<?php echo $epaperRes['edate'][0]; ?>" /></td>
		</tr>
		<tr>
			<td>Status</td>
			<td>
				<table class="table">
					<tr>
						<td>Enable</td>
						<td><input  <?php if($epaperRes['estatus'][0]==1) echo 'checked="checked"'; ?> style="width:70px;" type="radio" name="estatus" value="1" /></td>
					</tr>
					<tr>
						<td>Disable</td>
						<td><input <?php if($epaperRes['estatus'][0]==0) echo 'checked="checked"'; ?> style="width:70px;" type="radio" name="estatus" value="0" /></td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>Show Images</td>
			<table>
				<tr>
					<?php
						$images=unserialize($epaperRes['eimg'][0]);
						for($e=0; $e<count($images); $e++){
							?>
							<td data-toggle="modal" data-target="#myModal"><img class="epaper-img" src="<?php echo $epaperRes['edate'][0].'/'.$images[$e];?>" /></td>
							<?php
							$num=3;
							if($e % $num==0){
								echo '</tr>';
								// echo '</tr>';
								// $i=0;
								// echo '</tr>';
							}
						}
					?>
					
				</tr>
			</table>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="edit_epaper" value="Update" /></td>
		</tr>
	</table>

<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Change this image</h4>
      </div>
      <div class="modal-body">
        <p id="preview_img"></p>
        <p>Currently this is not working....</p>
       <!--  <p>
        	<input type="file" name="epaper-image" />
        	<input type="hidden" name="epaper-directory" value="<?php echo $epaperRes['eid'][0]; ?>" />
        </p> -->
      </div>
      <!-- <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="update_img">Save changes</button>
      </div> -->
    </div>
  </div>
</div>

</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>
<script type="text/javascript" src="../includes/lib/bootstrap.min.js"></script>