<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class rolecms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usercms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Rolecms_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00001516');
      $data['data'] = $this->Rolecms_model->listRole();
      $this->load->view('role/listrole',$data);
    }

    public function addrole(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00002116');
      if(!empty($_POST)){
        $this->form_validation->set_rules('_name', '_name', 'required|max_length[50]');
        $this->form_validation->set_rules('_desc', '_desc', 'required|max_length[100]');
        if($this->form_validation->run() == true) {
            $name = $this->input->post('_name');
            $desc = $this->input->post('_desc');
            $_irn = '';
            $_ien = '';
            $_iu = '';
            if(!empty($_FILES['icon'])){
              $upload = $this->uploadImage($_FILES['icon']['name'],$_FILES['icon']['tmp_name']);
              if($upload['success']){
                $_irn = $upload['_icon_real_name'];
                $_ien = $upload['_icon_enc_name'];
                $_iu =  $upload['_icon_url'];
              }
            }
            $IDRole = $this->Sequencecms_model->next("sys_tm_role");
            $userInfo = $this->userInfo();
            $dataRole = array (
              'role_id'=>$IDRole['nextval'],
              '_name'=>$name,
              '_desc'=>$desc,
              '_icon_real_name'=>$_irn,
              '_icon_enc_name'=>$_ien,
              '_icon_url'=>$_iu,
              '_active'=>'1',
              '_delete'=>'0',
              'create_date'=>date('Y-m-d H:i:s'),
              'create_by'=>$userInfo->user_no
            );
            $this->Rolecms_model->insertRole($dataRole);
            $notif_message = "Role Berhasil Disimpan";
            $set_notif = array('notifsukses' => $notif_message);
            $this->session->set_userdata($set_notif);
            redirect("rolecms");
        }
      }
      $this->load->view('role/addrole');

    }
    public function add(){
      $this->form_validation->set_rules('_name', '_name', 'required|max_length[10]');
      $this->form_validation->set_rules('_desc', '_desc', 'required|max_length[10]');
      if($this->form_validation->run() == true) {
          $name = $this->input->post('_name');
          $desc = $this->input->post('_desc');
          $_irn = '';
          $_ien = '';
          $_iu = '';
          if(!empty($_FILES['icon'])){
            $upload = $this->uploadImage($_FILES['icon']['name'],$_FILES['icon']['tmp_name']);
            if($upload['success']){
              $_irn = $upload['_icon_real_name'];
              $_ien = $upload['_icon_enc_name'];
              $_iu =  $upload['_icon_url'];
            }
          }
          $IDRole = $this->Sequencecms_model->next("sys_tm_role");
          $userInfo = $this->userInfo();
          $dataRole = array (
            'role_id'=>$IDRole['nextval'],
            '_name'=>$name,
            '_desc'=>$desc,
            '_icon_real_name'=>$_irn,
            '_icon_enc_name'=>$_ien,
            '_icon_url'=>$_iu,
            '_active'=>'1',
            '_delete'=>'0',
            'create_date'=>date('Y-m-d H:i:s'),
            'create_by'=>$userInfo->user_no
          );
          $this->Rolecms_model->insertRole($dataRole);
          $notif_message = "Role Berhasil Disimpan";
          $set_notif = array('notifsukses' => $notif_message);
          $this->session->set_userdata($set_notif);
          redirect("rolecms");
      }
    }

    public function edit($id){
      //Cek Access Url
      $this->getAccessUrl('ROLE00002216');
      $data = $this->Rolecms_model->search($id);
      $this->load->view('role/editrole',$data);
    }

    public function update(){
      $roleID = $this->input->post('role_id');
      $this->form_validation->set_rules('_name', '_name', 'required|max_length[1000]');
      $this->form_validation->set_rules('_desc', '_desc', 'required|max_length[1000]');
      if($this->form_validation->run() == true) {
          $name = $this->input->post('_name');
          $desc = $this->input->post('_desc');
          $dataRoleUpdate = array();
          if(!empty($_FILES['icon']['name'])){
              $checkImg = $this->Rolecms_model->search($roleID);
              if($checkImg['_icon_real_name'] === $_FILES['icon']['name']){
                  $dataRoleUpdate['_icon_real_name'] = $checkImg['_icon_real_name'];
                  $dataRoleUpdate['_icon_url'] = $checkImg['_icon_enc_name'];
                  $dataRoleUpdate['_icon_url'] =  $checkImg['_icon_url'];
              }else{
                  $deleteImg = FCPATH.'public_assets/uploads/'.$checkImg['_icon_enc_name'];
                  if(unlink($deleteImg)){
                    $upload = $this->uploadImage($_FILES['icon']['name'],$_FILES['icon']['tmp_name']);
                    if($upload['success']){
                      $dataRoleUpdate['_icon_real_name'] = $upload['_icon_real_name'];
                      $dataRoleUpdate['_icon_url'] = $upload['_icon_enc_name'];
                      $dataRoleUpdate['_icon_url'] =  $upload['_icon_url'];
                    }
                  }

              }
          }
          $userInfo = $this->userInfo();
          $dataRoleUpdate['_name'] =$name;
          $dataRoleUpdate['_desc'] =$desc;
          $dataRoleUpdate['last_update'] =date('Y-m-d H:i:s');
          $dataRoleUpdate['last_update_by'] =$userInfo->user_no;
          $this->Rolecms_model->updateRole($dataRoleUpdate,$roleID);
          $notif_message = "Role Berhasil Di Update";
          $set_notif = array('notifsukses' => $notif_message);
          $this->session->set_userdata($set_notif);
          redirect("rolecms");
      }
    }
}
