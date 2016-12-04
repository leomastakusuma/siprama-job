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
        <h3 class="m-bot15">Data Pelamar </h3>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('');?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="<?php echo site_url('Pelamarcms')?>">Pelamar</a></li>
                        <li class="active">List Pelamar </li>
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
                    <table class="table table-striped table-advance table-hover table-bordered" id="example">

                      <thead>
                        <tr>
                            <th class="text-center">Nama Lengkap</th>
                            <th class="text-center">Pendidikan</th>
                            <th class="text-center">No Telepone</th>
                            <th class="text-center">No Ponsel</th>
                            <th class="text-center">Alamat</th>
                            <th class="text-center">Posisi Kerja</th>
                            <th class="text-center">Tanggal Melamar</th>
                            <th class="text-center">Action</th>

                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach($data  as $r): ?>
                        <tr>
                            <td class="text-center"><?php echo $r->_fullname ;?></td>
                            <td class="text-center"><?php echo $r->pendidikan ;?></td>
                            <td class="text-center"><?php echo $r->_phone_home ;?></td>
                            <td class="text-center"><?php echo $r->_phone_primary ;?></td>
                            <td class="text-center"><?php echo $r->_address_sekarang ;?></td>
                            <td class="text-center"><?php echo $r->pekerjaan ;?></td>
                            <td class="text-center"><?php echo $r->tanggalMelamar ;?></td>
                            <td>
                              <a href="<?php echo site_url('Pelamarcms/detail').'/'.$r->pelamar_no;?>" class="btn btn-primary">Lihat</a>
                              <a href="<?php echo site_url('Pelamarcms/cetak').'/'.$r->pelamar_no;?>" class="btn btn-primary" target="_blank">Cetak</a>

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
