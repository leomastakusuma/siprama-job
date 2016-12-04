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
<section id="main-content">
    <section class="wrapper">
        <h3 class="m-bot15"> Management Role </h3>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('');?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="#">Role</a></li>
                        <li class="active">Add Role </li>
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
            <form method="post" action="<?php echo site_url("rolecms/addrole");?>" enctype="multipart/form-data">
                <!-- COL LEFT -->
                <div class="col-xs-9">
                    <!-- Content Article -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Role
                        </header>
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="position" name="_name" value="<?php echo !empty($_POST['_name']) ? $_POST['_name']: null;?>"><span class="has-error"><span class="help-block"> <?php echo form_error('_name');?></span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metaTitle" class="col-lg-2 col-sm-2 control-label">Description</label>
                                    <div class="col-lg-8">
                                        <textarea name="_desc" class="form-control"><?php echo !empty($_POST['_desc']) ? $_POST['_desc']: null;?></textarea><span class="has-error"><span class="help-block"> <?php echo form_error('_desc');?></span></span>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metaTitle" class="col-lg-2 col-sm-2 control-label">Icon</label>
                                    <div class="col-lg-8">
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
                                                  <input type="file" class="default" name='icon' id="icon">
                                                  </span>
                                                  <a href="#" class="btn btn-danger fileupload-exists"
                                                     data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                              </div>
                                          </div>
                                      </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                   <label for="metaTitle" class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                                    <div class="col-lg-8">
                                      <button id="toPublishs" type="submit"  class="btn btn-primary clicking" name="method" value="save"> Save </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                </div>
            </form>
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
</script>
<script>

</script>
</body>
