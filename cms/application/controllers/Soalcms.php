<?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Soalcms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Usercms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('Soalcms_model');
        $this->load->model('General_model');
    }
    public function index(){
      //Cek Access Url
      $this->getAccessUrl('ROLE00003816');
      $data['result'] = $this->Soalcms_model->listSoal();
      $this->load->view('soal/listsoal',$data);
    }

    public function addsoal(){
      $this->getAccessUrl('ROLE00004516');
      $data['typeSoal'] = $this->Soalcms_model->typeSoal();
      if(!empty($_POST)){
        $IDSoal = $this->Sequencecms_model->next('cms_tm_soal');
        /**Check position */
        $cekPosition = $this->Soalcms_model->position($this->userInfo()->branch_id);
        $position = !empty($cekPosition) ? ($cekPosition[0]->_position +1) : 1;
        $configValidation = $this->Validation();
        $this->form_validation->set_rules($configValidation);
        if ($this->form_validation->run() == TRUE) {
            #Check Exist Soal.
            $checkExistSoal = $this->General_model->checkExist('cms_tm_soal','_pertanyaan',$this->input->post('pertanyaan'));
            if($checkExistSoal > 1){
                $set_notif = array('notiferror' => 'Saol Telah Tersedia, Silahkan Masukan Soal Yang Lain');
                $this->session->set_userdata($set_notif);
                redirect("Soalcms");
            }

            $dataSoal = array(
                'soal_id'=>$IDSoal['nextval'],
                'branch_id'=>$this->userInfo()->branch_id,
                'category_soal_id'=>$this->input->post('kategori'),
                '_position'=> $position,
                '_pertanyaan'=>$this->input->post('pertanyaan'),
                '_opsi_a'=>$this->input->post('opsia'),
                '_score_a'=>$this->input->post('nilaia'),
                '_opsi_b'=>$this->input->post('opsib'),
                '_score_b'=>$this->input->post('nilaib'),
                '_opsi_c'=>$this->input->post('opsic'),
                '_score_c'=>$this->input->post('nilaic'),
                '_opsi_d'=>$this->input->post('opsid'),
                '_score_d'=>$this->input->post('nilaid'),
                '_active'=>'1',
                '_delete'=>'0',
                'create_date'=>date('Y-m-d H:i:s'),
                'create_by'=>$this->userInfo()->user_no
            );
            try {
               $this->Soalcms_model->insertSoal($dataSoal);
               $set_notif = array('notifsukses' => 'Soal Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("Soalcms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("Soalcms");
             }
        }

      }
      $this->load->view('soal/addsoal',$data);
    }

    public function editsoal(){
      $this->getAccessUrl('ROLE00003916');
      $IDSoal = $this->input->post('soalid');
      $data['r']= $this->Soalcms_model->search($IDSoal);
      $data['typeSoal'] = $this->Soalcms_model->typeSoal();
      if(!empty($this->input->post('method'))){
        $configValidation = $this->Validation();
        $this->form_validation->set_rules($configValidation);
          if ($this->form_validation->run() == TRUE) {
              #Check Exist Soal.
              $checkExistSoal = $this->General_model->checkExist('cms_tm_soal','_pertanyaan',$this->input->post('pertanyaan'));
              if($checkExistSoal > 1){
                  $set_notif = array('notiferror' => 'Saol Telah Tersedia, Silahkan Masukan Soal Yang Lain');
                  $this->session->set_userdata($set_notif);
                  redirect("Soalcms");
              }
              $dataSoal = array(
                  'branch_id'=>$this->userInfo()->branch_id,
                  'category_soal_id'=>$this->input->post('kategori'),
                  '_position'=> $position,
                  '_pertanyaan'=>$this->input->post('pertanyaan'),
                  '_opsi_a'=>$this->input->post('opsia'),
                  '_score_a'=>$this->input->post('nilaia'),
                  '_opsi_b'=>$this->input->post('opsib'),
                  '_score_b'=>$this->input->post('nilaib'),
                  '_opsi_c'=>$this->input->post('opsic'),
                  '_score_c'=>$this->input->post('nilaic'),
                  '_opsi_d'=>$this->input->post('opsid'),
                  '_score_d'=>$this->input->post('nilaid'),
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
              );
              try {
                 $this->Soalcms_model->updateSoal($dataSoal,$IDSoal);
                 $set_notif = array('notifsukses' => 'Soal Berhasil Di Update');
                 $this->session->set_userdata($set_notif);
                 redirect("Soalcms");
               }catch (Exception $ex) {
                 $set_notif = array('notiferror' => $ex);
                 $this->session->set_userdata($set_notif);
                 redirect("Soalcms");
               }
         }
      }
      $this->load->view('soal/editsoal',$data);


    }

    public function operation(){
        $IDSoal = $this->input->post('soalid');
        if(!empty($this->input->post('edit'))){
            $this->editsoal();
        }
        elseif(!empty($this->input->post('delete'))){
            $hapus_Soal = $this->Soalcms_model->hapus_Soal($IDSoal);
            if($hapus_Soal){
              $set_notif = array('notifsukses' => "Soal Berhasi DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
            }else{
              $set_notif = array('notifsukses' => "Soal Gagal DI Hapus");
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
            }
        }elseif ($this->input->post('setinactive')) {
            $set_aktif = $this->Soalcms_model->set_noactive($IDSoal);
           if($set_aktif){
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
           }else{
              $set_notif = array('notifsukses' => $set_aktif);
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
          }
        }elseif ($this->input->post('setactive')) {
            $set_noaktif = $this->Soalcms_model->set_active($IDSoal);
            if($set_noaktif){
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
            }else{
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("soalcms");
            }
        }
    }
    public function validation() {
        $configValidation = array(
              array(
                  'field' => 'kategori',
                  'label' => 'Kategori',
                  'rules' => 'required'
              ), array(
                  'field' => 'pertanyaan',
                  'label' => 'Pertanyaan',
                  'rules' => 'required'
              ), array(
                  'field' => 'opsia',
                  'label' => 'Opsi A',
                  'rules' => 'required'
              ),array(
                  'field' => 'nilaia',
                  'label' => 'Nilai A',
                  'rules' => 'required'
              ),array(
                  'field' => 'opsib',
                  'label' => 'Opsi B',
                  'rules' => 'required'
              ),array(
                  'field' => 'nilaib',
                  'label' => 'Nilai B',
                  'rules' => 'required'
              ),array(
                  'field' => 'opsic',
                  'label' => 'Opsi C',
                  'rules' => 'required'
              ),array(
                  'field' => 'nilaic',
                  'label' => 'Nilai C',
                  'rules' => 'required'
              ),array(
                  'field' => 'opsid',
                  'label' => 'Opsi D',
                  'rules' => 'required'
              ),array(
                  'field' => 'nilaid',
                  'label' => 'Nilai D',
                  'rules' => 'required'
              )
          );
        return $configValidation;
    }



}
