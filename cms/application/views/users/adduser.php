<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

      <!-- main content start -->
      <section id="main-content">
      <section class="wrapper">
         <h3 class="m-bot15">Users </h3>
         <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('usercms')?>">User</a></li>
                  <li class="active">Add User</li>
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
            <!-- COL LEFT -->
        <div class="col-lg-12" id="panel1" >
               <section class="panel">
                <header class="panel-heading">User Information</header>
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <section class="panel">
                           <form class='form-horizontal' action="<?php echo base_url() ?>usercms/save" method="post" enctype="multipart/form-data">
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Username</label>
                                 <div class="col-lg-4">
                                    <input type="text" class="form-control" value='<?php echo (!empty($_POST))?$_POST['username']:'';?>' id="username" name="username" placeholder="Username" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Fullname</label>
                                 <div class="col-lg-4">
                                    <input type="text" class="form-control" value='<?php echo (!empty($_POST))?$_POST['fullname']:'';?>' id="fullname" name="fullname" placeholder="Fullname" required>
                                 </div>
                              </div>
            							   <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Initial</label>
                                 <div class="col-lg-4">
                                    <input type="text" class="form-control" id="initial" value='<?php echo (!empty($_POST))?$_POST['initial']:'';?>' name="initial" placeholder="Initial Name" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Email</label>
                                 <div class="col-lg-4">
                                 <input type="email" class="form-control spinner"  value='<?php echo (!empty($_POST))?$_POST['email']:'';?>' id="email" name="email" placeholder="Email" required>
                               </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">User Level</label>
                                 <div class="col-lg-4">
                                 <select class="form-control m-bot15" id="level_id" name='level' required>
                                    <option value="">Pilih Level</option>
                                    <?php foreach ($level_id as $baris) :?>
                                        <?php if(!empty($_POST) && $_POST['level']==$baris['type_id']):?>
                                        <option selected value="<?php echo $baris['type_id'] ?>"><?php echo $baris->_name?></option>
                                        <?php else :?>
                                        <option value="<?php echo $baris['type_id'] ?>"><?php echo $baris['_name']?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                 </select>
                               </div>
                              </div>
                              <?php /*
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Branch</label>
                                 <div class="col-lg-4">
                                 <select class="form-control m-bot15" id="branch" name='branch' required>
                                    <option value="">Pilih Branch</option>
                                    <?php foreach ($branch as $baris) :?>
                                        <?php if(!empty($_POST) && $_POST['level']==$baris['type_id']):?>
                                        <option selected value="<?php echo $baris->branch_id ?>"><?php echo $baris->_name?></option>
                                        <?php else :?>
                                        <option value="<?php echo  $baris->branch_id  ?>"><?php echo $baris->_name;?></option>
                                        <?php endif;?>
                                    <?php endforeach;?>
                                 </select>
                               </div>
                              </div>*/?>
                              <div class="form-group">
                                <span id='otherchannel'><?php if(!empty($_POST) && ($_POST['level']=='LVL003' || $_POST['level']=='LVL002' || $_POST['level']=='LVL004' || $_POST['level']=='LVL007')){ ?> <input type="hidden" name="channel" value="CHANNEL00116"/><?php }?></span>
                                <label class="col-lg-2 col-sm-2 control-label" for="">Password</label>
                                 <div class="col-lg-4">
                                 <input type="password" class="form-control spinner"   id="password" name="password" placeholder="Password" required>
                               </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Address</label>
                                 <div class="col-lg-4">
                                    <input type="text" class="form-control" value='<?php echo (!empty($_POST))?$_POST['address']:'';?>'  id="address" name="address" placeholder="Address" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Phone</label>
                                 <div class="col-lg-4">
                                    <input type="text" class="form-control" value='<?php echo (!empty($_POST))?$_POST['phone']:'';?>' id="phone" name="phone" placeholder="Phone" required>
                                 </div>
                              </div>
                              <div class="form-group">
                                <label class="col-lg-2 col-sm-2 control-label" for="">Avatar</label>
                                 <div class="col-lg-4">
                                   <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                       <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                       <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                           <div class="fileupload-new thumbnail" style="width: 200px; height: 150px; background: #eee;">
                                           </div>
                                           <div class="fileupload-preview fileupload-exists thumbnail"
                                                style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                           <div>
                                               <span class="btn btn-white btn-file">
                                          <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                               <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                               <input type="file" class="default" name='avatar' id="icon">
                                               </span>
                                               <a href="#" class="btn btn-danger fileupload-exists"
                                                  data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                           </div>
                                       </div>
                                   </div>
                                 </div>
                              </div>
                             <div style='margin-bottom:20px'>
                                <button class="btn btn-success kanan clicking" style='float:none' type="submit">Add new user</button>
                                <a class="btn btn-danger kanan" style='float:none' onclick="konfirmasi_cancel('<?php echo base_url() ?>usercms')" >Cancel</a>
                                <div style='clear:both'></div>
                              </div>
                           </form>
                        </section>

                     </div>
                  </div>
            </div>
         </div>
         <!-- COL RIGHT -->
         </div>
         </section>
         <!-- footer -->
         <?php include($includes . "/footer.php"); ?>

     </section>
     <!-- notif footer general -->
     <?php #include($includes . "/footer-notif-general.php"); ?>
     <!-- js placed at the end of the document so the pages load faster -->
     <script src="<?php echo $js;?>jquery.js"></script>
     <script src="http://code.jquery.com/jquery-migrate-1.3.0.js"></script>
     <script src="<?php echo $assets;?>select/select2.full.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/bootstrap.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery.scrollTo.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/respond.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
     <!--custom switch-->
     <script src="<?php echo $js; ?>bootstrap-switch.js"></script>
     <script src="<?php echo $js; ?>clipboard.min.js"></script>
     <!--this page plugins-->
     <script type="text/javascript" src="<?php echo $assets;?>fuelux/js/spinner.min.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
         <script class="include" type="text/javascript" src="<?php echo $js;?>jquery.dcjqaccordion.2.7.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-daterangepicker/moment.min.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>jquery-multi-select/js/jquery.quicksearch.js"></script>
     <script type="text/javascript" src="<?php echo $assets;?>ckeditor/ckeditor.js"></script>
     <!--common script for all pages-->
     <script src="<?php echo $js ?>common-scripts.js"></script>
     <!--this page  script only-->
     <script src="<?php echo $js; ?>add-article.js"></script>
     <script src="<?php echo $js;?>jquery.cookie.js"></script>

    <script type="text/javascript" class="init">
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
         $('#level_id').on('change', function() {
           var level = $('#level_id').find(":selected").val();
            $("#level").val(level);
                });
            $('#channel_id').on('change', function() {
           var level = $('#channel_id').find(":selected").val();
            $("#channel").val(level);
                });
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

           $(document).ready(function () {
        $("#level_id").change(function () {
            var id = $(this).val();
            if(id=='LVL003' || id=='LVL002' || id=='LVL004' || id=='LVL007'){
              $('#xchannel').hide();
              $('#otherchannel').html('<input type="hidden" name="channel" value="CHANNEL00116"/>');
            }else{
              $('#xchannel').show();
              $('#otherchannel').html('');
            }
        });
      });
      </script>
   </body>
