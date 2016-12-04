<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Lamaran extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');
          $this->load->model("Lowongancms_model");
          $this->load->model("Soalcms_model");
          $this->load->model('Pelamarcms_model');
          $this->checkLogin();
    }

    public function Index()
  	{
          $data['userInfo'] = $this->userInfo();
          $data['personalInfo'] = $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          $data['statusLamaran'] = $this->Lowongancms_model->listLowonganbyID($this->userInfo()->pelamar_no);
          // $this->pr($data);
          $this->load->view('lamaran/status',$data);

  	}

    public function start(){
          $data['TanjungJawab'] = $this->Soalcms_model->TypeTanggungJawab();
          $data['IntegritasKejujuran']  = $this->Soalcms_model->TypeIntegritasKejujuran();
          $data['InisiatifKreatifitas'] = $this->Soalcms_model->TypeInisitipKreatif();
          $data['Teamwork'] = $this->Soalcms_model->TypeTeamWork();
          $data['TypeSoal'] = $this->Soalcms_model->typeSoal();
          // $this->pr($data);
          $this->load->view('psikotes/start',$data);

    }



}
