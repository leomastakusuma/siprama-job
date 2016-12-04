
<?php $images = $this->config->item('images');
$icons = $this->config->item('icons');
$css = $this->config->item('css');
$js = $this->config->item('js');
$bootstrap = $this->config->item('bootstrap');
$includes = getcwd().'/application/views/templates/';
?>
<?php include($includes.'header.php');?>


<body class="not-transparent-header">


	<div id="introLoader" class="introLoading"></div>

	<!-- start Container Wrapper -->
	<div class="container-wrapper">

		<!-- start Header -->
		<header id="header">

			<!-- start Navbar (Header) -->
			<?php include($includes . "/nav.php"); ?>
			<!-- end Navbar (Header) -->

		</header>

		<!-- start Main Wrapper -->
		<div class="main-wrapper">

			<!-- start hero-header -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list">
						<li><a href="<?php echo site_url('')?>">Home</a></li>
						<li><span>Job Details</span></li>
					</ol>

				</div>

			</div>
			<!-- end hero-header -->

			<div class="section sm">

				<div class="container">

					<div class="row">

						<div class="col-md-10 col-md-offset-1">

							<div class="job-detail-wrapper">

								<div class="job-detail-header text-center">

									<h2 class="heading mb-15"><?php echo $lowongan->_name ?></h2>

									<div class="meta-div clearfix mb-25">
										<span>at <a href="#"><?php echo $lowongan->clientname;?></a> as </span>
										<span class="job-label label label-success"><?php echo $lowongan->type_lowongan;?></span>
									</div>

									<ul class="meta-list clearfix">
										<li>
											<h4 class="heading">Location:</h4>
											<?php echo $lowongan->locname ;?>
										</li>
										<li>
											<h4 class="heading">Open Recruitment</h4>
											<?php echo $lowongan->_date_from;?>
										</li>
										<li>
											<h4 class="heading">Closed Recruitment</h4>
											<?php echo $lowongan->_date_thru;?>
										</li>
										<li>
											<h4 class="heading">Posted: </h4> 
											<?php
												$date = $lowongan->create_date;
												$getDate = date('Y-m-d H:i:s',strtotime($date));
												$now = date('Y-m-d H:i:s');

												$tgl_data = date('Y-m-d',strtotime($date));
												$tgl_skrng = date('Y-m-d');

												$dateTime =  new DateTime();
												$datetime2 = new DateTime($getDate);
												$interval = $dateTime->diff($datetime2);
												
												$selisih_jam = ltrim($interval->format('%H'),"0");
												$selisih_menit = ltrim($interval->format('%I'),"0");
												$selisih_hari = ltrim($interval->format('%D'),"0");

												if($tgl_data == $tgl_skrng){
													if ($interval->format('%H')=="0")
													{
														$posted = $selisih_menit." minutes ago";
													}
													else
													{
														$posted = $selisih_jam." hours ".$selisih_menit." minutes ago";
													}
												}else{
													$posted = $selisih_hari." days ".$selisih_jam." hours ago";
												}
											?>
											<?php echo $posted;?>
										</li>
									</ul>

								</div>

								<div class="job-detail-company-overview clearfix">
									<h3>Company overview</h3>
									<div class="image">
										<img src="<?php echo $lowongan->_logo_url;?>" alt="image">
									</div>
									<p><span class="font600"><?php echo $lowongan->clientname;?></span></p>
									<p><?php echo $lowongan->clientdesc?></p>
								</div>

								<div class="job-detail-content mt-30 clearfix">
									<h3>Deskripsi</h3>
									 <?php echo $lowongan->_desc?>
									<h3>Persyaratan</h3> 
									 <?php echo $lowongan->_persyaratan?>
									 <?php if(!empty($this->session->userdata('userinfo'))):?>
										 	<form action="<?php echo site_url('Psikotes')?>" method="POST">
												<input type="hidden" value="<?php echo $lowongan->lowongan_no ?>" name="lowongan_no">
												<input type="submit" name="Apply" value="Apply" class="btn btn-primary btn-hidden btn-lg mt-20">
											</form>
									 <?php else:?>
										 <a href="<?php echo site_url('Login');?>" class="btn btn-primary btn-hidden btn-lg mt-20">Apply</a>
									 <?php endif;?>
								</div>

							</div>

						</div>

					</div>

				</div>

			</div>


      			<?php include($includes.'footer.php');?>

      		</div>
      		<!-- end Main Wrapper -->

      	</div> <!-- / .wrapper -->
      	<!-- end Container Wrapper -->



      <?php include($includes.'footer-file.php');?>
