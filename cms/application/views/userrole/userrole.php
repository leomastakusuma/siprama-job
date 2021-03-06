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
         <h3 class="m-bot15"> User Access Management </h3>
         <div class="row">
            <div class="col-lg-12">
               <!--breadcrumbs start -->
               <ul class="breadcrumb">
               <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
               <li><a href="<?php echo site_url('userrolecms')?>">User Access</a></li>
               <li class="active">List User Access</li>
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
            <div class="col-lg-12" id="panel1" style="display: block">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <section class="panel">
                        <div class="adv-table editable-table">
                          <a href="<?php echo site_url('userrolecms/Adduserrole');?>" class="btn btn-success kanan">Create New User Access</a>
                           <table class="table table-striped table-advance table-hover table-bordered" id="example">
                              <thead>
					                          <th>User level</th>
                                    <th>Branch</th>
                                    <th>Role</th>
                                    <th>Create date</th>
                                    <th>Create by</th>
                                    <th style="width:230px">Action</th>
                                 </tr>
                              </thead>
							                <tbody>
                              <?php foreach($result  as $r): ?>
                              <tr>
						                     <td>
                                    <?php echo $r->level; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->_name; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->role; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->create_date; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->_full_name; ?>
                                 </td>
                                 <td>
                                    <form  action="<?php echo base_url() ?>userrolecms/userroleoperation/<?php echo $r->user_access_no; ?>" method="post">
                                       <button type="submit" name="delete" class="btn btn-danger clicking" onclick="return konfirmasi_hapus()"><i class="fa fa-pencil-square-o"></i> Delete</button>
                                       <?php
                                          $status = $r->_active;
                                          if($status=="1")
                                          {
                                          ?>
                                       <button type="submit" name="set_active" class="btn btn-success clicking" ><i class="fa fa-check"></i> Active</button>
                                       <?php
                                          }
                                           if($status=="0")
                                          {
                                           ?>
                                       <button type="submit" name="set_nonactive" class="btn btn-danger clicking" ><i class="fa fa-times"></i> Non Active</button>
                                       <?php
                                          }
                                          ?>
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
               </section>
           </div>
         <!-- COL RIGHT -->
         </div>
     </section>
     <!-- footer -->

     <?php include($includes . "/footer.php"); ?>    </section></section>
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
              $('#example').dataTable( {
    "aaSorting": [[0,'asc']]
  } );

          });
         $('#level_id').on('change', function() {
          var level = $('#level_id').find(":selected").val();
           $("#level").val(level);
               });

           $('#role_id').on('change', function() {
          var role = $('#role_id').find(":selected").val();
           $("#role").val(role);
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

      </script>
   </body>
