<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Corporatecms extends General {
public function __construct()
{
    parent::__construct();
    $this->load->helper('url');
    $this->load->helper('url');
    $this->load->library('form_validation');
    $this->load->library('session');
    $this->load->model('corporatecms_model');
    $this->load->model('Corporatecms_model');
    $this->load->model('Sequencecms_model');

}

public function Index()
{
    //Cek Access Url
    $this->getAccessUrl('ROLE00003416');
    $data['result'] = $this->corporatecms_model->ambil_data();
    $this->load->view('corporate/corporatelist', $data);
}
public function addCorporate()
{
    //Cek Access Url
    $this->getAccessUrl('ROLE00003516');
    $IDCorporate = $this->Sequencecms_model->next("sys_tm_corporate");
    $data['corporate'] = $this->Corporatecms_model->listCorporate();
    if(!empty($_POST)){
      $this->form_validation->set_rules('name', 'name', 'required|max_length[60]');
      $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
      $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');
      if ($this->form_validation->run() == true) {
              $p_address = $this->input->post('address');
              $p_desc = $this->input->post('desc');
              $p_phone   = $this->input->post('phone');
              $p_name    = strtoupper($this->input->post('name'));
              $IDCorporate = $this->Sequencecms_model->next("sys_tm_corporate");
              $_lrn = ' ';
              $_len = ' ';
              $_lu = ' ';

              if(!empty($_FILES['logo'])){
                $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                if($upload['success']){
                  $_lrn = $upload['_icon_real_name'];
                  $_len = $upload['_icon_enc_name'];
                  $_lu =  $upload['_icon_url'];
                }
              }
              $branchData = array(
                'corporate_id' =>$IDCorporate['nextval'],
                '_name'=>$p_name,
                '_address'=>$p_address,
                '_phone'=>$p_phone,
                '_logo_file_name'=>$_lrn,
                '_logo_enc_name'=>$_len,
                '_logo_url'=>$_lu,
                '_active'=>'1',
                '_delete'=>'0',
                'create_date'=>date('Y-m-d H:i:s'),
              );
              try{
                $result    = $this->corporatecms_model->insertCorporate($branchData);
                $set_notif = array('notifsukses' => 'Corporate Berhasil Disimpan');
                $this->session->set_userdata($set_notif);
                redirect("corporatecms");
              }catch (Exception $ex) {
                $set_notif = array('notiferror' => $ex);
                $this->session->set_userdata($set_notif);
                redirect("corporatecms");
              }
        }

    }

    $this->load->view('corporate/addcorporate',$data);
}

public function editCorporate(){
  //Cek Access Url
  $this->getAccessUrl('ROLE00003616');
  $IDCorporate = $this->input->post('corporate_id');
  $data['result'] = $this->corporatecms_model->searchCorporate($IDCorporate);
  $data['corporate'] = $this->Corporatecms_model->listCorporate();
  if(!empty($this->input->post('method'))){
    $this->form_validation->set_rules('name', 'name', 'required|max_length[60]');
    $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
    $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');

    if ($this->form_validation->run() == true) {
            $p_address = $this->input->post('address');
            $p_phone   = $this->input->post('phone');
            $p_name    = strtoupper($this->input->post('name'));
            $IDCorporate = $this->input->post('corporate_id');

            $result = $this->corporatecms_model->searchCorporate($IDCorporate);
            $_lrn = $result['_logo_file_name'];
            $_len = $result['_logo_enc_name'];
            $_lu =  $result['_logo_url'];

            if(!empty($_FILES['logo']['name'])){
              if(!empty($result['_icon_real_name']) && ($result['_icon_real_name'] != $_FILES['logo']['name']) ){
                  $deleteImg = FCPATH.'public_assets/uploads/'.$result['_icon_enc_name'];
                  if(unlink($deleteImg)){
                      $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                      if($upload['success']){
                        $_lrn = $upload['_icon_real_name'];
                        $_len = $upload['_icon_enc_name'];
                        $_lu =  $upload['_icon_url'];
                      }
                  }
              }else{
                  $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
                  if($upload['success']){
                    $_lrn = $upload['_icon_real_name'];
                    $_len = $upload['_icon_enc_name'];
                    $_lu =  $upload['_icon_url'];
                  }
              }

            }

            $corporateUpdate = array(
              '_name'=>$p_name,
              '_address'=>$p_address,
              '_phone'=>$p_phone,
              '_logo_file_name'=>$_lrn,
              '_logo_enc_name'=>$_len,
              '_logo_url'=>$_lu,
              '_active'=>'1',
              '_delete'=>'0',
              'create_date'=>date('Y-m-d H:i:s'),
            );
            try{
              $result    = $this->corporatecms_model->updateCorporate($corporateUpdate,$IDCorporate);
              $set_notif = array('notifsukses' => 'Corporate Berhasil Di Update');
              $this->session->set_userdata($set_notif);
              redirect("corporatecms");
            }catch (Exception $ex) {
              $set_notif = array('notiferror' => $ex);
              $this->session->set_userdata($set_notif);
              redirect("corporatecms");
            }


          }

  }
  $this->load->view('corporate/editcorporate', $data);

}
public function brandOperation()
{
    $this->form_validation->set_rules('corporate_id', 'corporate_id', 'required|max_length[45]');
    $p_brand_no = $this->input->post('corporate_id');
    if ($this->input->post('delete')) {
        $hapus_brand = $this->corporatecms_model->hapus_corp($p_brand_no);
        if($hapus_brand){
          $set_notif = array('notifsukses' => $hapus_brand);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
        }else{
          $set_notif = array('notifsukses' => $hapus_brand);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
        }
    }elseif ($this->input->post('edit')) {
        $this->editCorporate($p_brand_no);
    }elseif ($this->input->post('set_nonactive')) {
        $set_aktif = $this->corporatecms_model->set_active($p_brand_no);
       if($set_aktif){
          $set_notif = array('notifsukses' => $set_aktif);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
       }else{
          $set_notif = array('notifsukses' => $set_aktif);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
      }
    }elseif ($this->input->post('set_active')) {
        $set_noaktif = $this->corporatecms_model->set_noactive($p_brand_no);
        if($set_noaktif){
          $set_notif = array('notifsukses' => $set_noaktif);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
        }else{
          $set_notif = array('notifsukses' => $set_noaktif);
          $this->session->set_userdata($set_notif);
          redirect("corporatecms");
        }
    }
  }
}
