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
        <h3 class="m-bot15"> Management Pekerjaan Branch</h3>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('');?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pekerjaancms/listpekerjaanbranch')?>">Pekerjaan Branch</a></li>
                        <li class="active">Add Pekerjaan Branch </li>
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
            <form method="post" action="<?php echo site_url("pekerjaancms/addpekerjaanbranch");?>" enctype="multipart/form-data">
                <!-- COL LEFT -->
                <div class="col-xs-9">
                    <!-- Content Article -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Pekerjaan
                        </header>
                        <div class="panel-body">
                            <div class="form-horizontal">
                                <div class="form-group">
                                    <label for="setLocation" class="col-lg-3 col-lg-3 control-label">Branch</label>
                                    <div class="col-lg-8">
                                       <select class="form-control m-bot15" id="branch" name='branch'>
                                         <option value="">Select Branch</option>
                                           <?php foreach ($branch as $row=>$baris) :?>
                                             <?php if(!empty($_POST['branch'])):?>
                                                 <?php if($_POST['branch']==$baris->branch_id):?>
                                                   <option selected value="<?php echo $baris->branch_id?>"><?php echo $baris->_name?></option>
                                                 <?php else :?>
                                                   <option value="<?php echo $baris->branch_id?>"><?php echo $baris->_name ?></option>
                                                 <?php endif;?>
                                            <?php else :?>
                                                   <option value="<?php echo $baris->branch_id?>"><?php echo $baris->_name?></option>
                                            <?php endif;?>
                                           <?php endforeach ;?>
                                       </select>
                                     </div>
                                </div>
                                <div class="form-group">
                                    <label for="setLocation" class="col-lg-3 col-lg-3 control-label">Pekerjaan</label>
                                    <div class="col-lg-8">
                                       <select class="form-control m-bot15" id="pekerjaan" name='pekerjaan'>
                                         <option value="">Select Pekerjaan</option>
                                           <?php foreach ($pekerjaan as $row=>$baris) :?>
                                             <?php if(!empty($_POST['pekerjaan'])):?>
                                                 <?php if($_POST['pekerjaan']==$baris->pekerjaan_id):?>
                                                   <option selected value="<?php echo $baris->pekerjaan_id?>"><?php echo $baris->_name?></option>
                                                 <?php else :?>
                                                   <option value="<?php echo $baris->pekerjaan_id?>"><?php echo $baris->_name ?></option>
                                                 <?php endif;?>
                                            <?php else :?>
                                                   <option value="<?php echo $baris->pekerjaan_id?>"><?php echo $baris->_name?></option>
                                            <?php endif;?>
                                           <?php endforeach ;?>
                                       </select>
                                     </div>
                                </div>
                                <div class="form-group">
                                   <label for="metaTitle" class="col-lg-3 col-sm-3 control-label">&nbsp;</label>
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
