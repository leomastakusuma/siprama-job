<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

<!-- main content start -->
<style>
    .cancelling{
        display:none;
    }
</style>
    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <h3 class="m-bot15">Laporan </h3>
            <div class="row">
                <div class="col-lg-12">
                  <!--breadcrumbs start -->
                  <ul class="breadcrumb">
                      <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                      <li><a href="#">Laporan Rekapitulasi Pelamar Lolos</a></li>
                  </ul>
                  <!--breadcrumbs end -->
                </div>
            </div>
            <?php $session = $this->session->all_userdata();?>

            <?php
            if (validation_errors()!="")
            {
                ?>
                <div class="row">
                    <div class="col-lg-12">
                    <div class="alert alert-block alert-danger fade in">
                        <button data-dismiss="alert" class="close close-sm" type="button">
                            <i class="icon-remove"></i>
                        </button>
                        <?php echo validation_errors(); ?>
                    </div>
                    </div>
                </div>
                <?php
            }
            ?>
            <div class="row">
      				 <div class="col-xs-12" id="panel1">
                          <section class="panel">
                            <header class="panel-heading">
                              Laporan Rekapitulasi Pelamar Lolos
                            </header>
                              <div class="panel-body">
                                <div class="form-horizontal">
                                       <form  action="<?php echo base_url() ?>Laporancms/pelamarRekapitulasiLolos" method="post" target="_blank">
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Priode Awal</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="from" name="start" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Priode Awal</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="datethru" name="end">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp</label>
                                          <div class="col-lg-4">
                                            <button id="toPublishs" type="submit"  class="col-lg-2 col-sm-2  btn btn-primary clicking pull-right" name="method" value="save"> Save </button>
                                          </div>

                                        </div>

                                </div>
                             </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <!-- footer -->
        <?php include($includes . "/footer.php"); ?>    </section>
     <!-- notif footer general -->
    <!-- JS General -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $js ?>jquery.js"></script>
    <script src="<?php echo $js ?>bootstrap.min.js"></script>
    <script class="include" type="text/javascript"src="<?php echo $js ?>jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $js ?>jquery.scrollTo.min.js"></script>
    <script src="<?php echo $js ?>jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo $js ?>respond.min.js"></script>
    <script src="<?php echo $js ?>jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="<?php echo $js ?>bootstrap-switch.js"></script>
    <!--this page plugins-->
    <script type="text/javascript" src="<?php echo $assets ?>fuelux/js/spinner.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>ckeditor/ckeditor.js"></script>
    <!--common script for all pages-->
    <script src="<?php echo $js ?>common-scripts.js"></script>
    <!--this page  script only-->
    <script src="<?php echo $js ?>add-article.js"></script>
    <script type="text/javascript">
          var editor = CKEDITOR.replace("desc", {
              height: 400
          });
    </script>
    <script type="text/javascript">
          var editor = CKEDITOR.replace("persyaratan", {
              height: 400
          });
    </script>
    <script>
      $('.form_datetime2').datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight:'TRUE',
          autoclose: true,
      });
    </script>

</body>
