<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Index extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');
          $this->load->model("Lowongancms_model");
    }

    public function Index($idChannel='')
  	{
          // $this->pr($_GET);
          $data = array();
          $page = isset($_GET['page']) ? $_GET['page'] : 0;
          $data['lowongan'] = $this->Lowongancms_model->listLowongan($page);
          $data['lowonganPromoted'] = $this->Lowongancms_model->listLowonganPromoted();
          $data['total'] = $this->Lowongancms_model->selectCount();
          $data['homeslider'] = $this->Lowongancms_model->homeslider();
          $max = $data['total']->totalLowongan;
          if($page < $max){
            $data['now']  = $page;
            $next = $page + 5;
            if($page != 0){
              $data['prev'] = $page - 5;
            }
            if($next < $max){
              $data['next'] = $page + 5;
            }

          }
          // $this->pr($data);
  		    $this->load->view('index',$data);

  	}
    public function Jobdetail($id){
         $data['lowongan'] = $this->Lowongancms_model->detailLowongan($id);
         $this->load->view('jobdetail/index',$data);
    }

    public function ajaxList(){
      $page = isset($_POST['page']) ? $_POST['page'] : 0;
      $lowongan = $this->Lowongancms_model->listLowongan($page);
      $max= $this->Lowongancms_model->record_count();
      if($page < $max){
          $data['now']  = $page;
          $nextpage = $page + 5;
          if($page != 0){
            $prev = $page - 5;
          }
          if($page < ($max-1)){
            $next = $page + 5;
          }
      }

      $html ='';
      $html .="<div class='recent-job-wrapper alt-stripe mr-0'>";
              foreach($lowongan as $k=>$value):
                $html .="<a href='".site_url('Index/Jobdetail').'/'.$value->lowongan_no."'   class='recent-job-item clearfix'>";
                $html .="<div class='GridLex-grid-middle'>";
                  $html .="<div class='GridLex-col-6_xs-12'>";
                    $html .="<div class='job-position'>";
                      $html .="<div class='image'>";
                        $html .="<img src=".base_url_upload.$value->_logo_enc_name." alt='image'>";
                      $html .="</div>";
                      $html .="<div class='content'>";
                        $html .="<h4>".$value->_name."</h4>";
                        $html .="<p>".$value->clientname."</p>";
                      $html .="</div>";
                    $html .="</div>";
                  $html .="</div>";
                  $html .="<div class='GridLex-col-4_xs-8_xss-12 mt-10-xss'>";
                    $html .="<div class='job-location'>";
                      $html .="<i class='fa fa-map-marker text-primary'></i>&nbsp;".$value->locname;
                    $html .="</div>";
                  $html .="</div>";
                  $html .="<div class='GridLex-col-2_xs-4_xss-12'>";
                      $html .="<div class='job-label label label-success'>";
                        $html .= $value->type_lowongan;
                      $html .="</div>";
                      $date = $value->create_date;
                      $getDate = date('Y-m-d',strtotime($date));
                      $now = date('Y-m-d');
                      $dateTime =  new DateTime();
                      $datetime2 = new DateTime($getDate);
                      $interval = $dateTime->diff($datetime2);
                      if($getDate ==$now){
                        $posted =  $interval->format('%H hours %I minutes ago');
                      }else{
                        $posted =  $interval->format('%D days %H hours ago');
                      }

                    $html .="<span class='font12 block spacing1 font400 text-center'>".$posted."</span>";
                  $html .="</div>";
                $html .="</div>";
              $html.="</a>";
              endforeach;
      $html.="</div>";

      $html .="<div class='pager-wrapper'>";
        $html .="<nav class='pager-right'>";
          $html .="<ul class='pagination'>";
            $html .="<li>";
              if(isset($prev)):
                $html .="<a data-val=".$prev." aria-label='Previous' onclick='prev(this);'>";
                  $html .="<span aria-hidden='true'>&laquo;</span>";
                $html .="</a>";
              endif;
            $html .="</li>";
            $html .="<li>";
              if(!empty($next)) :
                $html .="<a data-val=".$next." aria-label='Next' onclick='next(this)'>";
                  $html .="<span aria-hidden='true'>&raquo;</span>";
                $html .="</a>";
              endif;
            $html .="</li>";
          $html .="</ul>";
        $html .="</nav>";
      $html .="</div>";

      echo $html;





    }


}
