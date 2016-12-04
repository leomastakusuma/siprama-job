<?php $uri =  $_SERVER['REQUEST_URI'];
     $url = explode("/",$uri);
?>
<aside>
    <div id="sidebar"  class="nav-collapse ">

          <?php $ceks = $this->session->userdata('cek');?>
          <?php if(!empty($ceks)):?>
                <?php $cek = $ceks;?>
          <?php else: ?>
                <?php $cek = array();?>
          <?php endif;?>

          <?php if($url[2] === 'Corporatecms' || $url[2] === 'rolecms' || $url[2] === 'managementbrandcms' || $url[2] === 'Managementbrandcms'): ?>
            <?php $class1 ="class='active'"; ?>
          <?php else :?>
            <?php $class1 ='';?>
          <?php endif;?>


          <?php if($url[2] === 'Kontrak' || $url[2] === 'kontrak' || $url[2] === 'lowongancms' || $url[2] === 'lowonganpromotecms' ||$url[2] === 'Lowonganpromotecms'|| $url[2] ==='Interviewclientcms' || $url[2] === 'interviewclientcms' || $url[2]==='Interviewcms' || $url[2]==='interviewcms'|| $url[2]==='Psikotescms' ): ?>
            <?php $class2 ="class='active'"; ?>
          <?php else :?>
            <?php $class2 ='';?>
          <?php endif;?>

          <?php if($url[2] ==="Laporancms") :?>
            <?php $class3 ="class='active'"; ?>
          <?php else: ?>
            <?php $class3 ='';?>
          <?php endif;?>

        <!-- sidebar menu start-->
        <ul class="sidebar-menu" id="nav-accordion">
          <?php if(in_array("ROLE00006116",$cek)):?>
              <li class="sub-menu">
              <a href="javascript:;"  <?php echo $class1 ;?>>
                  <i class="icon-tasks"></i>
                  <span>System Management </span>
              </a>
              <ul class="sub">
                  <?php if(in_array('ROLE00003416',$cek)) :?>
                      <?php if(!empty($url[2]) && $url[2] === 'Corporatecms'):?>
                        <li class="active">
                      <?php else :?>
                        <li>
                      <?php endif;?>
                        <a  href="<?php echo site_url('Corporatecms')?>">Corporate Management</a>
                        </li>
                  <?php endif;?>
                  <?php if(in_array('ROLE00001516',$cek)) :?>
                        <?php if(!empty($url[2]) && $url[2] ==='rolecms'):?>
                        <li  class="active">
                        <?php else :?>
                        <li>
                        <?php endif;?>
                        <a href="<?php echo site_url('rolecms')?>">
                            <span>Entry Role Management</span>
                         </a>
                    </li>
                  <?php endif;?>
                  <?php if(in_array('ROLE00001616',$cek)) :?>
                      <li class="sub-menu" class="active">
                          <?php if(!empty($url[2]) && ($url[2]==='managementbrandcms' || $url[2]==='Managementbrandcms')):?>
                              <a href="javascript:;" class="active" >
                          <?php else :?>
                              <a href="javascript:;">
                          <?php endif; ?>
                              <span>Branch</span>
                          </a>
                          <ul class="sub">
                              <?php if(in_array('ROLE00002616',$cek)) :?>
                                    <?php if(!empty($url[3]) && $url[3] ==='branchRole') :?>
                                      <li>
                                    <?php elseif(!empty($url[2]) && ($url[2] ==='managementbrandcms' || $url[2] ==='Managementbrandcms')) :?>
                                       <?php if(!empty($url[3]) && $url[3]==='addBranchRole') :?>
                                         <li>
                                       <?php else:?>
                                         <li class="active">
                                      <?php endif;?>
                                    <?php else :?>
                                      <li>
                                    <?php endif;?>
                                      <a  href="<?php echo site_url('managementbrandcms')?>" > Entry Branch</a>
                                    </li>
                              <?php endif;?>
                              <?php if(in_array('ROLE00002716',$cek)) :?>
                                    <?php if(!empty($url[3]) && ($url[3] ==='branchRole' ||$url[3] ==='addBranchRole' )):?>
                                      <li class="active">
                                    <?php else :?>
                                      <li>
                                    <?php endif;?>
                                      <a  href="<?php echo site_url('managementbrandcms/branchRole')?>" > Entry Branch Role</a>
                                    </li>
                              <?php endif;?>
                          </ul>
                      </li>
                  <?php endif;?>
              </ul>
          </li>
          <?php endif;?>

          <?php if(in_array('ROLE00006216',$cek)) :?>
              <?php #if(in_array('ROLE00002316',$cek)) :?>
                <li class="sub-menu">
                <?php if(!empty($url[2]) && ($url[2]==='usercms' || $url[2]==='userrolecms' )):?>
                  <a href="javascript:;" class="active" >
                <?php else :?>
                  <a href="javascript:;" class="" >
                <?php endif; ?>
                      <i class="fa fa-user"></i>
                      <span>User Management</span>
                  </a>
                  <ul class="sub">
                      <?php if(in_array('ROLE00002816',$cek)) :?>
                          <?php if((!empty($url[2]) && $url[2]==='usercms') || (!empty($url[3]) && $url[3]==='userOperation')):?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif;?>
                              <a  href="<?php echo site_url('usercms')?>">Entry User</a>
                          </li>
                      <?php endif;?>
                      <?php if(in_array('ROLE00002916',$cek)) :?>
                          <?php if(!empty($url[2]) && $url[2]==='userrolecms' || (!empty($url[3]) && $url[3]==='Adduserrole')):?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif;?>
                              <a  href="<?php echo site_url('userrolecms')?>">Entry User Access</a>
                          </li>
                      <?php endif;?>
                  </ul>
              </li>
              <?php #endif;?>
          <?php endif;?>

          <?php if(in_array('ROLE00006316',$cek)):?>
              <?php #if(in_array('ROLE00004716',$cek)) :?>
                <li class="sub-menu">
                  <?php if(!empty($url[2]) && ($url[2]==='Pelamarcms' || $url[2]==='pelamarcms'|| $url[2]==='pekerjaancms' || $url[2]==='locationcms' || $url[2]==='Locationcms' || $url[2]==='Clientcms' || $url[2] === 'Soalcms' || $url[2] === 'soalcms' || $url[2] === 'Multimediacms' || $url[2] === 'Homeslidercms' || $url[2] === 'homeslidercms')):?>
                    <a href="javascript:;" class="active" >
                  <?php else :?>
                    <a href="javascript:;" class="" >
                  <?php endif; ?>
                      <i class="fa fa-book"></i>
                      <span>Master Data</span>
                  </a>
                  <ul class="sub">
                      <?php if(in_array('ROLE00004816',$cek)) :?>
                        <?php if(!empty($url[3]) && ($url[3]==='listpekerjaanbranch' || $url[3]==='Operation')): ?>
                            <li>
                        <?php elseif((!empty($url[2]) && $url[2]==='pekerjaancms')):?>
                            <li class="active">
                        <?php else :?>
                          <li>
                        <?php endif;?>
                            <a  href="<?php echo site_url('pekerjaancms')?>">Entry Data Pekerjaan</a>
                          </li>
                      <?php endif;?>
                      <?php if(in_array('ROLE00003716',$cek)) :?>
                            <?php if(!empty($url[2]) && ($url[2]==='Soalcms' || $url[2] === 'operation' || $url[2] === 'soalcms')):?>
                                <li class="active">
                            <?php else :?>
                               <li>
                            <?php endif ;?>
                                <a  href="<?php echo site_url('Soalcms')?>">
                                <span>Entry Soal</span>
                            </a>
                        </li>
                      <?php endif;?>
                      <?php /*if(in_array('ROLE00005116',$cek)) :?>
                          <?php if(!empty($url[3]) && ($url[3]==='listpekerjaanbranch' || $url[3]==='addpekerjaanbranch' || $url[3]==='Operation' )) :?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif;?>
                            <a  href="<?php echo site_url('pekerjaancms/listpekerjaanbranch')?>">Pekerjaan Branch</a>
                          </li>
                      <?php endif;*/?>
                      <?php /*if(in_array('ROLE00005716',$cek)) :?>

                            <?php if(!empty($url[2]) && ($url[2]==='locationcms' || $url[2]==='Locationcms')):?>
                              <li class="active">
                            <?php else :?>
                              <li>
                            <?php endif ;?>
                                <a  href="<?php echo site_url('locationcms')?>">
                                <span>Entry Data Location</span>
                            </a>
                        </li>
                      <?php endif; */?>
                      <?php if(in_array('ROLE00005516',$cek)) :?>
                          <?php if(!empty($url[2]) && ($url[2]==='Clientcms' || $url[2] === 'operation')):?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif ;?>
                          <a  href="<?php echo site_url('Clientcms')?>">

                                <span>Entry Data Klien</span>
                            </a>
                        </li>
                      <?php endif;?>
                      <?php if(in_array('ROLE00008316',$cek)) :?>
                          <?php if(!empty($url[2]) && ($url[2]==='Multimediacms' || $url[2] === 'multimediacms')):?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif ;?>
                          <a  href="<?php echo site_url('Multimediacms')?>">

                                <span>Entry Multimedia Bank</span>
                            </a>
                        </li>
                      <?php endif;?>
                      <?php if(in_array('ROLE00008816',$cek)) :?>
                          <?php if(!empty($url[2]) && ($url[2]==='Homeslidercms' || $url[2] === 'homeslidercms')):?>
                            <li class="active">
                          <?php else :?>
                            <li>
                          <?php endif ;?>
                          <a  href="<?php echo site_url('Homeslidercms')?>">

                                <span>Entry Homeslider</span>
                            </a>
                        </li>
                      <?php endif;?>
                      <?php if(in_array('ROLE00003716',$cek)) :?>
                            <?php if(!empty($url[2]) && ($url[2]==='Pelamarcms' || $url[2] === 'pelamarcms')):?>
                                <li class="active">
                            <?php else :?>
                               <li>
                            <?php endif ;?>
                                <a  href="<?php echo site_url('Pelamarcms')?>">
                                <span>Lihat Data Pelamar</span>
                            </a>
                        </li>
                      <?php endif;?>

                  </ul>
              </li>
              <?php #endif;?>
          <?php endif;?>


          <?php if(in_array('ROLE00006416',$cek)) :?>
          <li class="sub-menu">
              <a href="javascript:;" <?php echo $class2;?> >
                  <i class="icon-exchange"></i>
                  <span>Transaksi</span>
              </a>
              <ul class="sub">
                <?php if(in_array('ROLE00004116',$cek)) :?>
                    <?php if(!empty($url[2]) && ($url[2]==='lowongancms' || $url[2] === 'operation')):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('lowongancms')?>" class="active">
                          <span>Entry Lowongan</span>
                      </a>
                  </li>
                  <?php if(in_array('ROLE00007916',$cek)) :?>
                      <?php if(!empty($url[2]) && ($url[2]==='lowonganpromotecms' || $url[2]==='Lowonganpromotecms'  )):?>
                        <li class="active">
                      <?php else :?>
                        <li>
                      <?php endif ;?>
                        <a  href="<?php echo site_url('Lowonganpromotecms')?>" class="active">
                            <span>Entry Lowongan Promote</span>
                        </a>
                    </li>
                  <?php endif;?>
                <?php endif;?>

                <?php if(in_array('ROLE00006516',$cek)) :?>
                      <?php if(!empty($url[2]) && ($url[2]==='Psikotescms' || $url[2]==='psikotescms')):?>
                          <li class="active">
                      <?php else :?>
                         <li>
                      <?php endif ;?>
                          <a  href="<?php echo site_url('Psikotescms')?>">
                          <span>Seleksi Psikotes</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00006916',$cek)) :?>
                      <?php if(!empty($url[2]) && ($url[2]==='Interviewcms' || $url[2]==='interviewcms')):?>
                          <li class="active">
                      <?php else :?>
                         <li>
                      <?php endif ;?>
                          <a  href="<?php echo site_url('Interviewcms')?>">
                          <span>Entry Interview</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00007316',$cek)) :?>
                      <?php if(!empty($url[2]) && ($url[2]==='Interviewclientcms' || $url[2]==='Interviewclientcms')):?>
                          <li class="active">
                      <?php else :?>
                         <li>
                      <?php endif ;?>
                          <a  href="<?php echo site_url('Interviewclientcms')?>">
                          <span>Entry Interview Client</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00009616',$cek)) :?>
                      <?php if(!empty($url[2]) && ($url[2]==='Kontrak' || $url[2]==='Kontrak')):?>
                          <li class="active">
                      <?php else :?>
                         <li>
                      <?php endif ;?>
                          <a  href="<?php echo site_url('Kontrak')?>">
                          <span>Entry Kontrak Kerja</span>
                      </a>
                  </li>
                <?php endif;?>
              </ul>
          </li>
          <?php endif;?>

          <?php if(in_array('ROLE00008016',$cek)) :?>
          <li class="sub-menu">
              <a href="javascript:;" <?php echo $class3;?> >
                  <i class="fa fa-print"></i>
                  <span>Laporan</span>
              </a>
              <ul class="sub">
                <?php if(in_array('ROLE00008116',$cek)) :?>
                    <?php if(!empty($url[2]) && ($url[2]==='Laporancms' || $url[2] === 'Laporancms') && empty($url[3])):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('Laporancms')?>" class="active">
                          <span>Laporan Pelamar Masuk</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00009216',$cek)) :?>
                    <?php if(!empty($url[3]) && ($url[3]==='getlolos')):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('Laporancms/getlolos')?>" class="active">
                          <span>Pelamar Lolos</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00009316',$cek)) :?>
                    <?php if(!empty($url[3]) && ($url[3]==='getgagal')):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('Laporancms/getgagal')?>" class="active">
                          <span>Pelamar Gagal</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00009416',$cek)) :?>
                    <?php if(!empty($url[3]) && ($url[3]==='getrekapitulasi')):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('Laporancms/getrekapitulasi')?>" class="active">
                          <span>Rkp Pelamar Masuk</span>
                      </a>
                  </li>
                <?php endif;?>
                <?php if(in_array('ROLE00008216',$cek)) :?>
                    <?php if(!empty($url[3]) && ($url[3]==='lowongan')):?>
                      <li class="active">
                    <?php else :?>
                      <li>
                    <?php endif ;?>
                      <a  href="<?php echo site_url('Laporancms/lowongan')?>" class="active">
                          <span>Laporan Lowongan</span>
                      </a>
                  </li>
                <?php endif;?>


              </ul>
          </li>
          <?php endif;?>
        </ul>
        <!-- sidebar menu end-->
    </div>
</aside>



<script>

function simpanmenu(idmenu)
{
    localStorage.setItem("simpanmenu", idmenu);

}
function clearmenu()
{
   localStorage.removeItem("simpanmenu");
}

$( document ).ready(function() {
    setTimeout(function(){
      var ambilmenu = localStorage.getItem("simpanmenu");
       $("#"+ambilmenu).parent().addClass('active');
       $("."+ambilmenu).addClass('active');
       $("#"+ambilmenu).parent().parent().parent().find("a.bokapnya").click();
       var levelsatu = $("#"+ambilmenu).parent().parent().parent().find("a.bokapnya").text();
       var leveldua = $("#"+ambilmenu).parent().text();
      $("#levelsatu").text(levelsatu);
      $("#leveldua").text(leveldua);
       }, 1000);
});
</script>
