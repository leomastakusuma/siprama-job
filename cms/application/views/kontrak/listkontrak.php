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
          <h3 class="m-bot15"> List Kontrak</h3>
          <div class="row">
              <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                    <li><a href="<?php echo site_url('Kontrak')?>">List Kontrak</a></li>
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
                        <header class="panel-heading">Data Pelamar Lolos Interview Client</header>
                        <section class="panel">
                           <table class="table table-hover table-bordered personal-task" id="editable-sample">
                              <thead>
                                 <tr>
                                    <th>ID Interview </th>
                                    <th>Pekerjaan</th>
                                    <th>Lowongan</th>
                                    <th>Klien</th>
                                    <th>Nama Pelamar</th>
                                    <th align="center" >Action</th>
                                 </tr>
                              </thead>
		                          <tbody>

                              <?php foreach($result  as $r): ?>
                                <tr>
                                  <td><?php echo $r->interview_client_no;?></td>
                                  <td  width="100px"><?php echo $r->lowongan_posisi;?></td>
                                  <td><?php echo $r->lowongan_name;?></td>
                                  <td width="200px"><?php echo $r->clientname;?></td>
                                  <td  width="250px"><?php echo $r->namalengkap;?></td>

                                  <td align="center">
                                    <a href="<?php echo site_url('kontrak/addkontrak').'/'.$r->apply_lowongan_no;?>" class="btn btn-success clicking">Buat Kontrak</a>
                                 </td>
                                </tr>
                              <?php endforeach; ?>
                              </tbody>
                           </table>
                        </section>
                     </div>
                  </div>
            </div>

            <div class="col-lg-12" id="panel1">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <header class="panel-heading">Data Kontrak</header>
                        <section class="panel">
                          <table class="table table-hover table-bordered personal-task" id="editable-sample-aja">
                             <thead>
                                <tr>
                                   <th>ID Kontrak </th>
                                   <th>Pekerjaan</th>
                                   <th>Lowongan</th>
                                   <th>Klien</th>
                                   <th>Nama Pelamar</th>
                                   <th align="center" >Action</th>
                                </tr>
                             </thead>
                             <tbody>

                             <?php foreach($datakontrak  as $r): ?>
                               <tr>
                                 <td><?php echo $r->kontrak_no;?></td>
                                 <td><?php echo $r->lowongan_posisi;?></td>
                                 <td><?php echo $r->lowongan_name;?></td>
                                 <td><?php echo $r->clientname;?></td>
                                 <td><?php echo $r->namalengkap;?></td>

                                 <td align="center" width="300px">
                                   <?php if($r->_print < 1 ):?>
                                   <a href="<?php echo site_url('kontrak/editkontrak').'/'.$r->apply_lowongan_no;?>" class="btn btn-primary clicking">Edit</a>
                                   <a href="<?php echo site_url('kontrak/batal').'/'.$r->apply_lowongan_no;?>" class="btn btn-warning clicking">Batal</a>
                                   <?php endif;?>
                                   <a href="<?php echo site_url('kontrak/detailkontrak').'/'.$r->apply_lowongan_no;?>" class="btn btn-default clicking">Detail</a>
                                   <?php if($r->_print < 1):?>
                                   <a href="<?php echo site_url('kontrak/cetak').'/'.$r->apply_lowongan_no;?>" class="btn btn-success clicking" target="_blank"  onclick="return confirm('Data Tidak Dapat Di Edit Ketika Telah Dicetak.');" >Cetak</a>
                                   <?php else :?>
                                     <a href="<?php echo site_url('kontrak/cetak').'/'.$r->apply_lowongan_no;?>" class="btn btn-success clicking" target="_blank">Cetak</a>
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
    $('#editable-sample').DataTable();
    $('#editable-sample-aja').DataTable();

</script>
</body>
