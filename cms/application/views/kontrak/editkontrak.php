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
                  <li class="active">Add Kontrak</li>
              </ul>
              <!--breadcrumbs end -->
            </div>
        </div>
        <?php
        if (validation_errors()!="" || !empty($_SESSION['notiferror']) )
        {
            ?>
            <div class="row">
                <div class="col-lg-12">
                <div class="alert alert-block alert-danger fade in">
                    <button data-dismiss="alert" class="close close-sm" type="button">
                        <i class="icon-remove"></i>
                    </button>
                    <?php echo validation_errors(); ?>
                    <?php echo !empty($_SESSION['notiferror']) ? $_SESSION['notiferror'] : '' ;?>

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
                        <?php if($pelamarInfo->tipelowonganid=="CTGLWGN01"):?>
                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Form Kontrak </header>
                            <div class="form-group panel-body">
                                <div class="form-horizontal">
                                  <div class="form-group">
                                       <label for="setLocation" class="col-lg-2 col-sm-3 control-label">Priode</label>
                                       <div>
                                         <div class="col-lg-4">
                                           <div class="row">
                                             <div class="col-lg-5">
                                               <input type="text" class="form-control form_datetime2 priodeawal" name="priodeawal" id="priodeawal" placeholder="Priode Awal" value="<?php echo date('Y-m-d',strtotime($getKontrak->_periode_start));?>">
                                             </div>
                                             <label for="setLocation" class="col-lg-2 col-sm-1 control-label">s/d</label>
                                             <div class="col-lg-5">
                                               <input type="text" class="form-control form_datetime2 priodeakhir" name="priodeakhir" id="priodeakhir" placeholder="Priode Akhir" value="<?php echo date('Y-m-d',strtotime($getKontrak->_periode_end));?>">
                                             </div>
                                           </div>
                                         </div>
                                       </div>
                                  </div>
                               </div>
                            </div>
                          </div>
                        </section>
                        <?php endif;?>
                        <section class="panel">
                          <div class="row">
                            <header class="panel-heading">Rincian </header>
                            <div class="row">
                              <div class="col-lg-6">
                                <div class="form-group panel-body">
                                    <div class="form-horizontal">
                                        <div class="row col-xs-12">
                                        <div class="form-group">
                                             <label for="setLocation" class="col-lg-4 col-sm-7 control-label">Tipe</label>
                                               <div class="col-lg-6">
                                                    <select class="form-control m-bot15 tipe" id="tipe" name="tipe">
                                                      <option value="">Pilih</option>
                                                       <?php foreach ($select as $key => $value) :?>
                                                          <option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
                                                       <?php endforeach;?>
                                                     </select>
                                               </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="setLocation" class="col-lg-4 col-sm-6 control-label">Jumlah</label>
                                               <div class="col-lg-6">
                                                     <input type="text" class="form-control jumlah" name="jumlah" id="jumlah" onkeypress=" return isNumberKey(event)">
                                               </div>
                                        </div>
                                        <div class="form-group">
                                             <label for="setLocation" class="col-lg-2 col-sm-3 control-label">&nbsp;</label>
                                               <div class="col-lg-8">
                                                     <button class="btn btn-primary pull-right tambah" name="tambah" value="tambah" onclick="return submitForm();">Tambah</button>
                                               </div>
                                        </div>
                                      </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                <div class="col-lg-12">
                                  <br/>
                                  <table class="table table-hover table-bordered personal-task" id="example">
                                     <thead>
                                        <tr>
                                           <th>No</th>
                                           <th>Type Rincian</th>
                                           <th>Nominal</th>
                                           <th>Action</th>
                                        </tr>
                                     </thead>
                                     <tbody>
                                         <?php if($kontrakTemp):?>
                                           <input type="hidden" name="kontrak_attachment_no" value="1" id="kontrak_attachment_no"?>
                                         <?php else: ?>
                                           <input type="hidden" name="kontrak_attachment_no" value="" id="kontrak_attachment_no"?>
                                         <?php endif; ?>
                                         <?php foreach ($kontrakTemp as $key => $value) :?>
                                           <tr>
                                           <td><?php echo $value->_position?></td>
                                           <td><?php echo $value->_name?></td>
                                           <td><?php echo $value->_amount?></td>
                                           <td>
                                             <button value="<?php echo $value->kontrak_attachment_no;?>" onclick="return deleteaja(this.value)" class="btn btn-warning clicking">Delete </button>
                                           </td>
                                           </tr>
                                         <?php endforeach;?>
                                     </tbody>
                                  </table>
                                </div>
                              </div>
                            </div>

                            <div class="row text-center">
                              <button class="btn btn-primary" name="Submit" value="Submit" onclick="return submitKontrak()">Ubah Kontrak</button>
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
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
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

    <script type="text/javascript">
    $('.form_datetime2').datepicker({
        format: 'yyyy-mm-dd',
        todayHighlight:'TRUE',
        autoclose: true,
    });
    function isNumberKey(evt){
        var charCode = (evt.which) ? evt.which : event.keyCode
        if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;
        return true;
    }

    function submitKontrak(){
        var tipe = "<?php echo $pelamarInfo->tipelowonganid;?>";
        var priodeawal = $('#priodeawal').val();
        var priodeakhir = $('#priodeakhir').val();
        var rincian = $('#kontrak_attachment_no').val();
        var idLowongan = '<?php echo $pelamarInfo->nomerLamaran;?>';
        var typelowongan = '<?php echo $pelamarInfo->tipelowonganid;?>';
        var tempKontrak = '<?php echo !empty($idKontrakTemp) ? $idKontrakTemp : NULL ;?>';
        var kontrakNO = '<?php echo $kontrak->kontrak_no;?>';

        if(tipe =='CTGLWGN01'){
            if(rincian == ''){
                alert('Harap Membuat Rincian Terlebih Dahulu');
            }else if(priodeawal == '' || priodeakhir ==''){
                alert('Pastikan Kolom Periode Telah terisi semua');
            }else if(priodeawal > priodeakhir){
                alert('Pastikan Periode Awal Lebih Kecil Dari Priode Akhir .');
            }
            else{
                $.ajax
                ({
                    type: "POST",
                    url: "<?php echo site_url('kontrak/ajaxEditKontrak');?>",
                    data: {"priodeawal":priodeawal,"priodeakhir":priodeakhir,"typelowongan" :  typelowongan, "idLowongan":idLowongan,"tempKontrak":tempKontrak,"kontrakNO":kontrakNO},
                    cache: false,
                    success: function (html) {
                        console.log(html);
                        window.location = "<?php echo site_url('Kontrak')?>";
                    }
                });
            }
        }else{
          if(rincian == ''){
              alert('Harap Membuat Rincian Terlebih Dahulu');
          }else {
              $.ajax
              ({
                  type: "POST",
                  url: "<?php echo site_url('kontrak/ajaxEditKontrak');?>",
                  data: {"priodeawal":priodeawal,"priodeakhir":priodeakhir,"typelowongan" :  typelowongan, "idLowongan":idLowongan,"tempKontrak":tempKontrak,"kontrakNO":kontrakNO},
                  cache: false,
                  success: function (html) {
                      console.log(html);
                      window.location = "<?php echo site_url('Kontrak')?>";
                  }
              });
          }

        }


    }


    function submitForm(){
        var tipe = $('.tipe').val();
        var jumlah = $('.jumlah').val();
        var tempKontrak = '<?php echo !empty($idKontrakTemp) ? $idKontrakTemp : NULL ;?>';
        var idLowongan = '<?php echo $pelamarInfo->nomerLamaran;?>';
        var kontrakNO = '<?php echo $kontrak->kontrak_no;?>';
        if(tipe == '' || jumlah ==''){
            alert('Pastikan tipe telah dipilih dan jumlah telah terisi terimakash .');
        }else {
            $.ajax
            ({
                type: "POST",
                url: "<?php echo site_url('kontrak/ajaxKontrakatch');?>",
                data: {"tipe":tipe,"jumlah":jumlah,"tempKontrak" :  tempKontrak, "idLowongan":idLowongan,"kontrakNO": kontrakNO},
                cache: false,
                success: function (html) {
                    console.log(html);
                    window.location = "<?php echo site_url('Kontrak/editkontrak').'/'.$kontrak->apply_lowongan_no;?>";
                }
            });
        }


        console.log(tipe+''+jumlah);
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
                window.location = "<?php echo site_url('Kontrak/editkontrak').'/'.$kontrak->apply_lowongan_no;?>";
            }
        });
    }

    </script>
</body>
