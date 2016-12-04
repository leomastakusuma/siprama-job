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
            <h3 class="m-bot15"> Management Lowongan Promote </h3>
            <div class="row">
                <div class="col-lg-12">
                  <!--breadcrumbs start -->
                  <ul class="breadcrumb">
                      <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                      <li><a href="<?php echo site_url('Lowongancms')?>">Lowongan Promote</a></li>
                      <li class="active">Edit Lowongan Promote</li>
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
                              Content Lowongan Promote
                            </header>
                              <div class="panel-body">
                                <div class="form-horizontal">
                                       <form  action="<?php echo base_url() ?>lowonganpromotecms/editlowonganpromoted" method="post" enctype="multipart/form-data">
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Lowongan</label>
                                             <div class="col-lg-6">
                                                <select class="form-control m-bot15 lowongan" id="lowongan" name='lowongan_no'>
                                                  <option value="">Pilih Lowongan</option>
                                                    <?php foreach ($lowongan as $row=>$baris) :?>
                                                      <?php if(!empty($_POST['lowongan'])):?>
                                                          <?php if($_POST['lowongan']===$baris->lowongan_no):?>
                                                            <option selected value="<?php echo $baris->lowongan_no?>"><?php echo $baris->_name?></option>
                                                          <?php else :?>
                                                            <option value="<?php echo $baris->lowongan_no?>"><?php echo $baris->_name ?></option>
                                                          <?php endif;?>
                                                     <?php else :?>
                                                            <?php if(!empty($result['lowongan_no']) && $result['lowongan_no'] === $baris->lowongan_no) :?>
                                                                <option  selected value="<?php echo $baris->lowongan_no?>"><?php echo $baris->_name?></option>
                                                            <?php else :?>
                                                                <option value="<?php echo $baris->lowongan_no?>"><?php echo $baris->_name?></option>
                                                            <?php endif;?>
                                                     <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                              </div>
                                         </div>
                                        <div id="lowonganID">
                                          <div class="form-group">
                                              <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Start Date Lowongan</label>
                                              <div class="col-lg-4">
                                                  <input type="text" class="form-control form_datetime2"  placeholder="From"  readonly="" value="<?php echo !empty($result['start']) ? $result['start'] : '';?>">
                                              </div>
                                          </div>
                                          <div class="form-group">
                                              <label for="setLocation" class="col-lg-2 col-sm-2 control-label">End Date Lowongan</label>
                                              <div class="col-lg-4">
                                                  <input type="text" class="form-control form_datetime2"  name="enddatelowongan" placeholder="Until" readonly="" value="<?php echo !empty($result['end']) ? $result['end'] : '';?>">
                                              </div>
                                          </div>
                                        </div>
                                      <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Star Date Promote</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="datethru" name="datefrom" value="<?php echo !empty($result['_date_from']) ? date('Y-m-d',strtotime($result['_date_from'])) : ''?>">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">End Date Promote</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="datethru" name="datethru" value="<?php echo !empty($result['_date_thru']) ? date('Y-m-d',strtotime($result['_date_thru'])) : ''?>">
                                            </div>
                                        </div>
                                        <input type="hidden" value="<?php echo $result['lowongan_promoted_no'] ?>" name="lowonganpromotedno">
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Cover</label>
                                            <div class="col-lg-8">
                                              <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                                  <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                                  <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 300px; height: 250px; background: #eee;">
                                                        <?php if(!empty($result['_cover_enc_name'])){
                                                            echo '<img  style="width: 190px; height: 140px; width="190" height="140" src="'.$result['_cover_url'].'" />';
                                                        }?>
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail"
                                                           style="max-width: 300px; max-height: 250px; line-height: 20px;"></div>
                                                      <div>
                                                          <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                          <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                          <input type="file" class="default" name='cover' id="cover">
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
              height: 400
          });
    </script>
    <script type="text/javascript">
        $(".lowongan").change(function () {
            var id = $(this).val();
            // console.log(id);
            $.ajax
            ({
                type: "POST",
                url: "<?php echo site_url('lowonganpromotecms/ajaxlowongan');?>",
                data: {"id":id},
                cache: false,
                success: function (html) {
                    console.log(html);
                    $("#lowonganID").html(html);
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
