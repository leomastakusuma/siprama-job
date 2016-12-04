<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php"); ?>

<body>
    <?php include("includes/nav.php"); ?>
<?php include("includes/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
        <div class="row">
            <div class="col-lg-6">
                <h3 class="m-bot15"> Edit Branch</h3>
            </div>
            <div class="col-lg-6" align='right' style='padding-top:15px'>
                    <button type="submit" class='btn btn-success' onclick="editedarticle(this.value)" value="<?php echo $edit[0]->branch_id ; ?>"> <i class="fa fa-refresh"></i> Refresh</button>
            </div>
        </div>
						         <?= null != validation_errors() ? validation_errors() : "" ?>
         <?= isset($err) ? $err : "" ?>
            <div class="row">
                <div class="col-lg-12">
                             <!--breadcrumbs start -->
                        <?php include("includes/breadcrumb.php"); ?>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <!-- COL LEFT -->






					 <div class="col-lg-12" id="panel1">

                    <section class="panel">

                        <div class="panel-body">
                          <div class="col-lg-15">

                      <section class="panel">
                  <?php foreach($edit  as $r): ?>

                                 <form  action="<?php echo base_url() ?>Managementbrandcms/update_brand" method="post">
                                  <div class="form-group">
                                      <div class="iconic-input">
                                          <input type="text" class="form-control" id="name" name="name" value="<?php echo $r->_name; ?>" placeholder="Brand" required maxlength="59">
                                      </div>
                                  </div>
								  <div class="form-group">
                                      <div class="iconic-input">
                                          <input type="text" class="form-control" id="address" name="address" value="<?php echo $r->_address; ?>" placeholder="Address" required maxlength="249">
                                      </div>
                                  </div>
								    <div class="form-group">
                                      <div class="iconic-input">
                                          <input type="text" class="form-control" id="phone" name="phone" value="<?php echo $r->_phone; ?>" placeholder="Phone" required maxlength="24">
                                      </div>
                                  </div>
								   <div class="form-group">
							<div class="form-group">
                                      <div class="iconic-input">
                                          <input type="hidden" class="form-control" id="brand_no" name="brand_no" value="<?php echo $r->branch_id ; ?>" placeholder="Keyword Number">
                                      </div>
                                  </div>

  <a class="btn btn-danger kanan" onclick="konfirmasi_cancel('<?php echo base_url() ?>managementbrandcms')" >Cancel</a>
                     <button class="btn btn-success kanan clicking" type="submit">Update Branch</button>
                              </form>
 <?php endforeach; ?>
                      </section>
                      <!--work progress end-->
                  </div>
              </div>

                        </div>
                </div>



                <!-- COL RIGHT -->

            </div>
        </section>
        <!-- footer -->
        <?php include("includes/footer.php"); ?>
    </section>
     <!-- notif footer general -->
        <?php include("includes/footer-notif-general.php"); ?>
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
<script src="<?php echo $js;?>jquery.cookie.js"></script>
    <script>
        // demo close footer notification
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
        function editedarticle(id){
            var csrftknajax = $.cookie('<?php echo $this->security->get_csrf_token_name();?>');
            var urlx = "<?php echo base_url();?>Managementbrandcms/brandOperation";
            $().redirect_pageself(urlx,{
              "brand_no": id,
              "edit" : id,
              "<?php echo $this->security->get_csrf_token_name();?>" : csrftknajax,
            });
        }
        $('#toPublish').on('click', function() {
            $(".notif-footer").addClass('show success');
            setTimeout(function() {
               $(".notif-footer").removeClass('show success');
           }, 1500);
        });
        $('#toUnPublish').on('click', function() {
            $(".notif-footer").addClass('show failed');
            setTimeout(function() {
               $(".notif-footer").removeClass('show failed');
           }, 1500);
        });
        $('.icon-remove').on('click', function() {
            $(".notif-footer").removeClass('show success failed');
        });
    </script>
</body>
