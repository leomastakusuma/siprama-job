<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Laporancms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Logincms_model');
        $this->load->model('Userrolecms_model');
        $this->load->model('Lowongancms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Pelamarcms_model');

    }


    public function Index() {
        $this->getAccessUrl('ROLE00008116');
        $this->load->view('laporan/searchpelamar');
    }


    public function lowongan(){
      $this->getAccessUrl('ROLE00008216');
	    $this->load->view('laporan/lowongan');

    }

    public function getlolos(){
      $this->getAccessUrl('ROLE00009216');
      $this->load->view('laporan/searchpelamarlolos');

    }

    public function getgagal(){
      $this->getAccessUrl('ROLE00009316');
      $this->load->view('laporan/searchpelamargagal');

    }
    public function getrekapitulasi(){
      $this->getAccessUrl('ROLE00009416');
      $this->load->view('laporan/searchrekapitulasipelamarlolos');

    }

     public function pelamarMasuk(){
       $this->getAccessUrl('ROLE00008116');
       if(!empty($_POST)){
           $this->form_validation->set_rules('start', 'Priode Awal', 'required');
           $this->form_validation->set_rules('end', 'Priode Akhir', 'required|callback_compareDates');
           if ($this->form_validation->run() == true) {
              $data['pelamar'] = $this->Lowongancms_model->laporanpelamarmasuk($this->input->post('start'),$this->input->post('end'));
              $data['start'] = $this->input->post('start');
              $data['end'] = $this->input->post('end');
              $this->load->view('laporan/laporanpelamar',$data);
           }else{
             $this->load->view('laporan/searchpelamar');
           }
       }

     }

     public function pelamarLolos(){
       $this->getAccessUrl('ROLE00009216');
       if(!empty($_POST)){
           $this->form_validation->set_rules('start', 'Priode Awal', 'required');
           $this->form_validation->set_rules('end', 'Priode Akhir', 'required|callback_compareDates');
           if ($this->form_validation->run() == true) {
              $data['pelamar'] = $this->Pelamarcms_model->getPelamarLolos($this->input->post('start'),$this->input->post('end'));
              $data['start'] = $this->input->post('start');
              $data['end'] = $this->input->post('end');
              $this->load->view('laporan/laporanpelamarlolos',$data);
           }else{
             $this->load->view('laporan/searchpelamarlolos');
           }
       }
     }

     public function pelamarRekapitulasiLolos(){
       $this->getAccessUrl('ROLE00009416');
       if(!empty($_POST)){
           $this->form_validation->set_rules('start', 'Priode Awal', 'required');
           $this->form_validation->set_rules('end', 'Priode Akhir', 'required|callback_compareDates');
           if ($this->form_validation->run() == true) {
              $data['pelamar'] = $this->Pelamarcms_model->getPelamarLolos($this->input->post('start'),$this->input->post('end'));
              $data['rekapitulasiLolos'] = $this->Pelamarcms_model->rekapitulasiLolos($this->input->post('start'),$this->input->post('end'));
              $data['start'] = $this->input->post('start');
              $data['end'] = $this->input->post('end');
              $this->load->view('laporan/laporanrekapitulasipelamarlolos',$data);
           }else{
             $this->load->view('laporan/searchpelamarlolos');
           }
       }
     }


    public function pelamarGagal(){
      $this->getAccessUrl('ROLE00009316');
      if(!empty($_POST)){
          $this->form_validation->set_rules('start', 'Priode Awal', 'required');
          $this->form_validation->set_rules('end', 'Priode Akhir', 'required|callback_compareDates');
          if ($this->form_validation->run() == true) {
             $data['pelamar'] = $this->Pelamarcms_model->getPelamarTidakLolos($this->input->post('start'),$this->input->post('end'));
             $data['start'] = $this->input->post('start');
             $data['end'] = $this->input->post('end');
             $this->load->view('laporan/laporanpelamargagal',$data);
          }else{
            $this->load->view('laporan/searchpelamargagal');
          }
      }
    }

     public function lowonganget(){
       $this->getAccessUrl('ROLE00008216');
       if(!empty($_POST)){
           $this->form_validation->set_rules('start', 'Priode Awal', 'required');
           $this->form_validation->set_rules('end', 'Priode Akhir', 'required|callback_compareDates');
           if ($this->form_validation->run() == true) {
              $data['lowongan'] = $this->Lowongancms_model->laporanlowongan($this->input->post('start'),$this->input->post('end'));
              $data['start'] = $this->input->post('start');
              $data['end'] = $this->input->post('end');
              $this->load->view('laporan/laporanlowongan',$data);
           }else{
             $this->load->view('laporan/searchpelamar');
           }
       }

     }

    function compareDates() {
        // $this->pr($_POST);
        $start = strtotime($this->input->post('start'));
        $end = strtotime($this->input->post('end'));
        if ($start > $end) {
            $this->form_validation->set_message('compareDates', 'Priode Akhir Tidak Boleh Lebih Kecil Dari Priode Awal.');
            return false;
        }
    }


}
