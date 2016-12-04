<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
      <section class="wrapper">
        <h3 class="m-bot15"> Management users </h3>
        <div class="row">
          <div class="col-lg-12">
            <!--breadcrumbs start -->
            <ul class="breadcrumb">
                <li><a href="#"><i class="icon-home"></i> Home</a></li>
                <li><a href="#">User</a></li>
                <li class="active">Add User</li>
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
                    <a href="<?php echo site_url('usercms/Adduser');?>" class="btn btn-success kanan">Add user</a>
                    <!-- <button class="btn btn-success kanan" onclick="addusers();">Add user</button> -->
                    <table class="table table-striped table-advance table-hover table-bordered" id="example">
                      <thead>
                        <tr>
                          <th class="text-center">Fullname</th>
                          <th class="text-center">Email</th>
                          <th class="text-center">Level</th>
                          <th class="text-center">Status</th>
                          <th class="text-center">Create date</th>
                          <th class="text-center">Create by</th>
                          <th class="text-center">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($result  as $r): ?>
                        <tr>
                          <td class="text-center"><?php echo $r->_full_name; ?></td>
                          <td class="text-center"><?php echo $r->_email; ?></td>
                          <td class="text-center"><?php echo $r->level_name; ?></td>
                          <td class="text-center">
                            <?php
                            if ($r->_active=="1")
                            {
                              ?><span class="label label-success">Active</span><?php
                            }
                            else
                            {
                              ?><span class="label label-danger">Non Active</span><?php
                            }
                            ?>
                          </td>
                          <td class="text-center">
                            <?php echo $r->create_date; ?>
                          </td>
                          <td class="text-center">
                            <?php echo $r->create_by_full_name; ?>
                          </td>
                          <td class="text-center">
                            <form  action="<?php echo base_url() ?>usercms/userOperation/<?php echo $r->nomor; ?>"  method="post">
                              <button type="submit" name="edit" class="btn btn-warning clicking" ><i class="fa fa-pencil-square-o"></i> Edit</button>

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
            </section>
        </div>
      </div>
    </section>
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
    function scorePassword(pass) {
        var score = 0;
        if (!pass)
            return score;

        // award every unique letter until 5 repetitions
        var letters = new Object();
        for (var i=0; i<pass.length; i++) {
            letters[pass[i]] = (letters[pass[i]] || 0) + 1;
            score += 5.0 / letters[pass[i]];
        }

        // bonus points for mixing it up
        var variations = {
            digits: /\d/.test(pass),
            lower: /[a-z]/.test(pass),
            upper: /[A-Z]/.test(pass),
            nonWords: /\W/.test(pass),
        }

        variationCount = 0;
        for (var check in variations) {
            variationCount += (variations[check] == true) ? 1 : 0;
        }
        score += (variationCount - 1) * 10;

        return parseInt(score);
    }

    function checkPassStrength(pass) {
        var score = scorePassword(pass);
        if (score > 80)
            return "<span style='color:#5AAC1F'>strong</span>";
        if (score > 60)
            return "<span style='color:#EAD742'>good</span>";
        if (score <= 60)
            return "weak";

        return "";
    }

    $(document).ready(function() {
        $("#password").on("keypress keyup keydown", function() {
            var pass = $(this).val();
            var ckp = checkPassStrength(pass);
            if(ckp=='weak'){
                $("#submitted").prop("disabled",true);
                $("#infopwd").html("<span style='color:#C64038'>weak</span>");
            }else{
                $("#submitted").prop("disabled",false);
                $("#infopwd").html(ckp);
            }
        });
    });
  </script>
</body>
