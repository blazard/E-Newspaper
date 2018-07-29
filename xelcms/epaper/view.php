<?php 
session_start();
include('../includes/functions.php');
error_reporting(5);
if(!isset($_SESSION['username'])){
	header ("Location: http://" . $_SERVER['HTTP_HOST'] .
		dirname($_SERVER['PHP_SELF']) . "/login.php");
		exit();
}
?>
<!-- <meta HTTP-EQUIV="refresh" CONTENT="1"> -->
<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">
<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="../styles/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../styles/news.css" />
<!-- Add News Content Start -->
<div id="newscontainer">
	<form method="post" action="" enctype="multipart/form-data">
	<table class="table">
		<tr class="danger">
			<th>Epaper ID</th>
			<th>Epaper Folder</th>
			<th>Epaper Status</th>
			<th>Edit</th>
		</tr>
		<?php
			$epaperRes=getEpapers($id=0);
			// echo '<pre>';
			// print_r($epaperRes);
			// echo '</pre>';
			// die;
			for($e=0; $e<count($epaperRes['eid']);$e++){
				?>
				<tr class="danger">
					<td><?php echo $epaperRes['eid'][$e]; ?></td>
					<td><?php echo $epaperRes['edate'][$e]; ?></td>
					<td><?php echo $epaperRes['estatus'][$e]; ?></td>
					<td><a href="edit.php?id=<?php echo $epaperRes['eid'][$e]; ?>">Edit</a></td>
				</tr>
				<?php
			}
		?>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>