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
			<th>Comment Time</th>
			<th>By Name</th>
			<th>By Email</th>
			<th>Subject</th>
			<th>Comment Text</th>
			<th>View Full</th>
		</tr>
		<?php
			$commentRes=commentList($id=0);
			// echo '<pre>';
			// print_r($commentRes);
			// echo '</pre>';
			// die;
			for($c=0; $c<count($commentRes['news_id']); $c++){
				?>
					<tr style="font-weight:normal;" class="<?php if($commentRes['comment_status'][$c]==1){echo 'success';} ?>">
						<td><?php echo $commentRes['comment_time'][$c]; ?></td>
						<td><?php echo $commentRes['comment_name'][$c]; ?></td>
						<td><?php echo $commentRes['comment_email'][$c]; ?></td>
						<td><?php echo $commentRes['comment_subject'][$c]; ?></td>
						<td><?php echo $commentRes['comment_text'][$c]; ?></td>
						<td><a href="comment-view.php?id=<?php echo $commentRes['comment_id'][$c]; ?>">View Full</a></th>
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