<!doctype html>
<html lang="en">
<?php $images = $this->config->item('images');
$icons = $this->config->item('icons');
$css = $this->config->item('css');
$js = $this->config->item('js');
$bootstrap = $this->config->item('bootstrap');
$includes = getcwd().'/application/views/templates/';

?>
<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Title Of Site -->
	<title>Siprama Cakrawala</title>
	<meta name="description" content="HTML Responsive Landing Page Template for Job Portal Based on Twitter Bootstrap 3.x.x">
	<meta name="keywords" content="job, work, resume, applicants, application, employee, employer, hire, hiring, human resource management, hr, online job management, company, worker, career, recruiting, recruitment">
	<meta name="author" content="crenoveative">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

	<!-- Fav and Touch Icons -->
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $images?>ico\apple-touch-icon-144-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo $images?>ico\apple-touch-icon-114-precomposed.png">
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $images?>ico\apple-touch-icon-72-precomposed.png">
	<link rel="apple-touch-icon-precomposed" href="<?php echo $images?>ico\apple-touch-icon-57-precomposed.png">
	<link rel="shortcut icon" href="<?php echo $images?>ico\favicon.png">

	<!-- CSS Plugins -->
	<link rel="stylesheet" type="text/css" href="<?php echo $bootstrap?>css\bootstrap.min.css" media="screen">
	<link href="<?php echo $css?>animate.css" rel="stylesheet">
	<link href="<?php echo $css?>main.css" rel="stylesheet">
	<link href="<?php echo $css?>component.css" rel="stylesheet">

	<!-- CSS Font Icons -->
	<link rel="stylesheet" href="<?php echo $icons?>linearicons\style.css">
	<link rel="stylesheet" href="<?php echo $icons?>font-awesome\css\font-awesome.min.css">
	<link rel="stylesheet" href="<?php echo $icons?>simple-line-icons\css\simple-line-icons.css">
	<link rel="stylesheet" href="<?php echo $icons?>ionicons\css\ionicons.css">
	<link rel="stylesheet" href="<?php echo $icons?>pe-icon-7-stroke\css\pe-icon-7-stroke.css">
	<link rel="stylesheet" href="<?php echo $icons?>rivolicons\style.css">
	<link rel="stylesheet" href="<?php echo $icons?>flaticon-line-icon-set\flaticon-line-icon-set.css">
	<link rel="stylesheet" href="<?php echo $icons?>flaticon-streamline-outline\flaticon-streamline-outline.css">
	<link rel="stylesheet" href="<?php echo $icons?>flaticon-thick-icons\flaticon-thick.css">
	<link rel="stylesheet" href="<?php echo $icons?>flaticon-ventures\flaticon-ventures.css">

	<!-- CSS Custom -->
	<link href="<?php echo $css?>style.css" rel="stylesheet">

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->

</head>


<body class="not-transparent-header">


	<div id="introLoader" class="introLoading"></div>

	<!-- start Container Wrapper -->
	<div class="container-wrapper">

		<!-- start Header -->
		<header id="header">

			<?php include($includes.'nav.php');?>

			<!-- end Navbar (Header) -->

		</header>

		<!-- start Main Wrapper -->
		<div class="main-wrapper">

			<!-- start hero-header -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list">
						<li><a href="<?php echo site_url();?>">Home</a></li>
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
											<li class="tg active" id="tg">
												<h4 class="heading">TANGGUNG JAWAB</h4>
											</li>
											<li class="ik" id="ik">
												<h4 class="heading">INTEGRITAS & KEJUJURAN</h4>
											</li>
											<li class="ikr" id="ikr">
												<h4 class="heading">INISIATIF & KREATIFITAS</h4>
											</li>
											<li class="tm" id="tm">
												<h4 class="heading">TEAMWORK</h4>
											</li>
										</ul>

									</div>

									<form class="post-form-wrapper" method="POST" action="simpanjawaban">

										<div class="row gap-20">
                        <form>
      											<div class="col-sm-12 col-md-12 tanggungjawab">
                              <?php foreach ($TanjungJawab as $key => $value) :?>
																		<label ><?php echo $value->_pertanyaan?></label>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-1" name="<?php echo $value->soal_id;?>"  value="a" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-1"><?php echo $value->_opsi_a;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-2" name="<?php echo $value->soal_id;?>" value="b" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-2"><?php echo $value->_opsi_b;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-3" name="<?php echo $value->soal_id;?>" value="c"type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-3"><?php echo $value->_opsi_c;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-4" name="<?php echo $value->soal_id;?>" value="d" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-4"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <br/>
                              <?php endforeach;?>
                              <div class="clear mb-15"></div>
        											<div class="col-sm-12 mt-10">
        												<input class="btn btn-primary" onclick="IntegritasK()" name="Next" value="Next">
        											</div>
      											</div>
                            <div class="col-sm-12 col-md-12 IntegritasKejujuran" style="display:none">
                              <?php foreach ($IntegritasKejujuran as $key => $value) :?>
                                    <label class="mb-10"><?php echo $value->_pertanyaan?></label>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-1" name="<?php echo $value->soal_id;?>" value="a" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-1"><?php echo $value->_opsi_a;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-2" name="<?php echo $value->soal_id;?>" value="b" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-2"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-3" name="<?php echo $value->soal_id;?>" value="c" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-3"><?php echo $value->_opsi_c;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-4" name="<?php echo $value->soal_id;?>" value="d" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-4"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <br/>
                              <?php endforeach;?>
                              <div class="clear mb-15"></div>
        											<div class="col-sm-12 mt-10">
                                <input class="btn btn-primary" onclick="tanggungjawab()" name="Previous" value="Previous">
        												<input class="btn btn-primary" name="Next" value="Next" onclick="InisiatifKreatifitas()">
        											</div>
                            </div>
                            <div class="col-sm-12 col-md-12 InisiatifKreatifitas" style="display:none">
                              <?php foreach ($InisiatifKreatifitas as $key => $value) :?>
                                    <label class="mb-10"><?php echo $value->_pertanyaan?></label>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-1" name="<?php echo $value->soal_id;?>" value="a" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-1"><?php echo $value->_opsi_a;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-2" name="<?php echo $value->soal_id;?>" value="b" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-2"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-3" name="<?php echo $value->soal_id;?>" value="c" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-3"><?php echo $value->_opsi_c;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-4" name="<?php echo $value->soal_id;?>" value="d" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-4"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <br/>
                              <?php endforeach;?>
                              <div class="clear mb-15"></div>
        											<div class="col-sm-12 mt-10">
                                <input  class="btn btn-primary" name="Previos" value="Previos" onclick="IntegritasK()">
        												<input  class="btn btn-primary" name="Next" value="Next" onclick="Teamwork()">
        											</div>
                            </div>
                            <div class="col-sm-12 col-md-12 Teamwork" style="display:none">
                              <?php foreach ($Teamwork as $key => $value) :?>
                                    <label class="mb-10"><?php echo $value->_pertanyaan?></label>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-1" name="<?php echo $value->soal_id;?>" value="a" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-1"><?php echo $value->_opsi_a;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-2" name="<?php echo $value->soal_id;?>" value="b" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-2"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-3" name="<?php echo $value->soal_id;?>" value="c" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-3"><?php echo $value->_opsi_c;?></label>
                                    </div>
                                    <div class="radio-block">
                                      <input id="<?php echo $value->soal_id;?>-4" name="<?php echo $value->soal_id;?>" value="d" type="radio" class="radio">
                                      <label for="<?php echo $value->soal_id;?>-4"><?php echo $value->_opsi_d;?></label>
                                    </div>
                                    <br/>
                              <?php endforeach;?>
                              <div class="clear mb-15"></div>
        											<div class="col-sm-12 mt-10">
                                <input class="btn btn-primary" name="Previos" value="Previos" onclick="InisiatifKreatifitas()">
																<input type="submit"  class="btn btn-primary"  value="Simpan Jawaban" name="Simpan Jawaban">
        											</div>
                            </div>
                        </form>
										</div>
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>

			<footer class="footer-wrapper">

				<div class="main-footer">

					<div class="container">

						<div class="row">

							<div class="col-sm-12 col-md-12">

								<div class="footer-about-us">
									<h5 class="footer-title">about Cakrawala</h5>
									<p>“Kami perusahaan dibidang Jasa Penyedian  dan Pengelola Tenaga Alih Daya yang siap menjadi patner semua Industri Bisnis, diseluruh wilayah Indonesia. Meliputi rekrutment, penempatan kerja, pengawasan, evaluasi dan pengembangan Karyawan.”</p>
								</div>

							</div>

						</div>

					</div>

				</div>

				<div class="bottom-footer">

					<div class="container">

						<div class="row">

							<div class="col-sm-12 col-md-12">

								<p class="copy-right">&#169; Copyright 2016 Siprama Cakrawala</p>

							</div>

						</div>

					</div>

				</div>

			</footer>

		</div>
		<!-- end Main Wrapper -->

	</div> <!-- / .wrapper -->
	<!-- end Container Wrapper -->


<!-- start Back To Top -->
<div id="back-to-top">
   <a href="#"><i class="ion-ios-arrow-up"></i></a>
</div>
<!-- end Back To Top -->


<!-- JS -->
<script type="text/javascript" src="<?php echo $js?>jquery-1.11.3.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="<?php echo $bootstrap?>js\bootstrap.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap-modalmanager.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap-modal.js"></script>
<script type="text/javascript" src="<?php echo $js?>smoothscroll.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.easing.1.3.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.waypoints.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>wow.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.slicknav.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.placeholder.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap-tokenfield.js"></script>
<script type="text/javascript" src="<?php echo $js?>typeahead.bundle.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap3-wysihtml5.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap-select.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery-filestyle.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>bootstrap-select.js"></script>
<script type="text/javascript" src="<?php echo $js?>ion.rangeSlider.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>handlebars.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.countimator.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.countimator.wheel.js"></script>
<script type="text/javascript" src="<?php echo $js?>slick.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>easy-ticker.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.introLoader.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>jquery.responsivegrid.js"></script>
<script type="text/javascript" src="<?php echo $js?>customs.js"></script>

<script type="text/javascript" src="<?php echo $js?>fileinput.min.js"></script>
<script type="text/javascript" src="<?php echo $js?>customs-fileinput.js"></script>

<script type="text/javascript" src="<?php echo $js?>jquery.sheepItPlugin.js"></script>
<script type="text/javascript" src="<?php echo $js?>customs-sheepItPlugin.js"></script>


<script type="text/javascript">
function disableF5(e) { if ((e.which || e.keyCode) == 116) e.preventDefault(); };
$(document).on("keydown", disableF5);
	function IntegritasK(){
		 $('.IntegritasKejujuran').show();
		 $('.tanggungjawab').hide();
		 $('.InisiatifKreatifitas').hide();
		 $('.Teamwork').hide();
		 var tg = document.getElementById("tg");
		 tg.className = "";
		 var ik = document.getElementById("ik");
		 ik.className += " active";
		 var ikr = document.getElementById("ikr");
 		 ikr.className = " ";

	}
	function tanggungjawab(){
		 $('.IntegritasKejujuran').hide();
		 $('.InisiatifKreatifitas').hide();
		 $('.Teamwork').hide();
		 $('.tanggungjawab').show();
		 var tg = document.getElementById("tg");
		 tg.className += " active";
		 var ik = document.getElementById("ik");
		 ik.className = " ";
		 var ikr = document.getElementById("ikr");
 		 ikr.className = " ";

	}
	function InisiatifKreatifitas(){
		 $('.Teamwork').hide();
		 $('.tanggungjawab').hide();
		 $('.IntegritasKejujuran').hide();
		 $('.InisiatifKreatifitas').show();
		 var ik = document.getElementById("ik");
		 ik.className = " ";
		 var tg = document.getElementById("tg");
		 tg.className = " ";
		 var tm = document.getElementById('tm');
		 tm.className =" ";
		 var ikr = document.getElementById("ikr");
		 ikr.className += " active";
	}
	function Teamwork(){
		 $('.Teamwork').show();
		 $('.InisiatifKreatifitas').hide();
		 $('.IntegritasKejujuran').hide();
		 $('.tanggungjawab').hide();
		 var ik = document.getElementById("ik");
		 ik.className = " ";
		 var tg = document.getElementById("tg");
		 tg.className = " ";
		 var ikr = document.getElementById("ikr");
		 ikr.className = " ";
		 var tm = document.getElementById('tm');
		 tm.className +=" active";
	}
</script>

</body>


</html>
