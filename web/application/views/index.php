<?php $includes = getcwd().'/application/views/templates';?>﻿

<?php include($includes . "/header.php"); ?>

<body class="home">


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
			<div class="hero alt-pb" style="background-image:url('<?php echo $images?>blog/blog-02.jpg');">
				<div class="container">

					<h1>Masa Depan Anda Dimulai Dari Sini</h1>

				</div>

			</div>
			<!-- end hero-header -->

			<div class="post-hero no-bb">

				<div class="container">

					<div class="post-hero-inner-shahow pt-40 pb-10 bg-light">

						<div class="row mt-5">

							<div class="col-md-10 col-md-offset-1">

								<div class="row">

									<div class="col-sm-12 col-md-12">

										<div class="counting-item alt-number-sm">

											<div class="counting-number h1"><span class="counter" data-decimal-delimiter="," data-thousand-delimiter="," data-value="<?php echo $total->totalLowongan;?>"></span></div>
											<?php if (validation_errors()!="" || !empty($_SESSION['error'])) :?>
														<div class="row ">
																<div class="col-lg-12">
																<div class="alert alert-block alert-danger fade in">
																		<button data-dismiss="alert" class="close close-sm" type="button">
																				<i class="fa fa-times"></i>
																		</button>
																		<?php echo validation_errors();?>
																		<?php echo !empty($_SESSION['error']) ? $_SESSION['error'] : '' ;?>
																</div>
																</div>
														</div>
											<?php endif?>
											Jobs Available

										</div>

									</div>

								</div>

							</div>

						</div>

					</div>

				</div>

			</div>
			<!-- leo; -->
			<?php if($lowonganPromoted):?>
				<div class="pt-70 pb-80">

				<div class="container mt-5">
					<div class="row">
						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

							<div class="section-title">

								<h2>Promosi Lowongan</h2>

							</div>

						</div>

					</div>

					<div class="category-item-09-wrapper">
						<div class="grid-category-wrapper">
							<?php foreach($lowonganPromoted as $key=>$val) :?>
								<?php if($val->_position == 1 && $val->lowongan_no) :?>
										<div class="grid-category-item category-item-09" data-colspan="10" data-rowspan="10" style="background-image:url('<?php echo base_url_upload.$val->_cover_enc_name;?>');">
											<a href="<?php echo site_url('Index/Jobdetail').'/'.$val->lowongan_no;?>">
													<div class="heading">
														<h3><?php echo $val->_name?></h3>
														<span class="post-heading">Apply</span>
													</div>
											</a>
										</div>
								<?php endif;?>

								<?php if($val->_position == 2 && $val->lowongan_no) :?>
									<div class="grid-category-item category-item-09" data-colspan="10" data-rowspan="5" style="background-image:url('<?php echo base_url_upload.$val->_cover_enc_name;?>');">
										<a href="<?php echo site_url('Index/Jobdetail').'/'.$val->lowongan_no;?>">
											<div class="heading">
												<h3><?php echo $val->_name?></h3>
												<span class="post-heading">Apply</span>
											</div>
										</a>
									</div>
								<?php endif;?>

								<?php if($val->_position == 3 && $val->lowongan_no) :?>
								<div class="grid-category-item category-item-09" data-colspan="5" data-rowspan="5" style="background-image:url('<?php echo base_url_upload.$val->_cover_enc_name;?>');">
									<a href="<?php echo site_url('Index/Jobdetail').'/'.$val->lowongan_no;?>">
											<div class="heading">
												<h3><?php echo $val->_name?></h3>
												<span class="post-heading">Apply</span>
											</div>
									</a>
								</div>
								<?php endif;?>

								<?php if($val->_position == 4 && $val->lowongan_no) :?>
								<div class="grid-category-item category-item-09" data-colspan="5" data-rowspan="5" style="background-image:url('<?php echo base_url_upload.$val->_cover_enc_name;?>');">
									<a href="<?php echo site_url('Index/Jobdetail').'/'.$val->lowongan_no;?>">
										<div class="heading">
											<h3><?php echo $val->_name?></h3>
										 <span class="post-heading">Apply</span>
  									</div>
									</a>
								</div>
								<?php endif;?>

						  <?php endforeach;?>
						</div>

					</div>

				</div>

			</div>
		<?php else :?>
			<div class="pt-70 pb-80">
			<div class="container mt-5">
				<div class="row">
					<div class="flexslider">
						<ul class="slides">
							<?php foreach ($homeslider as $key => $value) :?>
								<li>
									<img src="<?php echo base_url_upload.$value->_enc_name;?>"/>
									<p class="flex-caption"><?php echo $value->_title;?></p>
								</li>
							<?php endforeach;?>
						</ul>
					</div>
				</div>
			</div>

			<?php endif;?>

			<div class="bg-light pt-80 pb-80">

				<div class="container">

					<div class="row">

						<div class="col-sm-10 col-sm-offset-1 col-md-8 col-md-offset-2">

							<div class="section-title">

								<h2>Daftar Lowongan</h2>

							</div>

						</div>

					</div>

					<div class="row">

						<div class="col-md-12" id="joblist">
								<div class="recent-job-wrapper alt-stripe mr-0">
										<?php foreach($lowongan as $k=>$value):?>
											<a href="<?php echo site_url('Index/Jobdetail').'/'.$value->lowongan_no;?>" class="recent-job-item clearfix">
													<div class="GridLex-grid-middle">
														<div class="GridLex-col-6_xs-12">
															<div class="job-position">
																<div class="image">
																	<img src="<?php echo base_url_upload.$value->_logo_enc_name;?>" alt="image">
																</div>
																<div class="content">
																	<h4><?php echo $value->_name ?></h4>
																	<p><?php echo $value->clientname?></p>
																</div>
															</div>
														</div>
														<div class="GridLex-col-4_xs-8_xss-12 mt-10-xss">
															<div class="job-location">
																<i class="fa fa-map-marker text-primary"></i> &nbsp;<?php echo $value->locname;?>
															</div>
														</div>
														<div class="GridLex-col-2_xs-4_xss-12">
																<div class="job-label label label-success">
																	<?php echo $value->type_lowongan;?>
																</div>
															<?php
																$date = $value->create_date;
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

															<span class="font12 block spacing1 font400 text-center"><?php echo $posted;?></span>
														</div>
													</div>
												</a>
										<?php endforeach;?>
								</div>

								<div class="pager-wrapper">

									<nav class="pager-right">
										<ul class="pagination">
											<li>
												<?php if(isset($prev)):?>
													<a data-val="<?php echo $prev?>" aria-label="Previous" onclick="prev(this);">
														<span aria-hidden="true">&laquo;</span>
													</a>
												<?php endif;?>
											</li>
											<li>
												<?php if(!empty($next)) :?>
													<a data-val="<?php echo $next;?>" aria-label="Next" onclick="next(this)">
														<span aria-hidden="true">&raquo;</span>
													</a>
												<?php endif;?>
											</li>
										</ul>
									</nav>

								</div>
						</div>

					</div>

				</div>

			</div>

		<?php include($includes . "/footer.php"); ?>

		</div>
		<!-- end Main Wrapper -->

	</div> <!-- / .wrapper -->
	<!-- end Container Wrapper -->
	<?php include($includes . "/footer-file.php"); ?>

<script type="text/javascript">
	prev = function(uid) {
			var valueHref=uid.getAttribute('data-val');
			$.ajax
			({
					type: "POST",
					url: "<?php echo site_url('Index/ajaxList');?>",
					data: {'page':valueHref},
					cache: false,
					success: function (html) {
							console.log(valueHref)
							$('#joblist').html(html);
					}
			});


	}
	next = function(uid) {
			var valueHref=uid.getAttribute('data-val');
			$.ajax
			({
					type: "POST",
					url: "<?php echo site_url('Index/ajaxList');?>",
					data: {'page':valueHref},
					cache: false,
					success: function (html) {
						console.log(valueHref)
						$('#joblist').html(html);
					}
			});
	}
</script>
