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

			<!-- start breadcrumb -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list booking-step">
						<li><a href="<?php echo site_url()?>">Home</a></li>
						<li><span>Profile</span></li>
					</ol>

				</div>

			</div>
			<!-- end breadcrumb -->

			<div class="admin-container-wrapper">

				<div class="container">

					<div class="GridLex-gap-15-wrappper">

						<div class="GridLex-grid-noGutter-equalHeight">
              <div class="GridLex-col-3_sm-4_xs-12">

                <div class="admin-sidebar">

                  <div class="admin-user-item">

                    <div class="image">
                      <img src="<?php  echo base_url_upload_web.$personalInfo->_photo_enc_name;?>" alt="image" class="img-circle">
                    </div>

                    <h4><?php echo $personalInfo->_fullname?></h4>
                    <p class="user-role"><?php echo $userInfo->_email?></p>

                  </div>

                  <?php require ($includes.'menu.php');?>

                </div>

              </div>

              <div class="GridLex-col-9_sm-8_xs-12">

                <div class="admin-content-wrapper">

									<div class="admin-section-title">

										<h2>Data Akun</h2>

									</div>

									<?php require ($includes.'alert.php');?>

									<form class="post-form-wrapper" method="post" action="<?php echo site_url('Profile')?>" enctype="multipart/form-data">

										<div class="row gap-20 mid-top">
											<div class="col-sm-6 col-md-6">

												<div class="form-group">
													<label>Email</label>
													<input type="text" class="form-control" value="<?php echo $userInfo->_email?>" name="email">
												</div>

											</div>

											<div class="clear"></div>

											<div class="col-sm-6 col-md-6">

												<div class="form-group">
													<label>Resume/CV</label>
                          <input type="hidden" name="realname" value="<?php echo $userInfo->_resume_real_name?>">
                          <input type="hidden" name="url" value="<?php echo $userInfo->_resume_url?>">

													<input type="text" class="form-control" value="<?php echo $userInfo->_resume_real_name?>" readonly>
													<div class="mt-10">
														<button type="submit" class="btn btn-default" name="download" value="download">Download</button>
														<button type="submit" class="btn btn-default" name="remove" value="remove">Remove</button>
														<div class="btn btn-primary btn-file">
															Browse
															<input type="file" name="upload-resume" id="upload-resume">
														</div>
													</div>
												</div>

											</div>

											<div class="clear"></div>

											<div class="col-sm-12 mt-10">
                        <button type="submit" class="btn btn-default" name="update" value="update">Update</button>
											</div>

										</div>

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
      <script type="text/javascript" src="<?php echo $bootstrap?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
      <script type="text/javascript">
      var height = window.screen.height;
      var width = window.screen.width
      if(height > 640 && width > 340){
        $('#desktop').show();
        $('#mobile').hide();

      }else{
        $('#desktop').hide();
        $('#mobile').show();
      }
      </script>
