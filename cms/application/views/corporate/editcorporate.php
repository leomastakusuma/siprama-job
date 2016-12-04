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
            <h3 class="m-bot15"> Management Corporate </h3>
            <div class="row">
                <div class="col-lg-12">
                  <!--breadcrumbs start -->
                  <ul class="breadcrumb">
                      <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                      <li><a href="<?php echo site_url('corporatecms')?>">Corporate</a></li>
                      <li class="active">Edit Corporate</li>
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
      				 <div class="col-xs-9" id="panel1">
                          <section class="panel">
                            <header class="panel-heading">
                              Content Branch
                            </header>
                              <div class="panel-body">
                                <div class="form-horizontal">
                                       <form  action="<?php echo base_url() ?>corporatecms/editcorporate" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name</label>
                                          <div class="col-lg-8">
                                             <input type="hidden" class="form-control" id="corporate_id" name="corporate_id" value="<?php echo $result['corporate_id']?>"  placeholder="Brand name" required maxlength="59">

                                              <input type="text" class="form-control" id="name" name="name" value="<?php echo $result['_name']?>"  placeholder="Brand name" required maxlength="59">
                                            </div>
                                        </div>
      								                  <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Address</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="address" name="address"  value="<?php echo $result['_address']?>" placeholder="Address" required maxlength="244">
                                            </div>
                                        </div>
      								                  <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Phone</label>
                                            <div class="col-lg-8">
                                                <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"  value="<?php echo $result['_phone']?>"required maxlength="24">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Logo</label>
                                            <div class="col-lg-8">
                                              <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                                  <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                                  <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px; background: #eee;">
                                                        <?php if(!empty($result['_logo_url'])){
                                                            echo '<img  style="width: 190px; height: 140px; width="190" height="140" src="'.$result['_logo_url'].'" />';
                                                        }?>
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail"
                                                           style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                          <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                          <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                          <input type="file" class="default" name='logo' id="logo">
                                                          </span>
                                                          <a href="#" class="btn btn-danger fileupload-exists"
                                                             data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp</label>
                                          <div class="col-lg-8">
                                            <button id="toPublishs" type="submit"  class="col-lg-2 col-sm-2  btn btn-primary clicking" name="method" value="save"> Save </button>
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
    <script src="<?php echo $js ?>jquery.scrollTo.min.js"></script>`
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
    <script>
        // demo close footer notification
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
