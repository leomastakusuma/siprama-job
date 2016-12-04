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
  <h3 class="m-bot15"> Location </h3>
  <div class="row">
     <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
        <li><a href="<?php echo site_url('Locationcms')?>">Location</a></li>
        <li class="active">LIST Location</li>
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
      <div class="col-lg-15" id="panel2">
        <section class="panel">
          <div class="panel-body">
            <div class="col-lg-15">
              <!--work progress start-->
              <section class="panel">
                <div class="row">
                  <div class="col-md-2">
                    <i class='fa fa-flag' title='Negara'></i> = Negara
                  </div>
                  <div class="col-md-2">
                    <i class='fa fa-map-pin' title='Propinsi'></i> = Propinsi
                  </div>
                  <div class="col-md-2">
                    <i class='fa fa-map-marker' title='Kota'></i> = Kota
                  </div>
                  <div class="col-md-6 text-right">
                    <a href="<?php echo site_url('Locationcms/addlocation');?>" class="btn btn-success kanan">Add Location</a>
                  </div>
                </div>
                <div class="adv-table editable-table">

                  <table class="table table-striped table-advance table-hover table-bordered" id="example">

                    <thead>
                      <tr>
                        <th class="text-center">Tipe</th>
                        <th class="text-center" style="display:none"></th>
                        <th class="text-center">Nama</th>
                        <th class="text-center">Deskripsi</th>
                        <th style="display:none">Lattitude</th>
                        <th style="display:none">Longitude</th>
                        <th class="text-center">Create date</th>
                        <th class="text-center" style="width:320px">Action</th>
                      </tr>
                    </thead>

                    <tbody>
                      <?php foreach($result  as $r): ?>
                      <tr>
                        <td class="text-center">
                          <?php
                            $type = $r->type_location_id;
                            if($type==="TYPELOC01")
                            {
                              echo "<i class='fa fa-flag' title='Negara'></i>";
                            }
                            if($type==="TYPELOC02")
                            {
                              echo "<i class='fa fa-map-pin' title='Propinsi'></i>";
                            }
                            if($type==="TYPELOC03")
                            {
                              echo "<i class='fa fa-map-marker' title='Kota'></i>";
                            }
                          ?>
                        </td>
                        <td style="display:none">
                          <?php echo $r->type_location_id; ?>
                        </td>
                        <td>
                          <?php echo $r->_name; ?>
                        </td>
                        <td>
                          <?php echo $r->_desc; ?>
                        </td>
                        <td style="display:none">
                          <?php echo $r->_latitude; ?>
                        </td>
                        <td style="display:none">
                          <?php echo $r->_longitude; ?>
                        </td>
                        <td class="text-center">
                          <?php echo $r->create_date; ?>
                        </td>
                        <td class="text-center">
                          <form  action="<?php echo base_url() ?>locationcms/Operation/<?php echo $r->location_no; ?>" method="post">
                             <input type="hidden" name="location_no" value="<?php echo $r->location_no?>">
                            <button type="submit" name="delete" class="btn btn-danger clicking" onclick="return konfirmasi_hapus()"><i class="fa fa-times"></i> Delete</button>
                            <?php $status = $r->_active;?>
                            <?php if($status=="1") :?>
                              &nbsp;
                              <button type="submit" name="edit" value="edit" class="btn btn-warning" ><i class="fa fa-pencil-square-o"></i> Edit</button>&nbsp;
                              <button type="submit" name="set_active" class="btn btn-success clicking" ><i class="fa fa-check"></i> Active</button>
                            <?php endif;?>
                            <?php if($status=="0"): ?>
                              <button type="submit" name="set_nonactive" class="btn btn-danger clicking" ><i class="fa fa-times"></i> Non Active</button>
                            <?php endif ;?>
                          </form>
                        </td>
                      </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
              </section>
              <!--work progress end-->
            </div>
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
jQuery(document).ready(function() {
  $('#example').dataTable();
});
</script>
</body>
