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
        <h3 class="m-bot15"> Management Lowongan </h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('Lowongancms')?>">Lowongan</a></li>
                  <li class="active">ADD Lowongan</li>
              </ul>
              <!--breadcrumbs end -->
            </div>
        </div>
         <div class="row">
            <div class="col-lg-12" id="panel1">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <section class="panel">
                          <a href="<?php echo site_url('lowongancms/addlowongan');?>" class="btn btn-success kanan">Add Lowongan</a>
                           <table class="table table-hover table-bordered personal-task" id="editable-sample">

                              <thead>
                                 <tr>
                                    <th>Lowongan</th>
                                    <th>Client</th>
                                    <th>Type Lowongan</th>
                                    <th>pekerjaan</th>
                                    <th style="width:350px">Action</th>
                                 </tr>
                              </thead>
		                          <tbody>
                              <?php foreach($result  as $r): ?>
                                <tr>
                                  <td><?php echo $r->_name;?></td>
                                  <td><?php echo $r->clientname;?></td>
                                  <td><?php echo $r->type_lowongan;?></td>
                                  <td><?php echo $r->pekerjaanName;?></td>
                                  <td>
                                      <form  action="<?php echo base_url() ?>lowongancms/Operation" method="post">
                                         <input type="hidden" name="lowonganNo" id="lowonganNO" value="<?php echo $r->lowongan_no; ?>" />
                                         <button type="submit" name="delete" class="btn btn-danger clicking" onclick="return konfirmasi_hapus()"><i class="fa fa-pencil-square-o"></i> Delete</button>
                                         <?php $status = $r->_active;?>
                                            <?php if ($status=="1"):?>
                                               <button type="submit" name="edit" class="btn btn-warning clicking" ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                               <button type="submit" name="set_active" class="btn btn-success clicking" ><i class="fa fa-check"></i> Active</button>
                                            <?php else:?>
                                              <button type="submit" name="set_nonactive" class="btn btn-danger clicking" ><i class="fa fa-times"></i> Non Active</button>
                                         <?php endif;?>
                                      </form>
                                  </td>
                                </tr>
                              <?php endforeach; ?>
                              </tbody>
                           </table>
                        </section>
                     </div>
                  </div>
            </div>
         </div>
        <?php include($includes . "/footer.php"); ?>    </section>
</section>
<!-- notif footer general -->

<?php include($includes . "/footer-notif-general.php"); ?>
    <!-- notif footer general -->
    <!-- js placed at the end of the document so the pages load faster -->
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

      <script src="<?php echo $js;?>editable-table.js"></script>
      <script src="<?php echo $js;?>jquery.cookie.js"></script>

      <!-- END JAVASCRIPTS -->
<script>
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
    jQuery(document).ready(function() {
        EditableTable.init({
          "aaSorting": [[3,'asc']]
        });
    });
</script>
</body>
