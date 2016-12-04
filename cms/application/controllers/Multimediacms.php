<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Multimediacms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usercms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Clientcms_model');
        $this->load->model('Multimediacms_model');
        $this->load->model('General_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00008416');
      $data['result']= $this->Multimediacms_model->listMultimediaBank();
      $this->load->view('multimedia/multimedialist',$data);
    }
    public function addmultimedia(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00008716');
      if(!empty($_POST)){
        $configValidation = $this->Validation();
        $multimediaID = $this->Sequencecms_model->next('cms_tm_multimediabank');
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == TRUE) {
          $_lrn = '';
          $_len = '';
          $_lu  = '';
          if(!empty($_FILES['image']['name'])){
            $upload = $this->uploadImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
            if($upload['success']){
              $_lrn = $upload['_icon_real_name'];
              $_len = $upload['_icon_enc_name'];
              $_lu =  $upload['_icon_url'];
            }
          }
            $dataMultimedia = array(
                'multimediabank_no'=>$multimediaID['nextval'],
                '_title'=>$this->input->post('title'),
                '_desc'=>$this->input->post('desc'),
                '_real_name'=>$_lrn,
                '_enc_name'=>$_len,
                'multimedia_type_id'=>'MULTIMEDIA01',
                '_url'=>$_lu,
                'create_date'=>Date('Y-n-d H:i:s'),
                'create_by'=>$this->userInfo()->user_no
            );
            try {
               $this->Multimediacms_model->insertMultimedia($dataMultimedia);
               $set_notif = array('notifsukses' => 'Multimedia Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("Multimediacms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("Multimediacms");
             }
        }

      }
      $this->load->view("multimedia/addmultimedia");

    }

    public function editmultimedia(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00008516');
      $IDMultiMedia = $this->input->post('MultimediaID');
      $data['result'] = $this->Multimediacms_model->searchMultiMedia($IDMultiMedia);
      // $this->pr($data);
      if(!empty($this->input->post('method'))){
        $IDMultiMedia = $this->input->post('MultimediaID');
        $configValidation = $this->Validation();
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == true) {
                $p_desc = $this->input->post('desc');
                $p_name    = strtoupper($this->input->post('title'));

                #Check Exist Image
                $result = $this->Multimediacms_model->searchMultiMedia($IDMultiMedia);
                $_lrn = $result['_real_name'];
                $_len = $result['_enc_name'];
                $_lu =  $result['_url'];

                if(!empty($_FILES['image']['name'])){

                  if(!empty($result['_enc_name']) && ($result['_real_name'] != $_FILES['image']['name']) ){
                      $deleteImg = FCPATH.'public_assets/uploads/'.$result['_enc_name'];
                      if(unlink($deleteImg)){
                          $upload = $this->uploadImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
                          if($upload['success']){
                            $_lrn = $upload['_icon_real_name'];
                            $_len = $upload['_icon_enc_name'];
                            $_lu =  $upload['_icon_url'];
                          }
                      }
                  }else{
                      $upload = $this->uploadImage($_FILES['image']['name'],$_FILES['image']['tmp_name']);
                      if($upload['success']){
                        $_lrn = $upload['_icon_real_name'];
                        $_len = $upload['_icon_enc_name'];
                        $_lu =  $upload['_icon_url'];
                      }
                  }

                }
                $mutimediaUpdate = array(
                    '_title'=>$p_name,
                    '_desc'=>$p_desc,
                    '_real_name'=>$_lrn,
                    '_enc_name'=>$_len,
                    '_url'=>$_lu,
                    'last_update'=>date('Y-m-d H:i:s'),
                    'last_update_by'=>$this->userInfo()->user_no
                );
                try{
                    $result    = $this->Multimediacms_model->updateMultimedia($mutimediaUpdate,$IDMultiMedia);
                    $set_notif = array('notifsukses' => 'Multimedia Berhasil Di Update');
                    $this->session->set_userdata($set_notif);
                    redirect("Multimediacms");
                }catch (Exception $ex) {
                    $set_notif = array('notiferror' => $ex);
                    $this->session->set_userdata($set_notif);
                    redirect("Multimediacms");
                }

            }
      }
      $this->load->view("multimedia/editmultimedia",$data);
    }
    public function Operation()
    {
        $this->form_validation->set_rules('MultimediaID', 'MultimediaID', 'required');
        $MultimediaID = $this->input->post('MultimediaID');
        if ($this->input->post('delete')) {
            $this->getAccessUrl('ROLE00008616');
            $hapus_client = $this->Multimediacms_model->hapus_multimedia($MultimediaID);
            if($hapus_client){
                $set_notif = array('notifsukses' => "Multimedia Berhasi DI Hapus");
                $this->session->set_userdata($set_notif);
                redirect("Multimediacms");
            }else{
                $set_notif = array('notifsukses' => "Multimedia Gagal DI Hapus");
                $this->session->set_userdata($set_notif);
                redirect("Multimediacms");
            }
        }elseif ($this->input->post('edit')) {
              $this->editmultimedia();
        }
    }
    public function validation() {
        $configValidation = array(
              array(
                  'field' => 'title',
                  'label' => 'Title',
                  'rules' => 'required'
              ), array(
                  'field' => 'desc',
                  'label' => 'Description',
                  'rules' => 'required'
              )
          );
        return $configValidation;
    }

}
