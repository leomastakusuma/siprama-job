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
          <h3 class="m-bot15"> Seleksi Psikotes </h3>
          <div class="row">
              <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                    <li><a href="<?php echo site_url('Psikotescms')?>">Seleksi Psikotes</a></li>
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
                           <table class="table table-hover table-bordered personal-task" id="editable-sample">
                              <thead>
                                 <tr>
                                    <th>ID Psikotes</th>
                                    <th>ID Pelamar</th>
                                    <th>Lowongan</th>
                                    <th>Nama Pelamar</th>
                                    <th>Status</th>
                                    <th align="center" style="width:300px" >Action</th>
                                 </tr>
                              </thead>
		                          <tbody>

                              <?php foreach($result  as $r): ?>
                                <tr>
                                  <td><?php echo $r->psikotes_no;?></td>
                                  <td><?php echo $r->lowongan_no;?></td>
                                  <td><?php echo $r->lowongan_name;?></td>
                                  <td><?php echo $r->namalengkap;?></td>
                                  <td><?php echo $r->status_psikotes;?></td>
                                  <td align="center">
                                      <a href="<?php echo site_url('Psikotescms/detail').'/'.$r->apply_lowongan_no;?>" class="btn btn-warning clicking">Lihat Detail</a>
                                      <?php if($r->status_psikotes_id === "STATUSPSI00") :?>
                                          <a href="<?php echo site_url('Psikotescms/tindak').'/'.$r->apply_lowongan_no;?>" class="btn btn-success clicking">Tindak Lanjut</a>
                                      <?php endif;?>
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
    $(document).ready(function() {
      $('#editable-sample').DataTable();
    });
    // jQuery(document).ready(function() {
    //     EditableTable.init({
    //       "aaSorting": [[1,'asc']]
    //     });
    // });
</script>
</body>
