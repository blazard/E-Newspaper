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
<link rel="stylesheet" type="text/css" href="../styles/news.css" />
<!-- Add News Content Start -->
<div id="newscontainer">
	<form method="post" action="" enctype="multipart/form-data">
	<table>
		<tr><td colspan="2">
			<?php
				if(isset($_GET['newsid'])){
					$newsid=$_GET['newsid'];
				}else{
					exit();
				}
				if(isset($_POST['update_news'])){
					$news_title=mysql_real_escape_string($_POST['news_title']);
					$news_cat=mysql_real_escape_string($_POST['news_cat']);
					$news_content=mysql_real_escape_string(stripslashes(strip_tags($_POST['news_content'])));
					$news_is_breaking=$_POST['is_breaking'];
					$news_is_topstory=$_POST['top_story'];
					$news_image=$_FILES['newsimg']['name'];
					$news_image_tmp=$_FILES['newsimg']['tmp_name'];
					$news_image_size=floor($_FILES['newsimg']['size']/1024);
					$userid=$_SESSION['id'];
					// News Image Data
					$filedata=array(
						'userid'=>$userid,
						'filename'=>$news_image,
						'tmpfile'=>$news_image_tmp,
						'foldername'=>'news_images',
						'filesize'=>$news_image_size
						);
					$resNewsFile=addNewsFile($filedata);
						// News Data
						$newsdata=array(
						'news_id'=>$newsid,
						'news_title'=>$news_title,
						'news_cat'=>$news_cat,
						'news_content'=>$news_content,
						'news_image'=>$resNewsFile['filename'],
						'is_breaking'=>$news_is_breaking,
						'is_top_story'=>$news_is_topstory
						);
						$addnewsres=updateNews($newsdata);
						if($addnewsres['bool']==true){
							echo '<span class="alert success">News has been Updated</span>';
						}else{
							echo '<span class="alert error">Error: Updating News</span>';
						}
					}
					// echo '<pre>';
					// print_r($resNewsFile);
					// echo '</pre>';
					// die;
			?>

			<?php
				// Fetch News For perticular ID
				if(isset($_GET['newsid'])){
					$newsid=$_GET['newsid'];
				}
				$newsData=FetchSpecificNews($newsid);
				// echo '<pre>';
				// print_r($newsData);
				// echo '</pre>';
				// die;
			?>
		</td></tr>
		<tr>
			<td>News Title</td>
			<td>
				<input placeholder="Enter News Title..." type="text" name="news_title" value="<?php echo htmlentities($newsData['news_title']); ?>" />
			</td>
		</tr>
		<tr>
			<td>News Category</td>
			<td><select name="news_cat">
				<?php
					$categories=fetchCategories();
					if($categories==true){
						for($i=0; $i<sizeof($categories['id']); $i++){
							?>
							<option value="<?php if($categories['id'][$i]==$newsData['cat_id']) {echo $categories['id'][$i].'" selected="selected"';}else{ echo $categories['id'][$i];}?>"><?php echo $categories['categories'][$i]; ?></option>
							<?php
						}
					}
				?>
			</select></td>
		</tr>
		<tr>
			<td>Is this Breaking News ?</td>
			<td>
				<select name="is_breaking">
					<option value="0" <?php if($newsData['is_breaking']==0) echo 'selected="selected"';?>>No</option>
					<option value="1" <?php if($newsData['is_breaking']==1) echo 'selected="selected"';?>>Yes</option>
				</select>
				<span class="indicate">( By default this news is not in breaking story. )</span>
			</td>
		</tr>
		<tr>
			<td>Is this Top Story ?</td>
			<td>
				<select name="top_story">
					<option value="0" <?php if($newsData['is_topstory']==0) echo 'selected="selected"';?>>No</option>
					<option value="1" <?php if($newsData['is_topstory']==1) echo 'selected="selected"';?>>Yes</option>
				</select>
				<span class="indicate">( By default this news is not in top story. )</span>
			</td>
		</tr>
		<tr>
			<td>News Image</td><td>
			<p class="browseupload"><a href="updateimage.php?newsid=<?php echo $newsData['id']; ?>">Upload Image</a></p>
			</td>
		</tr>
		<tr>
			<td>News Content</td><td><textarea name="news_content" class="editme"><?php echo htmlentities($newsData['news_content']); ?></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="update_news" value="Update News" /></td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>