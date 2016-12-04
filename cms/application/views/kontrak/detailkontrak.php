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
        <h3 class="m-bot15"> Kontrak </h3>
        <div class="row">
            <div class="col-lg-12">
              <!--breadcrumbs start -->
              <ul class="breadcrumb">
                  <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
                  <li><a href="<?php echo site_url('Interviewclientcms')?>">Kontrak</a></li>
                  <li class="active">Detail Kontrak</li>
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
            <div class="col-xs-12" id="panel1">
               <section class="panel">
                  <div class="panel-body">
                     <div class="col-lg-12">
                        <!--work progress start-->
                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Detail Lamaran</header>
                             <div class="col-sm-12 panel-body" align="center">
                              <div class="form-horizontal">
                                   <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Nomer Lamaran</label>
                                         <div class="col-lg-4">
                                           <input type="text" class="form-control" value="<?php echo $pelamarInfo->nomerLamaran ?>" readonly>
                                         </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Perusahaan</label>
                                         <div class="col-lg-4">
                                           <input type="text" class="form-control" value="<?php echo $pelamarInfo->ClientName ?>" readonly >
                                         </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Posisi</label>
                                         <div class="col-lg-4">
                                           <input type="text" class="form-control" value="<?php echo $pelamarInfo->posisi ?>" readonly  >
                                         </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tipe</label>
                                         <div class="col-lg-4">
                                           <input type="text" class="form-control"  value="<?php echo $pelamarInfo->tipelowongan ?>"  readonly>
                                         </div>
                                   </div>
                                   <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tgl Lamaran</label>
                                         <div class="col-lg-4">
                                            <input type="text" class="form-control" value="<?php echo $pelamarInfo->tglLamaran ?>"readonly >
                                         </div>
                                    </div>
                                    <div class="form-group">
                                          <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Status</label>
                                          <div class="col-lg-4">
                                            <input type="text" class="form-control" value="<?php echo $pelamarInfo->statuspelamar ?>"readonly >
                                          </div>
                                     </div>
                                     <div class="form-group">
                                           <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tgl Status</label>
                                           <div class="col-lg-4">
                                             <input type="text" class="form-control" value="<?php echo $pelamarInfo->tglstatus ?>"readonly >
                                           </div>
                                      </div>
                              </div>
                             </div>
                          </div>
                        </section>

                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Info Lamaran</header>
                            <div class="col-lg-12 panel-body" align="center">
                              <div class="form-horizontal">
                                   <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Nomer KTP</label>
                                       <div class="col-lg-4">
                                         <input type="text" class="form-control" value="<?php echo $pelamarInfo->_no_ktp ?>" readonly>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Nama Lengkap</label>
                                       <div class="col-lg-4">
                                         <input type="text" class="form-control" value="<?php echo $pelamarInfo->namalengkap ?>" readonly>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tempat Tanggal Lahir</label>
                                       <div class="col-lg-4">
                                         <input type="text" class="form-control" value="<?php echo $pelamarInfo->tempatlahir.'&nbsp;'. $pelamarInfo->tgllahir ?>"readonly >
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Agama</label>
                                       <div class="col-lg-4">
                                         <input type="text" class="form-control" value="<?php echo $pelamarInfo->agama ?>" readonly>
                                       </div>
                                   </div>
                                   <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Warna Kulit</label>
                                       <div class="col-lg-4">
                                         <input type="text" class="form-control" value="<?php echo $pelamarInfo->warnaklt ?>" readonly >
                                       </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Berat - Tinggi</label>
                                        <div class="col-lg-4">
                                          <input type="text" class="form-control" value="<?php echo $pelamarInfo->berat.' Kg - '.$pelamarInfo->tinggi .' Cm' ?>"  readonly>
                                        </div>
                                     </div>
                              </div>
                             </div>
                          </div>
                        </section>

                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Form Kontrak </header>
                            <div class="form-group panel-body">
                                <?php if($kontrak->type_lowongan_id == 'CTGLWGN01') :?>
                                <div class="form-horizontal">
                                  <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Priode</label>
                                       <div>
                                         <div class="col-lg-4">
                                           <div class="row">
                                             <div class="col-lg-5">
                                               <input type="text" class="form-control" readonly value="<?php echo date('Y-m-d',strtotime($kontrak->_periode_start));?>" >
                                             </div>
                                             <label for="setLocation" class="col-lg-2 col-sm-1 control-label">s/d</label>

                                             <div class="col-lg-5">
                                               <input type="text" class="form-control" readonly value="<?php echo date('Y-m-d',strtotime($kontrak->_periode_end));?>" >
                                             </div>
                                           </div>
                                         </div>
                                         <div class="col-lg-4">
                                           <div class="row">
                                             <label for="setLocation" class="col-lg-3 col-sm-3 control-label">Dicetak</label>
                                             <div class="col-lg-3">
                                               <input type="text" class="form-control" readonly value="<?php echo $kontrak->_print;?>" >
                                             </div>
                                             <label for="setLocation" class="col-sm-3 control-label" style="margin-left: 0px;">Kali</label>
                                           </div>
                                         </div>
                                       </div>
                                  </div>
                                  <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tanggal Dibuat</label>
                                       <div>
                                         <div class="col-lg-4">
                                           <div class="row">
                                             <div class="col-lg-12">
                                               <input type="text" class="form-control" readonly value="<?php echo date('Y-m-d',strtotime($kontrak->create_date));?>" >
                                             </div>
                                           </div>
                                         </div>
                                         <div class="col-lg-4">
                                           <div class="row">
                                             <label for="setLocation" class="col-lg-3 col-sm-3 control-label">Tgl Cetak</label>
                                             <div class="col-lg-8">
                                               <?php if($kontrak->_last_print_date != '0000-00-00 00:00:00'):?>
                                               <input type="text" class="form-control" readonly value="<?php echo date('Y-m-d',strtotime($kontrak->_last_print_date));?>" >
                                               <?php else :?>
                                               <input type="text" class="form-control" readonly value="" >
                                               <?php endif;?>
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                  </div>
                                </div>
                                <?php else :?>
                                  <div class="form-horizontal">
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tanggal Dibuat</label>
                                        <div class="col-lg-4">
                                          <input type="text" class="form-control" value="<?php echo $kontrak->create_date ?>" readonly>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                         <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Dicetak</label>
                                         <div>
                                           <div class="col-lg-4">
                                             <div class="row">
                                               <div class="col-lg-3">
                                                 <input type="text" class="form-control" readonly value="<?php echo $kontrak->_print;?>" >
                                               </div>
                                               <div class="col-lg-3">
                                                 <label for="setLocation" class="col-lg-1 col-sm-1 control-label">Kali</label>
                                               </div>
                                             </div>
                                           </div>
                                         </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Tanggal Cetak</label>
                                        <div class="col-lg-4">
                                          <input type="text" class="form-control" value="<?php echo $kontrak->_last_print_date ?>" readonly>
                                        </div>
                                    </div>
                                  </div>
                                <?php endif;?>
                            </div>
                          </div>
                        </section>


                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Rincian </header>
                            <div class="form-group panel-body">
                                <div class="col-lg-12">
                                  <table class="table table-hover table-bordered personal-task" id="example">
                                     <thead>
                                        <tr>
                                           <th>No</th>
                                           <th>Type Rincian</th>
                                           <th>Nominal</th>
                                           <?php if($kontrak->_print < 1):?>
                                           <th>Action</th>
                                           <?php endif;?>
                                        </tr>
                                     </thead>
                                     <tbody>
                                       <?php foreach ($kontrakAtch as $key => $value) :?>
                                         <tr>
                                             <td><?php echo $value->_position;?></td>
                                             <td><?php echo $value->rincian;?></td>
                                             <td><?php echo number_format($value->_amount,0,'.','.');?></td>
                                             <?php if($value->_print < 1) :?>
                                             <td>
                                               <button value="<?php echo $value->kontrak_attachment_no;?>" onclick="return deleteaja(this.value)" class="btn btn-warning clicking">Delete </button>
                                             </td>
                                             <?php endif;?>
                                         </tr>
                                       <?php endforeach;?>
                                     </tbody>
                                  </table>
                                  <?php if($kontrak->_print < 1):?>
                                    <a href="<?php echo site_url('kontrak/cetak').'/'.$kontrak->apply_lowongan_no;?>" class="btn btn-primary clicking"  onclick="return confirm('Data Tidak Dapat Di Edit Ketika Telah Dicetak.');" target="_blank">Cetak</a>
                                  <?php else :?>
                                    <a href="<?php echo site_url('kontrak/cetak').'/'.$kontrak->apply_lowongan_no;?>" class="btn btn-primary clicking" target="_blank">Cetak</a>
                                  <?php endif;?>
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
      function submitForm(){
         $('#rules').show();
         document.getElementById("priodeawal").readOnly = true;
         document.getElementById("priodeakhir").readOnly = true;
         $('.addkontrak').hide();
      }
      function deleteaja(e){
          var idLowongan = "<?php echo $kontrak->apply_lowongan_no;?>";
          $.ajax
          ({
              type: "POST",
              url: "<?php echo site_url('kontrak/deleteKontrakAtch');?>",
              data: {"kontrakAtch":e,"idLowongan":idLowongan},
              cache: false,
              success: function (html) {
                  console.log(html);
                  window.location = "<?php echo site_url('Kontrak/detailkontrak').'/'.$kontrak->apply_lowongan_no;?>";
              }
          });
      }
      </script>
</body>
