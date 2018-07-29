<?php include 'header.php'; ?>
<?php
// Making Check for news single page so that nobody can access this page directly
	if(isset($_GET['newsid'])){
		$newsid=$_GET['newsid'];
		if(is_numeric($newsid)){
		$pNews=singleNews($newsid);
		if($pNews['bool']==false){
			echo '<h4>This is not valid news ID.</h4>';
			exit();
		}
		// echo '<pre>';
		// print_r($pNews);
		// echo '</pre>';
		// die;
	}else{
		echo '<h4>This is not valid news</h4>';
		die;
	}
}else{
	header("location:404.php");
}
?>
	<div class="single-wrapper row"><!-- Single News Wrapper -->
		<div class="col-md-8 single-left"><!-- Single Left -->
			<div class="singleleft-wrapper"><!-- Single Left Wrapper Start -->
				<p class="singlenews-textImg">
					<img src="<?php echo $urls->news.'/news_images/'.$pNews['newscontent']['news_image']; ?>" id="singlenewsImg" align="left" />
					<span class="singlenews-heading singlenews-content">
						<span class="singlenews-heading singlenews-content"><?php echo $pNews['newscontent']['news_title']; ?></span>
						<span class="singlenews-meta singlenews-content">
							BY <a href="#" class="newsby singlenews-metalinks"><?php echo $pNews['newscontent']['username']; ?></a> / <span class="newsdate singlenews-metalinks"><?php echo date('F d, Y',strtotime($pNews['newscontent']['news_time'])); ?></span>
						</span>
						<span class="singlenews-maintext singlenews-content"><?php echo substr($pNews['newscontent']['news_content'],0,250); ?></span>
<span class="singlenews-text"><?php echo substr($pNews['newscontent']['news_content'],250); ?></span>
					</span>
				</p>
			</div><!-- Single Left Wrapper End -->

			<div class="comment-section" id="commentSection"><!-- Comment Section Start -->
				<h3><i class="fa fa-comments"></i>&nbsp;Comment Section</h3>
				<form method="post" action="">
					<table class="table">
						<tr>
							<td colspan="2">
								<?php
									$num_a=rand(1,50);
									$num_b=rand(1,50);
									$answer=$num_a+$num_b;
									$_SESSION['answer']=$answer;
								?>
								<?php
									if(isset($_POST['comment_add'])){
										$comment_name=mysql_real_escape_string($_POST['comment_name']);
										$comment_email=mysql_real_escape_string($_POST['comment_email']);
										$comment_subject=mysql_real_escape_string($_POST['comment_subject']);
										$comment_msg=mysql_real_escape_string($_POST['comment_msg']);
										// Captcha Code
									    // value entered is correct
									    if(!empty($comment_email) && filter_var($comment_email, FILTER_VALIDATE_EMAIL)){
									    $commentData=array(
										'comment_name'=>$comment_name,
										'comment_email'=>$comment_email,
										'comment_subject'=>$comment_subject,
										'comment_msg'=>$comment_msg,
										'newsid'=>$newsid
										);
											if(isset($_POST["captcha"])&&$_POST["captcha"]!="" && $_SESSION["code"]==$_POST["captcha"]){
												$commentRes=addComment($commentData);
												// echo '<pre>';
												// print_r($commentRes);
												// echo '</pre>';
												// die;
												if($commentRes['bool']==true){
													echo 'Comments Submmitted but it is in Modration view.Once Approve you will notify by email';
												}
											}else{
												echo '<span class="alert-warning">Captcha is wrong</span>';
											}
										}else{
											echo '<span class="alert-warning">Please enter valid email.</span>';
										}
										}
									?>
							</td>
						</tr>
						<tr>
							<td>Name</td>
							<td><input type="text" name="comment_name" placeholder="Enter Your Name.." /></td>
						</tr>
						<tr>
							<td>Email</td>
							<td><input type="text" name="comment_email" placeholder="Enter Your Email.." /></td>
						</tr>
						<tr>
							<td>Subject</td>
							<td><input type="text" name="comment_subject" placeholder="Enter Your Subject.." /></td>
						</tr>
						<tr>
							<td>Message</td>
							<td><textarea placeholder="Enter Your Message.." name="comment_msg" cols="30" rows="10"></textarea></td>
						</tr>
						<tr>
							<td>Are you human?</td>
							<td>
							<p><img src="<?php echo $urls->home_url; ?>/captcha.php" /><br></p>
								<input type="text" name="captcha" />
							</td>
						</tr>
						<tr>
						</tr>
						<tr>
							<td colspan="2"><input type="submit" class="btn btn-danger" value="Add" name="comment_add" /></td>
						</tr>
					</table>
				</form>
			</div><!-- Comment Section End -->

			<div class="commentList">
				<h4>User Comments</h4>
				<ul>
					<?php
						$commentData=get_all_comments($newsid);
						if($commentData['bool']==false){
							echo 'No Comments on this news'.'<br/>';
							echo 'Be first to comment <a href="#commentSection">here</a>';
						}else{
							for($com=0; $com<(count($commentData['commentData'])); $com++){
								// echo '<pre>';
								// print_r($commentData['commentData'][$com]);
								// echo '</pre>';
								?>
								<li>
									<span class="boldText"><i class="fa fa-user"></i>&nbsp;<?php echo $commentData['commentData'][$com]['comment_name']; ?></span>
									<span class="commentText"><i class="fa fa-comment"></i>&nbsp;<?php echo $commentData['commentData'][$com]['comment_text']; ?></span>
								</li>
								<?php
							}
						}
					?>
					
				</ul>
			</div>

		</div><!-- Single Left -->
		<div class="col-md-4 single-right right-sidebar"><!-- Right Sidebar Start -->
			<?php include 'right-sidebar.php'; ?>
		</div><!-- Right Sidebar End -->
	</div><!-- Single News Wrapper -->
<?php include 'footer.php'; ?>