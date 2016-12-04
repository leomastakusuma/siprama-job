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
        <h3 class="m-bot15">Home Slider</h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('homeslidercms')?>">Home Slider</a></li>
                  <li class="active">List Home Slider</li>
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
                          <a href="<?php echo site_url('Homeslidercms/kosongkanSlider/true');?>" class="btn btn-danger kanan">Kosongkan Semua Slider</a>

                           <table class="table table-hover table-bordered personal-task" id="example">
                              <thead>
                                 <tr>
                                    <th>Title</th>
                                    <th>CreteDate</th>
                                    <th>CreateBy</th>
                                    <th>Action</th>
                                 </tr>
                              </thead>
		                          <tbody>
                              <?php $n = 0;?>
                              <?php $total = count($result);?>
                              <?php foreach($result  as $r): $n++;?>
                                <tr>
                                  <td><?php echo !empty($r->multimediabank_no) ? $r->_title : '';?></td>
                                  <td><?php echo !empty($r->multimediabank_no) ? $r->create_date : '';?></td>
                                  <td><?php echo !empty($r->multimediabank_no) ?  $r->_full_name : '';?></td>
                                  <td>
                                     <?php if($r->multimediabank_no) :?>
                                      <?php if($r->_position  == 1 ) :?>
                                        <button class='btn btn-primary btn-xs' onclick='functinUpImageDown(this.value)' value="<?php echo $r->homeslider_no?>"><i class='fa fa-chevron-down'></i></button>&nbsp;&nbsp;
                                      <?php endif; ?>
                                      <?php if($r->_position > 1) :?>
                                        <?php if($r->_position < $total):?>
                                          <button class='btn btn-primary btn-xs' onclick='functinUpImageDown(this.value)' value="<?php echo $r->homeslider_no?>"><i class='fa fa-chevron-down'></i></button>&nbsp;&nbsp;
                                        <?php endif;?>
                                          <button class='btn btn-primary btn-xs' onclick='functinUpImage(this.value)' value="<?php echo $r->homeslider_no?>"><i class='fa fa-chevron-up'></i></button>&nbsp;&nbsp;
                                      <?php endif;?>
                                      <button class='btn btn-danger btn-xs removetmp' onclick='functinSliderKosong(this.value)' value="<?php echo $r->homeslider_no?>"><i class='fa fa-times'></i></button>&nbsp;&nbsp;
                                    <?php endif;?>
                                      <form style="display:inline" action="<?php echo base_url() ?>homeslidercms/addhomeslider" method="post">
                                      <input type="hidden" name="homeslider_no" value="<?php echo $r->homeslider_no?>">
                                      <button type="submit" class='btn btn-success' name="edit" value="edit">Edit</button>
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

    // $(document).ready(function() {
    //   $('#example').DataTable( {
    //       "order": []
    //   });
    // });
    function functinUpImageDown(e){
        $.ajax({
            type:'POST',
            url: "<?php echo site_url('homeslidercms/dwimage');?>",
            data:{homeslider_no :e},
            success:function(html){
                console.log("success");
                // console.log(html);
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
            url: "<?php echo site_url('homeslidercms/upimage');?>",
            data:{homeslider_no :e},
            success:function(html){
                console.log("success");
                location.reload(true);
            },
            error: function(data){
                console.log("error");
            }
        });
    }
    function functinSliderKosong(e){
        $.ajax({
            type:'POST',
            url: "<?php echo site_url('homeslidercms/kosongkanSlider');?>",
            data:{homeslider_no :e},
            success:function(html){
                console.log("success");
                // console.log(html);
                location.reload(true);

            },
            error: function(data){
                console.log("error");
            }
        });
    }

</script>


</body>
