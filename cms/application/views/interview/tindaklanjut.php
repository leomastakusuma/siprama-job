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
        <h3 class="m-bot15"> Tindak Lanjut Interview </h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('interviewcms')?>">Interview</a></li>
                  <li class="active">Tndak Lanjut Interview </li>
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
            <div class="col-lg-12" id="panel1">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-15">
                        <!--work progress start-->
                        <section class="panel">
                          <div class="panel-body">
                            <div class="form-horizontal">
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">ID Interview</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control"  readonly value="<?php echo $interview->interview_no;?>" >
                                  </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">ID Psikotes</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control"  readonly value="<?php echo $interview->psikotes_no;?>" >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">ID Lamaran</label>
                                  <div class="col-lg-8">
                                    <input type="text" class="form-control" readonly value="<?php echo $interview->apply_lowongan_no;?>" >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Nama Lowongan</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" id="address" name="address"readonly value="<?php echo $interview->lowongan_name;?>" >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Nama Lengkap</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" readonly value="<?php echo $interview->_fullname;?>" >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Tanggal Psikotes</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" readonly value="<?php echo $interview->tglPsikotes;?>"  >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Status Psikotes</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" readonly value="<?php echo $interview->status_psikotes;?>"  >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Score</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" readonly value="<?php echo $interview->_score;?>">
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Analisa Psikotes</label>
                                  <div class="col-lg-8">
                                      <?php echo $interview->_analisa;?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Tanggal Interview</label>
                                  <div class="col-lg-8">
                                      <?php if($interview->status_interview_id === "STATUSINT00") :?>
                                        <input type="text" class="form-control" readonly value="-"  >
                                      <?php else :?>
                                        <input type="text" class="form-control" readonly value="<?php echo $interview->tglPsikotes;?>"  >
                                      <?php endif;?>
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Status Interview</label>
                                  <div class="col-lg-8">
                                      <input type="text" class="form-control" readonly value="<?php echo $interview->status_interview_name;?>"  >
                                  </div>
                              </div>
                              <div class="form-group">
                                  <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Analisa Interview</label>
                                  <div class="col-lg-8">
                                    <?php echo $interview->analisaInterview;?>
                                  </div>
                              </div>
                            </div>

                        </section>
                        <section class="panel">
                          <div class="row" align="center">
                              <div class="col-sm-6" align="center">
                               <table class="table table-hover table-bordered personal-task" id="editable-sample">
                                  <thead>
                                     <tr>
                                        <th>NO</th>
                                        <th>Jawaban</th>
                                        <th>Score</th>
                                     </tr>
                                  </thead>
    		                          <tbody>
                                  <?php $n =0;?>
                                  <?php foreach($result  as $r):$n++; ?>
                                    <tr>
                                      <td><?php echo $n;?></td>
                                      <td><?php echo $r->_opsi;?></td>
                                      <td style="text-align='center'"><?php echo $r->_current_score;?></td>
                                    </tr>
                                  <?php endforeach; ?>
                                  </tbody>
                                  <tfoot>
                                    <tr>
                                      <td colspan="2" align="right">Total Score</td>
                                      <td align="right"><?php echo $interview->_score;?></td>
                                    </tr>
                                  <tfoot>
                               </table>
                             </div>
                          </div>
                          <div class="row">
                            <div class="col-sm-12" align="center">
                              <div class="form-horizontal">
                                     <form  action="<?php echo base_url() ?>Interviewcms/tindaklanjut" method="post" enctype="multipart/form-data">
                                       <input type="hidden" value="<?php echo $interview->psikotes_no?>" name="psikotes_no">
                                       <input type="hidden" value="<?php echo $interview->pelamar_no?>" name="pelamar_no">
                                       <input type="hidden" value="<?php echo $interview->apply_lowongan_no;?>" name="lowongan_no">
                                       <input type="hidden" value="<?php echo $interview->interview_no;?>" name="interview_no">
                                     <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Status Interview</label>
                                          <div class="col-lg-8">
                                              <select name="status" class="form-control" required>
                                                  <option value="" >Select Status</option>
                                                  <?php foreach ($status as $key => $value) :?>
                                                    <option value="<?php echo $value->type_id?>" ><?php echo $value->_name?></option>
                                                  <?php endforeach;?>
                                              </select>
                                          </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Analisa Interview</label>
                                            <div class="col-lg-8">
                                                <textarea name="analisaa" class="form-control" cols="5" rows="10" ></textarea>
                                            </div>
                                         </div>
                                         <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-sm-2 control-label"></label>
                                             <div class="col-lg-8">
                                                <input type="submit" value="update" name="upadate" class="btn btn-primary pull-right">
                                             </div>
                                          </div>
                                     </form>
                              </div>
                             </div>
                          </div>
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
    <script type="text/javascript" src="<?php echo $assets ?>ckeditor/ckeditor.js"></script>

      <script src="<?php echo $js;?>editable-table.js"></script>
      <script src="<?php echo $js;?>jquery.cookie.js"></script>

      <!-- END JAVASCRIPTS -->
      <script type="text/javascript">
            var editor = CKEDITOR.replace("analisaa", {
                height: 200
            });
            var editor = CKEDITOR.replace("analisa", {
                height: 200
            });
      </script>
</body>
