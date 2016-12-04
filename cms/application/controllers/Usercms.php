<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';
require APPPATH . '/controllers/Upload.php';

class Usercms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usercms_model');
        $this->load->model('Managementbrandcms_model');

        $this->load->model('Sequencecms_model');
    }

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */
    public function Index() {
        //Cek Access Url
        $this->getAccessUrl('ROLE00002816');
        $data['result'] = $this->Usercms_model->ambil_data();
        $this->load->view('users/userlist', $data);
    }

    public function Adduser() {
        //Cek Access Url
        $this->getAccessUrl('ROLE00002816');
        $data['level_id'] = $this->Usercms_model->getUserLever();
        $data['branch'] = $this->Managementbrandcms_model->selectBranch();
        $this->load->view('users/adduser', $data);
    }

    public function Userrole() {
        $this->load->view('userrole');
    }

    public function Save() {
        // $data['level_id'] = $this->Usercms_model->Ambil_level_id();
        $data =array();
        $userInfo = $this->userInfo();
        // $this->pr($userInfo->user_no);die;
        $this->form_validation->set_rules('username', 'username', 'required|max_length[45]');
        $this->form_validation->set_rules('fullname', 'fullname', 'required|max_length[45]');
        $this->form_validation->set_rules('initial', 'initial', 'required|max_length[80]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[80]');
        $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
        $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');
        $this->form_validation->set_rules('email', 'email', 'required|max_length[45]');
        $this->form_validation->set_rules('level', 'level', 'required|max_length[30]');

        // $data['result'] = $this->Usercms_model->ambil_data();
        if ($this->form_validation->run() == true) {
            $p_fullname = strtoupper($this->input->post('fullname'));
            $p_username = strtoupper($this->input->post('username'));
            $p_inisial = strtoupper($this->input->post('initial'));
            $p_password = $this->input->post('password');
            $p_email = $this->input->post('email');
            $p_address = $this->input->post('address');
            $p_phone = $this->input->post('phone');
            $p_level_id = $this->input->post('level');
            // $branch = branchID;
            $IDUser = $this->Sequencecms_model->next("cms_tm_user");
            $_irn = '';
            $_ien = '';
            $_iu = '';
            if(!empty($_FILES['avatar'])){
              $upload = $this->uploadImage($_FILES['avatar']['name'],$_FILES['avatar']['tmp_name']);
              if($upload['success']){
                $_irn = $upload['_icon_real_name'];
                $_ien = $upload['_icon_enc_name'];
                $_iu =  $upload['_icon_url'];
              }
            }
            $simpanUser = array(
                'user_no' => $IDUser['nextval'],
                'branch_id' => $this->userInfo()->branch_id,#$branch,
                '_id' => $p_username,
                '_full_name' => $p_fullname,
                '_initial_name' => $p_inisial,
                'user_level_id' => $p_level_id,
                '_active' => '1',
                '_delete' => '0',
                '_avatar_real_name'=>$_irn,
                '_avatar_enc_name'=>$_ien,
                '_avatar_url'=>$_iu,
                '_password' => encText($p_password),
                '_phone' => $p_phone,
                '_address' => $p_address,
                '_email' => $p_email,
                'create_date' => date("Y-m-d H:i:s"),
                'create_by' => $userInfo->user_no
            );

            $result = $this->Usercms_model->simpan_user($simpanUser);


            if ($result) {
                $set_notif = array('notifsukses' => $result);
                $this->session->set_userdata($set_notif);
                redirect("usercms");
            } else {
                $set_notif = array('notifsukses' => $result);
                $this->session->set_userdata($set_notif);
                redirect("usercms");
            }
        }else{
          $data['level_id'] = $this->Usercms_model->getUserLever();

          $this->load->view('users/adduser', $data);
        }
    }

    public function update_user() {
      // $this->pr($_POST);
        $this->form_validation->set_rules('fullname', 'username', 'required|max_length[45]');
        $this->form_validation->set_rules('username', 'username', 'required|max_length[45]');
        $this->form_validation->set_rules('initial', 'initial', 'required|max_length[45]');
        $this->form_validation->set_rules('email', 'email', 'required|max_length[45]');
        $this->form_validation->set_rules('level', 'level', 'required|max_length[10]');
        $this->form_validation->set_rules('address', 'address', 'required|max_length[250]');
        $this->form_validation->set_rules('phone', 'phone', 'required|max_length[25]');
        $this->form_validation->set_rules('user_no', 'user_no', 'required|max_length[45]');
        if ($this->form_validation->run() == true) {
            $p_fullname = strtoupper($this->input->post('fullname'));
            $p_username = strtoupper($this->input->post('username'));
            $p_initial = strtoupper($this->input->post('initial'));
            $p_email = $this->input->post('email');
            $p_address = $this->input->post('address');
            $p_phone = $this->input->post('phone');
            $p_level_id = $this->input->post('level');
            $p_user_no = $this->input->post('user_no');


            $result = $this->Usercms_model->searchUser($p_user_no);
            $_lrn = $result['_avatar_real_name'];
            $_len = $result['_avatar_enc_name'];
            $_lu =  $result['_avatar_url'];

            if(!empty($_FILES['avatar']['name'])){
              if(!empty($result['_avatar_real_name']) && ($result['_avatar_enc_name'] != $_FILES['avatar']['name']) ){
                  $deleteImg = FCPATH.'public_assets/uploads/'.$result['_avatar_enc_name'];
                  if(unlink($deleteImg)){
                      $upload = $this->uploadImage($_FILES['avatar']['name'],$_FILES['avatar']['tmp_name']);
                      if($upload['success']){
                        $_lrn = $upload['_icon_real_name'];
                        $_len = $upload['_icon_enc_name'];
                        $_lu =  $upload['_icon_url'];
                      }
                  }
              }else{
                  $upload = $this->uploadImage($_FILES['avatar']['name'],$_FILES['avatar']['tmp_name']);
                  if($upload['success']){
                    $_lrn = $upload['_icon_real_name'];
                    $_len = $upload['_icon_enc_name'];
                    $_lu =  $upload['_icon_url'];
                  }
              }

            }

            $updateuser = array(
                '_id' => $p_username,
                '_full_name' => $p_fullname,
                '_initial_name' => $p_initial,
                'user_level_id' => $p_level_id,
                '_active' => '1',
                '_delete' => '0',
                '_phone' => $p_phone,
                '_address' => $p_address,
                '_email' => $p_email,
                '_avatar_real_name'=>$_lrn,
                '_avatar_enc_name'=>$_len,
                '_avatar_url'=>$_lu,
                'last_update' => date("Y-m-d H:i:s"),
                'last_update_by	' => $this->userInfo()->user_no
            );
            $result = $this->Usercms_model->updateuser($updateuser,$p_user_no);

            if ($result=="1") {
                $notif_message = "Data berhasil diupdate.";
                $set_notif = array('notifsukses' => $notif_message);
                $this->session->set_userdata($set_notif);
                redirect("usercms");
            } else {
                $notif_message = $result=="2" ? "Data gagal diupdate." : "Gagal update user. User sudah ada, atau inisial sudah digunakan.";
                $set_notif = array('notiferror' => $notif_message);
                $this->session->set_userdata($set_notif);
                redirect("usercms");
            }
        }else{
            $data['level_id'] = $this->Usercms_model->getUserLever();
            $data['edit'] = $this->Usercms_model->ambil_edit_data($this->input->post('user_no'));
            $this->load->view('users/edituser', $data);
        }
    }

    public function userOperation($p_user_no) {
        if ($this->input->post('delete')) {
            $hapus_user = $this->Usercms_model->hapus_user($p_user_no);
            $set_notif = array('notifsukses' => $hapus_user);
            $this->session->set_userdata($set_notif);
            redirect("usercms");
        } elseif ($this->input->post('edit')) {
            //Cek Access Url
            $this->getAccessUrl('ROLE00003216');
            $data['level_id'] = $this->Usercms_model->getUserLever();
            $data['branch'] = $this->Managementbrandcms_model->selectBranch();
            // $this->pr($data);
            // $data['channel_id'] = $this->Channelcms_model->selectChannel('channel_no,_name');
            $data['edit'] = $this->Usercms_model->ambil_edit_data($p_user_no);
            $this->load->view('users/edituser', $data);
        } elseif ($this->input->post('resetpass')) {
            $passbaru = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
            $set_aktif = $this->Usercms_model->reset_pass($p_user_no, $passbaru);
            $set_notif = array('notifganti' => $set_aktif);
            $this->session->set_flashdata($set_notif);
            $set_notif = array('notifsukses' => 'User Password Successfully Reset');
            $this->session->set_userdata($set_notif);
            $data['level_id'] = $this->Usercms_model->getUserLever();
            // $data['channel_id'] = $this->Channelcms_model->selectChannel('channel_no,_name');
            $data['edit'] = $this->Usercms_model->ambil_edit_data($p_user_no);
            $this->load->view('/users/edituser', $data);
            //redirect("usercms");
        } elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Usercms_model->set_active($p_user_no);
            $set_notif = array('notifsukses' => $set_aktif);
            $this->session->set_userdata($set_notif);
            redirect("usercms");
        } elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Usercms_model->set_noactive($p_user_no);
            $set_notif = array('notiferror' => $set_noaktif);
            $this->session->set_userdata($set_notif);
            redirect("usercms");
        } else {
            redirect("usercms");
        }
    }

}
