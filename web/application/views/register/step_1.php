
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
		  <?php include($includes.'nav.php');?>
			<!-- end Navbar (Header) -->

		</header>

		<!-- start Main Wrapper -->
		<div class="main-wrapper">

			<!-- start hero-header -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list">
						<li><a href="<?php echo site_url('')?>">Home</a></li>
						<li><span>Mendaftar</span></li>
					</ol>

				</div>

			</div>
			<!-- end hero-header -->

			<div class="admin-container-wrapper">

				<div class="container">

					<div class="GridLex-gap-15-wrappper">

						<div class="GridLex-grid-noGutter-equalHeight">

							<div class="GridLex-col-12_sm-12_xs-12">

								<div class="admin-content-wrapper">

									<div class="admin-section-title">

										<h2>Daftar</h2>
										<p></p>

									</div>

								<?php if (validation_errors()!="" || !empty($_SESSION['error'])) :?>
											<div class="row">
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
									<div class="employee-detail-header">


									</div>

									<form class="post-form-wrapper mid-top" method="post" action="<?php echo site_url('Register/step1')?>" enctype="multipart/form-data">
											<div class="row gap-20">
												<div class="col-sm-12 col-md-6">
													<div class="form-group">
														<label>Email</label>
														<input type="text" class="form-control" placeholder="Email" name="email">
													</div>
												</div>
												<div class="clear"></div>
												<div class="col-sm-12 col-md-6">
													<div class="form-group">
														<label>Password</label>
														<input type="password" class="form-control" placeholder="Password" name="password">
													</div>
												</div>
												<div class="clear"></div>
												<div class="col-sm-12 col-md-6">
													<div class="form-group">
														<label>Resume (CV)</label>
														<input type="file" class="form-control" placeholder="resume" name="resume">
													</div>
												</div>
												<div class="clear"></div>

												<div class="col-sm-12 mt-10">
													<input type="submit" class="btn btn-primary" name="Register" value="Register">
													<!-- <a href="register-step2.html" class="btn btn-primary">Register</a> -->
												</div>
											</div>
											<div class="clear"></div>
											<div class="clear"></div>

										</form>

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
