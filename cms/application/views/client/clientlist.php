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
          <h3 class="m-bot15"> Management Client </h3>
          <div class="row">
              <div class="col-lg-12">
                <!--breadcrumbs start -->
                <ul class="breadcrumb">
                    <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                    <li><a href="<?php echo site_url('Clientcms')?>">Client</a></li>
                    <li class="active">List Client</li>
                </ul>
                <!--breadcrumbs end -->
              </div>
          </div>
         <div class="row">
            <!-- COL LEFT -->
            <div class="col-lg-12" id="panel1">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <section class="panel">
                          <a href="<?php echo site_url('Clientcms/addclient');?>" class="btn btn-success kanan">Add Client</a>
                           <table class="table table-hover table-bordered personal-task" id="editable-sample">

                              <thead>
                                 <tr>

                                    <th>Name</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>Phone</th>
                                    <th style="width:350px">Action</th>
                                 </tr>
                              </thead>
		                          <tbody>
                              <?php foreach($result  as $r): ?>
                              <tr>
                                <td>
                                   <?php echo $r->_name; ?>
                                </td>
                                <td>
                                     <?php echo $r->branchname; ?>
                                </td>

                                 <td>
                                    <?php echo $r->_address; ?>
                                 </td>
                                 <td>
                                    <?php echo $r->_phone; ?>
                                 </td>

                                 <td>
                                    <form  action="<?php echo base_url() ?>Clientcms/Operation" method="post">
                                       <input type="hidden" name="clientID" id="clientID" value="<?php echo $r->client_id; ?>" />
                                       <button type="submit" name="delete" class="btn btn-danger clicking" onclick="return konfirmasi_hapus()"><i class="fa fa-pencil-square-o"></i> Delete</button>
                                       <?php
                                          $status = $r->_active;
                                          if($status=="1")
                                          {
                                          ?>

                                       <button type="submit" name="edit" class="btn btn-warning clicking" ><i class="fa fa-pencil-square-o"></i> Edit</button>
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
                        </section>
                        <!--work progress end-->
                     </div>
                  </div>
            </div>
            <div class="col-lg-12" id="panel2" style="display:none">
            <section class="panel">
            <div class="panel-body">
            <div class="col-lg-15">
            <section class="panel">
            <form  action="<?php echo base_url() ?>managementbrandcms/save" method="post">
            <div class="form-group">
            <div class="iconic-input">
            <input type="text" class="form-control" id="name" name="name"  placeholder="Brand name" required maxlength="59">
            </div>
            </div>
            <div class="form-group">
            <div class="iconic-input">
            <input type="text" class="form-control" id="address" name="address"  placeholder="Address" required maxlength="244">
            </div>
            </div>
            <div class="form-group">
            <div class="iconic-input">
            <input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" required maxlength="24">
            </div>
            </div>
            <div class="form-group">
            <div class="iconic-input">
            <input type="text" class="form-control" id="fax" name="fax"  placeholder="Fax" required maxlength="24">
            </div>
            </div>
            <div class="form-group">
            <div class="iconic-input">
            <input type="text" class="form-control" id="website" name="website"  placeholder="Website" required maxlength="44">
            </div>
            </div>
										  <a class="btn btn-danger kanan" onclick="konfirmasi_cancel('<?php echo base_url() ?>managementbrandcms')" >Cancel</a>

            <button class="btn btn-success kanan clicking" type="submit">Add brand</button>
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

      <!--script for this page only-->
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
