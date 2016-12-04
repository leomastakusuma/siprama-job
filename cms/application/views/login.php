<?php
$images = $this->config->item('images');
$css = $this->config->item('css');
$css = $this->config->item('css');
$js = $this->config->item('js');
$assets = $this->config->item('assets');
$j = base64_encode("JSOff") ;
?>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="keyword" content="">
    <link rel="shortcut icon" href="img/favicon.png">

    <title>Recruitment System - MYR Inc.</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo $css ?>bootstrap.min.css" rel="stylesheet">
    <link href="<?php echo $css ?>bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="<?php echo $assets ?>font-awesome/css/font-awesome.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="<?php echo $css ?>style.css" rel="stylesheet">
    <link href="<?php echo $css ?>style-responsive.css" rel="stylesheet" />

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo $assets ?>jshtml5shiv.js"></script>
    <script src="<?php echo $js ?>respond.min.js"></script>
    <![endif]-->
    <?php
    $csrf = array(
        'name' => $this->security->get_csrf_token_name(),
        'hash' => $this->security->get_csrf_hash(),
    );?>
</head>
  <noscript><meta http-equiv="refresh" content="0.5;url=notSupported.php?x=<?php echo $j; ?>"></noscript>

  <body class="login-body">

    <div class="container">

      <form class="form-signin" action="<?php echo base_url() ?>logincms/process" method="post" id="form">
        <h2 class="form-signin-heading">sign in now</h2>
        <div class="login-wrap">
            <input type="text" class="form-control" name="username" id="username" placeholder="username" value="" required autofocus>
            <input type="password" class="form-control" name="password" id="password" value="" placeholder="Password" required>

            <div style='margin-bottom:15px'>
              <?php #echo $this->recaptcha->render();?>
            </div>
            <!-- <label class="checkbox">
                <input type="checkbox" value="remember-me"> Remember me
                <span class="pull-right">
                    <a data-toggle="modal" href="#myModal"> Forgot Password?</a>

                </span>
            </label> -->
            <button class="btn btn-lg btn-login btn-block" type="button" id="login">Sign in </button>
			<?= null != validation_errors() ? validation_errors() : "" ?>
			<?= isset($err) ? $err : "" ?>
      <div align='center'><?php echo $this->session->flashdata('change');?></div>
        </div>

          <!-- Modal -->
          <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
              <div class="modal-dialog">
                  <div class="modal-content">
                      <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title">Forgot Password ?</h4>
                      </div>
                      <div class="modal-body">
                          <p>Enter your e-mail address below to reset your password.</p>
                          <input type="text" name="email" placeholder="Email" autocomplete="off" class="form-control placeholder-no-fix">

                      </div>
                      <div class="modal-footer">
                          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
                          <button class="btn btn-success" type="button">Submit</button>
                      </div>
                  </div>
              </div>
          </div>
          <!-- modal -->
          <input type='hidden'  name="<?=$csrf['name'];?>" value="<?=$csrf['hash'];?>">

      </form>

    </div>



    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $js ?>jquery.js"></script>
    <script src="<?php echo $js ?>bootstrap.min.js"></script>
    <script  type="text/javascript">
        $(document).ready(function(){
              $('#login').click(function () {
                  var login = $('#password').val();
                  $.ajax
                  ({
                      type: "GET",
                      url: "<?php echo site_url()?>Logincms/GeneratePassword/"+login,
                      cache: false,
                      success: function (html) {
                          $('#password').val(html);
                          $('form').submit();
                      }
                  });
              });
        });
    </script>

  </body>
</html>
