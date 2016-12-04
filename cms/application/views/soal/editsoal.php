<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

      <!-- main content start -->
      <section id="main-content">
      <section class="wrapper">
         <h3 class="m-bot15">Soal </h3>
         <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('Soalcms')?>">Soal</a></li>
                  <li class="active">Add Soal</li>
              </ul>
              <!--breadcrumbs end -->
            </div>
         </div>
         <?php $session = $this->session->all_userdata();?>

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
        <div class="col-lg-12" id="panel1" >
               <section class="panel">
                <header class="panel-heading">Soal Information</header>
                  <div class="panel-body">
                     <div class="col-lg-12">
                        <section class="panel">
                           <form class='form-horizontal' action="<?php echo base_url() ?>soalcms/editsoal" method="post" enctype="multipart/form-data">
                               <div class="form-group" id="">
                                   <label class="col-sm-2 control-label">Kategori Soal</label>
                                   <div class="col-sm-9">
                                        <select class="form-control" id="id_kategori" name="kategori">
                                           <option value="">Kategori Soal</option>
                                           <?php foreach ($typeSoal as $key => $value) : ?>
                                             <?php if(!empty($_POST['kategori']) && $_POST['kategori'] === $value->type_id) :?>
                                               <option  selected="" value="<?php echo $value->type_id ?>"><?php echo $value->_name?></option>
                                             <?php else :?>
                                                <?php if( $value->type_id === $r->category_soal_id) :?>
                                                  <option  selected="" value="<?php echo $value->type_id ?>"><?php echo $value->_name?></option>
                                                <?php else :?>
                                                  <option value="<?php echo $value->type_id ?>"><?php echo $value->_name?></option>
                                                <?php endif;?>
                                             <?php endif;?>
                                           <?php endforeach;?>
                                       </select>
                                   </div><!-- /.input group -->
                               </div><!-- /.form group -->
                               <input type="hidden" class="form-control"  placeholder="" name="soalid" value="<?php echo $r->soal_id;?>">
                               <div class="form-group" >
                                   <label class="col-sm-2 control-label">Pertanyaan</label>
                                   <div class="col-sm-9">
                                       <textarea class="form-control" rows="5"  name="pertanyaan"><?php echo $r->_pertanyaan;?></textarea>
                                   </div><!-- /.input group -->
                               </div><!-- /.form group -->
                               <div class="form-group" >
                                   <label class="col-sm-2 control-label">Opsi A</label>
                                     <div class="col-xs-7">
                                       <textarea class="form-control" name="opsia"><?php echo $r->_opsi_a;?></textarea>
                                       <!-- <input type="text" class="form-control"  placeholder="" name="opsia" value="<?php echo $r->_opsi_a;?>"> -->
                                     </div>
                                     <div class="col-xs-2">
                                        <input type="number" class="form-control" placeholder="Nilai" name="nilaia"  value="<?php echo $r->_score_a;?>" onkeypress="return isNumberKey(event)" min="1" max="100" maxlength="3">
                                     </div>
                                </div><!-- /.form group -->

                                  <div class="form-group" >
                                     <label class="col-sm-2 control-label">Opsi B</label>
                                       <div class="col-xs-7">
                                         <textarea class="form-control" name="opsib"><?php echo $r->_opsi_b;?></textarea>
                                         <!-- <input type="text" class="form-control" name="opsib"  placeholder="" value="<?php echo $r->_opsi_b;?>"> -->
                                       </div>
                                       <div class="col-xs-2">
                                         <input type="number" class="form-control" placeholder="Nilai" name="nilaib" value="<?php echo $r->_score_b;?>" onkeypress="return isNumberKey(event)" min="1" max="100" maxlength="3">
                                       </div>
                                 </div><!-- /.form group -->

                                  <div class="form-group" >
                                     <label class="col-sm-2 control-label">Opsi C</label>
                                       <div class="col-xs-7">
                                         <textarea class="form-control" name="opsic"><?php echo $r->_opsi_c;?></textarea>
                                         <!-- <input type="text" class="form-control" placeholder="" name="opsic" value="<?php echo $r->_opsi_c;?>"> -->
                                       </div>
                                       <div class="col-xs-2">
                                         <input type="number" class="form-control" placeholder="Nilai" value="<?php echo $r->_score_c;?>" name="nilaic" onkeypress="return isNumberKey(event)" min="1" max="100" maxlength="3">
                                       </div>
                                 </div>

                                  <div class="form-group" >
                                     <label class="col-sm-2 control-label">Opsi D</label>
                                       <div class="col-xs-7">
                                         <textarea class="form-control" name="opsid"><?php echo $r->_opsi_d;?></textarea>
                                         <!-- <input type="text" class="form-control"   placeholder="" name="opsid" value="<?php echo $r->_opsi_d;?>"> -->
                                       </div>
                                       <div class="col-xs-2">
                                         <input type="number" class="form-control"  value="<?php echo $r->_score_d;?>" placeholder="Nilai" name="nilaid" onkeypress="return isNumberKey(event)" min="1" max="100" maxlength="3">
                                       </div>
                                 </div>

                                 <div class="form-group">
                                   <label class="col-sm-2 control-label">&nbsp;</label>
                                   <div class="col-xs-7">
                                      <button type="submit" name="method" class="btn btn-primary" value="edit">update</button>
                                  </div>
                                 </div>
                           </form>
                        </section>

                     </div>
                  </div>
            </div>
         </div>
         <!-- COL RIGHT -->
         </div>
         </section>
         <!-- footer -->
         <?php include($includes . "/footer.php"); ?>

     </section>
     <!-- notif footer general -->
     <?php #include($includes . "/footer-notif-general.php"); ?>
     <!-- js placed at the end of the document so the pages load faster -->
     <script src="<?php echo $js;?>jquery.js"></script>
     <script src="http://code.jquery.com/jquery-migrate-1.3.0.js"></script>
     <script src="<?php echo $assets;?>select/select2.full.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/bootstrap.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery.scrollTo.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery.nicescroll.js" type="text/javascript"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/respond.min.js"></script>
     <script src="<?php echo site_url('public_assets'); ?>/js/jquery-ui-1.9.2.custom.min.js"></script>
     <!--custom switch-->
     <script src="<?php echo $js; ?>bootstrap-switch.js"></script>
     <script src="<?php echo $js; ?>clipboard.min.js"></script>
     <!--this page plugins-->
     <script type="text/javascript" src="<?php echo $assets;?>fuelux/js/spinner.min.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
         <script class="include" type="text/javascript" src="<?php echo $js;?>jquery.dcjqaccordion.2.7.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-daterangepicker/moment.min.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
     <script type="text/javascript"
             src="<?php echo $assets;?>jquery-multi-select/js/jquery.quicksearch.js"></script>
     <script type="text/javascript" src="<?php echo $assets;?>ckeditor/ckeditor.js"></script>
     <!--common script for all pages-->
     <script src="<?php echo $js ?>common-scripts.js"></script>
     <!--this page  script only-->
     <script src="<?php echo $js; ?>add-article.js"></script>
     <script src="<?php echo $js;?>jquery.cookie.js"></script>
     <script type="text/javascript">
           var editor = CKEDITOR.replace("pertanyaan", {
               height: 400
           });
     </script>
     <script type="text/javascript" class="init">
        $(".clicking").click(function(e){
            var txt = $('input[name="<?=$this->csrf['name'];?>"]');
            txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
        });
        function isNumberKey(evt){
            var charCode = (evt.which) ? evt.which : event.keyCode
            if (charCode > 31 && (charCode < 48 || charCode > 57))
                return false;
            return true;
        }

      </script>
   </body>
