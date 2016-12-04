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
        <h3 class="m-bot15"> Detail Pelamar </h3>
        <div class="row">
            <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="<?php echo site_url('');?>"><i class="icon-home"></i> Home</a></li>
                        <li><a href="<?php echo site_url('Pelamarcms')?>">Pelamar</a></li>
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
                <div class="col-xs-12">
                    <!-- Content Article -->
                    <section class="panel">
                        <header class="panel-heading">
                          Detail Pelamar
                        </header>
                        <div class="panel-body">
                            <div class="form-horizontal">
                              <form role="form" id="formid">

                              <div class="box-body">
                              <div class="row">
                                  <div class="form-group col-md-12">
                                      <label class="col-md-3 control-lable" for="lastName">Foto</label>
                                      <div class="col-md-6">
                                        <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                            <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                                <div class="fileupload-new thumbnail" style="width: 260px; height: 260px; background: #eee;">
                                                  <?php if(!empty($personalInfo->_photo_url)){
                                                      echo '<a href="'.$personalInfo->_photo_url.'" target="_blank"><img style="width: 250px; height: 250px;"  src="'.$personalInfo->_photo_url.'" /></a>';

                                                  }?>
                                                </div>
                                            </div>
                                        </div>
                                      </div>
                                  </div>
                              </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Nama Lengkap</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName"  value="<?php echo $personalInfo->_fullname;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Posisi Kerja</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" value="<?php echo $personalInfo->namapekerjaan;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Tempat Lahir</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir" value="<?php echo $personalInfo->tempatlahir;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Tanggal, Bulan dan Tahun Lahir</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir"  value="<?php echo $personalInfo->_birthdate;?>"  readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Jenis Kelamin</label>
                                       <div class="col-md-6">
                                         <?php if(isset($personalInfo->_gender)) :?>
                                            <?php if($personalInfo->_gender == 1) :?>
                                              <input type="text" path="lastName" id="lastName" name="tempatlahir" value="Perempuan" readonly="" class="form-control input-sm" required=""/>
                                            <?php else: ?>
                                              <input type="text" path="lastName" id="lastName" name="tempatlahir" value="Laki-Laki" readonly="" class="form-control input-sm" required=""/>
                                            <?php endif;?>
                                         <?php endif;?>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Agama</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir" value="<?php echo $personalInfo->agama;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Tinggi Badan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir" value="<?php echo $personalInfo->_height;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Berat Badan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir" value="<?php echo $personalInfo->_weight;?>"readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="lastName">Warna Kulit</label>
                                       <div class="col-md-6">
                                           <input type="text" path="lastName" id="lastName" name="tempatlahir" value="<?php echo $personalInfo->warnakulit;?>" readonly="" class="form-control input-sm" required=""/>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                 <div class="form-group col-md-12">
                                     <label class="col-md-3 control-lable" for="email">Alamat Email</label>
                                     <div class="col-md-6">
                                         <input type="text" path="email" id="email" value="<?php echo $personalInfo->_email;?>"  readonly="" class="form-control input-sm"/>
                                     </div>
                                 </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Nomor Telepon Rumah</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" name="telp_rumah" value="<?php echo $personalInfo->_phone_home;?>" readonly="" class="form-control input-sm" onkeypress="return istext(event)"/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No Ponsel 1</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" name="ponsel1" value="<?php echo $personalInfo->_phone_primary;?>" readonly="" class="form-control input-sm" onkeypress="return istext(event)" required=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No Ponsel 2</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" name="ponsel2" value="<?php echo $personalInfo->_phone_secondary;?>" readonly="" class="form-control input-sm" onkeypress="return istext(event)"/>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Status Pernikahan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" name="ponsel2" value="<?php echo $personalInfo->statuspernikahan;?>" readonly="" class="form-control input-sm" onkeypress="return istext(event)"/>
                                       </div>
                                   </div>
                               </div>

                               <?php if(!empty($personalFamily)) :?>
                               <?php $i = 0;?>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Nama Pasangan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" name="namapasangan"  value="<?php echo $personalFamily['pasangan']['nama'];?>" class="form-control input-sm" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <?php foreach ($personalFamily['anak']['nama'] as $key => $value) :$i++;?>
                                 <div class="row">
                                     <div class="form-group col-md-12">
                                         <label class="col-md-3 control-lable" for="email">Anak <?php echo $i;?></label>
                                         <div class="col-md-6">
                                             <input type="text" path="email" id="email" name="anakpertama" class="form-control input-sm" value="<?php echo $value?>" readonly=""/>
                                         </div>
                                     </div>
                                 </div>
                               <?php endforeach;?>
                             <?php endif;?>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Alamat lengkap sesuai KTP</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email"value="<?php echo $personalInfo->_address_ktp;?>" class="form-control input-sm" required="" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="country">Kelurahan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_address_ktp_kelurahan;?>" class="form-control input-sm" value="" readonly=""/>

                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="country">Kecamatan</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_address_ktp_kecamatan;?>" class="form-control input-sm" value="" readonly=""/>

                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="country">Kabupaten/Kota</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->kotasekarang;?>" class="form-control input-sm" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No KTP</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_ktp;?>" class="form-control input-sm" required="" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No SIM C</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_sim_c;?>"class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No SIM A</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_sim_a;?>"class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No SIM B1</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_sim_b1;?>"class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No SIM B2</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_sim_b2;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Kendaraan yang dimiliki</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->kepemilikankendaraan;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>

                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No NPWP</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_npwp;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No BPJS Ketenagakerjaan(jika ada)</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email"  value="<?php echo $personalInfo->_no_bpjs_tk;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No BPJS Kesehatan(jika ada)</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_bpjs_kesehatan;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No Kepersertaan Asuransi(jika ada)</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_no_insurance;?>"  class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">No Rekening (atas nama karyawan)</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" class="form-control input-sm"  value="<?php echo $personalInfo->_bank_account_no;?>"  onkeypress="return istext(event)"  readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Nama BANK</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->namabank;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Pendidikan terakhir</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->pedidikannama;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Pengalaman</label>
                                       <div class="col-md-6">
                                         <textarea class="form-control" cols="3" rows="3" readonly=""><?php echo $personalInfo->_experience;?></textarea>
                                       </div>
                                   </div>
                               </div>
                               <div class="row">
                                   <div class="form-group col-md-12">
                                       <label class="col-md-3 control-lable" for="email">Tahun Lulus</label>
                                       <div class="col-md-6">
                                           <input type="text" path="email" id="email" value="<?php echo $personalInfo->_pendidikan_year;?>" class="form-control input-sm" onkeypress="return istext(event)" value="" readonly=""/>
                                       </div>
                                   </div>
                               </div>


                               <div class="row">
                                 <div class="form-group col-md-12">
                                     <label class="col-md-3 control-lable" for="email">Tanggal Melamar</label>
                                     <div class="col-md-6">
                                         <input type="text" path="email" id="email" name="noasuransi" class="form-control input-sm" value="<?php echo $personalInfo->tglMelamar;  ?>" readonly=""/>
                                     </div>
                                 </div>
                             </div>
                             <div class="row">
                               <div class="form-group col-md-12">
                                   <label class="col-md-3 control-lable" for="email">&nbsp;</label>
                                   <div class="col-md-6">
                                      <a href="<?php echo site_url("Pelamarcms/cetak").'/'.$personalInfo->pelamar_no?>" class="btn btn-success" name="cetak" value="cetak" target="_blank">Cetak</a>
                                   </div>
                               </div>
                           </div>
                           </div><!-- /.box-body -->
                           </form>
                            </div>
                        </div>
                    </section>
              </div>
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

<script type="text/javascript" class="init">
$(".clicking").click(function(e){
    var txt = $('input[name="<?=$this->csrf['name'];?>"]');
    txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
});
</script>
<script>

</script>
</body>
