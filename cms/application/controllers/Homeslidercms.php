<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Homeslidercms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('General_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Homeslidercms_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00008916');
      $this->Homeslidercms_model->insertWhenEmpty();

      $data['result'] = $this->Homeslidercms_model->listHomeSlider();
      $IDSlider = $this->Sequencecms_model->next('cms_tm_fe_homeslider');
      $this->load->view('homeslider/homesliderlist',$data);
    }

    public function addhomeslider(){
      $this->getAccessUrl('ROLE00009016');
      $homdesilderNo = $this->input->post('homeslider_no');
      $data['homeslider']= $this->Homeslidercms_model->searchHomeSlider($homdesilderNo);
      $data['listMulitmediaBank'] = $this->Homeslidercms_model->listMulitmediaBank();
      if(!empty($this->input->post('method'))){
        $homdesilderNo = $this->input->post('homeslider_no');
        $this->form_validation->set_rules('desc', 'Description', 'required');
        $this->form_validation->set_rules('multimediabank_no', 'Multimedia Bank', 'required');
        if ($this->form_validation->run() == true) {
           $dataSlider = array(
               'multimediabank_no'=>$this->input->post('multimediabank_no'),
               '_title'=>$this->input->post('title'),
               '_desc'=>$this->input->post('desc'),
               '_active'=>'1',
               '_delete'=>'0',
               'create_date'=>date('Y-m-d H:i:s'),
               'create_by'=>$this->userInfo()->user_no
           );
           try {
              $this->Homeslidercms_model->updateHomeslider($dataSlider,$homdesilderNo);
              $set_notif = array('notifsukses' => 'Home Slider Berhasil Di Ubah');
              $this->session->set_userdata($set_notif);
              redirect("homeslidercms");
            }catch (Exception $ex) {
              $set_notif = array('notiferror' => $ex);
              $this->session->set_userdata($set_notif);
              redirect("homeslidercms");
            }

        }
      }
      $this->load->view('homeslider/addhomeslider',$data);
    }


    public function ajaxSlider(){
       $id = !empty($this->input->post('id')) ? $this->input->post('id') : '';
       if($id){
           $slider = $this->Homeslidercms_model->getmultimediaBank($id);
           $html ="";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Title Home Slider </label>";
               $html .="<div class='col-lg-9'>";
                   $html .="<input class='form-control form_datetime2'  name='title' placeholder='Title Home Slider' value='".$slider->_title."' >";
               $html .="</div>";
           $html .="</div>";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Description </label>";
               $html .="<div class='col-lg-9'>";
                   $html .="<textarea class='form-control form_datetime2'  name='desc' placeholder='desciption' cols='5' rows='10' >".$slider->_desc."</textarea>";
               $html .="</div>";
           $html .="</div>";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Cover</label>";
               $html .="<div class='col-lg-8'>";
                 $html .="<div style='padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;'>";
                     $html .="<div class='fileupload2 fileupload-new' data-provides='fileupload'>";
                         $html .="<div class='fileupload-new thumbnail' style='width: 300px; height: 250px; background: #eee;'>";
                           if(!empty($slider->_enc_name)){
                               $html .="<img  style='width: 190px; height: 140px; width='190' height='140' src='".$slider->_url."'/>";
                           }
                         $html .="</div>";
                     $html .="</div>";
                 $html .="</div>";
               $html .="</div>";
           $html .="</div>";
       }else{
           $html ="";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Title Home Slider </label>";
               $html .="<div class='col-lg-9'>";
                   $html .="<input class='form-control form_datetime2'  name='title' placeholder='Title Home Slider'>";
               $html .="</div>";
           $html .="</div>";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Description Multimedia</label>";
               $html .="<div class='col-lg-9'>";
                   $html .="<textarea class='form-control form_datetime2'  name='desc' placeholder='desciption' cols='5' rows='10'></textarea>";
               $html .="</div>";
           $html .="</div>";
           $html .="<div class='form-group'>";
               $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Cover</label>";
               $html .="<div class='col-lg-8'>";
                 $html .="<div style='padding:0; display: inline-table; vertical-align: bottom; margin-right: 15px;'>";
                     $html .="<div class='fileupload2 fileupload-new' data-provides='fileupload'>";
                         $html .="<div class='fileupload-new thumbnail' style='width: 300px; height: 250px; background: #eee;'>";
                         $html .="</div>";
                     $html .="</div>";
                 $html .="</div>";
               $html .="</div>";
           $html .="</div>";
       }

       echo $html;


    }

    public function upimage(){
      $IDTempNo = $this->input->post('homeslider_no');
      $selectId = $this->Homeslidercms_model->select_homeslider_by_id($this->input->post('homeslider_no'));
      if (count($selectId) > 0) {
          $position = $selectId[0]['_position'];
          $updatePosition = $position - 1;
          $data = array("_position"=>$updatePosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
          $this->Homeslidercms_model->update_position_homeslider($this->input->post('homeslider_no'), $data);

          // Check apakah posisi = updateposisi ?

          $samePosition = $this->Homeslidercms_model->check_position_homeslider($updatePosition,$IDTempNo);
          // print_r($samePosition);
          // echo $this->db->last_query();
          if (count($samePosition) > 0) {
              $otherId = $samePosition[0]['homeslider_no'];
              $updateOtherPosition = $updatePosition + 1;
              $dataOther = array("_position"=>$updateOtherPosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
              $this->Homeslidercms_model->update_position_homeslidersame($otherId, $updatePosition,$dataOther);
          }
      }

    }

    public function dwimage(){
      $IDTempNo = $this->input->post('homeslider_no');
      $selectId = $this->Homeslidercms_model->select_homeslider_by_id($this->input->post('homeslider_no'));
      // print_r($selectId);
      if (count($selectId) > 0) {
          $position = $selectId[0]['_position'];
          $updatePosition = $position + 1;
          $data = array("_position"=>$updatePosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
          $this->Homeslidercms_model->update_position_homeslider($this->input->post('homeslider_no'), $data);

          // Check apakah posisi = updateposisi ?

          $samePosition = $this->Homeslidercms_model->check_position_homeslider($updatePosition,$IDTempNo);

          if (count($samePosition) > 0) {
              $otherId = $samePosition[0]['homeslider_no'];
              $updateOtherPosition = $updatePosition - 1;
              $dataOther = array("_position"=>$updateOtherPosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
              $this->Homeslidercms_model->update_position_homeslidersame($otherId, $updatePosition,$dataOther);
          }
      }
    }

    public function kosongkanSlider($all=false){
        $this->getAccessUrl('ROLE00009116');
        $dataUpdate = array(
              'multimediabank_no'=>NULL,
              '_title'           =>'',
              '_desc'            =>'',
              'create_date'      =>'',
              '_active'          => '0'
          );
        if($all){
          $this->Homeslidercms_model->updateLowonganPromotedall($dataUpdate);
        }else{
          $this->Homeslidercms_model->updateHomeslider($dataUpdate,$this->input->post('homeslider_no'));
        }

        $set_notif = array('notifsukses' => 'Homeslidercms Promoted Berhasil Di Kosongkan');
        $this->session->set_userdata($set_notif);
        redirect("Homeslidercms");

    }
}
