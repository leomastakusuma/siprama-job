<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Settingusercms extends General {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     *      http://example.com/index.php/welcome
     *  - or -
     *      http://example.com/index.php/welcome/index
     *  - or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see https://codeigniter.com/user_guide/general/urls.html
     */

    function __construct()
    {
        // Construct the parent class
        parent::__construct();
        $this->load->model('Logincms_model');
    }

    public function index()
    {   
        $datacontent['title']   = 'Change Password';
        $this->load->view('settinguser/index',$datacontent);
    }

    public function change(){
        if(!empty($_POST)){
            $userInfo = $this->session->userdata('userinfo');
            $get = $this->Logincms_model->getuser_by_id($userInfo->user_no);
            $old = $this->input->post('old');
            $new = $this->input->post('new');
            $retype = $this->input->post('retype');
            if($get['_password']==encText($old)){
                if($new==$retype){
                    $data['_password'] = encText($new);//md5($new);
                    $this->Logincms_model->update($userInfo->user_no,$data);
                    $this->session->set_userdata('notifsukses','Password Berhasil Diganti, You will redirect automatically');
                    redirect('settingusercms');
                    //redirect('logincms/logout/success');
                }else{
                    $this->session->set_flashdata("retype", "retype doesn't match new password");
                    redirect('settingusercms');
                }
            }else{
                $this->session->set_flashdata('old', 'Wrong Password');
                redirect('settingusercms');
            }
        }
    }

    public function check(){
        if(!empty($_POST)){
            $userInfo = $this->session->userdata('userinfo');
            $get = $this->Logincms_model->getuser_by_id($userInfo->user_no);
            if($get['_password']==encText($this->input->post('old'))){
                $data['response'] = 'success';
            }else{
                $data['response'] = 'Wrong Password';
            }
        }else{
            $data['response'] = 'Something went wrong';
        }
        echo json_encode($data);
    }
}
