<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Psikotescms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Logincms_model');
        $this->load->model('Userrolecms_model');
        $this->load->model('Lamarancms_model');
        $this->load->model('Sequencecms_model');

    }


    public function Index() {
        $this->getAccessUrl('ROLE00006616');
        $data['result'] = $this->Lamarancms_model->listApply();
        $this->load->view('psikotes/listpsikotes',$data);
    }

    public function detail($id){
      $this->getAccessUrl('ROLE00006716');
        $data['psikotes'] = $this->Lamarancms_model->Psikotes($id);
        $data['result'] = $this->Lamarancms_model->psikotesdetail($data['psikotes']->psikotes_no);
        $this->load->view('psikotes/psikotesdetail',$data);
    }

    public function tindak($id){
      $this->getAccessUrl('ROLE00006816');
      $data['psikotes'] = $this->Lamarancms_model->Psikotes($id);
      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['psikotes']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatus();
      $this->load->view('psikotes/tindaklanjut',$data);
    }

    public function tindaklanjut(){
      $this->getAccessUrl('ROLE00006816');
      $data['psikotes'] = $this->Lamarancms_model->Psikotes($this->input->post('lowongan_no'));
      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['psikotes']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatus();
      if(!empty($_POST)){
          $this->form_validation->set_rules('analisaa', 'Analisa', 'required');
          $this->form_validation->set_rules('status', 'Status', 'required');
          if ($this->form_validation->run() == true) {
               $idPsikotes = $this->input->post('psikotes_no');
               $update = array(
                 'follow_up_by'=>$this->userInfo()->user_no,
                 'last_update'=>date('Y-m-d H:i:s'),
                 'status_psikotes_id'=>$this->input->post('status'),
                 '_analisa'=>$this->input->post('analisaa'),
                 'last_update_by'=>$this->userInfo()->user_no
               );
               $this->Lamarancms_model->updatepsikotes($update,$this->input->post('psikotes_no'));

               /*Insert Step Interview */
               $IDInterview = $this->Sequencecms_model->next('cms_tx_interview');
               $insertInterview = array(
                 'interview_no'=>$IDInterview['nextval'],
                 'branch_id'=>branchID,
                 'psikotes_no'=>$this->input->post('psikotes_no'),
                 'pelamar_no'=>$this->input->post('pelamar_no'),
                 'status_interview_id'=>'STATUSINT00',
                 '_active'=>'1',
                 'create_date'=>date('Y-m-d H:i:s'),
                 'create_by'=>$this->userInfo()->user_no
               );

               $this->Lamarancms_model->insertInterview($insertInterview);

               $notif_message = "Psikotes Berhasil Diupdate";
               $set_notif = array('notifsukses' => $notif_message);
               $this->session->set_userdata($set_notif);
               redirect("Psikotescms");
          }else{
            $this->load->view('psikotes/tindaklanjut',$data);
          }
      }
    }



}
