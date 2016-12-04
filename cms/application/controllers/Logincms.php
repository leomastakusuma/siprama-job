<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Logincms extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Logincms_model');
        $this->load->model('Userrolecms_model');

    }


    public function Index() {
        // $this->load->library('recaptcha');
        $this->load->view('login');
    }

    public function Process() {
        // Memanggil library
        // $this->load->library('recaptcha');

        $this->load->model('General_model');
        $this->form_validation->set_rules('username', 'username', 'required|max_length[45]');
        $this->form_validation->set_rules('password', 'password', 'required|max_length[80]');
        if ($this->form_validation->run() == true) {
            // Mendapatkan input recaptcha dari user
            // Dmatikan sementara
            // $captcha_answer = $this->input->post('g-recaptcha-response');

            // Verifikasi input recaptcha dari user
            // Dmatikan sementara
            // $response = $this->recaptcha->verifyResponse($captcha_answer);
               $response['success'] = array('success');
            // Proses
            if ($response['success']) {
                $p_username = $this->input->post('username');
                $p_password = $this->input->post('password');

                $cek_usernya = $this->Logincms_model->cari_user_dulu($p_username, $p_password);
                // echo $this->db->last_query();
                // print_r($cek_usernya);die;
                if ($cek_usernya == "1") {
                    $result = $this->Logincms_model->login($p_username, $p_password);

                    if ($result == TRUE) {
                        // tambahin get informasi data dari cms_tm_user untuk ditaro di $sessiondata
                        //$userinfo = $this->Logincms_model->userInfo($p_username)

                        $userInfo = $this->Logincms_model->userInfo($p_username, trim($p_password," "));
                        // $roles = $this->General_model->get_all_access($userInfo->user_level_id);
                        $roles = $this->Userrolecms_model->getAccess($userInfo->branch_id,$userInfo->user_level_id);

                        foreach ($roles as $rull):
                            $cks[] = $rull['role_id'];
                        endforeach;
                        $sessiondata = array(
                            'username' => $this->input->post('username'),
                            'loginuser' => TRUE,
                            'userinfo' => $userInfo,
                            'notifsukses' => "Selamat datang",
                            'cek' => $cks,
                        );
                        $this->session->set_userdata($sessiondata);
                        redirect("");
                    }
                }
                else {
                    $this->load->view('login', array('err' => $cek_usernya));
                }
            } else {
                $this->load->view('login', array('err' => 'wrong captcha'));
            }
        } else {
            $this->load->view('login', array('err' => validation_errors()));
        }
    }

    public function Logout() {
        $this->session->sess_destroy();
        redirect("Logincms");
    }

    public function GeneratePassword($password) {
       if(!empty($password)){
          $paswordGenerate = encText($password);
          echo $paswordGenerate;
       }
    }

}
