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

										<h2>Data keluarga</h2>

									</div>

                  <div class="admin-empty-dashboard">

                    <div class="icon">
                      <i class="ion-ios-people-outline"></i>
                    </div>

                    <h4>Maaf, data keluarga hanya untuk yang sudah memiliki status menikah.</h4>

                  </div>
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
