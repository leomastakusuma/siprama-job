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
						<li><a href="<?php echo site_url('');?>">Home</a></li>
						<li><span>Psikotes</span></li>
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

										<h2>Psikotes</h2>
										<p>Silahkan Jawab pertanyaan dibawah dengan baik dan benar.</p>

									</div>

									<div class="employee-detail-header">

										<ul class="meta-list clearfix">
											<li class="active">
												<h4 class="heading">Mulai Psikotes</h4>
											</li>
											<li>
												<h4 class="heading">Soal 1</h4>
											</li>
											<li>
												<h4 class="heading">Soal 2</h4>
											</li>
											<li>
												<h4 class="heading">Selesai</h4>
											</li>
										</ul>

									</div>

									<div class="register-success-wrapper">

										<div class="col-sm-10 col-md-8 col-sm-offset-1 col-md-offset-2">

											<div class="reg-success">

												<i class="ion-ios-lightbulb-outline"></i>

											</div>

											<h3>Wajib Mengisi Ujian Psikotes Online</h3>

											<p>“Kami perusahaan dibidang Jasa Penyedian  dan Pengelola Tenaga Alih Daya yang siap menjadi patner semua Industri Bisnis, diseluruh wilayah Indonesia. Meliputi rekrutment, penempatan kerja, pengawasan, evaluasi dan pengembangan Karyawan.”</p>


											<a href="<?php echo site_url('Psikotes/start')?>" class="btn btn-primary mt-15">Mulai Psikotes</a>

										</div>

									</div>

								</div>

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
