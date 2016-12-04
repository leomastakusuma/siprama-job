<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php"); ?>

<body>
    <?php include("includes/nav.php"); ?>
<?php include("includes/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <h3 class="m-bot15"> Add brand </h3>
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

                  
                
					
					
					
				 <div class="col-lg-12" id="panel1">
               
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
						
                                 
										  <a class="btn btn-danger kanan" onclick="konfirmasi_cancel('<?php echo base_url() ?>managementkeywordcms')" >Cancel</a>
                     <button class="btn btn-success kanan" type="submit" onclick="addusers();">Add brand</button>
                              </form>

                      </section>
                      <!--work progress end-->
                  </div>
              </div>

                        </div>
                </div>
				
				
				
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
    <script>
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
    <script>
    // sample autocomplete
  $(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#setKeyword, #dbRelated, #setLocation " )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
  });
  </script>
</body>
