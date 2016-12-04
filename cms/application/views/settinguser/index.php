<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>
<?php $sess = $this->session->userdata('notifsukses');
if(!empty($sess)){
    echo '<META http-equiv="refresh" content="2;URL='.site_url('logincms/logout').'">';
}?>
<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <h3 class="m-bot15"> <?php echo $title;?> </h3>
            <div class="row">
                <div class="col-lg-12">
                    <!--breadcrumbs start -->
                    <ul class="breadcrumb">
                        <li><a href="#"><i class="icon-home"></i> Home</a></li>
                        <li><a href="#">Setting User</a></li>
                        <li class="active"><?php echo $title;?></li>
                    </ul>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <!-- COL LEFT -->
                <div class="col-xs-12">
                    <!-- Content Article -->
                    <section class="panel">
                        <div class="panel-body">
                            <form class="form-horizontal" role="form" action='<?php echo site_url('settingusercms/change');?>' method='POST' enctype='multipart/form-data'>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 col-sm-2 control-label">Old Password</label>
                                    <div class="col-lg-8">
                                        <div class="col-lg-6">
                                            <input type="password" required class="form-control" id="checkpassword" name='old'>
                                            <span id='callback'><?php echo $this->session->flashdata('old');?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 col-sm-2 control-label">New Password</label>
                                    <div class="col-lg-8">
                                        <div class="col-lg-6">
                                            <input type="password" required class="form-control" disabled id="newpwd" name='new'>
                                        </div>
                                        <div class='col-lg-6'>
                                            <span id="infopwd"></span>
                                        </div>
                                        <div style='clear:both'></div>
                                        <div class="col-lg-8">
                                            Your Passwords must contain a minimum of 8 characters which must include at least one upper case character and a number
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-lg-2 col-sm-2 control-label">Retype New Password</label>
                                    <div class="col-lg-8">
                                        <div class="col-lg-6">
                                            <input type="password" required onkeyup="myFunction()" class="form-control" disabled id="" name='retype'>
                                            <span id="usercheck2"><?php echo $this->session->flashdata('retype');?></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-sm-1">
                                        <button type="submit" disabled id="submitted" class="btn btn-info clicking">Change</button>
                                    </div>
                                    <div class="col-sm-1">
                                        <a href='javascript:history.back()' class="btn btn-danger">Cancel</a>
                                    </div>
                                    
                                </div>
                                
                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- footer -->
    <?php include($includes . "footer.php"); ?>
<?php include($includes . "footer-notif-general.php"); ?>
    <!-- notif footer general -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo $js;?>jquery.js"></script>
    <script src="<?php echo $js;?>bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo $js;?>jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo $js;?>jquery.scrollTo.min.js"></script>
    <script src="<?php echo $js;?>jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo $js;?>common-scripts.js"></script>
    <script src="<?php echo $js;?>jquery.cookie.js"></script>
    <script>
    $(".clicking").click(function(e){
        var txt = $('input[name="<?=$this->csrf['name'];?>"]');
        txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
    });
    var inputBox = document.getElementById('checkpassword');

    inputBox.onkeyup = function(){
        $.ajaxSetup({ headers: { 'csrftoken' : $.cookie('<?php echo $this->security->get_csrf_token_name();?>') } });
        $.ajax({
            url: "<?php echo site_url('settingusercms/check');?>", // point to server-side PHP script 
            dataType: 'json',  // what to expect back from the PHP script, if anything
            data: {old:inputBox.value},                         
            type: 'post',
            success: function(response3){
                if(response3.response=='success'){
                    $("[name='new']").prop("disabled",false);
                    $("[name='retype']").prop("disabled",false);
                    $("#callback").html(response3.response);
                }else{
                    $("[name='new']").prop("disabled",true);
                    $("[name='retype']").prop("disabled",true);
                    $("#submitted").prop("disabled",true);
                    $("#callback").html(response3.response);
                }
            }
        });
    }
    function myFunction(){
        as = $("[name='new']").val();
        bs = $("[name='retype']").val();
        if(as!=bs){
            $("#submitted").prop("disabled",true);
            $('#usercheck2').html("retype doesn't match new password");
        }else{
            $('#usercheck2').html("matched successfully");
            $("#submitted").prop("disabled",false);
        }
    }

    function scorePassword(pass) {
        var score = 0;
        if (!pass)
            return score;

        // award every unique letter until 5 repetitions
        var letters = new Object();
        for (var i=0; i<pass.length; i++) {
            letters[pass[i]] = (letters[pass[i]] || 0) + 1;
            score += 5.0 / letters[pass[i]];
        }

        // bonus points for mixing it up
        var variations = {
            digits: /\d/.test(pass),
            lower: /[a-z]/.test(pass),
            upper: /[A-Z]/.test(pass),
            nonWords: /\W/.test(pass),
        }

        variationCount = 0;
        for (var check in variations) {
            variationCount += (variations[check] == true) ? 1 : 0;
        }
        score += (variationCount - 1) * 10;

        return parseInt(score);
    }

    function checkPassStrength(pass) {
        var score = scorePassword(pass);
        if (score > 80)
            return "<span style='color:#5AAC1F'>strong</span>";
        if (score > 60)
            return "<span style='color:#EAD742'>good</span>";
        if (score <= 60)
            return "weak";

        return "";
    }

    $(document).ready(function() {
        $("#newpwd").on("keypress keyup keydown", function() {
            var pass = $(this).val();
            var ckp = checkPassStrength(pass);
            if(ckp=='weak'){
                $("#submitted").prop("disabled",true);
                $("#infopwd").html("<span style='color:#C64038'>weak</span>");
            }else{
                $("#infopwd").html(ckp);
            }
        });
    });
    </script>
</body>
