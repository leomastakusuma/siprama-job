<!DOCTYPE html>
<?php         $userinfo       = $this->session->userdata("userinfo");
?>
<html lang="en">
    <?php $includes = getcwd() . '/application/views/includes/'; ?>

   <?php include("includes/header.php"); ?>
   <body>
      <?php include("includes/nav.php"); ?>
      <?php include("includes/sidebar-menu.php"); ?>
      <!-- main content start -->
      <section id="main-content">
      <section class="wrapper">
         <h3 class="m-bot15"> User access management </h3>
         <div class="row">
            <div class="col-lg-12">
               <!--breadcrumbs start -->
               <?php include("includes/breadcrumb.php"); ?>
               <!--breadcrumbs end -->
            </div>
         </div>
         <div class="row">
            <!-- COL LEFT -->
            <div class="col-lg-12" id="panel1" style="display: block">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <section class="panel">
                        <div class="adv-table editable-table">
                           <button class="btn btn-success kanan" onclick="addusers();">Create new user access</button>
                           <table class="table table-striped table-advance table-hover table-bordered" id="example">
       
                              <thead>
                                 <th style="display:none;"></th>
								 <th>User level</th>
                                    <th>Role</th>
                                    <th>Create date</th>
                                    <th>Create by</th>
                                    <th style="width:230px">Action</th>
                                 </tr>
                              </thead>
							    <tbody>
                              <?php foreach($result  as $r): ?>
                              <tr>
							  <td style="display:none;">
                                    <?php echo $r->user_level_id; ?>
                                 </td>
<td>
                                    <?php echo $r->level_name; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->_name; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->create_date; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->created_by_fullname; ?>
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
            </div>
            <div class="col-lg-12" id="panel2" style="display: none">
            <section class="panel">
            <div class="panel-body">
            <div class="col-lg-15">
            <!--work progress start-->
            <section class="panel">
            <form  action="<?php echo base_url() ?>userrolecms/save" method="post">
            <div class="form-group">
            <select class="form-control m-bot15" id="level_id" required>
            <option value="">Pilih Level</option>
            <?php 
               foreach($level_id as $baris)
               { 
                 echo '<option value="'.$baris->user_level_id.'">'.$baris->_name.'</option>';
               }
               ?>
            </select>
            <input type="hidden" class="form-control" id="level" name="level">
            </div>
            <div class="form-group">
            <select class="form-control m-bot15" id="role_id" required>
            <option value="">Pilih Role</option>
            <?php 
               foreach($role_id as $baris)
               { 
                 echo '<option value="'.$baris->role_id.'">'.$baris->_name.'</option>';
               }
               ?>
            </select>
            <input type="hidden" class="form-control" id="role" name="role" placeholder="Keyword">
            </div>
        
            <a class="btn btn-danger kanan" onclick="addusers();">Cancel</a>
            <button class="btn btn-success kanan clicking"  type="submit">Add new role</button>					                                
            </form>
            </section>
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