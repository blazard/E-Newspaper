<?php include 'header.php'; ?>
	<div class="single-wrapper row"><!-- Single News Wrapper -->
		<div class="col-md-3 single-left"><!-- Single Left -->
			<div class="epaperr-wrapper"><!-- E-paper Wrapper Start -->
				<ul>
				<?php
				if(isset($_GET['eid'])){
					$eid=$_GET['eid'];
					$fetchImg=fetchEpaperNewsSpecific($eid);
					if($fetchImg['bool']==true){
						// echo '<pre>';
						// print_r($fetchImg);
						// echo '</pre>';
						// die;
						$date=$fetchImg['epaper_date'][0];
						$img=unserialize($fetchImg['epaper_images'][0]);
						for($r=0; $r<count($img); $r++){
							$image=$date.'/'.$img[$r];
						?>
						<li id="id<?php echo $r; ?>">
							<img src="<?php echo $urls->epaper.'/'.$image; ?>" />
						</li>
						<?php
						} //End for loop
					}else{
						echo $fetchImg['msg'];
					}

				// If this is not get id then it show the below part
				}else{
					$response=fetchEpaperNews();
					if($response['bool']==true){
						$id=$response['epaper_id'];
						$images=$response['epaper_images'];
						$date=$response['epaper_date'];
					}else{
						echo $response['msg'];
					}
					// echo '<pre>';
					// print_r($date);
					// echo '</pre>';
					// die;
				?>
				
					<?php
						for($ep=0; $ep<count($images);$ep++){
							$img=unserialize($images[$ep]);
							$image=htmlentities($date[$ep]).'/'.$img[0];
							?>
								<li><a href="epaper.php?eid=<?php echo $id[$ep]; ?>"><img src="<?php echo $urls->epaper.'/'.$image; ?>" height="200" /><?php echo $date[$ep]; ?></a></li>
							<?php
						}
					}// If Not Get id
					?>
				</ul>
			</div><!-- E-paper Wrapper End -->
		</div><!-- Single Left -->
		<div class="col-md-9 epaperr-medium-view right-sidebar"><!-- Right Sidebar Start -->
			<div class="mediumImg-wrapper">
				<a href="#" class="fancybox"><img src="" id="targetImg" /></a>
			</div>
		</div><!-- Right Sidebar End -->
	</div><!-- Single News Wrapper -->
<?php include 'footer.php'; ?>