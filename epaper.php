<?php include 'header.php'; ?>
	<div class="single-wrapper row"><!-- Single News Wrapper -->
		<div class="col-md-8 single-left"><!-- Single Left -->
			<div class="epaperr-wrapper"><!-- E-paper Wrapper Start -->
				<ul id="all">
				<?php
					$response=fetchEpaperNews();
					if($response['bool']==true){
						$id=$response['epaper_id'];
						$images=$response['epaper_images'];
						$date=$response['epaper_date'];
					}
					else{
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
								<li><a href="<?php echo $urls->epapers.'/'.$id[$ep]; ?>"><img src="<?php echo $urls->epaper.'/'.$image; ?>" /><?php echo $date[$ep]; ?></a></li>
							<?php
						}
					?>
					
				</ul>
			</div><!-- E-paper Wrapper End -->
		</div><!-- Single Left -->
		<div class="col-md-4 epaperr-medium-view right-sidebar"><!-- Right Sidebar Start -->
			<?php include('right-sidebar.php'); ?>
		</div><!-- Right Sidebar End -->
	</div><!-- Single News Wrapper -->
<?php include 'footer.php'; ?>