<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Aboutus extends General {

    function __construct() {
        parent::__construct();
        $this->load->helper('s3');
        $this->load->model('About_model');
        $userInfo = $this->userInfo();
        $access = $this->checkUserAccess($userInfo->user_level_id, "ROLE04916");
        if ($access != 1) {
            redirect("logincms/logout");
        }
    }

    public function index(){
      $userInfo = $this->userInfo();
      $data['about'] = $this->About_model->selectAll();
      $this->load->view('about/list', $data);
    }

    public function edit($ID){
      if(empty($ID))
        redirect('General/page500');
      $dataDisclaimer = $this->About_model->get($ID);
      foreach ($dataDisclaimer as $key => $value)
      {
                 if($key=='_content')
                 {
                   $dataDisclaimer['content']=$value;
                 }
                 if($key=='_title')
                 {
                   $dataDisclaimer['title']=$value;
                 }
      }

      if(!empty($_POST)){
            $about_no = $this->input->post('about_no');
            $title = $this->input->post('title');
            $content    = $this->input->post('content');

            $configValidation = $this->Validation('save');
            $this->load->helper(array('form', 'url'));
            $this->load->library('form_validation');
            $this->form_validation->set_rules($configValidation);
                if ($this->form_validation->run() == TRUE) {
                    try{
                        $update = array(
                            '_title'=>$title,
                            '_content'=>$content,
                            'last_update'=>date('Y-m-d H:i:s'),
                        );
                        $this->About_model->update($about_no,$update);
                        $set_notif = array('notifsukses' => 'About Berhasil  diubah.');
                        $this->session->set_userdata($set_notif);
                        redirect('aboutus');
                    }catch(Exception $e){
                        $set_notif = array('notiferror' => $e->getMessage);
                        $this->session->set_userdata($set_notif);
                        redirect('aboutus');
                    }
                } else {
                     $dataDisclaimer = '';
                     $dataDisclaimer['about_no'] =$about_no;
                     $dataDisclaimer['_title'] = $title;
                     $dataDisclaimer['content']=$content;

                }
      }

      $this->load->view('about/edit',$dataDisclaimer);
    }

    public function validation($method) {
        $configValidation = array();
        if ($method === 'save' || $method === 'update-draft') {
            $configValidation = array(
                array(
                    'field' => 'title',
                    'label' => 'Title',
                    'rules' => 'required'
                ),array(
                    'field' => 'content',
                    'label' => 'Content',
                    'rules' => 'required'
                ),
            );
          }
          return $configValidation;
    }
}
