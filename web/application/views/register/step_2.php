<?php  $images = $this->config->item('images');
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

			<!-- start hero-header -->
			<div class="breadcrumb-wrapper">

				<div class="container">

					<ol class="breadcrumb-list">
						<li><a href="<?php echo site_url('')?>">Home</a></li>
						<li><span>Mendaftar</span></li>
					</ol>

				</div>

			</div>
			<!-- end hero-header -->

			<div class="admin-container-wrapper">

				<div class="container">

					<div class="GridLex-gap-15-wrappper">

						<div class="GridLex-grid-noGutter-equalHeight">

							<div class="GridLex-col-12_sm-8_xs-12">

								<div class="admin-content-wrapper">

									<div class="admin-section-title">

										<h2>Mendaftar</h2>
										<p>Silahkan Masukan Data Diri Anda Sesuai Dengan Kolom Yang Tersedia .</p>

									</div>

									<div class="employee-detail-header" id="personal">
										<ul class="meta-list clearfix">
												<li class="active">
													<h4 class="heading">Data Personal</h4>
												</li>
												<li>
													<h4 class="heading">Data Keluarga</h4>
												</li>
												<li>
													<h4 class="heading">Selesai</h4>
												</li>
										</ul>
									</div>
									<div class="employee-detail-header" id="keluarga" style="display:none">
										<ul class="meta-list clearfix">
												<li >
													<h4 class="heading">Data Personal</h4>
												</li>
												<li  class="active">
													<h4 class="heading">Data Keluarga</h4>
												</li>
												<li>
													<h4 class="heading">Selesai</h4>
												</li>
										</ul>
									</div>
									<?php require ($includes.'alert.php');?>
                  <form class="post-form-wrapper" enctype="multipart/form-data" method="post" action="<?php echo site_url("Register/step2")?>">
										<div id="personaldata">

											<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="col-sm-12 col-md-6">
													<div class="form-group">
														<label>Photo</label>
														<div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
																<div class="fileupload2 fileupload-new" data-provides="fileupload">
																		<div class="fileupload-new thumbnail" style="width: 250px; height: 250px; background: #eee; ">
																		</div>
																		<div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 300px; max-height: 250px; line-height: 20px;"></div>
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
												</div>
											</div>

											<div class="col-sm-12 col-md-6">
												<div class="col-sm-12 col-md-12">
												<div class="row">
  													<div class="form-group">
  														<label>No KTP *</label>
  														<input type="text" class="form-control" placeholder="No KTP" name="n_ktp" id="ktp" maxlength="45" onkeypress="return isNumberKey(event)" value="<?php  echo !empty($_POST['ktp']) ? $_POST['ktp'] : ''?>">
  													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
						                            <div class="form-group">
						                              	<label>Nama Lengkap *</label>
						                              	<input type="text" class="form-control" placeholder="Nama Lengkap" name="n_lengkap" id="n_lengkap" maxlength="60" value="<?php  echo !empty($_POST['n_lengkap']) ? $_POST['n_lengkap'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
<<<<<<< HEAD
                							<div class="col-sm-12 col-md-6">
                  								<label>Tempat Tanggal Lahir *</label>
                  								<select class="selectpicker show-tick form-control mb-15 lokasilahir" data-live-search="false" name="tempat_lahir" id="ttl">
=======
                            							<div class="col-sm-12 col-md-6">
                            								<div class="row">
	                              								<label>Tempat Lahir *</label>
	                              								<select class="selectpicker show-tick form-control mb-15" data-live-search="false" name="tempat_lahir" id="ttl">
>>>>>>> c239ff469e7e64da9b58e2672306a7a52bbfd0cd
																	<option value="">Pilih</option>
																	<?php foreach ($kota as $key => $value) :?>
																		<?php if(!empty($_POST['tempat_lahir']) && $_POST['tempat_lahir']===$value->location_no) :?>
																			<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
																		<?php else :?>
																			<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
																		<?php endif;?>
																	<?php endforeach;?>
<<<<<<< HEAD
                  								</select>
                							</div>
                    					<div class="col-sm-12 col-md-6">
                      							<label>&nbsp;</label>
																		<input type="text" class="form-control form_datetime2" placeholder="Tanggal Lahir" name="tgl_lahir" id="tlahir"  value="<?php  echo !empty($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : ' '?>">
                  						</div>
=======
	                              								</select>
	                              							</div>
                            							</div>
	                            						<div class="col-sm-12 col-md-6">
	                            							<div class="row">
		                              							<label>Tanggal Lahir *</label>
																<input type="text" class="form-control form_datetime2" placeholder="Tanggal Lahir" name="tgl_lahir" id="tlahir"  value="<?php  echo !empty($_POST['tgl_lahir']) ? $_POST['tgl_lahir'] : ' '?>">
															</div>
	                            						</div>
>>>>>>> c239ff469e7e64da9b58e2672306a7a52bbfd0cd
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
  													<div class="form-group">
  														<label>Jenis Kelamin *</label>
  														<select class="selectpicker form-control" data-live-search="false" name="j_kelamin" id="j_kelamin">
																<option value="">Pilih</option>
																<?php if(isset($_POST['j_kelamin']) && $_POST['j_kelamin'] == 0) :?>
																	<option value="0" selected>Laki - Laki
	  															<option value="1">Perempuan
																<?php elseif ( !empty($_POST['j_kelamin']) && $_POST['j_kelamin'] == 1) :?>
																	<option value="0">Laki - Laki
	  															<option value="1" selected>Perempuan
																<?php else :?>
																	<option value="0">Laki - Laki
	  															<option value="1">Perempuan
																<?php endif;?>
  														</select>
  													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
						                            <div class="form-group">
						                             	<label>Agama *</label>
						                             	<select class="selectpicker form-control" data-live-search="false" name="agama" id="agama">
						                               		<option value="">PILIH</option>
																<?php foreach ($religion as $key => $value) :?>
																	<?php if(!empty($_POST['agama']) && $_POST['agama'] === $value->type_id) :?>
																		<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																	<?php else : ?>
																		<option value="<?php echo $value->type_id?>" ><?php echo $value->_name?></option>
																	<?php endif;?>
																<?php endforeach;?>
						                              	</select>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
  													<div class="form-group">
  														<label>Alamat (KTP) *</label>
                              							<textarea name="alamatktp" placeholder="Alamat KTP" id="alamatktp" class="form-control" rows="5" maxlength="300"><?php  echo !empty($_POST['alamatktp']) ? $_POST['alamatktp']  : '' ?></textarea>
  													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
  														<label>Keluharan (KTP) *</label>
  														<input type="text" class="form-control"  id="kelurahanktp" placeholder="Keluharan (KTP)" name="kelurahan" maxlength="45" value="<?php  echo !empty($_POST['kelurahan']) ? $_POST['kelurahan'] : ''?>">
                          							</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
  													<div class="form-group">
  														<label>Kecamatan (KTP) *</label>
  														<input type="text" class="form-control" placeholder="Kecamatan (KTP)" id="kecamatanktp" name="kecamatan" maxlength="45" value="<?php  echo !empty($_POST['kemacatan']) ? $_POST['kecamatan'] : ''?>">
  													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
						                            <div class="form-group">
						                    	        <label>Kota (KTP) *</label>
						                                <select class="selectpicker form-control kotaktp" data-live-search="false" name="ktp" id="kotaktp">
															<option value="">Pilih</option>
																<?php foreach ($kota as $key => $value) :?>
																	<?php if(!empty($_POST['ktp']) && $_POST['ktp'] === $value->location_no) :?>
																		<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
																	<?php else :?>
																		<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
																	<?php endif;?>
																<?php endforeach;?>
							                            </select>
								                    </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              	<label>Alamat Sekarang *</label>
						                              	<textarea name="alamat_sekarang" placeholder="Alamat Sekarang" class="form-control" rows="5" maxlength="300"><?php  echo !empty($_POST['alamat_sekarang']) ? $_POST['alamat_sekarang'] : ''?></textarea>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              	<label>Kota (Alamat Sekarang) *</label>
						                             	<select class="selectpicker form-control kotasekarang" data-live-search="false" name="kota_sekarang" id="kotasekarang">
															<option value="">Pilih</option>
															<?php foreach ($kota as $key => $value) :?>
																<?php if(!empty($_POST['kota_sekarang']) && $_POST['kota_sekarang'] === $value->location_no) :?>
																	<option value="<?php echo $value->location_no?>" selected><?php echo $value->_name?></option>
																<?php else : ?>
																	<option value="<?php echo $value->location_no?>"><?php echo $value->_name?></option>
																<?php endif ;?>
															<?php endforeach;?>
						                              	</select>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Telepon Rumah</label>
						                              <input type="text" class="form-control" placeholder="Telepon Rumah" onkeypress="return isNumberKey(event)" name="t_rumah" maxlength="25" value="<?php  echo !empty($_POST['t_rumah']) ? $_POST['t_rumah'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Telepon HP ke-1 *</label>
						                              <input type="text" class="form-control" placeholder="Telepon HP ke-1"  onkeypress="return isNumberKey(event)" name="t_hpke_1" maxlength="25" value="<?php  echo !empty($_POST['t_hpke_1']) ? $_POST['t_hpke_1'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label>Telepon HP ke-2</label>
														<input type="text" class="form-control" placeholder="Telepon HP ke-2"  onkeypress="return isNumberKey(event)" name="t_hpke_2" maxlength="25" value="<?php  echo !empty($_POST['t_hpke_2']) ? $_POST['t_hpke_2'] : ''?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
						                            <div class="col-sm-12 col-md-6">
														<div class="form-group">
															<div class="row">
								                              <label>Berat</label>
								                              <input type="text" class="form-control" placeholder="Berat (KG)" name="beratbadan" onkeypress="return isNumberKey(event)" maxlength="3" value="<?php !empty($_POST['beratbadan']) ? $_POST['beratbadan'] : ''  ?>">
								                            </div>
								                        </div>
								                    </div>

						                            <div class="col-sm-12 col-md-6">
						                            	<div class="form-group">
								                        	<div class="row">
								                              <label>Tinggi</label>
								                              <input type="text" class="form-control" placeholder="Tinggi (CM)" name="tinggibandan" onkeypress="return isNumberKey(event)" maxlength="3" value="<?php !empty($_POST['tinggibandan']) ? $_POST['tinggibandan'] : ''  ?>">
								                            </div>
								                        </div>
								                    </div>
                      							</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
                             							<label>Warna Kulit *</label>
														<select class="selectpicker form-control" data-live-search="false" name="warnakulit" id="warnakulit">
															<option value="">Pilih</option>
															<?php foreach ($warnakulit as $key => $value) :?>
																<?php if(!empty($_POST['warnakulit']) && $_POST['warnakulit'] === $value->type_id) :?>
																	<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																<?php else :?>
																	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																<?php endif;?>
															<?php endforeach;?>
														</select>
                          							</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
                              							<label>Status Pernikahan *</label>
                              							<select class="selectpicker form-control" data-live-search="true" id="s_pernikahan" name="s_pernikahan">
                                							<option value="">Pilih</option>
																<?php foreach ($statuspernikahan as $key => $value) :?>
																	 <?php if(!empty($_POST['s_pernikahan']) && $_POST['s_pernikahan'] === $value->type_id):?>
																		 <option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																	 <?php else :?>
																		 <option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																	 <?php endif;?>
																<?php endforeach;?>
                              							</select>
                          							 </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              	<label>Jumlah Anak</label>
						                              	<input type="text" class="form-control" placeholder="Jumlah Anak" name="jumlahanak"  id="jumlahanak" onkeypress="return isNumberKey(event)" maxlength="2" value="<?php !empty($_POST['jumlahanak']) ? $_POST['jumlahanak'] : ''?>">
						                            </div>
												</div>
												</div>
											</div>

											<div class="col-sm-12 col-md-6">

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label for="form-register-photo-2">Nama Orang Terdekat *</label>
														<input type="text" class="form-control" placeholder="Nama Orang Dekat" name="n_orang_t" maxlength="60" value="<?php  echo !empty($_POST['n_orang_t']) ? $_POST['n_orang_t'] : '';?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label for="form-register-photo-2">Telepon Orang Terdekat *</label>
														<input type="text" class="form-control" placeholder="Telepon Orang Terdekat" name="t_orang_t" onkeypress="return isNumberKey(event)" maxlength="20" value="<?php  echo !empty($_POST['t_orang_t']) ? $_POST['t_orang_t'] : ''?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label for="form-register-photo-2">No SIM A</label>
														<input type="text" class="form-control" placeholder="No SIM A" name="n_sim_a" maxlength="45" onkeypress="return isNumberKey(event)" value="<?php  echo !empty($_POST['n_sim_a']) ? $_POST['n_sim_a'] : ''?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label>No SIM B1</label>
														<input type="text" class="form-control" placeholder="No SIM B1" name="n_sim_b1" maxlength="45" onkeypress="return isNumberKey(event)" value="<?php  echo !empty($_POST['n_sim_b1']) ? $_POST['n_sim_b1'] : ''?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              	<label>No SIM B2</label>
						                              	<input type="text" class="form-control" placeholder="No SIM B2" name="n_sim_b2" id="simb" maxlength="45" onkeypress="return isNumberKey(event)"  value="<?php  echo !empty($_POST['n_sim_b2']) ? $_POST['n_sim_b2'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
					                              		<label>No SIM C</label>
					                              		<input type="text" class="form-control" placeholder="No SIM C" name="n_simc" maxlength="45"  onkeypress="return isNumberKey(event)" value="<?php  echo !empty($_POST['n_sim_c']) ? $_POST['n_sim_c'] : ''?>">
					                            	</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              	<label>Kendaraan Yang Dimiliki *</label>
						                              	<select class="selectpicker form-control" data-live-search="false" name="k_yang_dimiliki" id="kendaraan">
						                                	<option value="">Pilih</option>
															<?php foreach ($kendaraan as $key => $value) :?>
																<?php  if(!empty($_POST['k_yang_dimiliki']) && $_POST['k_yang_dimiliki'] === $value->type_id) :?>
																	<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																<?php else :?>
																	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																<?php endif; ?>
															<?php endforeach;?>
														</select>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                             	<label>No NPWP</label>
						                              	<input type="text" class="form-control" placeholder="No NPWP" name="npwp" maxlength="45" onkeypress="return isNumberKey(event)" value="<?php  echo !empty($_POST['npwp']) ? $_POST['npwp']  : '' ?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>No BPJS Ketenagakerjaan</label>
						                              <input type="text" class="form-control" placeholder="No BPJS Ketenagakerjaan" nonkeypress="return isNumberKey(event)" ame="bpjs_k" maxlength="45" value="<?php  echo !empty($_POST['bpjs_k']) ? $_POST['bpjs_k']  : '' ?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>No BPJS Kesehatan</label>
						                              <input type="text" class="form-control" placeholder="No BPJS Kesehatan" name="bpjs_kes" onkeypress="return isNumberKey(event)" maxlength="45" value="<?php  echo !empty($_POST['bpjs_kes']) ? $_POST['bpjs_kes'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Provider Asuransi *</label>
						                              <select class="selectpicker form-control" data-live-search="false" name="p_asuransi" id="p_asuransi">
						                               	 <option value="">Pilih</option>
																<?php foreach ($asuransi as $key => $value) :?>
																	<?php if(!empty($_POST['p_asuransi']) && $_POST['p_asuransi'] === $value->type_id) :?>
																			<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																	<?php else :?>
																			<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																	<?php endif;?>
																<?php endforeach;?>
														</select>
                            						</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>No Asuransi</label>
						                              <input type="text" class="form-control p_asuransi_rek" placeholder="No Asuransi" name="p_asuransi_rek" id="p_asuransi_rek" onkeypress="return isNumberKey(event)" maxlength="25" value="<?php  echo !empty($_POST['p_asuransi_rek']) ? $_POST['p_asuransi_rek'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Pendidikan Terakhir *</label>
						                              <select class="selectpicker form-control" data-live-search="false" name="pendidikan" >
						                                <option value="">Pilih</option>
																<?php foreach ($pendidikan as $key => $value) :?>
																	<?php if(!empty($_POST['pendidikan']) && $_POST['pendidikan'] === $value->type_id) :?>
																		<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																	<?php else :?>
																		<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																	<?php endif;?>
																<?php endforeach;?>
						                              </select>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
                              							<label>Tempat Pendidikan *</label>
                              							<input type="text" class="form-control" placeholder="Tempat Pendidikan" name="t_pendidikan" data-toggle="tooltip" data-placement="bottom" title="Jakarta / Bogor " maxlength="45" value="<?php  echo !empty($_POST['t_pendidikan']) ? $_POST['t_pendidikan'] : ''?>">
                            						</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Tahun Lulus *</label>
						                              <input type="text" class="form-control" placeholder="Tahun Lulus" name="t_lulus" id="t_lulus" onkeypress="return isNumberKey(event)" maxlength="4" value="<?php  echo !empty($_POST['t_lulus']) ? $_POST['t_lulus'] : ''?>">
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Provider Bank (Rekening) *</label>
						                              <select class="selectpicker form-control" data-live-search="false" name="p_bank" id="p_bank" >
						                                <option value="">Pilih</option>
															<?php foreach ($bank as $key => $value) :?>
																<?php if(!empty($_POST['p_bank']) && $_POST['p_bank'] ===  $value->type_id) :?>
																	<option value="<?php echo $value->type_id?>" selected><?php echo $value->_name?></option>
																<?php else :?>
																	<option value="<?php echo $value->type_id?>"><?php echo $value->_name?></option>
																<?php endif;?>
															<?php endforeach;?>
						                              </select>
						                            </div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
														<label>No Rekening</label>
														<input type="text" class="form-control" placeholder="No Rekening" name="p_bank_rek"  onkeypress="return isNumberKey(event)" size="12" id="p_bank_rek" onkeypress="return isNumberKey(event)" maxlength="45" value="<?php  echo !empty($_POST['p_bank_rek']) ? $_POST['p_bank_rek'] : ''?>">
													</div>
												</div>
												</div>

												<div class="col-sm-12 col-md-12">
												<div class="row">
													<div class="form-group">
						                              <label>Pengalaman *</label>
						                              <textarea name="pengalaman" placeholder="Pengalaman" id="pengalaman" class="form-control" rows="5"><?php  echo !empty($_POST['pengalaman']) ? $_POST['pengalaman'] : '';?></textarea>
														<br/>
														<div class="desktop" id="desktop" style="display:none">
																<input id="family" style="display:none" type="button" class="btn btn-primary pull-right" name="Simpan & Lanjut"  value="Simpan & Lanjut" onclick="showFamily()">
																<input id="nofamily" style="display:none" type="button" class="btn btn-primary pull-right" name="Simpan & Lanjut" value="Simpan & Lanjut" onclick="return checksubmit()">
														</div>
						                            </div>
												</div>
												</div>

											</div>
										</div>

											<div id="personalfamily" style="display:none">
												<div class="row gap-20">
														<div class="col-sm-12 col-md-6">
															<div class="form-group">
																<label for="form-register-photo-2">Nama Suami / Istri *</label>
																<input type="text" class="form-control" placeholder="Nama Suami / Istri" name="n_soi" id="n_soi" maxlength="60" value="<?php echo !empty($_POST['n_soi']) ? $_POST['n_soi'] : ''?>">
															</div>
														</div>
															<div class="clear"></div>
														<div class="col-sm-12 col-md-6">
															<div class="form-group">
																<label for="form-register-photo-2">Telepone</label>
																<input type="text" class="form-control" placeholder="Telepone" name="telp" maxlength="25"  value="<?php echo !empty($_POST['telp']) ? $_POST['telp'] : ''?>">
															</div>
														</div>
														<div class="clear"></div>
														<br/>
														<div class="col-sm-12 col-md-6">
																<div class="panel panel" id="datajumlahanak" style="display:none">
																	 <h3 class="panel-title">Data Anak</h3>
																	  <div class="panel-body">
																			<div class="col-sm-12 col-md-12">
																				<table class="table">
																				  <thead>
																				    <tr>
																				      <th>No</th>
																				      <th>Nama *</th>
																				      <th>Telepone</th>
																				    </tr>
																				  </thead>
																				  <tbody>
																				    <tr>
																				      <th scope="row"><div id="nomer"></div></th>
																				      <td><div id="namaanak" class="form-group"></div></td>
																				      <td><div id="telpanak" class="form-group" onkeypress="return isNumberKey(event)" ></div></td>
																				    </tr>
																	  		 </tbody>
																				</table>
																			</div>
																	  </div>
																</div>
																<div class="pull-right">
																	<input type="button" class="btn btn-primary" name="Simpan & Lanjut" value="Kembali Ke Pesonal Data" onclick="showPersonal()">
													 		  		<input type="button" class="btn btn-primary" name="Simpan" value="Simpan" id="simpandata" onclick="simpandatapersonaldanfamily()">
															  </div>
														</div>
														<div class="clear"></div>
												</div>
											</div>
									</form>


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
	$('#p_asuransi').change(function(){
		var p = $(this).val();
		if(p  && p !='INSPROVIDER00'){
			  console.log(p);
				document.getElementById("p_asuransi_rek").disabled = false;
		}else{
				document.getElementById("p_asuransi_rek").disabled = true;
		}
	});

	$('#p_bank').change(function(){
		var p = $(this).val();
		if(p && p !='BANK00'){
				document.getElementById("p_bank_rek").disabled = false;
		}else{
				document.getElementById("p_bank_rek").disabled = true;
		}
	});

	$('#s_pernikahan').change(function(){
		var p = $(this).val();
		if(p && p !='RELATIONSHIP02'){
			document.getElementById("jumlahanak").disabled = false;
			// $('#family').show();
			// $('#nofamily').hide();

		}else{
			document.getElementById("jumlahanak").disabled = true;
			$('#jumlahanak').val('');
			// $('#family').hide();
			// $('#nofamily').show();
		}
	});

	$('#nofamily').show();

	$('#personal').show();

	document.getElementById("jumlahanak").disabled = true;
	document.getElementById("p_asuransi_rek").disabled = true;
	document.getElementById("p_bank_rek").disabled = true;

	var sizeH = window.screen.availHeight;
	var sizeW = window.screen.availWidth;

	function isNumberKey(evt){
	    var charCode = (evt.which) ? evt.which : event.keyCode
	    if (charCode > 31 && (charCode < 48 || charCode > 57))
	        return false;
	    return true;
	}

	function checksubmit(){
		  var kelurahanktp = $('#kelurahanktp').val();
		  var kecatanktp = $('#kecamatanktp').val();
		  var alamatktp = $('#alamatktp').val();
		  var t_lulus = $('#t_lulus').val();
		  var pengalaman = $('#pengalaman').val();
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
			if( kelurahanktp == '' || alamatktp == '' || t_lulus == '' || pengalaman =='' || statuspernikahan == '' || warnakulit == '' || kotaktp =='' || agama=='' || kendaraan == '' || asuransi == '' || bank=='' || ktp =='' || kotasekarang=='' || namalengkap =='' || ttl=='' || tplahir =='' || jkelamin==''){
					alert('Pastikan Field Bertanda (*) Telah Terisi !!');
			}else
			if(rekeningbank == '' && bank != 'BANK00'){
					alert('Rekening Bank Tidak Boleh Kosong');
			}else if(rekening_asu == '' && asuransi != 'INSPROVIDER00'){
					alert('Rekening Asuransi Tidak Boleh Kosong');
			}else if(statuspernikahan != "RELATIONSHIP02"){
				  $('#personaldata').hide();
					$('#personalfamily').show();
					var j_anak = $('#jumlahanak').val();
					if(j_anak > 0){
					$('#datajumlahanak').show();
					var nama 	= document.getElementById("namaanak");
					var nomer = document.getElementById("nomer");
					var telp  = document.getElementById("telpanak");
					while (nomer.hasChildNodes()) {
							nomer.removeChild(nomer.lastChild);
					}
					while (nama.hasChildNodes()) {
							nama.removeChild(nama.lastChild);
					}
					while (telp.hasChildNodes()) {
							telp.removeChild(telp.lastChild);
					}

					for (i=0;i<j_anak;i++){
							var label = document.createElement("label");
							nomer.appendChild(label);
							nomer.appendChild(document.createTextNode((i+1)));

							var input = document.createElement("input");
							var nameid = "idanak" + i;
							input.type = "text";
							input.maxlength="60";
							input.name = "namaanak" + i;
							input.class="form-control" ;
							input.placeholder="Nama Anak";
							nama.appendChild(input).className="form-control";
							input.setAttribute("id",nameid);

							var inputtlp = document.createElement("input");
							inputtlp.type = "text";
							inputtlp.name = "telpanak" + i;
							inputtlp.maxlength="25";
							inputtlp.class="form-control" ;
							inputtlp.placeholder="No Telp";
							telp.appendChild(inputtlp).className="form-control";

					}
				}
			}
			else{
				$("#nofamily").prop("type", "submit");
			}
	}

	function showFamily(){
			var kendaraan = $('#kendaraan').val();
			var asuransi	= $('#p_asuransi').val();
			var rekening_asu = $('#p_asuransi_rek').val();
			var bank	= $('#p_bank').val();
			var rekeningbank = $('#p_bank_rek').val();
			if(kendaraan == '' && asuransi == '' &&  bank==''){
				alert('Pastikan Field Bertanda (*) Telah Terisi !!');
			}
			else if(asuransi && asuransi !='INSPROVIDER00' && rekening_asu =='' ){
					alert('Rekening Asuransi Wajib Di Isi');
			}else if(bank && bank !='BANK00' &&  rekeningbank =='' ){
					alert('Rekening Bank Wajib Di Isi');
			}
			else{
					$('#personaldata').hide();
					var j_anak = $('#jumlahanak').val();
					if(j_anak > 0){
					$('#datajumlahanak').show();
					var nama 	= document.getElementById("namaanak");
					var nomer = document.getElementById("nomer");
					var telp  = document.getElementById("telpanak");
					while (nomer.hasChildNodes()) {
							nomer.removeChild(nomer.lastChild);
					}
					while (nama.hasChildNodes()) {
							nama.removeChild(nama.lastChild);
					}
					while (telp.hasChildNodes()) {
							telp.removeChild(telp.lastChild);
					}

					for (i=0;i<j_anak;i++){
							var label = document.createElement("label");
							nomer.appendChild(label);
							nomer.appendChild(document.createTextNode((i+1)));

							var input = document.createElement("input");
							var nameid = "idanak" + i;
							input.type = "text";
							input.name = "namaanak" + i;
							input.class="form-control" ;
							input.placeholder="Nama Anak";
							nama.appendChild(input).className="form-control";
							input.setAttribute("id",nameid);

							var inputtlp = document.createElement("input");
							inputtlp.type = "text";
							inputtlp.name = "telpanak" + i;
							inputtlp.class="form-control" ;
							inputtlp.placeholder="No Telp";
							telp.appendChild(inputtlp).className="form-control";

					}
		  	}
				$('#personalfamily').show();
				$('#keluarga').show();
				$('#personal').hide();
			}

	}

	function showPersonal(){
			$('#personaldata').show();
			$('#personalfamily').hide();
			$('#keluarga').hide();
			$('#personal').show();
	}

	function simpandatapersonaldanfamily(){
			var namasti = $('#n_soi').val();
			var jumlahanak = $('#jumlahanak').val();
			if(namasti == ''){
				alert('Pastikan Nama Suami / Istri Terisi');
			}
			for(i=0;i<jumlahanak;i++){
				var namanak = $('#idanak'+i).val();
				if(namanak == ''){
					alert('Pastikan Nama Anak Terisi');
				}else{
					$("#simpandata").prop("type", "submit");
				}
			}
	}
	var height = window.screen.height;
	var width = window.screen.width
	if(height > 640 && width > 340){
		$('#desktop').show();
		$('#mobile').hide();

	}else{
		$('#desktop').hide();
		$('#mobile').show();
	}
</script>
<script>
	$('.form_datetime2').datepicker({
		format: 'yyyy-mm-dd',
		todayHighlight:'TRUE',
		autoclose: true

	});
</script>
