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

										<h2>Status Lamaran</h2>

									</div>

									<div class="resume-list-wrapper">
										<?php foreach ($statusLamaran as $key => $value) :?>
											<div class="resume-list-item">

												<div class="row">

													<div class="col-sm-12 col-md-10">

														<div class="content">

															<a href="#">

																<h4><?php echo $value->_name ?></h4>

																<div class="row mb-10">
																	<div class="col-sm-12 col-md-3">
																		<strong class="mr-10">Posisi</strong>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<strong class="mr-10">Tipe</strong>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<strong class="mr-10">Tanggal Lamaran</strong>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<strong class="mr-10">Status</strong>
																	</div>
																</div>

																<div class="row">
																	<div class="col-sm-12 col-md-3">
																		<span class="mr-10"><?php echo $value->lowongan_posisi ?></span>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<span class="mr-10"><?php echo $value->type_lowongan_name;?></span>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<span class="mr-10"><?php echo $value->tanggal_lamar;?></span>
																	</div>
																	<div class="col-sm-12 col-md-3">
																		<span class="label label-info"><?php echo $value->status_lamar_name;?></span>
																	</div>
																</div>

															</a>

														</div>

													</div>

													<div class="col-sm-12 col-md-2">

														<div class="resume-list-btn">

															<a  target="_blank" href="<?php echo site_url('Index/Jobdetail').'/'.$value->lowongan_no;?>"class="btn btn-primary btn-sm mb-5 mb-0-sm">Detail</a>
															<?php if($value->status_apply_lowongan_id != 'STATUSINTCL01') :?>
															<form method="post" action="<?php echo site_url('Psikotes/updateApplyLowongan');?>">
																<input type="hidden" name="apply_lowongan_no" value="<?php echo $value->apply_lowongan_no?>">
																<input type="submit"  class="btn btn-primary btn-sm btn-inverse" name="Batal" value="Batal"   onclick="return confirm('Yakin Akan Membatalkan Lamaran ?');">
															</form>
															<?php endif;?>
														</div>

													</div>

												</div>

											</div>

										<?php endforeach;?>

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
