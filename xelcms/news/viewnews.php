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
<!-- Meta Tags -->
<!-- <meta HTTP-EQUIV="refresh" CONTENT="5"> -->
<meta HTTP-EQUIV="CACHE-CONTROL" CONTENT="NO-CACHE">
<meta HTTP-EQUIV="PRAGMA" CONTENT="NO-CACHE">

<!-- Stylesheets -->
<link rel="stylesheet" type="text/css" href="../styles/bootstrap.min.css" />
<link rel="stylesheet" type="text/css" href="../styles/news.css" />

<!-- Add News Content Start -->
<div id="viewnewscontainer">
<form method="post" action="">
	<table class="table table-striped">
		<tr>
			<td colspan="4">
				<?php
					if(isset($_POST['delete'])){
						$newsid=$_POST['newsid'];
						$delRes=deleteNews($newsid);
						if($delRes['bool']==true){
						echo '<span class="alert success">News has been Deleted</span>';
						}else{
							echo '<span class="alert error">Error: Deleting News</span>';
						}
					}
				?>
			</td>
		</tr>
		<tr style="background-color:#425d7b;">
			<th colspan="1" align="left" style="color:#fff;">Sort By</th>
			<th colspan="4" align="left" style="font-weight:normal; font-size:12px;">
				<select name="catid">
					<?php
						$opcategories=fetchCategories();
						for($op=0; $op<count($opcategories['categories']); $op++){
					?>
					<option value="<?php echo $opcategories['id'][$op]; ?>"><?php echo $opcategories['categories'][$op]; ?></option>
					<?php
				}
				?>
				</select>
				<input type="submit" name="sortby_cat" value="Sort" />
			</th>
		</tr>
		<tr style="background-color:#425d7b; color:#fff;">
			<th align="left">News Time</th>
			<th align="left">News Title</th>
			<th align="left">News Image</th>
			<th align="left">Edit</th>
			<th align="left">Delete</th>
		</tr>
	<?php

		// Create Pagination
		//$totalrows=fetchNewsRows(); //30
		$limit=3;
		if(!isset($_GET['page']) || $_GET['page']==1){
			$start=0; // Becuase Limit Start default From 0 so that set start=0
		}else{
			// Main Logic for pagination
			$page=$_GET['page']-1;
			$start=$page*$limit;
		}

		if(isset($_POST['sortby_cat'])){
			$catid=$_POST['catid'];
		}else{
			$catid=0;
		}
		$newsData=fetchNewsSubPart($start,$limit,$catid);
		// echo '<pre>';
		// print_r($newsData);
		// echo '</pre>';
		// die;
		for($i=0; $i<count($newsData['id']); $i++){
			?>
			<tr>
				<td><?php echo $newsData['news_time'][$i]; ?></td>
				<td><?php echo $newsData['news_title'][$i]; ?></td>
				<td><img width="100" src="news_images/<?php echo $newsData['news_image'][$i]; ?>" /></td>
				<td><a href="edit.php?newsid=<?php echo $newsData['id'][$i]; ?>">Edit news</a></td>
				<td><input type="checkbox" name="newsid[]" value="<?php echo $newsData['id'][$i]; ?>" /></td>
			</tr>
			<?php
		}
	?>
	<!-- <tr> -->
		<!-- <td colspan="3"></td> -->
		<!-- <td align="right"><input type="submit" value="Delete News" name="delete" id="deletenews" onclick="return confirm('Do you want to delete these categories?')" /></td> -->
	<!-- </tr> -->
	<tr>
		<td colspan="4">
	<?php
		// Logic for creating pagination
		$total=fetchNewsRows($catid);
		$totalshow=3;
		$showw=ceil($total/$totalshow);
		echo '<span class="pagination_box">';
		for($j=1; $j<=$showw; $j++){
			?>
				<a href="viewnews.php?page=<?php echo $j; ?>"><?php echo $j; ?></a>
			<?php
		}
		echo '</span>';
	?>
		</td>
		<td>
			<?php 
				if($total>0){
			?>
			<input type="submit" od="deletenews" name="delete" value="Delete News" onclick="return confirm('Do you really want to delete these categories?')" />
			<?php }else{
				echo 'No News Found';
			} ?>
		</td>
	</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>