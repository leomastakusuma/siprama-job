<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Clientcms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usercms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Clientcms_model');
        $this->load->model('General_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00005416');
      $data['result']= $this->Clientcms_model->listClient();
      $this->load->view('client/clientlist',$data);
    }
    public function addclient(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00005616');
      if(!empty($_POST)){
        $configValidation = $this->Validation();
        $clientID = $this->Sequencecms_model->next('cms_tm_client');
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == TRUE) {
          $checkExistClient = $this->General_model->checkExist('cms_tm_client','_name',$this->input->post('name'));
          if($checkExistClient > 1){
              $set_notif = array('notiferror' => 'Nama Klien Telah Tersedia, Silahkan Masukan Nama Yang Lain!');
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
          }
          $_lrn = '';
          $_len = '';
          $_lu  = '';
          if(!empty($_FILES['logo']['name'])){
            $upload = $this->uploadImage($_FILES['logo']['name'],$_FILES['logo']['tmp_name']);
            if($upload['success']){
              $_lrn = $upload['_icon_real_name'];
              $_len = $upload['_icon_enc_name'];
              $_lu =  $upload['_icon_url'];
            }
          }
            $dataClient = array(
              'client_id'=>$clientID['nextval'],
              'branch_id'=>$this->userInfo()->branch_id,
              '_name'=>$this->input->post('name'),
              '_desc'=>$this->input->post('desc'),
              '_address'=>$this->input->post('address'),
              '_phone'=>$this->input->post('phone'),
              '_logo_real_name'=>$_lrn,
              '_logo_enc_name'=>$_len,
              '_logo_url'=>$_lu,
              '_pic_name'=>$this->input->post('pic_name'),
              '_pic_email'=>$this->input->post('pic_email'),
              '_pic_phone'=>$this->input->post('pic_phone'),
              'create_date'=>Date('Y-n-d H:i:s'),
              'create_by'=>$this->userInfo()->user_no
            );
            try {
               $this->Clientcms_model->insertClient($dataClient);
               $set_notif = array('notifsukses' => 'Client Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("clientcms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("clientcms");
             }
        }

      }
      $this->load->view('client/addclient');

    }

    public function editclient(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00004016');
      $IDClient = $this->input->post('clientID');
      $data['result'] = $this->Clientcms_model->searchClient($IDClient);
      if(!empty($this->input->post('method'))){
        $IDClient = $this->input->post('clientID');
        $configValidation = $this->Validation();
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == true) {
                $checkExistClient = $this->General_model->checkExist('cms_tm_client','_name',$this->input->post('name'));
                if($checkExistClient > 1){
                    $set_notif = array('notiferror' => 'Nama Klien Telah Tersedia, Silahkan Masukan Nama Yang Lain!');
                    $this->session->set_userdata($set_notif);
                    redirect("Clientcms");
                }
                $p_address = $this->input->post('address');
                $p_desc = $this->input->post('desc');
                $p_phone   = $this->input->post('phone');
                $p_pic_name    = strtoupper($this->input->post('pic_name'));
                $p_pic_email = $this->input->post('pic_email');
                $p_pic_phone = $this->input->post('pic_phone');
                $p_name    = strtoupper($this->input->post('name'));
                $IDBranch = $this->input->post('brand_no');

                $result = $this->Clientcms_model->searchClient($IDClient);
                $_lrn = $result['_logo_real_name'];
                $_len = $result['_logo_enc_name'];
                $_lu =  $result['_logo_url'];

                if(!empty($_FILES['logo']['name'])){

                  if(!empty($result['_logo_real_name']) && ($result['_logo_enc_name'] != $_FILES['logo']['name']) ){
                      $deleteImg = FCPATH.'public_assets/uploads/'.$result['_logo_enc_name'];
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
                $clientUpdate = array(
                  '_name'=>$p_name,
                  '_desc'=>$p_desc,
                  '_address'=>$p_address,
                  '_phone'=>$p_phone,
                  '_logo_real_name'=>$_lrn,
                  '_logo_enc_name'=>$_len,
                  '_logo_url'=>$_lu,
                  '_pic_name'=>$p_pic_name,
                  '_pic_phone'=>$p_pic_phone,
                  '_pic_email'=>$p_pic_email,
                  '_active'=>'1',
                  '_delete'=>'0',
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
                );
                try{
                  $result    = $this->Clientcms_model->updateClient($clientUpdate,$IDClient);
                  $set_notif = array('notifsukses' => 'Client Berhasil Di Update');
                  $this->session->set_userdata($set_notif);
                  redirect("Clientcms");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("Clientcms");
                }

            }
      }
      $this->load->view('client/editclient',$data);
    }
    public function Operation()
    {
        $this->form_validation->set_rules('clientID', 'clientID', 'required');
        $clientID = $this->input->post('clientID');
        if ($this->post->input('delete')) {
            $hapus_client = $this->Clientcms_model->hapus_client($clientID);
            if($hapus_client){
              $set_notif = array('notifsukses' => "Client Berhasi DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
            }else{
              $set_notif = array('notifsukses' => "Client Gagal DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
            }
        }elseif ($this->input->post('edit')) {
            $this->editclient();
        }elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Clientcms_model->set_active($clientID);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
          }
        }elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Clientcms_model->set_noactive($clientID);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("Clientcms");
            }
        }
    }
    public function validation() {
        $configValidation = array(
              array(
                  'field' => 'name',
                  'label' => 'Name',
                  'rules' => 'required'
              ), array(
                  'field' => 'address',
                  'label' => 'Address',
                  'rules' => 'required'
              ), array(
                  'field' => 'desc',
                  'label' => 'Description',
                  'rules' => 'required'
              ), array(
                 'field'=>'pic_email',
                 'label'=>'Email',
                 'rules'=>'valid_email'
              )
          );
        return $configValidation;
    }

}
