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
    <h3 class="m-bot15">Management Branch</h3>
    <div class="row">
      <div class="col-lg-12">
        <ul class="breadcrumb">
            <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
            <li><a href="<?php echo site_url('Managementbrandcms')?>">Branch</a></li>
            <li class="active">ADD Role Branch</li>
        </ul>
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
      <div class="col-lg-12" id="panel2">
        <section class="panel">
              <div class="panel-body">
                  <div class="col-lg-15">
                    <section class="panel">
                      <form  action="<?php echo base_url() ?>managementbrandcms/addBranchRole" method="post">
                        <div class="form-group">
                        <select class="form-control m-bot15" id="branch" name="branch">
                          <option value="">Pilih Branch</option>
                          <?php foreach($branch as $baris) :?>
                             <option value="<?php echo $baris->branch_id;?>"><?php echo $baris->_name ?></option>'
                          <?php endforeach ;?>
                        </select>
                        </div>
                        <div class="form-group">
                          <select class="form-control m-bot15" id="role_id" name="role">
                            <option value="">Pilih Role</option>
                            <?php foreach($role as $baris) :?>
                               <option value="<?php echo $baris->role_id; ?>"><?php echo $baris->_name ?></option>;
                            <?php endforeach ;?>
                          </select>
                        </div>
                        <a class="btn btn-danger kanan" onclick="addusers();">Cancel</a>
                        <button class="btn btn-success kanan clicking"  type="submit">Add new role</button>
                      </form>
                    </section>
                </div>
              </div>
        </section>
      </div>
     </div>
</section>
<!-- footer -->
<?php include($includes . "footer.php"); ?>
</section>
<!-- notif footer general -->

<?php include($includes . "footer-notif-general.php"); ?>
<!-- notif footer general -->
<!-- js placed at the end of the document so the pages load faster -->
<style>
    .editable-table .dataTables_filter{
        width: auto !important;
    }
    .adv-table .dataTables_length select{
      margin: 0 !important
    }
    .kanan{
      margin-bottom: 0
    }
</style>
<link href="<?php echo $assets;?>advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
<link href="<?php echo $assets;?>advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
<script src="<?php echo $js;?>jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $assets;?>advanced-datatable/media/js/jquery.js"></script>
<script src="<?php echo $js;?>bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo $js;?>jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo $js;?>jquery.scrollTo.min.js"></script>
<script src="<?php echo $js;?>jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo $assets;?>advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $assets;?>data-tables/DT_bootstrap.js"></script>
<!-- this page plugin -->
<script type="text/javascript" src="<?php echo $assets;?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!--common script for all pages-->
<script src="<?php echo $js;?>common-scripts.js"></script>

  <!--script for this page only-->
<script src="<?php echo $js;?>editable-table.js"></script>
<script src="<?php echo $js;?>jquery.cookie.js"></script>

<script type="text/javascript" class="init">
$(".clicking").click(function(e){
    var txt = $('input[name="<?=$this->csrf['name'];?>"]');
    txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
});
</script>
</body>
