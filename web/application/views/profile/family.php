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

										<h2>Data keluarga</h2>

									</div>

                  <form class="post-form-wrapper" action="<?php echo site_url('Profile/family')?>" method="POST">

  										<?php require ($includes.'alert.php');?>

											<div class="col-sm-6 col-md-6">

												<div class="form-group">
													<label>Nama Suami / Istri *</label>
                          <input type="hidden" class="form-control" value="<?php echo $personalFamily[0]->pelamar_family_info_no?>" name="familyInfo">
                          <input type="text" class="form-control" value="<?php echo $personalFamily[0]->_name?>" name="nsoi">
												</div>

											</div>

											<div class="clear"></div>

											<div class="col-sm-6 col-md-6">

												<div class="form-group">
													<label>Telepon</label>
													<input type="text" class="form-control" value="<?php echo $personalFamily[0]->_phone?>" name="telp"placeholder="Not Required">
												</div>

											</div>

											<div class="clear"></div>
											<div class="col-sm-2 col-md-2">
												<div class="form-group">
													<label>Jumlah Anak </label>
													<input type="hidden"  value="<?php echo $personalInfo->pelamar_personal_info_no?>" name="NoPersonalInfo">
													<input type="text" onkeypress="return isNumberKey(event)" class="form-control" value="<?php echo $personalInfo->_total_children?>"  size="2" max-size="10" name="jumlahanak" placeholder="Not Required" maxlength="2">
												</div>

											</div>

											<div class="clear"></div>

											<div class="col-sm-12 mt-10">
												<input type="submit" class="btn btn-primary" name="update" value="update">
											</div>
											<br/><br/>
										</form>

                      <br/>
											<div class="col-sm-12 col-md-12">

												<h4>Data Anak</h4>

												<div class="table-responsive mt-10">
													<table class="table table-hover">
														<thead>
															<tr>
																<th>No</th>
																<th>Nama *</th>
																<th>Telepon</th>
                                <th>Edit</th>
															</tr>
														</thead>
														<tbody>
															<?php $totalChild = $personalInfo->_total_children;?>
															<input type="hidden" name="personalInfoNo" value="<?php echo $personalInfo->pelamar_no?>" class="form-control"  id="personalInfoNo">
															<?php $max =0;?>
															<?php foreach ($personalFamily as $key => $value) :?>
                                <?php if($value->family_type_id !='FAMILY02') :?>
                                <tr>
																		<?php if($key <= $totalChild) :?>
		  																<td><?php echo $key;?></td>
		  																<td><input type="text" name="testing" value="<?php echo $value->_name?>" class="form-control" disabled id="nmanak<?php echo $value->pelamar_family_info_no?>" required></td>
		  																<td><input type="text" name="testing" value="<?php echo $value->_phone?>" onkeypress="return isNumberKey(event)"  class="form-control" disabled id="tlpanak<?php echo $value->pelamar_family_info_no?>" required></td>
		                                  <td>
																					<button type="button" value="<?php echo $value->pelamar_family_info_no?>" class="btn btn-sm btn-primary" id="familyedit<?php echo $value->pelamar_family_info_no?>" onclick="return editfamily(this.value);"><i class="fa fa-pencil"></i></button>
																					<button style="display : none" type="button" value="<?php echo $value->pelamar_family_info_no?>" class="btn btn-sm btn-primary" id="familysave<?php echo $value->pelamar_family_info_no?>" onclick="return savefamily(this.value)"><i class="fa fa-floppy-o"></i></button>
																					<button type="button" value="<?php echo $value->pelamar_family_info_no?>" class="btn btn-sm btn-danger" id="familydelete<?php echo $value->pelamar_family_info_no?>" onclick="return familydelete(this.value);"><i class="fa fa-times"></i></button>
																			</td>
																		<?php endif;?>
																</tr>
																<?php $max = $key;?>
                              <?php endif;?>
                              <?php endforeach;?>
															<?php for($i = 1 ; $i<=$totalChild;$i++) :?>
																<tr>
																	<?php if($i > $max):?>
																		<td><?php echo $i;?></td>
																		<td><input type="text" name="namanak<?php echo $i;?>" value="" class="form-control"  id="nmanak<?php echo $i?>"></td>
																		<td><input type="text" name="telp<?php echo $i;?>" value="" class="form-control"  onkeypress="return isNumberKey(event)"  id="tlpanak<?php echo $i?>"></td>
																		<td>
																			<button type="button" value="<?php echo $i?>" class="btn btn-sm btn-primary" id="add<?php echo $i?>" onclick="return addFamily(this.value)"><i class="fa fa-floppy-o"></i></button>
																		</td>
																	<?php endif;?>
															<?php endfor;?>
														</tr>
														</tbody>
													</table>
												</div>

											</div>

											<div class="clear"></div>

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
			<script type="text/javascript">
			function isNumberKey(evt){
					var charCode = (evt.which) ? evt.which : event.keyCode
					if (charCode > 31 && (charCode < 48 || charCode > 57))
							return false;
					return true;
			}
			function editfamily(e){
					document.getElementById("nmanak"+e).disabled = false;
					document.getElementById("tlpanak"+e).disabled = false;
					$('#familysave'+e).show();
					$('#familyedit'+e).hide();
			}
			function savefamily(e){
				var pelamarFamily = e;
				var anak = $('#nmanak'+e).val();
				var telp = $('#tlpanak'+e).val();
				$.ajax
				({
						type: "POST",
						url: "<?php echo site_url('profile/ajaxsavefamily');?>",
						data: {'formanak':anak,'formtlp' : telp, 'pelamarFamily': pelamarFamily},
						cache: false,
						success: function (html) {
								document.getElementById("nmanak"+e).disabled = true;
								document.getElementById("tlpanak"+e).disabled = true;
								$('#familysave'+e).hide();
								$('#familyedit'+e).show();
								location.reload();
						}
				});
			}

			function addFamily(e){
				var anak = $('#nmanak'+e).val();
				var telp = $('#tlpanak'+e).val();
				var pelamarNo = $('#personalInfoNo').val();
				console.log(anak);
				console.log(telp);
				console.log(pelamarNo);
				$.ajax
				({
						type: "POST",
						url: "<?php echo site_url('profile/ajaxaddfamily');?>",
						data: {'formanak':anak,'formtlp' : telp, 'pelamarNo': pelamarNo},
						cache: false,
						success: function (html) {
								document.getElementById("nmanak"+e).disabled = true;
								document.getElementById("tlpanak"+e).disabled = true;
								$('#familysave'+e).hide();
								$('#familyedit'+e).show();
								location.reload();
						}
				});
			}

			function familydelete(e){
				var personalFamilyNo = e;
				var pelamarNo = $('#personalInfoNo').val();
				console.log(e);
				console.log(pelamarNo);
				$.ajax
				({
						type: "POST",
						url: "<?php echo site_url('profile/ajaxchangeFamily');?>",
						data: {'personalFamilyNo':personalFamilyNo, 'pelamarNo': pelamarNo},
						cache: false,
						success: function (html) {
								document.getElementById("nmanak"+e).disabled = true;
								document.getElementById("tlpanak"+e).disabled = true;
								$('#familysave'+e).hide();
								$('#familyedit'+e).show();
								location.reload();
						}
				});
			}

			</script>
