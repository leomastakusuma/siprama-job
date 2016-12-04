<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Interviewcms extends General {

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
        $this->getAccessUrl('ROLE00007016');
        $data['result'] = $this->Lamarancms_model->listInterview();
        $this->load->view('interview/listinterview',$data);
    }

    public function detail($id){
      $this->getAccessUrl('ROLE00007216');
        $data['interview'] = $this->Lamarancms_model->Interview($id);
        $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
        $this->load->view('interview/interviewdetail',$data);
    }

    public function tindak($id){
      $this->getAccessUrl('ROLE00007116');
      $data['interview'] = $this->Lamarancms_model->Interview($id);
      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatusInterview();
      $this->load->view('interview/tindaklanjut',$data);
    }

    public function tindaklanjut(){
      $this->getAccessUrl('ROLE00007116');
      $data['interview'] = $this->Lamarancms_model->Interview($this->input->post('lowongan_no'));
      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatusInterview();
      if(!empty($_POST)){
        $this->form_validation->set_rules('analisaa', 'Analisa', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == true) {
               $idInterview = $this->input->post('interview_no');
               $update = array(
                 'last_update'=>date('Y-m-d H:i:s'),
                 'status_interview_id'=>$this->input->post('status'),
                 '_analisa_interview'=>$this->input->post('analisaa'),
                 'last_update_by'=>$this->userInfo()->user_no,
               );

              //  $this->pr($update);
               $this->Lamarancms_model->updateInterview($update,$this->input->post('interview_no'));
              //  echo $this->db->last_query();die;
               /*Insert Step Interview Client*/
               $IDInterviewClient = $this->Sequencecms_model->next('cms_tx_interview_client');
               $insertInterviewClient = array(
                 'interview_client_no'=>$IDInterviewClient['nextval'],
                 'branch_id'=>branchID,
                 'interview_no'=>$this->input->post('interview_no'),
                 'status_interview_client_id'=>'STATUSINTCL00',
                 '_active'=>'1',
                 'create_date'=>date('Y-m-d H:i:s'),
                 'create_by'=>$this->userInfo()->user_no
               );

               #Ketika Sudah Direview Dan Hasi Tidak Lolos Maka Status Apply  Langsung Diganti...
               if($this->input->ppst('status')==='STATUSINT02'){
                   $getApplyLowongan = $this->Lamarancms_model->getApplyLowongan($data['interview']->psikotes_no);
                   $this->Lamarancms_model->updateStatusApplyLowongan($this->input->post('status'),$getApplyLowongan->applyNo);
                   $insertInterviewClient['_analisa_interview'] = 'Tidak Lolos Interview';
                   $insertInterviewClient['status_interview_client_id'] = 'STATUSINTCL02';
               }

               $this->Lamarancms_model->insertInterviewClient($insertInterviewClient);


               $notif_message = "Interview  Berhasil Diupdate";
               $set_notif = array('notifsukses' => $notif_message);
               $this->session->set_userdata($set_notif);
               redirect("Interviewcms");
           }else{
            $this->load->view('interview/tindaklanjut',$data);
           }
      }
    }



}
