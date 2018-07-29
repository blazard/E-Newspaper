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
			<th>Banner ID</th>
			<th>Banner URL</th>
			<td align="center">Banner Image</td>
			<th>Banner Loc</th>
			<th>Banner Status</th>
			<th>Edit</th>
			<th>Delete</th>
		</tr>
		<?php
		// 
			if(isset($_POST['delete-banner'])){
				$bannerids=$_POST['banner_id'];
				$delRes=deleteBanners($bannerids);
				if($delRes['bool']==true){
					echo 'Banners has been deleted';
				}else{
					echo $delRes['msg'];
				}
			}
		?>
		<?php
		// get Banners
			$bannerRes=banners($id=0);
			// echo '<pre>';
			// print_r($bannerRes);
			// echo '</pre>';
			// die;
			for($c=0; $c<count($bannerRes['banner_id']); $c++){
				?>
					<tr style="font-weight:normal;">
						<td><?php echo $bannerRes['banner_id'][$c]; ?></td>
						<td><?php echo $bannerRes['banner_url'][$c]; ?></td>
						<td align="center"><img width="30%" src="banner_images/<?php echo $bannerRes['banner_img'][$c]; ?>" /></td>
						<td><?php echo $bannerRes['banner_loc'][$c]; ?></td>
						<td><?php echo $bannerRes['banner_status'][$c]; ?></td>
						<td><a href="banner-edit.php?id=<?php echo $bannerRes['banner_id'][$c]; ?>">Edit</a></td>
						<td><input style="width:auto;" type="checkbox" name="banner_id[]" value="<?php echo $bannerRes['banner_id'][$c]; ?>" /></td>
					</tr>
				<?php
			}
		?>
		<tr><td colspan="7" align="right"><input style="width:auto;" name="delete-banner"  type="submit" value="Delete" /></td></tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>