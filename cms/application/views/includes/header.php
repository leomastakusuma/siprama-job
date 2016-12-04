<?php
$images = $this->config->item('images');
$css = $this->config->item('css');
$css = $this->config->item('css');
$js = $this->config->item('js');
$assets = $this->config->item('assets');
$j = base64_encode("JSOff");
?>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="NET Portal">
    <meta name="keyword" content="">

    <link rel="shortcut icon" href="public_<?php echo $assets ?>img/favicon.png">


    <title>Recruitment System</title>

    <!-- Bootstrap core CSS -->

    <link href="<?php echo $css ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $css ?>bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo $assets ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <link href="<?php echo $assets ?>jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="<?php echo $css ?>owl.carousel.css" type="text/css">
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-fileupload/bootstrap-fileupload.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-datepicker/css/datepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-timepicker/compiled/timepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-colorpicker/css/colorpicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-daterangepicker/daterangepicker-bs3.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>bootstrap-datetimepicker/css/datetimepicker.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo $assets ?>jquery-multi-select/css/multi-select.css" />
    <link rel="stylesheet" href="<?php echo $assets ?>jquery-ui/jquery-ui-1.10.1.custom.min.css">
    <link rel="stylesheet" href="<?php echo $assets ?>select/select2.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>

    <script src="<?php echo $js?>bootstrap-dropdownhover.min.js"></script>

    <!-- Custom styles for this template -->
    <link rel="stylesheet" href="<?php echo $css ?>style.css" rel="stylesheet">
    <link href="<?php echo $css ?>home.css" rel="stylesheet">
    <link href="<?php echo $css ?>bootstrap-dropdownhover.min.css" rel="stylesheet">

    <link href="<?php echo $css ?>style-responsive.css" rel="stylesheet" />
    <link rel="stylesheet" href="<?php echo $css ?>custom-style.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
<?php include("js-general.php"); ?>


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
<noscript><meta http-equiv="refresh" content="0.5;url=notSupported.php?x=<?php echo $j; ?>"></noscript>
