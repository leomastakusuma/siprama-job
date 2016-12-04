
<html>
	<head>
		<title>Siprama Cakrawala - Sistem Recruitment</title>
		<link rel="shortcut icon" href="http://yansen.dev.codigo.id/myr/Loker/images/favicon.ico">
		<link rel="stylesheet" type="text/css" href="http://yansen.dev.codigo.id/myr/Loker/assets/print_report.css" >
		<link href="http://yansen.dev.codigo.id/myr/Loker/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
	</head>
	<body>
		<center>
			<div class="main_container">
				<div class="width-100 ">
					<div class=" pull-right"><img src="<?php echo base_url()?>public_assets/img/big_logo.png"  width=200 alt="Logo"></div>
				</div>

				<div class="width-100">
          <div class="width-79 text-12px text-left PT-25px height-35 ">
            confidential
          </div>

					<div class="width-100 MT-10px ">
				<u>PERJANJIAN KERJASAMA KEMITRAAN</u><br>
				<strong>Nomor : <?php echo $kontrak->kontrak_no ?>/PKK/SC-FDN/<?php echo $bulan; ?>/<?php echo date('Y') ?></strong>
			</div>
			<div class="width-100 MT-10px text-11px text-left">
				Pada hari ini, <?php echo hari_ini(); ?> tanggal <strong><?php echo date('d') ?> </strong>bulan <strong> <?php echo bulan_ini(); ?> </strong>tahun <strong> <?php echo date('Y') ?></strong> di Tangerang, dibuat dan ditandatangani Perjanjian Kerjasama Kemitraan oleh dan antara :
			</div>
			<div class="width-100 MT-10px text-left">
				<table class="text-11px PL-15px width-100" cellpadding=4>
					<tr>
						<td width=20 valign="top">I</td>
						<td>
							<b><?php echo $pelamarInfo->branch;?></b>, suatu perseroan terbatas yang didirikan berdasarkan peraturan perundang-undangan yang berlaku di negara Republik Indonesia, berdudukan di Tangerang, beralamat di <?php echo $pelamarInfo->alamatbranch;?>, yang dalam hal ini diwakili oleh
							<b><?php echo $pelamarInfo->namalengkap; ?></b> dalam kedudukannya sebagai Direktur Operasional dari dan oleh karenanya sah bertindak untuk dan atas nama
							<b><?php echo $pelamarInfo->branch;?></b>, selanjutnya disebut
							<b>PIHAK PERTAMA.</b>
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">II</td>
						<td>
							<table class="text-11px width-100">
								<tr>
									<td width="100">Nama</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->namalengkap;?></td>
								</tr>
								<tr>
									<td width="100">Tempat/Tgl Lahir</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->tempatlahir.','.$pelamarInfo->tgllahir;?></td>
								</tr>
								<tr>
									<td width="100">Jenis Kelamin</td>
									<td width="20">:</td>
									<?php $gender = $pelamarInfo->_gender;?>
									<?php if($gender == '0'):?>
										<td>Laki-Laki</td>
									<?php else :?>
										<td>Perempuan</td>
									<?php endif;?>
								</tr>
								<tr>
									<td width="100">No. KTP</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->_no_ktp;?></td>
								</tr>
								<tr>
									<td width="150">Alamat Tempat Tinggal</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->_address_sekarang;?></td>
								</tr>
								<tr>
									<td width="100">No. Telp.</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->_phone_primary;?></td>
								</tr>
								<tr>
									<td width="100">No Rekening</td>
									<td width="20">:</td>
									<td><?php echo $pelamarInfo->_bank_account_no;?></td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</div>
			<div class="width-100 MT-10px text-11px text-left">
				selanjutnya disebut <b>PIHAK KEDUA.</b>
			</div>
			<div class="width-100 MT-10px text-11px text-left">
				Kedua Belah Pihak telah sepakat untuk melakukan Perjanjian Kerjasama Kemitraan dengan ketentuan persyaratan sebagai berikut :
			</div>
			<div class="width-100 MT-10px text-left">
				<table class="text-11px PL-15px width-100" cellpadding=4>
					<tr>
						<td width=20 valign="top">1.</td>
						<td>
							PIHAK PERTAMA akan mempekerjakan PIHAK KEDUA pada perusahaan <?php echo $pelamarInfo->branch;?> sebagai
							<b><?php echo $pelamarInfo->posisi; ?></b> yang ditempatkan pada <b><?php echo $pelamarInfo->ClientName; ?></b> sesuai dengan kebutuhan terhitung mulai tanggal
							<?php echo date('d')." ".bulan_ini()." ".date('Y'); ?>.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">2.</td>
						<td>
							PIHAK KEDUA selama bekerja di perusahaan PIHAK PERTAMA akan memperoleh imbalan jasa berupa Paket Gaji per bulan dengan rincian sebagai berikut :<br><br>
							<table class="text-12px PL-15px width-100" cellpadding=4>
									<?php foreach ($kontrakAtch as $key => $value) :?>
										<tr>
											<td width=20 valign="top"><li><?php echo $value->rincian;?></li></td>
											<td width=20 valign="top"><b>Rp. <?php echo number_format($value->_amount,0,'.','.');?>,-</b></td>
										<tr>
									<?php endforeach;?>
							</table>
							<br><br>
							Gaji di atas belum dikurangi dengan pajak pendapatan, iuran BPJS Ketenagakerjaan (2%) sebagaimana diatur dalam peraturan perundang-undangan yang berlaku.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">3.</td>
						<td>
							PIHAK KEDUA diwajibkan memakai seragam kerja yang sudah ditetapkan oleh PIHAK PERTAMA dimana pakaian tersebut harus rapih dan sopan dalam melakukan pekerjaan di lokasi kerja.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">4.</td>
						<td>
							Jam kerja akan diatur sesuai dengan jadwal kerja yang akan ditentukan berdasarkan keperluan sesuai dengan peraturan perundang-undangan yang berlaku, dimana hari kerja adalah 6 hari dalam seminggu.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">5.</td>
						<td>
							Perjanjian Kerjasama Kemitraan antara PIHAK PERTAMA dengan PIHAK KEDUA akan berakhir dengan sendirinya bila <?php echo $pelamarInfo->ClientName; ?> sewaktu-waktu memutuskan hubungan kerjasama dengan PIHAK PERTAMA, dan karenanya PIHAK PERTAMA tidak berkewajiban membayar kepada PIHAK KEDUA upah sisa masa kontrak dan/atau kompensasi dalam bentuk apapun juga.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">6.</td>
						<td>
							PIHAK PERTAMA dapat mengakhiri Perjanjian Kerjasama Kemitraan ini apabila PIHAK KEDUA melakukan pelanggaran berat sebagai berikut :<br>
							<ul>
								<li type="a">Melakukan penipuan, pencurian, atau penggelapan barang dan/atau uang milik perusahaan.</li>
								<li type="a">Melakukan pelanggaran-pelanggaran terhadap Tata Tertib Peraturan Perusahaan.</li>
								<li type="a">Memberikan keterangan palsu atau yang dipalsukan sehingga merugikan perusahaan.</li>
								<li type="a">Mabuk, meminum minuman keras yang memabukan, memakai dan atau mengedarkan narkotika, psikotropika, dan zat adiktif lainnya di tempat kerja.</li>
								<li type="a">Melakukan perbuatan asusila atau perjudian di tempat kerja.</li>
								<li type="a">Menyalahgunakan dan membocorkan informasi, data dan dokumen rahasia milik Pihak Pertama maupun Perusahaan Klien untuk kepentingan pribadi atau pihak ketiga.</li>
								<li type="a">Hal-hal lain yang bertentangan dengan peraturan perundang-undangan ketenagakerjaan yang berlaku saat ini.</li>
							</ul>
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">&nbsp;</td>
						<td>
							<b>Apabila PIHAK KEDUA melakukan pelanggaran seperti pada pasal 6 (a), maka PIHAK KEDUA bersedia menanggung kerugian tersebut dengan memberikan ganti rugi sesuai nilai material kerugian tersebut dalam bentuk uang atau barang kepada PIHAK PERTAMA, DAN/PIHAK KLIEN DAN/PELANGGAN KLIEN tanpa perlu menunggu keputusan Pengadilan.</b>
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">7.</td>
						<td>
							Pihak Pertama berhak untuk memberhentikan PIHAK KEDUA sewaktu-waktu apabila PIHAK KEDUA tidak mencapai target yang ditetapkan, dan karenanya PIHAK PERTAMA tidak berkewajiban membayar kepada PIHAK KEDUA upah sisa masa kontrak dan/atau kompensasi dalam bentuk apapun juga.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">8.</td>
						<td>
							PIHAK KEDUA menyatakan diri sehat jasmani dan rohani dan dibuktikan dengan Surat Keterangan Sehat dari dokter,  serta sanggup memenuhi kewajiban bekerja sesuai dengan ketentuan.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">9.</td>
						<td>
							PIHAK KEDUA dalam menjalankan tugasnya harus tunduk dan taat pada peraturan perusahaan PIHAK PERTAMA termasuk : bersedia mengundurkan diri apabila PIHAK KEDUA dinyatakan hamil.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">10.</td>
						<td>
							PIHAK KEDUA dapat mengajukan cuti tahunan setelah bekerja selama 12 bulan secaca terus menerus pada perusahaan PIHAK PERTAMA, sekurang-kurangnya 12 hari dalam setahun dengan masa berlaku bulan Januari sampai dengan bulan Desember setiap tahun dan pengajuan cuti menggunakan surat tertulis selambat-lambatnya 2 minggu sebelumnya kepada PIHAK PERTAMA.
						</td>
					</tr>
					<tr>
						<td width=20 valign="top">11.</td>
						<td>
							Hal-hal dan ketentuan lain dalam Perjanjian Kerjasama Kemitraan ini akan diatur dalam Surat Pernyataan yang akan ditanda tangani oleh PIHAK KEDUA yang merupakan kesatuan dan bagian yang tidak terpisahkan dari Perjanjian ini.
						</td>
					</tr>
				</table>
			</div>
			<div class="width-100 MT-10px text-11px text-left">
				Disetujui oleh kedua belah pihak pada hari ini, <?php echo hari_ini(); ?>, tanggal <?php echo date('d')." ".bulan_ini()." ".date('Y'); ?>.
			</div>
			<div class="width-100 MT-30px MB-50px">
				<div class="width-100 ML-15px">
					<div class="width-49 height-100" >
						<div class="width-100"><b>PIHAK KEDUA</b></div>
						<div class="width-100 text-11px text-left MT-10px">
						Saya telah membaca, mengerti dan setuju dengan
						Isi Perjanjian ini dengan ini pula saya menyatakan
						Bahwa Saya tidak akan melakukan tuntutan dalam
						Bentuk apapun Terhadap perusahaan setelah
						Berakhirnya Perjanjian Kerjasama Kemitraan ini.
						</div>
						<div class="width-100 text-11px text-center MT-60px">
							<b><?php echo $pelamarInfo->namalengkap; ?></b>
						</div>
					</div>
					<div class="width-49  height-100" >
						<div class="width-100"><b>PIHAK PERTAMA</b></div>
						<div class="width-100 text-11px text-left MT-30px">
						&nbsp;
						</div>
						<div class="width-100 text-11px text-center MT-60px">
							<b><u>Aris Yulianto Habibie</u></b><br>
							Direktur Operasional
						</div>
					</div>
				</div>
			</div>

				<div class="clear"></div>

			</div>
		</center>
	</body>
</html>
