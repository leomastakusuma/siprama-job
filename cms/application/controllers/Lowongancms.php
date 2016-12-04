<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Lowongancms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->helper('security');
        $this->load->model('General_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Clientcms_model');
        $this->load->model('Lowongancms_model');
        $this->load->model('Pekerjaancms_model');
        $this->load->model('Locationcms_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00004216');
      $data['result'] = $this->Lowongancms_model->listLowongan();
      $this->load->view('lowongan/lowonganlist',$data);
    }
    public function addlowongan(){
      //Cek Access Url
      // $this->pr($_POST);
      $this->getAccessUrl('ROLE00004316');
      $data['lowongan']= $this->General_model->getLowongan();
      $data['pekerjaan']= $this->Pekerjaancms_model->getPekerjaanbyBranch($this->userInfo()->branch_id);
      $data['client'] = $this->Clientcms_model->listClient();
      $data['kota'] = $this->Locationcms_model->Ambil_kota();

      if(!empty($_POST)){
        $configValidation = $this->Validation();
        $lowonganID = $this->Sequencecms_model->next('cms_tm_lowongan');
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == TRUE) {
            $dataLowongan = array(
                        'lowongan_no'=>$lowonganID['nextval'],
                        'client_id'=>$this->input->post('client'),
                        'branch_id'=>$this->userInfo()->branch_id,
                        '_name'=>$this->input->post('name'),
                        '_desc'=>$this->input->post('desc'),
                        'type_lowongan_id'=>$this->input->post('lowongan'),
                        'pekerjaan_branch_no'=>$this->input->post('pekerjaan'),
                        '_persyaratan'=>$this->input->post('persyaratan'),
                        '_date_from'=>$this->input->post('datefrom'),
                        '_date_thru'=>$this->input->post('datethru'),
                        'create_date'=>Date('Y-n-d H:i:s'),
                        'location_no'=>$this->input->post('lokasikota'),
                        '_active'=>'1',
                        '_delete'=>'0',
                        'create_by'=>$this->userInfo()->user_no
            );
            // $this->pr($dataLowongan);
            try {
               $this->Lowongancms_model->insertLowongan($dataLowongan);
               $set_notif = array('notifsukses' => 'Lowongan Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("lowongancms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("lowongancms");
             }
        }

      }
      $this->load->view('lowongan/addlowongan',$data);

    }

    public function editlowongan(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00004416');
      $IDLowongan = $this->input->post('lowonganNo');
      // $this->pr($_POST);
      $data['r'] = $this->Lowongancms_model->searchLowongan($IDLowongan);
      $data['lowongan']= $this->General_model->getLowongan();
      $data['pekerjaan']= $this->Pekerjaancms_model->getPekerjaanbyBranch($this->userInfo()->branch_id);
      $data['client'] = $this->Clientcms_model->listClient();
      $data['kota'] = $this->Locationcms_model->Ambil_kota();
      if(!empty($this->input->post('method'))){
          $lowonganNo = $this->input->post('lowonganNo');
          $configValidation = $this->Validation();
          $this->form_validation->set_rules($configValidation);
          if($this->form_validation->run() == true){
                $lowonganUpdate = array(
                    'client_id'=>$this->input->post('client'),
                    'type_lowongan_id'=>$this->input->post('lowongan'),
                    'pekerjaan_branch_no'=>$this->input->post('pekerjaan'),
                    '_name'=>$this->input->post('name'),
                    '_desc'=>$this->input->post('desc'),
                    '_persyaratan'=>$this->input->post('persyaratan'),
                    'last_update'=>date('Y-m-d H:i:s'),
                    '_date_from'=>$this->input->post('datefrom'),
                    'location_no'=>$this->input->post('lokasikota'),
                    '_date_thru'=>$this->input->post('datethru'),
                    'last_update_by'=>$this->userInfo()->user_no
                  );
                  try{
                    $result    = $this->Lowongancms_model->updateLowongan($lowonganUpdate,$lowonganNo);
                    $set_notif = array('notifsukses' => 'Lowongan Berhasil Di Update');
                    $this->session->set_userdata($set_notif);
                    redirect("lowongancms");
                  }catch (Exception $ex) {
                    $set_notif = array('notiferror' => $ex);
                    $this->session->set_userdata($set_notif);
                    redirect("lowongancms");
                  }
          }
      }
      $this->load->view('lowongan/editlowongan',$data);
    }
    public function Operation() {
        $this->form_validation->set_rules('lowonganNO', 'lowonganNO', 'required');
        $lowonganNO = $this->input->post('lowonganNo');
        if ($this->input->post('delete')) {
            $hapus_Lowongan = $this->Lowongancms_model->hapus_Lowongan($lowonganNO);
            if($hapus_Lowongan){
              $set_notif = array('notifsukses' => "Lowongan Berhasi DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
            }else{
              $set_notif = array('notifsukses' => "Lowongan Gagal DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
            }
        }elseif ($this->input->post('edit')) {
            $this->editlowongan();
        }elseif ($this->input->post('set_nonactive')) {
            $set_aktif = $this->Lowongancms_model->set_active($lowonganNO);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
          }
        }elseif ($this->input->post('set_active')) {
            $set_noaktif = $this->Lowongancms_model->set_noactive($lowonganNO);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("lowongancms");
            }
        }
    }
    public function validation() {
        $configValidation = array(
              array(
                  'field' => 'client',
                  'label' => 'Client',
                  'rules' => 'required'
              ), array(
                  'field' => 'lowongan',
                  'label' => 'Lowongan',
                  'rules' => 'required'
              ), array(
                  'field' => 'name',
                  'label' => 'Name',
                  'rules' => 'required'
              ),array(
                    'field' => 'pekerjaan',
                    'label' => 'Pekerjaan',
                    'rules' => 'required'
              ),array(
                    'field' => 'datefrom',
                    'label' => 'Date From',
                    'rules' => 'required|callback_validDateStart|callback_compareDates'
              ),array(
                    'field' => 'datethru',
                    'label' => 'Date Thru',
                    'rules' => 'required|callback_validDateEnd'
              ),array(
                    'field' => 'lokasikota',
                    'label' => 'Lokasi',
                    'rules' => 'required'
              )
          );
        return $configValidation;
    }
    /**
     * Function untuk validasi tanggal set headline dimana end date tidak boleh lebh kecil dari start date
     * @return boolean
     */
    function compareDates() {
        // $this->pr($_POST);
        $start = strtotime($this->input->post('datefrom'));
        $end = strtotime($this->input->post('datethru'));
        if ($start > $end) {
            $this->form_validation->set_message('compareDates', 'Your  Start Date must be earlier than your end End Date');
            return false;
        }
    }
    function validDateStart() {
        // $this->pr($_POST);
        $Now =  strtotime(date('Y-m-d'));
        $start = strtotime($this->input->post('datefrom'));
        // $end = strtotime($this->input->post('datethru'));
        if ($Now > $start) {
            $this->form_validation->set_message('validDateStart', 'Your  Start Date must be greater than '.date('Y-m-d'));
            return false;
        }
    }
    function validDateEnd() {
        // $this->pr($_POST);
        $Now =  strtotime(date('Y-m-d'));
        // $start = strtotime($this->input->post('datefrom'));
        $end = strtotime($this->input->post('datethru'));
        if ($Now > $end) {
            $this->form_validation->set_message('validDateEnd', 'Your  End Date must be greater than '.date('Y-m-d'));
            return false;
        }
    }
}
