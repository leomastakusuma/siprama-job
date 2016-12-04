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
            <h3 class="m-bot15"> Management Home Slider</h3>
            <div class="row">
                <div class="col-lg-12">
                  <!--breadcrumbs start -->
                  <ul class="breadcrumb">
                      <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                      <li><a href="<?php echo site_url('Lowongancms')?>">Home Slider</a></li>
                      <li class="active">Add Home Slider </li>
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
                              Content Homeslider
                            </header>
                              <div class="panel-body">
                                <div class="form-horizontal">
                                       <form  action="<?php echo base_url() ?>Homeslidercms/addhomeslider" method="post" enctype="multipart/form-data">
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Multimedia Title</label>
                                             <div class="col-lg-9">
                                                <select class="form-control m-bot15 multimedia" id="multimedia" name='multimediabank_no'>
                                                  <option value="">Pilih Multimedia</option>
                                                    <?php foreach ($listMulitmediaBank as $row=>$baris) :?>
                                                      <?php if(!empty($_POST['multimediabank_no'])):?>
                                                          <?php if($_POST['multimediabank_no']===$baris->multimediabank_no):?>
                                                            <option selected value="<?php echo $baris->multimediabank_no?>"><?php echo $baris->_title?></option>
                                                          <?php else :?>
                                                            <option value="<?php echo $baris->multimediabank_no?>"><?php echo $baris->_title ?></option>
                                                          <?php endif;?>
                                                     <?php else :?>
                                                                <?php if($homeslider->multimediabank_no === $baris->multimediabank_no):?>
                                                                  <option value="<?php echo $baris->multimediabank_no?>" selected><?php echo $baris->_title?></option>
                                                                <?php else:?>
                                                                  <option value="<?php echo $baris->multimediabank_no?>"><?php echo $baris->_title?></option>
                                                                <?php endif;?>
                                                     <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                              </div>
                                         </div>
                                         <input type="hidden" name="homeslider_no" value="<?php echo $homeslider->homeslider_no?> ">
                                        <div id="lowonganID">
                                              <div class="form-group">
                                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Title Home Slider</label>
                                                  <div class="col-lg-9">
                                                      <input class="form-control form_datetime2" name="title" placeholder="Title Home Slider" value="<?php echo $homeslider->_title;?>">
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Description Slider</label>
                                                  <div class="col-lg-9">
                                                      <textarea class="form-control form_datetime2" name="desc" placeholder="Description" cols="5" rows="10"><?php echo $homeslider->_desc;?></textarea>
                                                  </div>
                                              </div>
                                              <div class="form-group">
                                                    <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Cover</label>
                                                    <div class="col-lg-8">
                                                      <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                                          <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                                          <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                              <div class="fileupload-new thumbnail" style="width: 300px; height: 250px; background: #eee;">
                                                                <?php if($homeslider->_enc_name):?>
                                                                    <img  style="width: 190px; height: 140px; width='190' height='140'" src="<?php echo $homeslider->_url?>" />
                                                                <?php endif?>
                                                              </div>
                                                              <div class="fileupload-preview fileupload-exists thumbnail"style="max-width: 300px; max-height: 250px; line-height: 20px;"></div>
                                                              <div>
                                                                  <span class="btn btn-white btn-file">
                                                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                                    <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                                    <input type="file" class="default" name='cover' id="cover">
                                                                  </span>
                                                                  <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                                              </div>
                                                          </div>
                                                      </div>
                                                   </div>
                                              </div>
                                        </div>
                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp</label>
                                          <div class="col-lg-8">
                                            <button id="toPublishs" type="submit"  class="col-lg-2 col-sm-2  btn btn-success clicking" name="method" value="save"> Save </button>
                                            <a class="btn btn-danger kanan" style='float:none' onclick="konfirmasi_cancel('<?php echo base_url() ?>Client')" >Cancel</a>
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
              height: 200
          });
    </script>
    <script type="text/javascript">
        $(".multimedia").change(function () {
            CKEDITOR.remove(editor);
            var id = $(this).val();
            $.ajax
            ({
                type: "POST",
                url: "<?php echo site_url('Homeslidercms/ajaxSlider');?>",
                data: {"id":id},
                cache: false,
                success: function (html) {
                  $("#lowonganID").html(html);
                  CKEDITOR.replace("desc", {
                      height: 200
                  });
                }
            });

        });
    </script>
    <script>
      $('.form_datetime2').datepicker({
          // minDate: new Date(2016, 10 - 1, 25),
          format: 'yyyy-mm-dd',
          todayHighlight:'TRUE',
          autoclose: true,

      });
    </script>

</body>
