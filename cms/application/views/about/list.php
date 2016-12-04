<!DOCTYPE html>
<html lang="en">
    <?php $includes = getcwd() . '/application/views/includes/'; ?>
    <?php include($includes . "/header.php"); ?>
    <body>
        <?php include($includes . "/nav.php"); ?>
        <?php include($includes . "/sidebar-menu.php");
        ?>
        <!-- main content start -->
        <section id="main-content">
            <section class="wrapper">
                <h3 class="m-bot15"> About Us List</h3>
                <div class="row">
                    <div class="col-lg-12">
                        <!--breadcrumbs start -->
                        <ul class="breadcrumb">
                            <li><a href="#"><i class="icon-home"></i> Home</a></li>
                            <li>Content Management</li>
                            <li>About Us</li>

                        </ul>
                        <!--breadcrumbs end -->
                    </div>
                </div>
                <div class="row">
                    <!-- COL LEFT -->
                    <div class="col-lg-12">
                        <section class="panel">
                            <div class="panel-body">
                                <div class="col-lg-12">
                                    <!--work progress start-->
                                    <section class="panel">
                                        <div class="adv-table editable-table">
                                            <table class="table table-striped table-advance table-hover table-bordered" id="example">
                                                <thead>
                                                    <tr>
                                                        <th width="30%">Title</th>
                                                        <th width="60%">Content</th>
                                                        <th width="10%">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tr>
                                                    <?php foreach ($about as $k=>$v):?>
                                                      <td><?php echo $v['_title']?></td>
                                                      <td><?php echo $v['_content']?></td>
                                                      <td>
                                                          <a href="<?php echo site_url('aboutus/edit/'.$v['about_no']);?>" class="button"><button  class="btn btn-success" ><i class="fa fa-pencil-square-o"></i>Edit</button></a>
                                                      </td>
                                                    </tr>
                                                  <?php endforeach;?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </section>
                                    <!--work progress end-->
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
                <!-- COL RIGHT -->
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
    <!-- END JAVASCRIPTS -->
<script src="<?php echo $js;?>jquery.cookie.js"></script>

    <script type="text/javascript" class="init">
    jQuery(document).ready(function() {
    $("#example").dataTable({
    "aaSorting": [[2,'desc']]
    });
    });
    // demo close footer notification
    $('#toPublish').on('click', function () {
    $(".notif-footer").addClass('show success');
    setTimeout(function () {
    $(".notif-footer").removeClass('show success');
    }, 1500);
    });
    $('#toUnPublish').on('click', function () {
    $(".notif-footer").addClass('show failed');
    setTimeout(function () {
    $(".notif-footer").removeClass('show failed');
    }, 1500);
    });
    $('.icon-remove').on('click', function () {
    $(".notif-footer").removeClass('show success failed');
    });
    </script>
</body>
