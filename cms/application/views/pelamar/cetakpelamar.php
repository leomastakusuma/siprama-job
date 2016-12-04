<?php
$images = $this->config->item('images');
$css = $this->config->item('css');
$css = $this->config->item('css');
$js = $this->config->item('js');
$assets = $this->config->item('assets');
?>
<html>
	<head>
		<title>Siprama Cakrawala - Sistem Recruitment</title>
    <link href="<?php echo $css ?>print.css" rel="stylesheet">
    <link href="<?php echo $css ?>bootstrap.min.css" rel="stylesheet">

	</head>
	<body>
		<center>
			<div class="main_container">

				<div class="width-100 border-bottom-double">
					<div class="width-20 text-left"><img src="<?php echo $images?>big_logo.png"  width=125 alt="Logo"></div>
					<div class="width-79 text-24px text-right PT-25px height-35 ">LAPORAN DATA PELAMAR</div>
				</div>

          <div class="width-100">

            <div class="width-70 MT-10px text-left">
              	<table class="text-11px width-100" border=1 cellpadding=4>
              		<tr>
                    <td>Nama Lengkap</td>
                    <td><?php echo $personalInfo->_fullname;?></td>
                  </tr>
                  <tr>
                    <td>Posisi Kerja</td>
                    <td><?php echo $personalInfo->_fullname;?></td>
                  </tr>
                  <tr>
                    <td>Tempat Lahir</td>
                    <td><?php echo $personalInfo->place_birth;?></td>
                  </tr>
                  <tr>
                    <td>Tanggal, Bulan dan Tahun Lahir</td>
                    <td><?php echo $personalInfo->_birthdate;?></td>
                  </tr>
                  <tr>
                    <td>Jenis Kelamin</td>
                    <?php if ($personalInfo->_gender == '0'):?>
                    <td>L</td>
                    <?php else :?>
                    <td>P</td>
                    <?php endif;?>
                  </tr>

                  <tr>
                    <td>Agama</td>
                    <td><?php echo $personalInfo->agama;?></td>
                  </tr>
                  <tr>
                    <td>Tinggi Badan</td>
                    <td><?php echo $personalInfo->_height;?> cm</td>
                  </tr>
                  <tr>
                    <td>Berat Badan</td>
                    <td><?php echo $personalInfo->_weight;?></td>
                  </tr>
                  <tr>
                    <td>Warna Kulit</td>
                    <td><?php echo $personalInfo->warnakulit;?></td>
                  </tr>
                  <tr>
                    <td>Alamat Email</td>
                    <td><?php echo $personalInfo->_email?></td>
                  </tr>
                  <tr>
                    <td>Nomor Telepon Rumah</td>
                    <td><?php echo $personalInfo->_phone_home;?></td>
                  </tr>
                  <tr>
                    <td>No Ponsel1</td>
                    <td><?php echo $personalInfo->_phone_primary;?></td>
                  </tr>
                  <tr>
                    <td>No Ponsel2</td>
                    <td><?php echo $personalInfo->_phone_secondary;?></td>
                  </tr>
                  <tr>
                    <td>Status Pernikahan</td>
                    <td><?php echo $personalInfo->statuspernikahan?></td>
                  </tr>
                  <?php if (!empty($personalFamily)):?>
                   <?php if(!empty($personalFamily['pasangan'])):?>
                    <tr>
                      <td>Nama Pasangan</td>
                      <td><?php echo $personalFamily['pasangan']['nama'];?></td>
                    </tr>
                    <?php endif;?>
                    <?php if(!empty($personalFamily['anak'])):?>
                        <?php $nx=0;?>
                        <?php foreach ($personalFamily['anak']['nama']  as $key => $value) :$nx++;?>
                          <tr>
                            <td>Anak Ke - <?php echo $nx?></td>
                            <td><?php echo $value;?></td>
                          </tr>
                        <?php endforeach;?>
                    <?php endif;?>
                  <?php endif;?>
                  <tr>
                    <td>Alamat lengkap sesuai KTP</td>
                    <td><?php echo $personalInfo->_address_ktp;?></td>
                  </tr>
                  <tr>
                    <td>Kelurahan</td>
                    <td><?php echo $personalInfo->_address_ktp_kelurahan;?></td>
                  </tr>
                  <tr>
                    <td>Kecamatan</td>
                    <td><?php echo $personalInfo->_address_ktp_kecamatan;?></td>
                  </tr>
                  <tr>
                    <td>Kabupaten/Kota</td>
                    <td><?php echo $personalInfo->kotaktp;?></td>
                  </tr>
                  <tr>
                    <td>No KTP</td>
                    <td><?php echo $personalInfo->_no_ktp;?></td>
                  </tr>
                  <tr>
                    <td>No SIM C</td>
                    <td><?php echo $personalInfo->_no_sim_c;?></td>
                  </tr>
                  <tr>
                    <td>No SIM A</td>
                    <td><?php echo $personalInfo->_no_sim_a;?></td>
                  </tr>
                  <tr>
                    <td>No SIM B1</td>
                    <td><?php echo $personalInfo->_no_sim_b1;?></td>
                  </tr>
                  <tr>
                    <td>No SIM B2</td>
                    <td><?php echo $personalInfo->_no_sim_b2;?></td>
                  </tr>
                  <tr>
                    <td>No NPWP</td>
                    <td><?php echo $personalInfo->_no_npwp;?></td>
                  </tr>
                  <tr>
                    <td>No BPJS Ketenagakerjaan</td>
                    <td><?php echo $personalInfo->_no_bpjs_tk;?></td>
                  </tr>
                  <tr>
                    <td>No BPJS Kesehatan</td>
                    <td><?php echo $personalInfo->_no_bpjs_kesehatan;?></td>
                  </tr>
                  <tr>
                    <td>No Kepersertaan Asuransi</td>
                    <td><?php echo $personalInfo->_no_insurance;?></td>
                  </tr>
                  <tr>
                    <td>No Rekening</td>
                    <td><?php echo $personalInfo->_bank_account_no;?></td>
                  </tr>
                  <tr>
                    <td>Nama BANK</td>
                    <td><?php echo $personalInfo->namabank;?></td>
                  </tr>
                  <tr>
                    <td>Pendidikan Terakhir</td>
                    <td><?php echo $personalInfo->pedidikannama;?></td>
                  </tr>
                  <tr>
                    <td>Pengalaman</td>
                    <td><?php echo $personalInfo->_experience;?></td>
                  </tr>
                  <tr>
                    <td>Tahun Lulus</td>
                    <td><?php echo $personalInfo->_pendidikan_year;?></td>
                  </tr>
                  <tr>
                    <td>Tanggal Melamar</td>
                    <td><?php echo $personalInfo->tglMelamar;?></td>
                  </tr>
                </table>
            </div>

            <div class="width-24 MT-10px text-left pull-right">
              <a href="<?php echo $personalInfo->_photo_url;?>" target="_blank">
                <img style="width: 250px; height: 250px;" class="img img-responsive" src="<?php echo $personalInfo->_photo_url;?>">
              </a>
            </div>
        </div>
				<!-- <input type="button" name="Cetak" value="Cetak" class="btn btn-default pull-right" onclick="return cetak()"> -->
				<div class="clear"></div>

			</div>
		</center>
	</body>
	<script>
			function cetak() {
		    window.print();
		}
	</script>
</html>
