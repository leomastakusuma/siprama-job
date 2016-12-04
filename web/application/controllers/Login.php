<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends ci_controller {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');

    }

    public function Index($idChannel='')
  	{

      $this->load->view('login/index');

  	}

    public function Proses(){
      $this->load->model('General_model');
      $this->load->model('Logincms_model');
      $this->form_validation->set_rules('email', 'Email', 'required|max_length[45]');
      $this->form_validation->set_rules('password', 'Password', 'required|max_length[80]');
      if ($this->form_validation->run() == true) {
             // Proses
              $p_username = $this->input->post('email');
              $p_password = encText($this->input->post('password'));
              $cek_usernya = $this->Logincms_model->cari_user_dulu($p_username,$p_password);
              if ($cek_usernya == "1") {
                  $result = $this->Logincms_model->login($p_username, $p_password);

                  if ($result == TRUE) {
                      $userInfo = $this->Logincms_model->userInfo($p_username, trim($p_password," "));
                      $updateLogin = array('_last_login'=>date('Y-m-d H:i:s'));
                      $userID = $userInfo->pelamar_no;
                      $this->Logincms_model->update($userID,$updateLogin);

                      $sessiondata = array(
                          'username' => $this->input->post('username'),
                          'loginuser' => TRUE,
                          'userinfo' => $userInfo,
                      );

                      $this->session->set_userdata($sessiondata);
                      redirect("");
                  }
              }
              else {
                  $this->session->set_flashdata('error',$cek_usernya);
                  $this->load->view('login/index', array('er' => $cek_usernya));

              }

      } else {

          $this->load->view('login/index', array('err' => validation_errors()));
      }
    }

    public function logout(){
       session_destroy();
       redirect('');
    }

}
