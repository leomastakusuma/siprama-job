<div id="overlay"></div>
    <style>
    body{
        background: #f1f2f7 !important;
    }
    .breadcrumb{
        background: #fff !important;
    }
    </style>
    <header class="header white-bg">
    <div class="sidebar-toggle-box">
        <div data-original-title="Toggle Navigation" data-placement="right" class="icon-reorder tooltips"></div>
    </div>
    <!--logo start-->
    <a href="<?php echo site_url();?>" class="logo">Recruitment System</a>
    <!--logo end-->
    <div class="top-nav ">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <?php /*<img alt="" src="<?php echo $images?>avatar1_small.jpg"> */ ?>
                    <span class="username"><?php

					$userInfo= $this->session->userdata('userinfo');
					echo $userInfo->_full_name;
					?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <div class="log-arrow-up"></div>
                    <!-- <li><a href="#"><i class=" icon-suitcase"></i>Profile</a></li> -->
                    <li style="width: 100%;"><a href="<?php echo site_url('settingusercms');?>"><i class="fa fa-key"></i>Change Password</a></li>
                    <!-- <li><a href="#"><i class="icon-bell-alt"></i> Notification</a></li> -->
                    <li><a href="<?php echo base_url() ?>logincms/logout"><i class="fa fa-sign-out"></i> Log Out</a></li>
                </ul>
            </li>
            <!-- user login dropdown end -->
        </ul>
        <!--search & user info end-->
    </div>
</header>
