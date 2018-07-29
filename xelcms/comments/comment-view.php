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
		<tr>
			<td colspan="2">
				<?php
					if(isset($_GET['id'])){
						$id=$_GET['id'];
					}else{
						$id=0;
					}

					// Update Comments
					if(isset($_POST['comment_approve_btn'])){
						$comntRes1=updateComment($id);
						if($comntRes1['bool']==true){
							echo 'Comments has been Approved';
						}else{
							echo $comntRes1['msg'];
						}
					}

					if(isset($_POST['comment_disapprove_btn'])){
						$comntRes2=updateCommentd($id);
						if($comntRes2['bool']==true){
							echo 'Comments has been Disapproved';
						}else{
							echo $comntRes2['msg'];
						}
					}
				?>
			</td>
		</tr>
		<tr class="danger">
			<th>Comment Text</th>
			<th>News Title</th>
		</tr>
		<?php
			$commentRes=commentList($id);
			$newsData=FetchSpecificNews($commentRes['news_id'][0]);
			// echo '<pre>';
			// print_r($newsData);
			// echo '</pre>';
			// die;
				?>
					<tr style="font-weight:normal;">
						<td><?php echo $commentRes['comment_text'][0]; ?></td>
						<td><?php echo $newsData['news_title']; ?></td>
					</tr>
				<?php
		?>
		<tr>
			<td colspan="2"><input type="submit" name="comment_approve_btn" value="Approve" /></td>
		</tr>
		<tr>
			<td colspan="2"><input type="submit" name="comment_disapprove_btn" value="Disapprove" /></td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>