<?php $images = $this->config->item('images');
$icons = $this->config->item('icons');
$css = $this->config->item('css');
$js = $this->config->item('js');
$bootstrap = $this->config->item('bootstrap');
$includes = getcwd().'/application/views/templates/';
?>
<?php include($includes.'header.php');?>


<body class="not-transparent-header">

	<div id="introLoader" class="introLoading"></div>

	<!-- start Container Wrapper -->
	<div class="container-wrapper">

		<!-- start Header -->
		<header id="header">

      <!-- start Navbar (Header) -->
      <?php include($includes.'nav.php');?>
      <!-- end Navbar (Header) -->

		</header>

		<!-- start Main Wrapper -->
		<div class="main-wrapper">

			<!-- start breadcrumb -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list booking-step">
						<li><a href="<?php echo site_url()?>">Home</a></li>
						<li><span>Profile</span></li>
					</ol>

				</div>

			</div>
			<!-- end breadcrumb -->

			<div class="admin-container-wrapper">

				<div class="container">

					<div class="GridLex-gap-15-wrappper">

						<div class="GridLex-grid-noGutter-equalHeight">
              <div class="GridLex-col-3_sm-4_xs-12">

                <div class="admin-sidebar">

                  <div class="admin-user-item">

                    <div class="image">
                      <img src="<?php  echo base_url_upload_web.$personalInfo->_photo_enc_name;?>" alt="image" class="img-circle">
                    </div>

                    <h4><?php echo $personalInfo->_fullname?></h4>
                    <p class="user-role"><?php echo $userInfo->_email?></p>

                  </div>

  								<?php require ($includes.'menu.php');?>

								</div>

              </div>



              <div class="GridLex-col-9_sm-8_xs-12">

                <div class="admin-content-wrapper">

                  <div class="admin-section-title">

                    <h2>Hi, <?php echo $personalInfo->_fullname?> !</h2>

                  </div>
									<?php require ($includes.'alert.php');?>
                  <div id="personaldata">
										<form method="post" action="<?php echo site_url('Profile/personal')?>" enctype="multipart/form-data">
                    <div class="row gap-20">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Foto Anda</label>
                          <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                              <div class="fileupload2 fileupload-new" data-provides="fileupload">
                                  <div class="fileupload-new thumbnail" style="width: 250px; height: 250px; background: #eee; ">
																		<img src="<?php  echo base_url_upload_web.$personalInfo->_photo_enc_name;?>" alt="image" class="img-circle">
                                  </div>
                                  <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 250px; max-height: 250px; line-height: 20px;">
																	</div>
                                  <div>
                                      <span class="btn btn-default btn-file">
                                      <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                      <span class="fileupload-exists"><i class="fa fa-undo"></i> Change</span>
                                      <input type="file" class="default" name='profile' id="icon">
                                      </span>
                                      <a href="#" class="btn btn-danger fileupload-exists"
                                         data-dismiss="fileupload"><i class="fa fa-trash"></i> Remove</a>
                                  </div>
                              </div>
                          </div>
                        </div>
                      </div>
											<input type="hidden" value="<?php echo $personalInfo->pelamar_personal_info_no?>" name="personalInfo">
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="form-register-photo-2">Nama Orang Terdekat</label>
                          <input type="text" class="form-control" placeholder="Nama Orang Dekat" name="n_orang_t" value="<?php echo $personalInfo->_closer_person_fullname;?>" maxlength="60">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="form-register-photo-2">Telepon Orang Terdekat</label>
                          <input type="text" class="form-control" placeholder="Telepon Orang Terdekat" name="t_orang_t"  onkeypress="return isNumberKey(event)"  value="<?php echo $personalInfo->_closer_person_phone;?>" maxlength="25">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label for="form-register-photo-2">No SIM A</label>
                          <input type="text" class="form-control" placeholder="No SIM A" name="n_sim_a" value="<?php echo $personalInfo->_no_sim_a?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No SIM B1</label>
                          <input type="text" class="form-control" placeholder="No SIM B1" name="n_sim_b1" value="<?php echo $personalInfo->_no_sim_b1?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="clear"></div>


                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No KTP *</label>
                          <input type="text" class="form-control" placeholder="No KTP" name="n_ktp" id="ktp" value="<?php echo $personalInfo->_no_ktp;?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No SIM B2</label>
                          <input type="text" class="form-control" placeholder="No SIM B2" name="n_sim_b2" id="simb" value="<?php echo $personalInfo->_no_sim_b2?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Nama Lengkap *</label>
                          <input type="text" class="form-control" placeholder="Nama Lengkap" name="n_lengkap" id="n_lengkap" value="<?php echo $personalInfo->_fullname;?>" maxlength="60">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No SIM C</label>
                          <input type="text" class="form-control" placeholder="No SIM C" name="n_simc" value="<?php echo $personalInfo->_no_sim_c;?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="form-group">
                        <div class="col-sm-4 col-md-3">
                          <label>Tempat Tanggal Lahir *</label>
                          <select class="selectpicker show-tick form-control mb-15 lokasilahir" data-live-search="false" name="tempat_lahir" id="ttl">
                            <option value="">Pilih</option>
                            <?php foreach ($kota as $key => $value) :?>
															<?php if(!empty($personalInfo->place_birth) && $personalInfo->place_birth === $value->location_no) :?>
                              	<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
															<?php else: ?>
																<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                        <div class="col-sm-4 col-md-3">
                          <label>&nbsp;</label>
                          <input type="text" class="form-control form_datetime2" placeholder="" name="tgl_lahir" id="tlahir" value="<?php echo $personalInfo->_birthdate?>">
                        </div>



                        <div class="col-sm-4 col-md-6">
                          <label>Kendaraan Yang Dimiliki</label>
                          <select class="selectpicker form-control" data-live-search="false" name="k_yang_dimiliki" id="kendaraan">
                            <option value="">Pilih</option>
                            <?php foreach ($kendaraan as $key => $value) :?>
															<?php if(!empty($personalInfo->owned_kendaraan_id) && $personalInfo->owned_kendaraan_id ===$value->type_id):?>
                              <option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else:?>
																<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>

                      <div class="clear"></div>


                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Jenis Kelamin *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="j_kelamin" id="j_kelamin">
                            <option value="">Pilih</option>
														<?php if(isset($personalInfo->_gender)):?>
																<?php if($personalInfo->_gender == 0):?>
																	<option value="0" selected="">Laki - Laki
																	<option value="1">Perempuan
																<?php else :?>
																	<option value="0" >Laki - Laki
																	<option value="1" selected>Perempuan
																<?php endif;?>
														<?php else :?>
	                            <option value="0">Laki - Laki
	                            <option value="1">Perempuan
														<?php endif;?>
                          </select>
                        </div>
                      </div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No NPWP</label>
                          <input type="text" class="form-control" placeholder="No NPWP" name="npwp" value="<?php echo $personalInfo->_no_npwp;?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="clear"></div>


                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Agama *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="agama" id="agama">
                            <option value="">PILIH</option>
                            <?php foreach ($religion as $key => $value) :?>
															<?php if(!empty($personalInfo->religion_id) && $personalInfo->religion_id ===$value->type_id):?>
																<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
																<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No BPJS Ketenagakerjaan</label>
                          <input type="text" class="form-control" placeholder="No BPJS Ketenagakerjaan" name="bpjs_k" value="<?php echo $personalInfo->_no_bpjs_tk;?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Alamat (KTP) *</label>
                          <textarea name="alamatktp" placeholder="Alamat KTP" class="form-control" rows="5" maxlength="300"><?php echo $personalInfo->_address_ktp?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No BPJS Kesehatan</label>
                          <input type="text" class="form-control" placeholder="No BPJS Kesehatan" name="bpjs_kes" value="<?php echo $personalInfo->_no_bpjs_kesehatan;?>" maxlength="45"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Provider Asuransi *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="p_asuransi" id="p_asuransi">
                            <option value="">Pilih</option>
                            <?php foreach ($asuransi as $key => $value) :?>
															<?php if(!empty($personalInfo->insurance_id) && $personalInfo->insurance_id === $value->type_id) :?>
																<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Keluharan (KTP) *</label>
                          <input type="text" class="form-control" placeholder="Keluharan (KTP)" name="kelurahan" value="<?php echo $personalInfo->_address_ktp_kelurahan;?>" maxlength="45">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No Asuransi</label>
                          <input type="text" class="form-control p_asuransi_rek" placeholder="No Asuransi" name="p_asuransi_rek" id="p_asuransi_rek" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_no_insurance;?>" maxlength="45">
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Kecamatan (KTP) *</label>
                          <input type="text" class="form-control" placeholder="Kecamatan (KTP)" name="kecamatan" value="<?php echo $personalInfo->_address_ktp_kecamatan;?>" maxlength="45">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Pendidikan *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="pendidikan" >
                            <option value="">Pilih</option>
                            <?php foreach ($pendidikan as $key => $value) :?>
															<?php if(!empty($personalInfo->pendidikan_id) && $personalInfo->pendidikan_id === $value->type_id) :?>
																<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>

                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Kota (KTP) *</label>
                          <select class="selectpicker form-control kotaktp" data-live-search="false" name="ktp" id="kotaktp">
                            <option value="">Pilih</option>
                            <?php foreach ($kota as $key => $value) :?>
															<?php if(!empty($personalInfo->address_ktp_kota) && $personalInfo->address_ktp_kota === $value->location_no) :?>
																<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
															<?php else : ?>
                              	<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Tempat Pendidikan *</label>

                          <input type="text" class="form-control" placeholder="Tempat Pendidikan" name="t_pendidikan" data-toggle="tooltip" data-placement="bottom" title="Jakarta / Bogor " value="<?php echo $personalInfo->_pendidikan_place?>" maxlength="45">
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Alamat Sekarang *</label>
                          <textarea name="alamat_sekarang" placeholder="Alamat Sekarang" class="form-control" rows="5" maxlength="300"><?php echo $personalInfo->_address_sekarang?></textarea>
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Tahun Lulus *</label>
                          <input type="text" class="form-control" placeholder="Tahun Lulus" name="t_lulus" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_pendidikan_year?>" maxlength="4">
                        </div>
                      </div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Provider Bank (Rekening) *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="p_bank" id="p_bank" >
                            <option value="">Pilih</option>
                            <?php foreach ($bank as $key => $value) :?>
															<?php if(!empty($personalInfo->bank_id) && $personalInfo->bank_id === $value->type_id) :?>
																	<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              		<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Kota (Alamat Sekarang) *</label>
                          <select class="selectpicker form-control kotasekarang " data-live-search="false" name="kota_sekarang" id="kotasekarang">
                            <option value="">Pilih</option>
                            <?php foreach ($kota as $key => $value) :?>
															<?php if(!empty($personalInfo->address_sekarang_kota) && $personalInfo->address_sekarang_kota === $value->location_no ):?>
																<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              	<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Telepon Rumah</label>
                          <input type="text" class="form-control" placeholder="Telepon Rumah" name="t_rumah" value="<?php echo $personalInfo->_phone_home?>" maxlength="25"  onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                          <label>Telepon HP ke-1 *</label>
                          <input type="text" class="form-control" placeholder="Telepon HP ke-1" name="t_hpke_1"  value="<?php echo $personalInfo->_phone_primary?>" maxlength="25"  onkeypress="return isNumberKey(event)">
                        </div>
                        <div class="form-group">
                          <label>Telepon HP ke-2</label>
                          <input type="text" class="form-control" placeholder="Telepon HP ke-2" name="t_hpke_2"  value="<?php echo $personalInfo->_phone_secondary?>" maxlength="25"  onkeypress="return isNumberKey(event)">
                        </div>
                      </div>


                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>No Rekening</label>
                          <input type="text" class="form-control" placeholder="No Rekening" name="p_bank_rek" size="12" id="p_bank_rek" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_bank_account_no?>" maxlength="25">
                        </div>
                        <div class="form-group">
                          <label>Pengalaman *</label>
                          <textarea name="pengalaman" placeholder="Pengalaman" class="form-control" rows="5"><?php echo $personalInfo->_experience?></textarea>
                          <br/>
                          <div class="desktop" id="desktop" style="display:none" >
                              <input id="nofamily"  type="button" class="btn btn-primary pull-right" name="Update" value="Update" onclick="return checksubmit()">
                          </div>
                        </div>
                      </div>

                      <div class="clear"></div>


                      <div class="form-group">
                        <div class="col-sm-4 col-md-3">
                          <label>Berat - Tinggi</label>
                          <input type="text" class="form-control" placeholder="Berat (KG)" name="beratbadan" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_weight?>" maxlength="3">
                        </div>
                        <div class="col-sm-4 col-md-3">
                          <label>&nbsp;</label>
                          <input type="text" class="form-control" placeholder="Tinggi (CM)" name="tinggibandan" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_height?>" maxlength="3">
                        </div>
                      </div>

                      <div class="clear"></div>
                      <div class="clear"></div>
                      <br/>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Warna Kulit *</label>
                          <select class="selectpicker form-control" data-live-search="false" name="warnakulit" id="warnakulit">
                            <option value="">Pilih</option>
                            <?php foreach ($warnakulit as $key => $value) :?>
															<?php if(!empty($personalInfo->skin_color_id) && $personalInfo->skin_color_id === $value->type_id):?>
																<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="clear"></div>
                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Status Pernikahan *</label>
                          <select class="selectpicker form-control" data-live-search="true" id="s_pernikahan" name="s_pernikahan">
                            <option value="">Pilih</option>
                            <?php foreach ($statuspernikahan as $key => $value) :?>
															<?php if(!empty($personalInfo->relationship_id) && $personalInfo->relationship_id === $value->type_id ):?>
																<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
															<?php else :?>
                              	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
															<?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                      </div>
                      <div class="clear"></div>

                      <div class="col-sm-12 col-md-6">
                        <div class="form-group">
                          <label>Jumlah Anak</label>
                          <input type="text" class="form-control" placeholder="Jumlah Anak" name="jumlahanak"  maxlength="2" id="jumlahanak" onkeypress="return isNumberKey(event)" value="<?php echo $personalInfo->_total_children?>">
                        </div>
                        <br/>
                        <div class="mobile" id="mobile" style="display:none">
                        <input type="button"  id="nofamily"  class="btn btn-primary pull-right" name="Update" value="Update" onclick="checksubmit()">
                        </div>
                      </div>
                      <div class="clear"></div>

                    </div>
									</form>
                  </div>

                </div>

              </div>


				   </div>

					</div>

				</div>

			</div>


      			<?php include($includes.'footer.php');?>

      		</div>
      		<!-- end Main Wrapper -->

      	</div> <!-- / .wrapper -->
      	<!-- end Container Wrapper -->



      <?php include($includes.'footer-file.php');?>
      <script type="text/javascript" src="<?php echo $bootstrap?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
			<script type="text/javascript" src="<?php echo $bootstrap?>select/select2.full.js"></script>

      <script type="text/javascript">
			$('.lokasilahir').select2();
			$('.kotaktp').select2();
			$('.kotasekarang').select2();
			function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57))
							return false;
					return true;
			}
			$('#p_asuransi').change(function(){
				var p = $(this).val();
				if(p && p!='INSPROVIDER00'){
						document.getElementById("p_asuransi_rek").disabled = false;
				}else{
						document.getElementById("p_asuransi_rek").disabled = true;
				}
			});

			$('#p_bank').change(function(){
				var p = $(this).val();
				if(p && p!='BANK00'){
						document.getElementById("p_bank_rek").disabled = false;
				}else{
						document.getElementById("p_bank_rek").disabled = true;
				}
			});

      var height = window.screen.height;
      var width = window.screen.width
      if(height > 640 && width > 340){
        $('#desktop').show();
        $('#mobile').hide();

      }else{
        $('#desktop').hide();
        $('#mobile').show();
      }
				$('.form_datetime2').datepicker({
					format: 'yyyy-mm-dd',
					todayHighlight:'TRUE',
					autoclose: true

				});
				function checksubmit(){
						var kendaraan = $('#kendaraan').val();
						var asuransi	= $('#p_asuransi').val();
						var rekening_asu = $('#p_asuransi_rek').val();
						var bank	= $('#p_bank').val();
						var rekeningbank = $('#p_bank_rek').val();
						var ktp =$('#ktp').val();
						var simb = $('#simb').val();
						var kotasekarang = $('#kotasekarang').val();
						var namalengkap = $('#n_lengkap').val();
						var ttl = $('#ttl').val();
						var tplahir = $('#tlahir').val();
						var jkelamin = $('#j_kelamin').val();
						var agama	= $('#agama').val();
						var kotaktp = $('#kotaktp').val();
						var warnakulit = $('#warnakulit').val();
						var statuspernikahan = $('#s_pernikahan').val();
						if( statuspernikahan == '' || warnakulit == '' || kotaktp =='' || agama=='' || kendaraan == '' || asuransi == '' || bank=='' || ktp =='' || kotasekarang=='' || namalengkap =='' || ttl=='' || tplahir =='' || jkelamin==''){
								alert('Pastikan Field Bertanda (*) Telah Terisi !!');
						}else
						if(rekeningbank == '' && bank != 'BANK00'){
								alert('Rekening Bank Tidak Boleh Kosong');
						}else if(rekening_asu == '' && asuransi != 'INSPROVIDER00'){
								alert('Rekening Asuransi Tidak Boleh Kosong');
						}else{
							$("#nofamily").prop("type", "submit");
						}
				}

      </script>
