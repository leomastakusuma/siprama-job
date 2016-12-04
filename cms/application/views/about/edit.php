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
        <div class="row">
            <div class="col-lg-6">
                <h3 class="m-bot15"> Edit About Us</h3>
            </div>
            <div class="col-lg-6" align='right' style='padding-top:15px'>
                    <button type="submit" class='btn btn-success' onclick="location.reload()"> <i class="fa fa-refresh"></i> Refresh</button>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-home"></i> Home</a></li>
                        <li><a href="#">Disclaimer</a></li>
                        <li class="active">Edit Disclaimer </li>
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
            <form method="post" action="<?php echo site_url("aboutus/edit/".$about_no);?>" enctype="multipart/form-data">
                <!-- COL LEFT -->
                <div class="col-xs-9">
                    <!-- Content Article -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Career
                        </header>
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <input type="hidden" value="<?php echo  $about_no;?>" name="about_no">
                                <div class="form-group">
                                    <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Title</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="title" name="title" value="<?php echo !empty($_title) ? $_title: null;?>"><span class="has-error"><span class="help-block"> <?php echo form_error('position');?></span></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Content Editor -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Editor
                        </header>
                        <div class="panel-body">
                            <div class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <textarea class="form-control ckeditor" name="content" rows="6"><?php echo !empty($content) ? $content:null;?></textarea><span class="has-error"><span class="help-block"><?php echo form_error('content')?></span></span>
                                    </div>
                                </div>
                            </div>
                                <div class="form-group">
                                    <button id="toPublishs" type="submit"  class="btn btn-primary clicking" name="method" value="save"> Update </button>
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
        src="<?php echo $assets;?>bootstrap-daterangepicker/moment.min.js"></script>
<script type="text/javascript"
        src="<?php echo $assets;?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
<script type="text/javascript"
        src="<?php echo $assets;?>jquery-multi-select/js/jquery.quicksearch.js"></script>
<script type="text/javascript" src="<?php echo $assets;?>ckeditor/ckeditor.js"></script>
<!--common script for all pages-->
<script src="<?php echo $js ?>common-scripts.js"></script>
<script src="<?php echo $js;?>jquery.cookie.js"></script>

    <script type="text/javascript" class="init">
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
        var editor = CKEDITOR.replace("content", {
            height: 500,
        });
</script>
</body>
