<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Interviewclientcms extends General {

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
        $this->getAccessUrl('ROLE00007416');
        $data['result'] = $this->Lamarancms_model->listInterviewClient();
        $this->load->view('interviewclient/listinterviewclient',$data);
    }

    public function detail($id){
        $this->getAccessUrl('ROLE00007516');
        $data['interview'] = $this->Lamarancms_model->Interviewclient($id);
        $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
        // $this->pr($data);
        $this->load->view('interviewclient/interviewclientdetail',$data);
    }

    public function tindak($id){
      $this->getAccessUrl('ROLE00007616');
      $data['interview'] = $this->Lamarancms_model->Interviewclient($id);
      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatusIntervieClient();
      // $this->pr($data);
      $this->load->view('interviewclient/tindaklanjut',$data);
    }

    public function tindaklanjut(){
      $this->getAccessUrl('ROLE00007616');
      $data['interview'] = $this->Lamarancms_model->Interviewclient($this->input->post('lowongan_no'));

      $data['result'] = $this->Lamarancms_model->psikotesdetail($data['interview']->psikotes_no);
      $data['status']=$this->Lamarancms_model->selecStatusIntervieClient();
      if(!empty($_POST)){
        $this->form_validation->set_rules('analisaa', 'Analisa', 'required');
        $this->form_validation->set_rules('status', 'Status', 'required');
            if ($this->form_validation->run() == true) {
              //  $idInterview = $_POST['interview_no'];
               $update = array(
                 'last_update'=>date('Y-m-d H:i:s'),
                 'status_interview_client_id'=>$this->input->post('status'),
                 '_analisa_interview'=>$this->input->post('analisaa'),
                 'last_update_by'=>$this->userInfo()->user_no,
               );
               #Ketika Sudah Direview Maka Status Apply  Langsung Diganti...
               $getApplyLowongan = $this->Lamarancms_model->getApplyLowongan($data['interview']->psikotes_no);
               $this->Lamarancms_model->updateStatusApplyLowongan($this->input->post('status'),$getApplyLowongan->applyNo);

               $this->Lamarancms_model->updateInterviewclient($update,$this->input->post('interview_client_no'));
               $notif_message = "Interview Client Berhasil Diupdate";
               $set_notif = array('notifsukses' => $notif_message);
               $this->session->set_userdata($set_notif);
               redirect("Interviewclientcms");
           }else{
            $this->load->view('interviewclient/tindaklanjut',$data);
           }
      }
    }



}
