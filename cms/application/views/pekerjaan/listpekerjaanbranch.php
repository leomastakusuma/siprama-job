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
        <h3 class="m-bot15"> Management Pekerjaan Branch</h3>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('');?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="<?php echo site_url('pekerjaancms/listpekerjaanbranch')?>">Pekerjaan Branch</a></li>
                        <li class="active">List Pekerjaan Branch </li>
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
        }
        ?>
        <div class="row">
          <!-- COL LEFT -->
          <div class="col-lg-12" id="panel1">
            <section class="panel">
              <div class="panel-body">
                <div class="col-lg-15">
                  <!--work progress start-->
                  <div class="adv-table editable-table">
                    <a href="<?php echo site_url('pekerjaancms/addpekerjaanbranch');?>" class="btn btn-success kanan">Add Pekerjaan Branch</a>
                    <!-- <button class="btn btn-success kanan" onclick="addusers();">Add user</button> -->
                    <table class="table table-striped table-advance table-hover table-bordered" id="example">

                      <thead>
                        <tr>
                          <th class="text-center">Name</th>
                          <th class="text-center">Branch</th>
                          <th class="text-center">Create date</th>
                          <th class="text-center">Create by</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($data  as $r): ?>
                        <tr>
                          <td class="text-center"><?php echo $r->_name; ?></td>
                          <td class="text-center"><?php echo $r->branchname; ?></td>
                          <td class="text-center">
                            <?php echo $r->create_date; ?>
                          </td>
                          <td class="text-center">
                            <?php echo $r->_full_name; ?>
                          </td>
                          <td class="text-center">
                            <?php if ($r->_active=="1") :?>
                              <span class="label label-success">Active</span>
                            <?php else: ?>
                              <span class="label label-danger">Non Active</span>
                            <?php endif ?>
                          </td>
                          <td class="text-center">
                            <form  action="<?php echo base_url() ?>pekerjaancms/Operation"  method="post">
                              <input type="hidden" name="pekerjaanBranchID" value="<?php echo $r->pekerjaan_branch_no?>">
                              <button type="submit" name="editbranch" method="edit" class="btn btn-warning clicking"value="edit" ><i class="fa fa-pencil-square-o"></i> Edit</button>
                              <?php $status = $r->status; ?>
                              <?php if ($status == "1"): ?>
                              <button type="submit" name="set_activebranch" method="set_nonactive" value="set_nonactive" style='float:none' class="btn btn-success clicking" ><i class="fa fa-check"></i> Active</button>
                              <button type="submit" name="deletebranch" method="set_active" value="set_active"style='float:none'class="btn btn-danger clicking" ><i class="fa fa-times"></i> Delete</button>
                              <?php endif; ?>
                              <?php if ($status == "0") : ?>
                              <button type="submit" name="set_nonactivebranch" method="set_active" value="set_active"style='float:none'class="btn btn-danger clicking" ><i class="fa fa-times"></i> Non Active</button>
                              <?php endif; ?>
                            </form>
                          </td>
                        </tr>
                        <?php endforeach; ?>
                      </tbody>
                    </table>
                  </div>
                  <!--work progress end-->
                </div>
              </div>
            </div>
          </section>
        </div>
        <!-- COL RIGHT -->
      </div>
    </section>
    <!-- footer -->
    <!-- footer -->
    <?php include($includes . "/footer.php"); ?>
    <?php include($includes . "/footer-notif-general.php"); ?>

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
  jQuery(document).ready(function() {
  $('#example').dataTable();
  });
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
