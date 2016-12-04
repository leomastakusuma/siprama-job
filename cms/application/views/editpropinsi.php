<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php"); ?>

<body>
    <?php include("includes/nav.php"); ?>
<?php include("includes/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
		<?php foreach($edit  as $r): ?>
            <h3 class="m-bot15"><i class="fa fa-map-pin" title="Propinsi"></i> Edit propinsi: <?php echo ucfirst(strtolower($r->_name));  ?> </h3>
						         <?= null != validation_errors() ? validation_errors() : "" ?>
         <?= isset($err) ? $err : "" ?>
            <div class="row">
                <div class="col-lg-12">
                             <!--breadcrumbs start -->
<?php include("includes/breadcrumb.php"); ?>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <!-- COL LEFT -->

           	<div class="col-lg-12" id="panel2">
               
                    <section class="panel">
                  
                        <div class="panel-body">
                          <div class="col-lg-15">

                      <section class="panel">
                				  
						

							             <form  action="<?php echo base_url() ?>locationcms/updatepropinsi" method="post" id="savepropinsi">
										 <div class="form-group">
                                      <div class="iconic-input">
                                         <input type="hidden" class="form-control no" name="no" id="no" value="<?php echo $r->location_no; ?>">
                                      </div>
                                  </div>
								   <div class="form-group">
      <label class="control-label col-sm-2" for="country_id">Negara:</label>
      <div class="col-sm-12">          
         <select class="form-control m-bot15" id="country_id" disabled>
                                    <option>Pilih Negara</option>
                                    <?php 
                                       foreach($country_id as $baris)
                                       { 
                                         echo '<option value="'.$baris->location_no.'">'.$baris->_name.'</option>';
                                       }
                                       ?>
                                 </select>
								                                  <input type="hidden" class="form-control" id="country" name="country"  value="<?php echo $r->_parent_location_no; ?>">

      </div>
    </div>
														   <div class="form-group">
      <label class="control-label col-sm-2" for="name">Propinsi:</label>
      <div class="col-sm-12">          
      <input type="text" class="form-control" id="name" name="name" placeholder="Propinsi" value="<?php echo $r->_name; ?>" required maxlength="59">

      </div>
    </div>
                      <div class="form-group">
      <label class="control-label col-sm-2" for="name">Name On Gmaps:</label>
      <div class="col-sm-12">          
                          <input type="text" class="form-control" id="gmaps-name" name="gmaps_name" value="<?php echo $r->name_on_gmaps;?>" placeholder="name on gmaps">
                        </div>
                      </div>
  
	
															   <div class="form-group">
      <label class="control-label col-sm-2" for="desc">Deskripsi:</label>
      <div class="col-sm-12">          
								  
                                      <input type="text" class="form-control spinner"  id="desc" name="desc" placeholder="Deskripsi" value="<?php echo $r->_desc; ?>"  maxlength="199">
                                
	
      </div>
    </div>
								  <div class="form-group">
                                      <div class="iconic-input">
                                         <input type="hidden" class="form-control type" name="type" id="type" value="<?php echo $r->type_location_id; ?>">
                                      </div>
                                  </div>
								  	  <div class="form-group">
                                      <div class="iconic-input">
                                         <input type="hidden" class="form-control type" name="type" id="type" value="<?php echo $r->type_location_id; ?>">
                                      </div>
                                  </div>
					 <div class="form-group">
                                      <div class="iconic-input">
                                         <input type="hidden" class="form-control country" id="country" name="country" value="<?php echo $r->_parent_location_no; ?>">
                                      </div>
                                  </div>
                            

						
                                 
							  <a class="btn btn-danger kanan" onclick="konfirmasi_cancel('<?php echo base_url() ?>locationcms')" >Cancel</a>
                     <button class="btn btn-success kanan" type="submit">Update Location</button>
                              </form>

							  
						
							      
							  
  

                      </section>
                      <!--work progress end-->
                  </div>
              </div>

                        </div>
						
						
                </div>
				
				<?php endforeach; ?>
				
                <!-- COL RIGHT -->
           
            </div>
        </section>
        <!-- footer -->
        <?php include("includes/footer.php"); ?>
    </section>
     <!-- notif footer general -->
        <?php include("includes/footer-notif-general.php"); ?>
    <!-- JS General -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $js ?>jquery.js"></script>
    <script src="<?php echo $js ?>bootstrap.min.js"></script>
    <script class="include" type="text/javascript"src="<?php echo $js ?>jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $js ?>jquery.scrollTo.min.js"></script>
    <script src="<?php echo $js ?>jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo $js ?>respond.min.js"></script>
    <script src="<?php echo $js ?>jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="<?php echo $js ?>bootstrap-switch.js"></script>
    <!--this page plugins-->
    <script type="text/javascript" src="<?php echo $assets ?>fuelux/js/spinner.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>ckeditor/ckeditor.js"></script>
    <!--common script for all pages-->
    <script src="<?php echo $js ?>common-scripts.js"></script>
    <!--this page  script only-->
    <script src="<?php echo $js ?>add-article.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script src="<?php echo $js;?>jquery.cookie.js"></script>
    <script>
    $('#savepropinsi').submit(function() {
      var txt = $('input[name="<?php echo $this->security->get_csrf_token_name();?>"]');
      txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
     $( document ).ready(function() {
            	var select_country = $("#country").val();
           	   $('#country_id option[value='+select_country+']').attr('selected','selected');
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
