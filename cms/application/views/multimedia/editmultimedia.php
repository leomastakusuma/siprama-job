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
            <h3 class="m-bot15"> Management Multimedia </h3>
            <div class="row">
                <div class="col-lg-12">
                  <!--breadcrumbs start -->
                  <ul class="breadcrumb">
                      <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                      <li><a href="<?php echo site_url('Multimediacms')?>">Multimedia</a></li>
                      <li class="active">Edit Mutlimedia</li>
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
                                       <form  action="<?php echo base_url() ?>Multimediacms/editmultimedia" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name</label>
                                          <div class="col-lg-8">
                                             <input type="hidden" class="form-control" id="MultimediaID" name="MultimediaID" value="<?php echo $result['multimediabank_no']?>">

                                              <input type="text" class="form-control" id="title" name="title" value="<?php echo !empty($_POST['title'])  ?  $_POST['title']  : $result['_title'] ?>"  placeholder="Title" required maxlength="59">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Description</label>
                                            <div class="col-lg-8">
                                                <textarea name="desc" class="form-control" placeholder="Description"><?php echo !empty($_POST['desc'])  ?  $_POST['desc']  : $result['_desc']?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Image</label>
                                            <div class="col-lg-8">
                                              <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                                  <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                                  <i><font size="1" color="green">Minimum <?php echo minw169;?>x<?php echo minh169;?> px</font></i></p>
                                                  Ext : (jpg|jpeg|png)
                                                  <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 350px; height: 250px; background: #eee;">
                                                        <?php if(!empty($result['_url'])){
                                                            echo '<img  style="width: 340px; height: 240px; width="340" height="240" src="'.$result['_url'].'" />';
                                                        }?>
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail"
                                                           style="max-width: 350px; max-height: 250px; line-height: 20px;"></div>
                                                      <div>
                                                          <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                          <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                          <input type="file" class="default" name='image' id="image">
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

        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }
        var _URL = window.URL || window.webkitURL;
        $('input[name=image]').change(function () {
            var val = $(this).val().toLowerCase();
            var regex = new RegExp("(.*?)\.(jpg|jpeg|png)$");

            if(val===""){

            }else{
                if(!(regex.test(val))) {
                    $(this).val('');
                    alert('Please select correct file format');
                }/*else{
                 var fr = new FileReader;
                 fr.onload = function() {
                       var img = new Image;
                       img.onload = function() {
                           var w = this.width;
                           var h = this.height;
                           if(this.width<'<?php echo minw169;?>' || this.height<'<?php echo minh169;?>'){
                               $('.fileupload2').fileupload('clear');
                               alert('mohon upload image minimum <?php echo minw169;?>x<?php echo minh169;?>px');
                           }
                          //  alert(img.width);
                       };
                       img.src = fr.result;
                 };
                 fr.readAsDataURL(this.files[0]);
               }*/
            }
      });
    </script>
</body>
