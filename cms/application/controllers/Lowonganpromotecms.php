<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Lowonganpromotecms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('General_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Clientcms_model');
        $this->load->model('Lowongancms_model');
        $this->load->model('Pekerjaancms_model');
        $this->load->model('Locationcms_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00007716');
      $data['result'] = $this->Lowongancms_model->promotedLowonganList();
      // $this->pr($data);
      #insertWhenEmpty
      $this->Lowongancms_model->insertWhenEmpty();

      $this->load->view('lowonganpromote/lowonganlist',$data);
    }
    public function editlowonganpromoted(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00007816');
      $data['lowongan']= $this->Lowongancms_model->listlowonganPromote();
      $id = $this->input->post('lowonganpromotedno');
      $data['result'] = $this->Lowongancms_model->searchLowonganPromote($id);
      // echo $this->db->last_query();
      // $this->pr($_POST);
      if(!empty($this->input->post('method'))){
        $lowonganID = $this->Sequencecms_model->next('cms_tm_lowongan_promoted');
        $this->form_validation->set_rules('lowongan_no','Lowongan','required');
        $this->form_validation->set_rules('datefrom','Date From Lowongan Promote','required|callback_compareDatesFrom');
        $this->form_validation->set_rules('datethru','Date Thru Lowongan Promote','required|callback_compareDates');
        if ($this->form_validation->run() == TRUE) {
            $dataLowongan = array(
                        // 'lowongan_promoted_no'=>$_POST['lowonganpromotedno'],#$lowonganID['nextval'],
                        'branch_id'=>$this->userInfo()->branch_id,
                        'lowongan_no'=>$this->input->post('lowongan_no'),
                        '_date_from'=>$this->input->post('datefrom'),
                        '_date_thru'=>$this->input->post('datethru'),
                        'create_date'=>Date('Y-n-d H:i:s'),
                        '_active'=>'1',
                        '_delete'=>'0',
                        'create_by'=>$this->userInfo()->user_no
            );
            if(!empty($_FILES['cover']['name'])){
                $upload = $this->uploadImage($_FILES['cover']['name'],$_FILES['cover']['tmp_name']);
                if($upload['success']){
                  $_lrn = $upload['_icon_real_name'];
                  $_len = $upload['_icon_enc_name'];
                  $_lu =  $upload['_icon_url'];
                }
                $dataLowongan['_cover_real_name'] = $_lrn;
                $dataLowongan['_cover_enc_name'] = $_len;
                $dataLowongan['_cover_url'] = $_lu;
            }
            try {
               $this->Lowongancms_model->udateLowonganPromoted($dataLowongan,$this->input->post('lowonganpromotedno'));
               $set_notif = array('notifsukses' => 'Lowongan Promoted Berhasil Di Ubah');
               $this->session->set_userdata($set_notif);
               redirect("lowonganpromotecms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("lowonganpromotecms");
             }
        }

      }
      $this->load->view('lowonganpromote/aditlowongan',$data);

    }



    /**
     * Function untuk validasi tanggal set headline dimana end date tidak boleh lebh kecil dari start date
     * @return boolean
     */
    function compareDates() {
        // $this->pr($_POST);
        $start = strtotime($this->input->post('enddatelowongan'));
        $end = strtotime($this->input->post('datethru'));
        if ($start < $end) {
            $this->form_validation->set_message('compareDates', 'Date Thru  Promote Tidak Boleh Lebih Besar Dari End Date Lowongan');
            return false;
        }
    }

    function compareDatesFrom() {
        // $this->pr($_POST);
        $start = strtotime($this->input->post('datefrom'));
        $end = strtotime($this->input->post('datethru'));
        if ($start > $end) {
            $this->form_validation->set_message('compareDatesFrom', 'Date Thru  Promote Tidak Boleh Lebih Kecil Dari Start Date Promote');
            return false;
        }
    }

    public function ajaxlowongan(){
       $lowongan = $this->Lowongancms_model->searchLowongan($this->input->post('id'));
       $html ="";
       $html .="<div class='form-group'>";
           $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>Start Date Lowongan</label>";
           $html .="<div class='col-lg-4'>";
               $html .="<input type='text' class='form-control form_datetime2'  value='".$lowongan['_date_from']."'  placeholder='From' disabled>";
           $html .="</div>";
       $html .="</div>";
       $html .="<div class='form-group'>";
            $html .="<label for='setLocation' class='col-lg-2 col-sm-2 control-label'>End Date Lowongan</label>";
            $html .="<div class='col-lg-4'>";
                $html .="<input type='text' class='form-control form_datetime2' name='enddatelowongan' value='".$lowongan['_date_thru']."' name='datethru' placeholder='Until' readonly>";
            $html .="</div>";
        $html .="</div>";
        echo $html;
    }

    public function upimage(){
      $IDTempNo = $this->input->post('lowonganPoromote');
      $selectId = $this->Lowongancms_model->select_lowongan_promoted_by_id($this->input->post('lowonganPoromote'));
      // print_r($selectId);
      if (count($selectId) > 0) {
          $position = $selectId[0]['_position'];
          $updatePosition = $position - 1;
          $data = array("_position"=>$updatePosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
          $this->Lowongancms_model->update_position_lowonganpromote($this->input->post('lowonganPoromote'), $data);

          // Check apakah posisi = updateposisi ?

          $samePosition = $this->Lowongancms_model->check_position_lowonganpromote($updatePosition,$IDTempNo);
          // print_r($samePosition);
          // echo $this->db->last_query();
          if (count($samePosition) > 0) {
              $otherId = $samePosition[0]['lowongan_promoted_no'];
              $updateOtherPosition = $updatePosition + 1;
              $dataOther = array("_position"=>$updateOtherPosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
              $this->Lowongancms_model->update_position_lowonganpromotesame($otherId, $updatePosition,$dataOther);
          }
      }

    }

    public function dwimage(){
      $IDTempNo = $this->input->post('lowonganPoromote');
      $selectId = $this->Lowongancms_model->select_lowongan_promoted_by_id($this->input->post('lowonganPoromote'));
      if (count($selectId) > 0) {
          $position = $selectId[0]['_position'];
          $updatePosition = $position + 1;
          $data = array("_position"=>$updatePosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
          $this->Lowongancms_model->update_position_lowonganpromote($this->input->post('lowonganPoromote'), $data);

          // Check apakah posisi = updateposisi ?
          $samePosition = $this->Lowongancms_model->check_position_lowonganpromote($updatePosition,$this->input->post('lowonganPoromote'));
          print_r($samePosition);
          if (count($samePosition) > 0) {
              $otherId = $samePosition[0]['lowongan_promoted_no'];
              $updateOtherPosition = $updatePosition - 1;
              $dataOther = array("_position"=>$updateOtherPosition,'last_update'=>date('Y-m-d H:i:s'),'last_update_by'=>$this->userInfo()->user_no);
              $this->Lowongancms_model->update_position_lowonganpromotesame($otherId,$updatePosition, $dataOther);
          }
      }
    }

    public function kosongkanLowongan($all=false){
        $dataUpdate = array(
              'lowongan_no'       =>NULL,
              '_cover_real_name'  =>'',
              '_cover_enc_name'   =>'',
              '_cover_url'        =>'',
              '_date_from'        =>NULL,
              '_date_thru'        =>NULL
          );
        if($all){
          $this->Lowongancms_model->udateLowonganPromotedall($dataUpdate);
        }else{
          $this->Lowongancms_model->udateLowonganPromoted($dataUpdate,$this->input->post('lowonganPoromote'));
        }

        $set_notif = array('notifsukses' => 'Lowongan Promoted Berhasil Di Kosongkan');
        $this->session->set_userdata($set_notif);
        redirect("lowonganpromotecms");

    }
}
