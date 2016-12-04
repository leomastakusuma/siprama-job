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
        <h3 class="m-bot15"> Management Lowongan Promoted</h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('Lowongancms')?>">Lowongan</a></li>
                  <li class="active">List Lowongan Promoted</li>
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
                          <a href="<?php echo site_url('lowonganpromotecms/kosongkanLowongan/true');?>" class="btn btn-danger kanan">Kosongkan Semua Promoted</a>

                           <table class="table table-hover table-bordered personal-task" id="editable-sample">
                              <thead>
                                 <tr>
                                    <th>Position</th>
                                    <th>Lowongan</th>
                                    <th>DateFrom</th>
                                    <th>Datethru</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
		                          <tbody>
                              <?php $n = 0;?>
                              <?php foreach($result  as $r): $n++;?>
                                <tr>
                                  <td><?php echo $r->_position;?></td>
                                  <td>
                                    <?php #if($r->lowongan_no != '') :?>
                                    <?php echo $r->_name;?>
                                    <?php #endif;?>
                                  </td>
                                  <td><?php echo $r->_date_from;?></td>
                                  <td><?php echo $r->_date_thru;?></td>
                                  <td style="width:220px;">
                                      <form  action="<?php echo base_url() ?>lowonganpromotecms/editlowonganpromoted" method="post">
                                         <input type="hidden" name="lowonganpromotedno"  value="<?php echo $r->lowongan_promoted_no; ?>"  id="lowonganpromotedno"/>
                                         <?php if($r->lowongan_no) :?>
                                           <button type="submit" name="edit" value="edit" name="edit" class="btn btn-success clicking pull-left" ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                         <?php else :?>
                                           <button type="submit" name="edit" value="edit" name="edit" class="btn btn-success clicking" ><i class="fa fa-pencil-square-o"></i> Edit</button>
                                         <?php endif;?>
                                      </form>
                                    <?php if($r->lowongan_no) :?>
                                        <?php if($r->_position  == 1 ) :?>
                                          <button class='btn btn-primary btn-xs' onclick='functinUpImageDown(this.value)' value="<?php echo $r->lowongan_promoted_no?>"><i class='fa fa-chevron-down'></i></button>&nbsp;&nbsp;
                                        <?php endif; ?>
                                        <?php if($r->_position > 1 && $r->_position < 4) :?>
                                          <button class='btn btn-primary btn-xs' onclick='functinUpImageDown(this.value)' value="<?php echo $r->lowongan_promoted_no?>"><i class='fa fa-chevron-down'></i></button>&nbsp;&nbsp;
                                        <?php endif;?>
                                        <?php if($r->_position > 1) :?>
                                          <button class='btn btn-primary btn-xs' onclick='functinUpImage(this.value)' value="<?php echo $r->lowongan_promoted_no?>"><i class='fa fa-chevron-up'></i></button>&nbsp;&nbsp;
                                        <?php endif;?>
                                        <button class='btn btn-danger btn-xs removetmp' onclick='functinLowonganPromoteKosong(this.value)' value="<?php echo $r->lowongan_promoted_no?>"><i class='fa fa-times'></i></button>
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


    function functinUpImageDown(e){
        $.ajax({
            type:'POST',
            url: "<?php echo site_url('lowonganpromotecms/dwimage');?>",
            data:{lowonganPoromote :e},
            success:function(html){
                console.log("success");
                console.log(html);
                location.reload(true);
            },
            error: function(data){
                console.log("error");
            }
        });
    }

    function functinUpImage(e){
        $.ajax({
            type:'POST',
            url: "<?php echo site_url('lowonganpromotecms/upimage');?>",
            data:{lowonganPoromote :e},
            success:function(html){
                console.log("success");
                console.log(html);
                location.reload(true);

                // $('#TmpImage').html(html);
            },
            error: function(data){
                console.log("error");
            }
        });
    }
    function functinLowonganPromoteKosong(e){
        $.ajax({
            type:'POST',
            url: "<?php echo site_url('lowonganpromotecms/kosongkanLowongan');?>",
            data:{lowonganPoromote :e},
            success:function(html){
                console.log("success");
                console.log(html);
                location.reload(true);

            },
            error: function(data){
                console.log("error");
            }
        });
    }
</script>


</body>
