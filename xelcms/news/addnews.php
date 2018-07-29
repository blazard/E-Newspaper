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
				if(isset($_POST['add_news'])){
					$news_title=mysql_real_escape_string($_POST['news_title']);
					$news_cat=mysql_real_escape_string($_POST['news_cat']);
					$news_content=mysql_real_escape_string(stripslashes(strip_tags($_POST['news_content'])));
					$news_is_breaking=$_POST['is_breaking'];
					$news_is_topstory=$_POST['top_story'];
					$news_image=$_FILES['newsimg']['name'];
					$news_image_tmp=$_FILES['newsimg']['tmp_name'];
					$news_image_size=floor($_FILES['newsimg']['size']/1024);
					$userid=$_SESSION['id'];
					$username=$_SESSION['username'];
					// News Image Data
					$filedata=array(
						'userid'=>$userid,
						'filename'=>$news_image,
						'tmpfile'=>$news_image_tmp,
						'foldername'=>'news_images',
						'filesize'=>$news_image_size
						);
					$resNewsFile=addNewsFile($filedata);
					if($resNewsFile['bool']==true){
						// News Data
						$newsdata=array(
						'username'=>$username,
						'news_title'=>$news_title,
						'news_cat'=>$news_cat,
						'news_content'=>$news_content,
						'news_image'=>$resNewsFile['filename'],
						'is_breaking'=>$news_is_breaking,
						'is_top_story'=>$news_is_topstory
						);
						$addnewsres=addNews($newsdata);
						if($addnewsres['bool']==true){

							echo '<span class="alert success">News has been added</span>';
						}else{
							echo '<span class="alert error">Error: Adding News</span>';
						}
					}else{
						echo '<span class="alert error">Error: Uploading news images..</span>';
					}
					// echo '<pre>';
					// print_r($resNewsFile);
					// echo '</pre>';
					// die;
				}
			?>
		</td></tr>
		<tr>
			<td>News Title</td><td><input placeholder="Enter News Title..." type="text" name="news_title" /></td>
		</tr>
		<tr>
			<td>News Category</td>
			<td><select name="news_cat">
				<?php 
					$categories=fetchCategories();
					if($categories==true){
						for($i=0; $i<sizeof($categories['id']); $i++){
							?>
							<option value="<?php echo $categories['id'][$i]; ?>"><?php echo $categories['categories'][$i]; ?></option>
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
					<option value="1">Yes</option>
					<option value="0" selected="selected">No</option>
				</select>
				<span class="indicate">( By default this news is not in breaking story. )</span>
			</td>
		</tr>
		<tr>
			<td>Is this Top Story ?</td>
			<td>
				<select name="top_story">
					<option value="1">Yes</option>
					<option value="0" selected="selected">No</option>
				</select>
				<span class="indicate">( By default this news is not in top story. )</span>
			</td>
		</tr>
		<tr>
			<td>News Image</td><td><p class="browseupload">Upload Image</p>
				<p class="fileupload"><input type="file" name="newsimg" id="newsimg" /></p>
				<p><img src="#" id="preview" /></p>
			</td>
		</tr>
		<tr>
			<td>News Content</td><td><textarea name="news_content" class="editme"></textarea></td>
		</tr>
		<tr>
			<td colspan="2" align="right"><input type="submit" name="add_news" value="Add News" /></td>
		</tr>
	</table>
</form>
</div>
<script type="text/javascript" src="../includes/lib/jquery-1.11.2.js"></script>
<script type="text/javascript" src="../includes/lib/tinymce/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript" src="../includes/lib/custom.js"></script>