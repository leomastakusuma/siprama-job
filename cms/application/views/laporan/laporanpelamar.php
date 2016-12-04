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
					<div class="width-79 text-24px text-right PT-25px height-35 ">LAPORAN PELAMAR MASUK</div>
				</div>


				<div class="width-100">
						<div class="width-100 MT-10px ">Periode <?php echo $start?> s/d <?php echo $end?></div>
						<div class="width-100 MT-10px ">
							<table class="text-11px width-100" border=1 cellpadding=4>
								<thead>
											<tr>
														  <th>No</th>
														  <th>Nama Lengkap</th>
								              <th>Pendidikan</th>
								              <th>No Ponsel</th>
								              <th>Alamat</th>
								              <th>Posisi Kerja</th>
								              <th>Tanggal Dibuat</th>
											</tr>
								</thead>
								<tbody>
										<?php $n= 0;?>
										<?php foreach ($pelamar as $key => $value) :$n++;?>
												<tr>
														<td><?php echo $n;?></td>
														<td><?php echo $value->_fullname ;?></td>
														<td><?php echo $value->pendidikan ;?></td>
														<td><?php echo $value->_phone_primary ;?></td>
														<td><?php echo $value->_address_ktp ;?></td>
														<td><?php echo $value->lowonganName ;?></td>
														<td><?php echo $value->tanggalDibuat ;?></td>
												</tr>

										<?php endforeach;?>
								</tbody>
							</table>

						</div>

				</div>
				<div class="clear"></div><br/>
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
