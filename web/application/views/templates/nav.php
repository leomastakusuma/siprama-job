<nav class="navbar navbar-default navbar-fixed-top navbar-sticky-function">

  <div class="container">

    <div class="logo-wrapper">
      <div class="logo">
        <a href="<?php echo site_url()?>"><img src="<?php echo $images?>big_logo.png" alt="Logo"></a>
      </div>
    </div>

    <div class="nav-mini-wrapper">
      <ul class="nav-mini sign-in">
        <?php $login = $this->session->userdata('userinfo');?>
        <?php if(!empty($login)):?>
            <li><a href="<?php echo site_url('Profile')?>">Profil</a></li>
            <li><a href="<?php echo site_url('Login/logout')?>">Keluar</a></li>
        <?php else:?>
            <li><a href="<?php echo site_url('Login')?>">Masuk</a></li>
            <li><a href="<?php echo site_url('Register')?>">Daftar</a></li>
        <?php endif;?>
      </ul>
    </div>

  </div>

</nav>
