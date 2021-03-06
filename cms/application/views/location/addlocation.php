<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd() . '/application/views/includes/'; ?>
<?php include($includes . "/header.php"); ?>

<body>
<?php include($includes . "/nav.php"); ?>
<?php include($includes . "/sidebar-menu.php"); ?>

<!-- main content start -->
<style>
    .cancelling{
        display:none;
    }
</style>
      <!-- main content start -->
<section id="main-content">
<section class="wrapper">
  <h3 class="m-bot15"> Location </h3>
  <div class="row">
     <div class="col-lg-12">
        <!--breadcrumbs start -->
        <ul class="breadcrumb">
        <li><a href="<?php echo site_url()?>"><i class="icon-home"></i> Home</a></li>
        <li><a href="<?php echo site_url('Locationcms')?>">Location</a></li>
        <li class="active">ADD Location</li>
        </ul>
        <!--breadcrumbs end -->
     </div>
  </div>
    <?php $session = $this->session->all_userdata();?>

    <?php
    if (validation_errors()!="")
    {
        ?>
        <div class="row">
            <div class="col-lg-12">
            <div class="alert alert-block alert-danger fade in">
                <button data-dismiss="alert" class="close close-sm" type="button">
                    <i class="icon-remove"></i>
                </button>
                <?php echo validation_errors(); ?>
            </div>
            </div>
        </div>
        <?php
    }
    ?>
    <div class="row">
      <div class="col-lg-8" id="panel2">
        <section class="panel">
              <div class="panel-body">
                <div class="form-horizontal">
                    <section class="panel">
                        <form  action="<?php echo base_url() ?>locationcms/addlocation" method="post">
                          <div class="form-group">
                            <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Tipe Lokasi</label>
                            <div class="col-lg-8">
                              <select class="form-control m-bot15 level" id="level" name="level">
                                <option value="">Pilih Tipe Lokasi</option>
                                <?php foreach($location_type as $k=>$baris) :?>
                                   <?php if(!empty($_POST['level']) && ($_POST['level']== $baris->type_id)) :?>
                                     <option selected value="<?php echo $baris->type_id;?>"><?php echo $baris->_name ?></option>'
                                   <?php else :?>
                                     <option value="<?php echo $baris->type_id;?>"><?php echo $baris->_name ?></option>'
                                   <?php endif;?>
                                <?php endforeach ;?>
                              </select>
                            </div>
                          </div>
                          <div class="negara" style="display:none">
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Country</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="countryc"  placeholder="Country" value="<?php echo !empty($_POST['countryc']) ? $_POST['countryc'] : ''?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name On Gmaps</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="nameongmapsc"  placeholder="Name On Gmap"  value="<?php echo !empty($_POST['nameongmapsc']) ? $_POST['nameongmapsc'] : ''?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Deskripsi</label>
                                <div class="col-lg-8">
                                    <textarea name="descc" class="form-control" placeholder="Deskription" rows="5" cols="20"><?php echo !empty($_POST['descc']) ? $_POST['descc'] : ''?></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="provinsi" style="display:none">
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Negara</label>
                                <div class="col-lg-8">
                                  <select class="form-control m-bot15 level" name="negarap">
                                    <option value="">Pilih Negara </option>
                                    <?php foreach($negara as $k=>$baris) :?>
                                       <?php if(!empty($_POST['negarap']) && ($_POST['negarap'] == $baris->location_no)):?>
                                         <option selected value="<?php echo $baris->location_no;?>"><?php echo $baris->_name ?></option>'
                                       <?php else :?>
                                          <option value="<?php echo $baris->location_no;?>"><?php echo $baris->_name ?></option>'
                                        <?php endif;?>
                                    <?php endforeach ;?>
                                  </select>
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Provinsi</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="provinsip"  placeholder="Province"  value="<?php !empty($_POST['provinsip']) ? $_POST['provinsip'] : '' ;?>">
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name On Gmaps</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="nameongmapsp"  placeholder="Name On Gmap" value="<?php !empty($_POST['nameongmapsp']) ? $_POST['nameongmapsp'] : '' ;?>" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Deskripsi</label>
                                <div class="col-lg-8">
                                    <textarea name="descp" class="form-control" placeholder="Deskription" rows="5" cols="20"><?php !empty($_POST['descp']) ? $_POST['descp'] : '' ;?></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="kota" style="display:none">
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Negara</label>
                                <div class="col-lg-8">
                                  <select class="form-control m-bot15 negarak" name="negarak">
                                    <option value="">Pilih Negara </option>
                                    <?php foreach($negara as $k=>$baris) :?>
                                       <?php if(!empty($_POST['negarak']) && ($_POST['negarak']== $baris->location_no)) :?>
                                       <option value="<?php echo $baris->location_no;?>" selected><?php echo $baris->_name ?></option>'
                                       <?php else :?>
                                         <option value="<?php echo $baris->location_no;?>"><?php echo $baris->_name ?></option>'
                                        <?php endif;?>
                                    <?php endforeach ;?>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-lg-2 control-label">Provinsi</label>
                                <div class="col-lg-8">
                                  <select class="form-control m-bot15 provinsik" name="provinsik">
                                      <option value="">Pilih Provinsi</option>
                                  </select>
                                </div>
                              </div>

                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Kota</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="kotak" value="<?php echo !empty($_POST['kotak']) ? $_POST['kotak'] : ''?>" placeholder="Kota" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Name On Gmaps</label>
                                <div class="col-lg-8">
                                    <input type="text" class="form-control form_datetime2" name="nameongmapsk"  placeholder="Name On Gmap" value="<?php echo !empty($_POST['nameongmapsk']) ? $_POST['nameongmapsk'] : ''?>" >
                                </div>
                              </div>
                              <div class="form-group">
                                <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Deskripsi</label>
                                <div class="col-lg-8">
                                    <textarea name="desck" class="form-control" placeholder="Deskription" rows="5" cols="20"><?php echo !empty($_POST['desck']) ? $_POST['desck'] : ''?></textarea>
                                </div>
                              </div>
                          </div>

                          <div class="form-group submitbutton" style="display:none">
                            <label for="setLocation" class="col-lg-2 col-sm-2 control-label">&nbsp</label>
                            <input type="hidden" class="typelok" name="Type">
                            <div class="col-lg-8">
                              <button id="toPublishs" type="submit"  class="col-lg-2 col-sm-2  btn btn-success clicking" name="method" value="save"> Save </button>
                              <a class="btn btn-danger kanan" style='float:none' onclick="konfirmasi_cancel('<?php echo base_url() ?>locationcms')" >Cancel</a>
                            </div>
                          </div>
                      </form>
                    </section>
                </div>
              </div>
        </section>
      </div>
     </div>
</section>
<!-- footer -->
<?php include($includes . "footer.php"); ?>
</section>
<!-- notif footer general -->

<?php include($includes . "footer-notif-general.php"); ?>
<!-- notif footer general -->
<!-- js placed at the end of the document so the pages load faster -->
<style>
    .editable-table .dataTables_filter{
        width: auto !important;
    }
    .adv-table .dataTables_length select{
      margin: 0 !important
    }
    .kanan{
      margin-bottom: 0
    }
</style>
<link href="<?php echo $assets;?>advanced-datatable/media/css/demo_page.css" rel="stylesheet" />
<link href="<?php echo $assets;?>advanced-datatable/media/css/demo_table.css" rel="stylesheet" />
<script src="<?php echo $js;?>jquery.js"></script>
<script type="text/javascript" language="javascript" src="<?php echo $assets;?>advanced-datatable/media/js/jquery.js"></script>
<script src="<?php echo $js;?>bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="<?php echo $js;?>jquery.dcjqaccordion.2.7.js"></script>
<script src="<?php echo $js;?>jquery.scrollTo.min.js"></script>
<script src="<?php echo $js;?>jquery.nicescroll.js" type="text/javascript"></script>
<script type="text/javascript" language="javascript" src="<?php echo $assets;?>advanced-datatable/media/js/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo $assets;?>data-tables/DT_bootstrap.js"></script>
<!-- this page plugin -->
<script type="text/javascript" src="<?php echo $assets;?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
<!--common script for all pages-->
<script src="<?php echo $js;?>common-scripts.js"></script>

  <!--script for this page only-->
<script src="<?php echo $js;?>editable-table.js"></script>
<script src="<?php echo $js;?>jquery.cookie.js"></script>

<script type="text/javascript" class="init">
$(".clicking").click(function(e){
    var txt = $('input[name="<?=$this->csrf['name'];?>"]');
    txt.val($.cookie('<?php echo $this->security->get_csrf_token_name();?>'));
});
var type = "<?php echo !empty($method) ? $method : ''?>";

if(type == 'negara'){
  $(".typelok").val('negara');
  $(".negara").show();
  $('.provinsi').hide();
  $('.kota').hide();
  $(".submitbutton").show();


}else if(type == 'provinsi'){
  $(".typelok").val('provinsi');
  $(".negara").hide();
  $('.provinsi').show();
  $('.kota').hide();
  $(".submitbutton").show();

}else if(type == 'kota'){
  $(".typelok").val('kota');
  $(".negara").hide();
  $('.provinsi').hide();
  $('.kota').show();
  $(".submitbutton").show();

}

$(".level").change(function(){
   var value = $(this).val();
   if(value == 'TYPELOC01'){
     $(".typelok").val('negara');
     $(".negara").show();
     $('.provinsi').hide();
     $('.kota').hide();

   }else if(value == 'TYPELOC02'){
     $(".typelok").val('provinsi');
     $(".negara").hide();
     $('.provinsi').show();
     $('.kota').hide();

   }else if(value == 'TYPELOC03'){
     $(".typelok").val('kota');
     $(".negara").hide();
     $('.provinsi').hide();
     $('.kota').show();

   }
   $(".submitbutton").show();

});
$(".negarak").change(function () {
    var id = $(this).val();
    var csrf_hash = $.cookie('<?php echo $this->security->get_csrf_token_name();?>');
    //var dataString = 'id=' + id;
    $.ajaxSetup({ headers: { 'csrftoken' : $.cookie('<?php echo $this->security->get_csrf_token_name();?>') } });
    $.ajax
    ({
        type: "POST",
        url: "<?php echo site_url('locationcms/ajaxProvinsi');?>",
        data: {'<?php echo $this->security->get_csrf_token_name();?>':csrf_hash,"id":id},
        //data: dataString,
        cache: false,
        success: function (html) {
            console.log(html);
            $(".provinsik").html(html);
        }
    });

});

</script>
</body>
