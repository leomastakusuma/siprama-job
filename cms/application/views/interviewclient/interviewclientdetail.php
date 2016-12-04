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
        <h3 class="m-bot15"> Detail Interview Client </h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('Interviewclientcms')?>">Interview Client</a></li>
                  <li class="active">Detail Interview Client</li>
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
                          <div class="panel-body">
                            <div class="form-horizontal">
                                    <div class="form-group">
                                      <label for="setLocation" class="col-lg-2 col-sm-2 control-label">ID Interview Client</label>
                                      <div class="col-lg-8">
                                          <input type="text" class="form-control"  readonly value="<?php echo $interview->interview_client_no;?>" >
                                        </div>
                                    </div>
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
                                          <?php echo $interview->analisainterviewclient;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Tanggal Interview Client</label>
                                        <div class="col-lg-8">
                                            <?php if($interview->status_interview_client_id === "STATUSINTCL00") :?>
                                              <input type="text" class="form-control" readonly value="-"  >
                                            <?php else :?>
                                              <input type="text" class="form-control" readonly value="<?php echo $interview->tglInterviewClient;?>"  >
                                            <?php endif;?>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Status Interview Client</label>
                                        <div class="col-lg-8">
                                            <input type="text" class="form-control" readonly value="<?php echo $interview->selecStatusInterviewName;?>"  >
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Analisa Interview Client</label>
                                        <div class="col-lg-8">
                                            <?php echo $interview->analisainterviewclient;?>
                                        </div>
                                    </div>
                                    <?php if($interview->status_interview_client_id =='STATUSINT00' || $interview->status_interview_client_id =="STATUSINTCL00"  ):?>
                                      <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp;</label>
                                          <div class="col-lg-8">
                                            <a href="<?php echo site_url('Interviewcms/tindak').'/'.$interview->apply_lowongan_no;?>" class="btn btn-success clicking">Tindak Lanjut</a>
                                          </div>
                                      </div>
                                   <?php endif;?>
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
    jQuery(document).ready(function() {
        EditableTable.init({
          "aaSorting": [[3,'asc']]
        });
    });
</script>
</body>
