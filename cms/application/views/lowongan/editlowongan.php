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
    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <h3 class="m-bot15"> Management Lowongan </h3>
              <div class="row">
                  <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="<?php echo site_url('Lowongancms')?>">Lowongan</a></li>
                        <li class="active">ADD Lowongan</li>
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
      				 <div class="col-xs-15" id="panel1">
                          <section class="panel">
                            <header class="panel-heading">
                              Content Branch
                            </header>
                              <div class="panel-body">
                                <div class="form-horizontal">
                                       <form  action="<?php echo base_url() ?>lowongancms/editlowongan" method="post">
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Client Name</label>
                                             <div class="col-lg-8">
                                                <select class="form-control m-bot15" id="client" name='client'>
                                                  <option value="">Cient Name</option>
                                                    <?php foreach ($client as $row=>$baris) :?>
                                                        <?php if(!empty($_POST['client'])):?>
                                                            <?php if($_POST['client']==$baris->client_id):?>
                                                              <option selected value="<?php echo $baris->client_id ?>"><?php echo $baris->_name?></option>
                                                            <?php else :?>
                                                              <option value="<?php echo $baris->client_id?>"><?php echo $baris->_name ?></option>
                                                            <?php endif;?>
                                                        <?php else :?>
                                                             <?php if($baris->client_id===$r['client_id']):?>
                                                               <option selected value="<?php echo $baris->client_id?>"><?php echo $baris->_name?></option>
                                                             <?php else : ?>
                                                               <option value="<?php echo $baris->client_id?>"><?php echo $baris->_name?></option>
                                                             <?php endif;?>
                                                        <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                              </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Type Lowongan</label>
                                             <div class="col-lg-8">
                                                <select class="form-control m-bot15" id="lowongan" name='lowongan'>
                                                  <option value="">Type Lowongan</option>
                                                    <?php foreach ($lowongan as $row=>$baris) :?>
                                                        <?php if(!empty($_POST['lowongan'])):?>
                                                            <?php if($_POST['lowongan']===$baris->type_id):?>
                                                              <option selected value="<?php echo $baris->type_id?>"><?php echo $baris->_name?></option>
                                                            <?php else :?>
                                                              <option value="<?php echo $baris->type_id?>"><?php echo $baris->_name ?></option>
                                                            <?php endif;?>
                                                        <?php else :?>
                                                            <?php if($baris->type_id===$r['type_lowongan_id']):?>
                                                              <option selected value="<?php echo $baris->type_id?>"><?php echo $baris->_name?></option>
                                                            <?php else : ?>
                                                              <option value="<?php echo $baris->type_id?>"><?php echo $baris->_name?></option>
                                                            <?php endif;?>
                                                       <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                              </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Perkerjaan</label>
                                             <div class="col-lg-8">
                                                <select class="form-control m-bot15" id="pekerjaan" name='pekerjaan'>
                                                  <option value="">Pekerjaan</option>
                                                    <?php foreach ($pekerjaan as $row=>$baris) :?>
                                                      <?php if(!empty($_POST['pekerjaan'])):?>
                                                          <?php if($_POST['pekerjaan']===$baris->pekerjaan_branch_no):?>
                                                            <option selected value="<?php echo $baris->pekerjaan_branch_no?>"><?php echo $baris->_name?></option>
                                                          <?php else :?>
                                                            <option value="<?php echo $baris->pekerjaan_branch_no?>"><?php echo $baris->_name ?></option>
                                                          <?php endif;?>
                                                     <?php else :?>
                                                          <?php if($baris->pekerjaan_branch_no===$r['pekerjaan_branch_no']):?>
                                                            <option selected value="<?php echo $baris->pekerjaan_branch_no?>"><?php echo $baris->_name?></option>
                                                          <?php else : ?>
                                                            <option value="<?php echo $baris->pekerjaan_branch_no?>"><?php echo $baris->_name?></option>
                                                          <?php endif;?>
                                                     <?php endif;?>
                                                    <?php endforeach ;?>
                                                </select>
                                              </div>
                                         </div>
                                         <div class="form-group">
                                           <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Pilih Kota</label>
                                           <div class="col-lg-8">
                                             <select class="form-control m-bot15 lokasi" name="lokasikota">
                                               <option value="">Pilih Kota </option>
                                               <?php foreach($kota as $k=>$baris) :?>
                                                  <?php if($baris->location_no === $r['location_no']) :?>
                                                    <option value="<?php echo $baris->location_no;?>" selected=""><?php echo $baris->_name ?></option>
                                                  <?php else :?>
                                                    <?php if(!empty($_POST['lokasikota'])&&($_POST['lokasikota'] ==  $r['location_no'] )):?>
                                                      <option value="<?php echo $baris->location_no;?>" selected=""><?php echo $baris->_name ?></option>
                                                    <?php else :?>
                                                      <option value="<?php echo $baris->location_no;?>"><?php echo $baris->_name ?></option>
                                                    <?php endif;?>
                                                  <?php endif;?>
                                               <?php endforeach ;?>
                                             </select>
                                           </div>
                                         </div>
                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name</label>
                                          <div class="col-lg-8">
                                              <input type="hidden" name="lowonganNo" value="<?php echo $r['lowongan_no']?>">
                                              <input type="text" class="form-control" id="name" name="name" value="<?php echo $r['_name']?>" placeholder="Name">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Start Date</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="from" name="datefrom"  value="<?php echo $r['_date_from'];?>" placeholder="From" >
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">End Date</label>
                                            <div class="col-lg-4">
                                                <input type="text" class="form-control form_datetime2" id="datethru" name="datethru" value="<?php echo $r['_date_thru'];?>"placeholder="Until">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Description</label>
                                            <div class="col-lg-8">
                                                <textarea name="desc" class="form-control" placeholder="Description" rows="10" cols="20"><?php echo $r['_desc'];?></textarea>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Persyaratan</label>
                                            <div class="col-lg-8">
                                                <textarea name="persyaratan" class="form-control" placeholder="Persyaratan" rows="10" cols="20"><?php echo $r['_persyaratan'];?></textarea>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp</label>
                                          <div class="col-lg-8">
                                            <button id="toPublishs" type="submit"  class="col-lg-2 col-sm-2  btn btn-success clicking" name="method" value="save"> Save </button>
                                            <a class="btn btn-danger kanan" style='float:none' onclick="konfirmasi_cancel('<?php echo base_url() ?>Client')" >Cancel</a>
                                          </div>

                                        </div>

                                </div>
                             </div>
                </div>
            </div>
        </section>
        <!-- footer -->
        <!-- footer -->
        <?php include($includes . "/footer.php"); ?>    </section>
     <!-- notif footer general -->
    <!-- JS General -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $js ?>jquery.js"></script>
    <script src="<?php echo $js ?>bootstrap.min.js"></script>
    <script class="include" type="text/javascript"src="<?php echo $js ?>jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $js ?>jquery.scrollTo.min.js"></script>`
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
    <script type="text/javascript" src="<?php echo $assets ?>select/select2.full.js"></script>

    <script src="<?php echo $js ?>common-scripts.js"></script>
    <script src="<?php echo $js ?>add-article.js"></script>

    <script type="text/javascript">
          $(".lokasi").select2();

          var editor = CKEDITOR.replace("desc", {
              height: 400
          });
    </script>
    <script type="text/javascript">
          var editor = CKEDITOR.replace("persyaratan", {
              height: 400
          });
    </script>
    <script>
      $('.form_datetime2').datepicker({
          format: 'yyyy-mm-dd',
          todayHighlight:'TRUE',
          autoclose: true,
      });
    </script>
</body>
