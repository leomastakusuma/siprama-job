<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Pelamarcms extends General {

  public function __construct() {
      parent::__construct();
      $this->load->helper('url');
      $this->load->model('Pelamarcms_model');
  }

  public function index(){
      $this->getAccessUrl('ROLE00009516');
      $data['data'] = $this->Pelamarcms_model->getPelamar();
      $this->load->view('pelamar/listpelamar',$data);
  }

  public function detail($id){
      $this->getAccessUrl('ROLE00009516');
      $data['personalInfo'] = $this->Pelamarcms_model->getPelamarPersonalDetail($id);
      if(empty($data['personalInfo'])){
        $set_notif = array('notiferror' => 'Ops Data Tidak Ditemukan');
        $this->session->set_userdata($set_notif);
        redirect("Pelamarcms");
      }
      $personalFamily = $this->Pelamarcms_model->getPelamarPersonalFamilyDetail($id);
      foreach ($personalFamily  as $key => $value) {
          if($value->family_type_id == 'FAMILY02'){
             $data['personalFamily']['pasangan']['nama'] = $value->_name;
             $data['personalFamily']['pasangan']['tlp'] = $value->_phone;
          }else{
             $data['personalFamily']['anak']['nama'][] = $value->_name;
             $data['personalFamily']['anak']['tlp'][] = $value->_phone;
          }
      }
      $this->load->view('pelamar/detailPelamar',$data);
  }

  public function cetak($id){
    $data['personalInfo'] = $this->Pelamarcms_model->getPelamarPersonalDetail($id);
    if(empty($data['personalInfo'])){
      $set_notif = array('notiferror' => 'Ops Data Tidak Ditemukan');
      $this->session->set_userdata($set_notif);
      redirect("Pelamarcms");
    }
    $personalFamily = $this->Pelamarcms_model->getPelamarPersonalFamilyDetail($id);
    foreach ($personalFamily  as $key => $value) {
        if($value->family_type_id == 'FAMILY02'){
           $data['personalFamily']['pasangan']['nama'] = $value->_name;
           $data['personalFamily']['pasangan']['tlp'] = $value->_phone;
        }else{
           $data['personalFamily']['anak']['nama'][] = $value->_name;
           $data['personalFamily']['anak']['tlp'][] = $value->_phone;
        }
    }
    // $this->pr($data);
    $this->load->view('pelamar/cetakpelamar',$data);
  }

}
