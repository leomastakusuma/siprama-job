<!DOCTYPE html>
<html lang="en">
<?php include("includes/header.php"); ?>

<body>
    <?php include("includes/nav.php"); ?>
    <?php include("includes/sidebar-menu.php"); ?>

    <!-- main content start -->
    <!-- main content start -->
    <section id="main-content">
      <section class="wrapper">
         <!-- <h3 class="m-bot15"> Dashboard </h3> -->
         <!-- DISINI GASSS -->
         <div class="contaner">
            <!-- <div class="dropdown"> -->


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
    <script src="<?php echo $js;?>jquery.cookie.js"></script>
    <script src="<?php echo $js ?>add-article.js"></script>


    <script type="text/javascript">
      $(document).ready(function () {
          //Ajax For GA
          var Analytics = $("#AnalyticsLoad").val();
          if(Analytics == 0 ){
              $.ajax
              ({
                  type: "GET",
                  url: '<?php echo site_url().'index/loadAjaxGA'?>',
                  cache: false,
                  success: function (html) {
                      $("#analytics").html(html);
                      console.log('First Load GA');
                      Analytics = 1;
                  }
              });
          }

         var  interval = 35000,//5000 = 5 second
              intervalTimerGAN;
              var urlloadGA = '<?php echo site_url().'index/loadAjaxGA'?>';
              intervalTimerGAN = setInterval(function() {
                  $.ajax
                  ({
                      type: "GET",
                      url: urlloadGA,
                      cache: false,
                      success: function (html) {
                          $("#analytics").html(html);
                          console.log("Load GA By Timer's");
                      }
                  });
              }, interval);
          //END AJAX FOR GA

          //Ajax For Load Data Article
          var  id ='<?php echo !empty($channelName['channel_no']) ? $channelName['channel_no'] : null;?>';
          if (id){
            var  urlload = '<?php echo site_url().'index/loadAjax/'?>'+id;
          }else{
            var  urlload = '<?php echo site_url().'index/loadAjax/'?>';
          }
          var  interval = 30000,
               intervalTimers;
               intervalTimers = setInterval(function() {
                    $.ajax
                    ({
                        type: "GET",
                        url: urlload,
                        cache: false,
                        success: function (html) {
                            $("#dashboard").html(html);
                            console.log("Load Data By Timer's");
                        }
                    });
                },interval);
          //End Ajax Article
      });
    </script>
</body>
