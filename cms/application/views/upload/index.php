<!DOCTYPE html>
<html lang="en">
<?php $includes = getcwd().'/application/views/includes/';?>
<?php include($includes."/header.php"); ?>

<body>
    <?php include($includes."/nav.php"); ?>
<?php include($includes."/sidebar-menu.php"); ?>

    <!-- main content start -->
    <section id="main-content">
        <section class="wrapper">
            <h3 class="m-bot15"> Add Article </h3>
            <div class="row">
                <div class="col-lg-12">
                         <!--breadcrumbs start -->
<?php include($includes."/breadcrumb.php"); ?>
                    <!--breadcrumbs end -->
                </div>
            </div>
            <div class="row">
                <!-- COL LEFT -->
                <div class="col-xs-9">
                    <!-- Select Category -->
                    <section class="panel">
                        <header class="panel-heading">
                            Channel
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-6">
                                <select class="form-control m-bot15" name="channel" id="channel">
                                    <option VALUE="">Select Channel</option>
                                    <?php foreach($channel as $parent):?>
                                        <option value='<?php echo $parent['channel_no']?>'><?php echo $parent['_name'];?></option>";
                                    <?php endforeach;?>
                                </select>
                                </div>
                                <div class="col-sm-6">
                                    <select class="form-control">
                                        <option>Sub Channel</option>
                                        <option>Soccer</option>
                                        <option>Tenis</option>
                                        <option>etc</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Main Media -->
                    <section class="panel">
                        <header class="panel-heading">
                            Main Media
                        </header>
                        <div class="panel-body">
                            <p>Upload Video</p>
                            <div style="max-width: 400px; width: 100%;">
                                <div class="thumbnail" style="width: 400px; height: 250px; background: #eee;"></div>
                                <div class="progress progress-striped active progress-xs" style="display:none">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                                    
                                    </div>
                                </div>
                            </div>
                            <div class="controls">
                                <div class="fileupload fileupload-new" data-provides="fileupload" style="display: inline-table;">
                                    <span class="btn btn-white btn-file" id='uploadvideo'>
                                    <span class="fileupload-new"><i class="icon-paper-clip"></i> Select file</span>
                                    <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                    <input type="file" name='video' id='video' class="default">
                                    </span>
                                    <span class="fileupload-preview" style="margin-left:5px;"></span>
                                    <a href="#" class="close fileupload-exists" data-dismiss="fileupload" style="float: none; margin-left:5px;"></a>
                                </div>
                                <button style="display: inline-table;" type="button" class="btn btn-danger "><i class="icon-trash"></i> Remove</button>
                            </div>
                        </div>
                    </section>
                    <!-- Media Support -->
                    <section class="panel">
                        <header class="panel-heading">
                            Media Support
                        </header>
                        <div class="panel-body">
                            <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                <p>16:9</p>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 200px; height: 150px; background: #eee;">
                                        <!-- <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> -->
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 200px; max-height: 150px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                   <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                        <input type="file" class="default">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                <p>4:3</p>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 150px; height: 100px; background: #eee;">
                                        <!-- <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> -->
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 100px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                   <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                        <input type="file" class="default">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                            <div style="padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;">
                                <p>1:1</p>
                                <div class="fileupload fileupload-new" data-provides="fileupload">
                                    <div class="fileupload-new thumbnail" style="width: 75px; height: 75px; background: #eee;">
                                        <!-- <img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt=""> -->
                                    </div>
                                    <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 75px; max-height: 75px; line-height: 20px;"></div>
                                    <div>
                                        <span class="btn btn-white btn-file">
                                   <span class="fileupload-new"><i class="icon-paper-clip"></i> Select image</span>
                                        <span class="fileupload-exists"><i class="icon-undo"></i> Change</span>
                                        <input type="file" class="default">
                                        </span>
                                        <a href="#" class="btn btn-danger fileupload-exists" data-dismiss="fileupload"><i class="icon-trash"></i> Remove</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Content Article -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Article
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <label for="inputJudul" class="col-lg-2 col-sm-2 control-label">Title</label>
                                    <div class="col-lg-10">
                                        <input type="text" name='title' class="form-control" id="inputJudul">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="inputSubjudul" class="col-lg-2 col-sm-2 control-label">Sub Title</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="inputSubjudul">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="resume" class="col-lg-2 col-sm-2 control-label">Description</label>
                                    <div class="col-lg-10">
                                        <textarea class="form-control" name='desc' cols="60" rows="5"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="setLocation" class="col-lg-2 col-sm-2 control-label">Location</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="setLocation">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metaTitle" class="col-lg-2 col-sm-2 control-label">Meta Title</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="metaTitle">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="metaDesc" class="col-lg-2 col-sm-2 control-label">Meta Description</label>
                                    <div class="col-lg-8">
                                        <textarea class="form-control" cols="60" rows="3"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keyword" class="col-lg-2 col-sm-2 control-label">Keyword</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="setKeyword">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="dbRelated" class="col-lg-2 col-sm-2 control-label">Database</label>
                                    <div class="col-lg-8">
                                        <input type="text" class="form-control" id="dbRelated">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                    <!-- Content Editor -->
                    <section class="panel">
                        <header class="panel-heading">
                            Content Editor
                        </header>
                        <div class="panel-body">
                            <form class="form-horizontal" role="form">
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <textarea class="form-control ckeditor" name="editor1" rows="6"></textarea>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
                <!-- COL RIGHT -->
                <div class="col-xs-3">
                   
                    <!-- Author -->
                    <section class="panel">
                        <header class="panel-heading">
                            Author
                        </header>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-sm-12">
                                    <select class="form-control m-bot15">
                                        <option>Reporter</option>
                                        <option>Tono</option>
                                        <option>Tini</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <select class="form-control m-bot15">
                                        <option>Writer</option>
                                        <option>Tono</option>
                                        <option>Tini</option>
                                    </select>
                                </div>
                                <div class="col-sm-12">
                                    <select class="form-control">
                                        <option>Editor</option>
                                        <option>Tono</option>
                                        <option>Tini</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </section>
                    <!-- Misc -->
                    <section class="panel">
                        <header class="panel-heading">
                            Misc
                        </header>
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="checkboxes">
                                    <label class="label_check" for="setHeadline">
                                        <input name="setHeadline" id="setHeadline" value="1" type="checkbox" checked /> Headline
                                    </label>
                                    <label class="label_check" for="setEditorChoice">
                                        <input name="setEditorChoice" id="setEditorChoice" value="1" type="checkbox" /> Editor Choice</label>
                                </div>
                            </div>
                        </div>
                    </section>
                     <!-- Publish -->
                    <section class="panel">
                        <header class="panel-heading">
                            Publish
                        </header>
                        <div class="panel-body">
                            <div class="form-group">
                                <label for="exampleInputEmail1">Publication Date</label>
                                <input size="16" type="text" value="" readonly="" class="form_datetime form-control">
                            </div>
                             <div class="form-group">
                                <div class="checkboxes">
                                    <label class="label_check" for="holdArticle">
                                        <input name="holdArticle" id="holdArticle" value="1" type="checkbox" checked /> Hold Article
                                    </label>
                                  
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Start Hold Date</label>
                                <input size="16" type="text" value="" readonly="" class="form_datetime form-control">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">End Hold Date</label>
                                <input size="16" type="text" value="" readonly="" class="form_datetime form-control">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Preview Article</button>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-default"> Save Draft</button>
                            </div>
                            <div class="form-group">
                                <button id="toUnPublish" type="submit" class="btn btn-danger"> Unpublish</button>
                                <button id="toPublish" type="submit" class="btn btn-primary"> Publish </button>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </section>
        <!-- footer -->
        <?php include($includes."/footer.php"); ?>
    </section>
     <!-- notif footer general -->
        <?php include($includes."/footer-notif-general.php"); ?>
    <!-- JS General -->
    <!-- js placed at the end of the document so the pages load faster -->
    <script src="<?php echo site_url('public_assets');?>/js/jquery.js"></script>
    <script src="http://code.jquery.com/jquery-migrate-1.3.0.js"></script>
    <script src="<?php echo site_url('public_assets');?>/js/bootstrap.min.js"></script>
    <script class="include" type="text/javascript" src="<?php echo site_url('public_assets');?>/js/jquery.dcjqaccordion.2.7.js"></script>
    <script src="<?php echo site_url('public_assets');?>/js/jquery.scrollTo.min.js"></script>
    <script src="<?php echo site_url('public_assets');?>/js/jquery.nicescroll.js" type="text/javascript"></script>
    <script src="<?php echo site_url('public_assets');?>/js/respond.min.js"></script>
    <script src="<?php echo site_url('public_assets');?>/js/jquery-ui-1.9.2.custom.min.js"></script>
    <!--custom switch-->
    <script src="<?php echo site_url('public_assets');?>/js/bootstrap-switch.js"></script>
    <!--this page plugins-->
    <script type="text/javascript" src="<?php echo $assets ?>fuelux/js/spinner.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="<?php echo $assets ?>ckeditor/ckeditor.js"></script>
    <!--common script for all pages-->
    <script src="<?php echo site_url('public_assets');?>/js/common-scripts.js"></script>
    <!--this page  script only-->
    <script src="<?php echo site_url('public_assets');?>/js/add-article.js"></script>
    <script type="text/javascript" src="<?php echo $js;?>jquery.ajaxfileupload.js"></script>
    <script>
        // demo close footer notification
        $('#toPublish').on('click', function() {
            $(".notif-footer").addClass('show success');
            setTimeout(function() {
               $(".notif-footer").removeClass('show success');
           }, 1500);
        });
        $('#toUnPublish').on('click', function() {
            $(".notif-footer").addClass('show failed');
            setTimeout(function() {
               $(".notif-footer").removeClass('show failed');
           }, 1500);
        });
        $('.icon-remove').on('click', function() {
            $(".notif-footer").removeClass('show success failed');
        });
    </script>
    <script>
    // sample autocomplete
  $(function() {
    var availableTags = [
      "ActionScript",
      "AppleScript",
      "Asp",
      "BASIC",
      "C",
      "C++",
      "Clojure",
      "COBOL",
      "ColdFusion",
      "Erlang",
      "Fortran",
      "Groovy",
      "Haskell",
      "Java",
      "JavaScript",
      "Lisp",
      "Perl",
      "PHP",
      "Python",
      "Ruby",
      "Scala",
      "Scheme"
    ];
    function split( val ) {
      return val.split( /,\s*/ );
    }
    function extractLast( term ) {
      return split( term ).pop();
    }
 
    $( "#setKeyword, #dbRelated, #setLocation " )
      // don't navigate away from the field on tab when selecting an item
      .bind( "keydown", function( event ) {
        if ( event.keyCode === $.ui.keyCode.TAB &&
            $( this ).autocomplete( "instance" ).menu.active ) {
          event.preventDefault();
        }
      })
      .autocomplete({
        minLength: 0,
        source: function( request, response ) {
          // delegate back to autocomplete, but extract the last term
          response( $.ui.autocomplete.filter(
            availableTags, extractLast( request.term ) ) );
        },
        focus: function() {
          // prevent value inserted on focus
          return false;
        },
        select: function( event, ui ) {
          var terms = split( this.value );
          // remove the current input
          terms.pop();
          // add the selected item
          terms.push( ui.item.value );
          // add placeholder to get the comma-and-space at the end
          terms.push( "" );
          this.value = terms.join( ", " );
          return false;
        }
      });
    $('#uploadvideo').click(function(e){
        var title = $("[name='title']").val();
        var desc = $("[name='desc']").val();
        var channel = $("[name='channel']").val();
        console.log(title+desc);
        if(title==='' || desc==='' || channel===''){
            e.preventDefault();
        }
    });
    $("#video").on('change', function() {
        var file_data = $('#video').prop('files')[0];   
        var form_data = new FormData();                  
        form_data.append('video', file_data);        
        form_data.append('channel', $("[name='channel']").val()); 
        form_data.append('title', $("[name='title']").val()); 
        form_data.append('desc', $("[name='desc']").val()); 
        $('.progress').show();
        $.ajax({
                url: "<?php echo site_url('dailymotionTest/testVideoUpload');?>", // point to server-side PHP script 
                dataType: 'json',  // what to expect back from the PHP script, if anything
                cache: false,
                contentType: false,
                processData: false,
                data: form_data,                         
                type: 'post',
                success: function(response){
                    if(response.response=='success'){
                        $('.progress').html('<div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-success"></div><input type="hidden" name="dailylink" value="'+response.dailyID+'"/>');
                    }else{
                        $('.progress').html('<div style="width: 100%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="100" role="progressbar" class="progress-bar progress-bar-danger"></div>')
                    }
                }
        }); 
    });
  });
  </script>
</body>
