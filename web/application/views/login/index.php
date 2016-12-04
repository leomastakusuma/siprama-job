
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
			<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

			  <div class="container">

			    <div class="logo-wrapper">
			      <div class="logo">
			        <a href="<?php echo site_url()?>"><img src="<?php echo $images?>big_logo.png" alt="Logo"></a>
			      </div>
			    </div>

			    <div class="nav-mini-wrapper">
			      <ul class="nav-mini sign-in">
			      </ul>
			    </div>

			  </div>

			</nav>


			<!-- end Navbar (Header) -->

		</header>

		<!-- start Main Wrapper -->
		<div class="main-wrapper">


			<div class="admin-container-wrapper">

				<div class="container">

					<div class="GridLex-gap-15-wrappper">

						<div class="GridLex-grid-noGutter-equalHeight">


									 <div class="login-container-wrapper">

						 				<div class="container">

						 					<div class="row">

						 						<div class="col-md-10 col-md-offset-1">

						 							<div class="row">

						 								<div class="col-sm-6 col-sm-offset-3">

						 									<div class="login-box-wrapper">

						 										<div class="modal-header">
						 											<h4 class="modal-title text-center">Kandidat Masuk</h4>
						 										</div>
																<?php if (validation_errors()!="" || !empty($_SESSION['error'])) :?>
																		<div class="row mid-top">
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
						 										<div class="modal-body">
						 											<div class="row gap-20">
																		<form method="post" action="<?php echo site_url('Login/proses');?>" enctype="multipart/form-data">
						 												<div class="col-sm-12 col-md-12">

						 													<div class="form-group">
						 														<label>Username</label>
						 														<input class="form-control" placeholder="Email" type="text" name="email">
						 													</div>

						 												</div>

						 												<div class="col-sm-12 col-md-12">

						 													<div class="form-group">
						 														<label>Password</label>
						 														<input class="form-control" placeholder="Password" type="password" name="password">
						 													</div>

						 												</div>

						 												<div class="col-sm-6 col-md-6">
						 													<!-- <div class="checkbox-block">
						 														<input id="remember_me_checkbox" name="remember_me_checkbox" class="checkbox" value="First Choice" type="checkbox">
						 														<label class="" for="remember_me_checkbox">Remember me</label>
						 													</div> -->
						 												</div>

						 												<div class="col-sm-6 col-md-6">
						 													<!-- <div class="login-box-link-action">
						 														<a href="<?php echo site_url();?>">Forgot password?</a>
						 													</div> -->
						 												</div>

						 												<div class="col-sm-12 col-md-12">
						 													<div class="login-box-box-action">
						 														Tidak memiliki akun ? Harap <a href="<?php echo site_url('Register');?>">daftar</a> terlebih dahulu.
						 													</div>
						 												</div>

						 											</div>
						 										</div>

						 										<div class="modal-footer text-center">
						 											<button type="submit" class="btn btn-primary" >Masuk</button>
						 										</div>
															</form>
						 									</div>


						 								</div>

						 							</div>

						 						</div>

						 					</div>

						 				</div>

						 			</div>


								</div>

							<!-- </div> -->

						</div>

					</div>

				</div>

			</div>


		</div>
		<!-- end Main Wrapper -->
		<?php include($includes.'footer.php');?>

	</div> <!-- / .wrapper -->
	<!-- end Container Wrapper -->



<?php include($includes.'footer-file.php');?>
