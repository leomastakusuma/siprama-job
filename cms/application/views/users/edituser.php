<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>
        <?php
        $resetpass = $this->session->flashdata('notifganti');
        ?>
        <!-- main content start -->
        <section id="main-content">
            <section class="wrapper">
                <h3 class="m-bot15"> Edit user </h3>
                <div class="row">
                    <div class="col-lg-12">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i> Home</a></li>
                            <li><a href="#">User</a></li>
                            <li class="active">Edit User</li>
                        </ul>
                        <!--breadcrumbs end -->
                    </div>
                </div>
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
                }elseif(!empty($resetpass)){?>
                    <div class="row">
                        <div class="col-lg-12">
                        <div class="alert alert-block alert-success fade in">
                            <button data-dismiss="alert" class="close close-sm" type="button">
                                <i class="icon-remove"></i>
                            </button>
                            <?php echo $edit[0]->_full_name.' New Password was "'.$resetpass.'"'; ?>
                        </div>
                        </div>
                    </div>
                <?php }
                ?>
                <div class="row">
                    <!-- COL LEFT -->
                    <div class="col-lg-12" id="panel1">
                        <section class="panel">
                        <header class="panel-heading">User Information</header>
                        <div class="panel-body">
                            <div class="col-lg-15">
                                <section class="panel">
                                    <?php foreach ($edit as $r): ?>
                                    <form class='form-horizontal' action="<?php echo base_url() ?>usercms/update_user" method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Username</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="username" name="username" placeholder="Username" value="<?php echo (!empty($_POST['username']))?$_POST['username']:$r->_id; ?>" required maxlength="44">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Fullname</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="fullname" name="fullname" placeholder="Fullname" value="<?php echo (!empty($_POST['fullname']))?$_POST['fullname']:$r->_full_name; ?>" required maxlength="44">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Initial</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control" id="initial" name="initial" placeholder="Initial Name" value="<?php echo (!empty($_POST['initial']))?$_POST['initial']:$r->_initial_name; ?>" required maxlength="5">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Email</label>
                                            <div class="col-lg-4">
                                                <input type="email" class="form-control spinner"  id="email" name="email" placeholder="Email" value="<?php echo (!empty($_POST['email']))?$_POST['email']:$r->_email; ?>" required maxlength="44">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">User Level</label>
                                            <div class="col-lg-4">
                                                <select class="form-control m-bot15" id="level_id" name='level'>
                                                  <option value="">Level</option>
                                                    <?php foreach ($level_id as $row=>$baris) :?>
                                                      <?php if(!empty($_POST['level'])):?>
                                                          <?php if($_POST['level']==$baris['type_id']):?>
                                                            <option selected value="<?php echo $baris['type_id']?>"><?php echo $baris['_name']?></option>
                                                          <?php else :?>
                                                            <option value="<?php echo $baris['type_id']?>"><?php echo $baris['_name'] ?></option>
                                                          <?php endif;?>
                                                     <?php else :?>
                                                          <?php if($baris['type_id']===$r->user_level_id) :?>
                                                            <option selected value="<?php echo $baris['type_id']?>" ><?php echo $baris['_name']?></option>
                                                          <?php else :?>
                                                            <option value="<?php echo $baris['type_id']?>"><?php echo $baris['_name']?></option>
                                                          <?php endif;?>
                                                    <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                            </div>
                                        </div>
                                        <?php /*
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">User Level</label>
                                            <div class="col-lg-4">
                                              <select class="form-control m-bot15" id="branch" name='branch' required>
                                                 <option value="">Pilih Branch</option>
                                                 <?php foreach ($branch as $baris) :?>
                                                     <?php if(!empty($_POST) && $_POST['branch']==$baris->branch_id):?>
                                                     <option selected value="<?php echo $baris->branch_id ?>"><?php echo $baris->_name?></option>
                                                     <?php else :?>
                                                      <?php if($baris->branch_id ===$r->branch_id):?>
                                                          <option selected value="<?php echo $baris->branch_id ?>"><?php echo $baris->_name?></option>
                                                      <?php else :?>
                                                          <option value="<?php echo  $baris->branch_id  ?>"><?php echo $baris->_name;?></option>
                                                      <?php endif;?>
                                                     <?php endif;?>
                                                 <?php endforeach;?>
                                              </select>
                                          </div>
                                        </div>*/?>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Address</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control"  id="address" name="address" placeholder="Address" value="<?php echo (!empty($_POST['address']))?$_POST['address']:$r->_address; ?>" required maxlength="249">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Phone</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control"  id="phone" name="phone" placeholder="Phone" value="<?php echo (!empty($_POST['phone']))?$_POST['phone']:$r->_phone; ?>" required maxlength="24">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-lg-2 col-sm-2 control-label" for="">Avatar</label>
                                            <div class="col-lg-4">
                                              <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                                  <!-- <i><font size="1" color="green">Minimum 272x153 px</font></i></p> -->
                                                  <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                      <div class="fileupload-new thumbnail" style="width: 200px; height: 150px; background: #eee;">
                                                        <?php if(!empty($r->_avatar_url)){
                                                            echo '<img  style="width: 190px; height: 140px; width="190" height="140" src="'.$r->_avatar_url.'" />';
                                                        }?>
                                                      </div>
                                                      <div class="fileupload-preview fileupload-exists thumbnail"
                                                           style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                                      <div>
                                                          <span class="btn btn-white btn-file">
                                                     <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                                          <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                                          <input type="file" class="default" name='avatar' id="avatar">
                                                          </span>
                                                          <a href="#" class="btn btn-danger fileupload-exists"
                                                             data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                                      </div>
                                                  </div>
                                              </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="iconic-input">
                                                <input type="hidden" class="form-control" id="user_no" name="user_no" value="<?php echo $r->user_no; ?>" placeholder="Keyword Number">
                                            </div>
                                        </div>
                                        <div style='margin-bottom:10px'>
                                            <a class="btn btn-danger kanan" style='float:none' onclick="konfirmasi_cancel('<?php echo base_url() ?>usercms')" >Cancel</a>
                                            <button class="btn btn-success kanan clicking" style='float:none' type="submit">Update user</button>
                                        </form>
                                        <form  action="<?php echo base_url() ?>usercms/userOperation/<?php echo $r->user_no; ?>"  method="post" style="display: inline;">

                                              

                                        </form>
                                    </div>
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
        <?php include($includes . "/footer.php"); ?>
    </section>
    <!-- notif footer general -->
    <?php #include("includes/footer-notif-general.php"); ?>
    <!-- JS General -->
    <!-- js placed at the end of the document so the pages load faster -->
    <style>
    .kanan{
    margin-bottom: 0
    }
    </style>
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

    <script type="text/javascript" class="init">
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
    $(document).ready(function () {
    var select_level = $("#level").val();
    var select_channel = $("#channel").val();
    $('#channel_id option[value=' + select_channel + ']').attr('selected', 'selected');
    $('#level_id option[value=' + select_level + ']').attr('selected', 'selected');
    });
    $('#level_id').on('change', function () {
    var level = $('#level_id').find(":selected").val();
    $("#level").val(level);
    });
    $('#channel_id').on('change', function () {
    var level = $('#channel_id').find(":selected").val();
    $("#channel").val(level);
    });
    $('#toPublish').on('click', function () {
    $(".notif-footer").addClass('show success');
    setTimeout(function () {
    $(".notif-footer").removeClass('show success');
    }, 1500);
    });
    $('#toUnPublish').on('click', function () {
    $(".notif-footer").addClass('show failed');
    setTimeout(function () {
    $(".notif-footer").removeClass('show failed');
    }, 1500);
    });
    $('.icon-remove').on('click', function () {
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
