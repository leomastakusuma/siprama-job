<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';
class Locationcms extends General {

    public function __construct() {
        parent::__construct();
        $this->load->helper('url');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('Locationcms_model');
        $this->load->model('Sequencecms_model');
        $this->load->model('General_model');
    }


	public function Index()
	{
     $this->getAccessUrl('ROLE00005816');
		 $data['location_type'] = $this->Locationcms_model->Ambil_location_type();
		 $data['country_id'] = $this->Locationcms_model->Ambil_country_id();
		 $data['result'] = $this->Locationcms_model->ambil_data();
     $this->load->view('location/locationlist', $data);

  }

	public function Addlocation(){
    $this->getAccessUrl('ROLE00005916');
    $data['location_type'] = $this->Locationcms_model->Ambil_location_type();
    $data['negara'] = $this->Locationcms_model->Ambil_country_id();
    $data['provinsi'] = $this->Locationcms_model->Ambil_province_id();
    if(!empty($_POST)){
        $method = $_POST['Type'];
        $configValidation = $this->Validation($method);
        $this->form_validation->set_rules($configValidation);
        $IDLocation = $this->Sequencecms_model->next('cms_tm_location');
        if ($this->form_validation->run() == TRUE) {
          $checkExistLoc = $this->General_model->checkExist('cms_tm_location','_name',$this->input->post('countryc'));
          if($checkExistLoc > 1){
              $set_notif = array('notiferror' => 'Nama Lokasi Telah Tersedia!');
              $this->session->set_userdata($set_notif);
              redirect("Locationcms");
          }
            if($method === 'negara'){
                $datalokasi = array(
                  'location_no'=>$IDLocation['nextval'],
                  'type_location_id'=>$this->input->post('level'),
                  '_location_country_no'=>$IDLocation['nextval'],
                  '_name'=>$this->input->post('countryc'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsc'),
                  '_desc'=>$this->input->post('descc'),
                  'create_date'=>date('Y-m-d H:i:s'),
                  'create_by'=>$this->userInfo()->user_no
                );
            }if($method === 'provinsi'){
                // die('e');
                $datalokasi = array(
                  'location_no'=>$IDLocation['nextval'],
                  'type_location_id'=>$this->input->post('level'),
                  '_location_country_no'=>$this->input->post('negarap'),
                  '_parent_location_no'=>$this->input->post('negarap'),
                  '_name'=>$this->input->post('provinsip'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsp'),
                  '_desc'=>$this->input->post('descp'),
                  'create_date'=>date('Y-m-d H:i:s'),
                  'create_by'=>$this->userInfo()->user_no
                );
            }if($method === 'kota'){
                $datalokasi = array(
                  'location_no'=>$IDLocation['nextval'],
                  'type_location_id'=>$this->input->post('level'),
                  '_location_country_no'=>$this->input->post('negarak'),
                  '_parent_location_no'=>$this->input->post('provinsik'),
                  '_name'=>$this->input->post('kotak'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsk'),
                  '_desc'=>$this->input->post('desck'),
                  'create_date'=>date('Y-m-d H:i:s'),
                  'create_by'=>$this->userInfo()->user_no
                );
            }
            try {
               $this->Locationcms_model->insertLocation($datalokasi);
               $set_notif = array('notifsukses' => 'Lokasi Berhasil Disimpan');
               $this->session->set_userdata($set_notif);
               redirect("Locationcms");
             }catch (Exception $ex) {
               $set_notif = array('notiferror' => $ex);
               $this->session->set_userdata($set_notif);
               redirect("Locationcms");
             }
        }

        $data['method']=$method;
    }

    $this->load->view('location/addlocation', $data);
	}


  public function editnegara(){
      $this->getAccessUrl('ROLE00006016');
      $p_loc_no = $_POST['location_no'];
      $data['edit'] = $this->Locationcms_model->ambil_edit_data($p_loc_no);
      if(!empty($_POST['method'])){
            $configValidation = $this->Validation("negara");
            $this->form_validation->set_rules($configValidation);
            if ($this->form_validation->run() == TRUE) {
              $checkExistLoc = $this->General_model->checkExist('cms_tm_location','_name',$this->input->post('countryc'));
              if($checkExistLoc > 1){
                  $set_notif = array('notiferror' => 'Nama Lokasi Telah Tersedia!');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
              }
               $datalokasiUpdate = array(
                  '_name'=>$this->input->post('countryc'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsc'),
                  '_desc'=>$this->input->post('descc'),
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
               );
               try {
                  $this->Locationcms_model->updatelocation($datalokasiUpdate,$p_loc_no);
                  $set_notif = array('notifsukses' => 'Lokasi Berhasil Disimpan');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }
           }
      }

      $this->load->view('location/editnegara',$data);
  }

  public function editpropinsi(){
      $this->getAccessUrl('ROLE00006016');
      $p_loc_no = $_POST['location_no'];
      $data['edit'] = $this->Locationcms_model->ambil_edit_data($p_loc_no);
      $data['negara'] = $this->Locationcms_model->Ambil_country_id();
      if(!empty($_POST['method'])){
            $configValidation = $this->Validation("provinsi");
            $this->form_validation->set_rules($configValidation);
            if ($this->form_validation->run() == TRUE) {
              //  $this->pr($_POST);
              $checkExistLoc = $this->General_model->checkExist('cms_tm_location','_name',$this->input->post('provinsip'));
              if($checkExistLoc > 1){
                  $set_notif = array('notiferror' => 'Nama Lokasi Telah Tersedia!');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
              }
               $datalokasiUpdate = array(
                  '_name'=>$this->input->post('provinsip'),
                  '_location_country_no'=>$this->input->post('negarap'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsp'),
                  '_desc'=>$this->input->post('descp'),
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
               );
               try {
                  $this->Locationcms_model->updatelocation($datalokasiUpdate,$p_loc_no);
                  $set_notif = array('notifsukses' => 'Lokasi Berhasil Disimpan');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }
           }
      }

      $this->load->view('location/editprovinsi',$data);
  }

  public function editkota(){
      $this->getAccessUrl('ROLE00006016');
      $p_loc_no = $_POST['location_no'];
      $data['edit'] = $this->Locationcms_model->ambil_edit_data($p_loc_no);
      // $this->pr($data);
      $negara = $data['edit'][0]->_location_country_no;
      // echo $negara;die;
      $data['negara'] = $this->Locationcms_model->Ambil_country_id();
      $data['provinsi'] = $this->Locationcms_model->Ambil_data_propinsi_by_negara($negara);
      // $this->pr($data['provinsi']);
      if(!empty($_POST['method'])){
            $configValidation = $this->Validation("kota");
            $this->form_validation->set_rules($configValidation);
            if ($this->form_validation->run() == TRUE) {
              //  $this->pr($_POST);
              $checkExistLoc = $this->General_model->checkExist('cms_tm_location','_name',$this->input->post('kotak'));
              if($checkExistLoc > 1){
                  $set_notif = array('notiferror' => 'Nama Lokasi Telah Tersedia!');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
              }
               $datalokasiUpdate = array(
                  '_location_country_no'=>$this->input->post('negarak'),
                  '_parent_location_no'=>$this->input->post('provinsik'),
                  '_name'=>$this->input->post('kotak'),
                  'name_on_gmaps'=>$this->input->post('nameongmapsk'),
                  '_desc'=>$this->input->post('desck'),
                  'last_update'=>date('Y-m-d H:i:s'),
                  'last_update_by'=>$this->userInfo()->user_no
               );
               try {
                  $this->Locationcms_model->updatelocation($datalokasiUpdate,$p_loc_no);
                  $set_notif = array('notifsukses' => 'Lokasi Berhasil Disimpan');
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }catch (Exception $ex) {
                  $set_notif = array('notiferror' => $ex);
                  $this->session->set_userdata($set_notif);
                  redirect("Locationcms");
                }
           }
      }

      $this->load->view('location/editkota',$data);
  }

  public function Operation($p_loc_no) {

  		$jenis_lokasi = $this->Locationcms_model->ambil_jenis_lokasi($p_loc_no);
      if (isset($_POST['delete'])) {
              $hapus_location = $this->Locationcms_model->hapus_loc($p_loc_no);
              if ($hapus_location) {
                  $set_notif = array('notifsukses' => $hapus_location);
                  $this->session->set_userdata($set_notif);
                  redirect("locationcms");
              } else {
                  $set_notif = array('notiferror' => $hapus_location);
                  $this->session->set_userdata($set_notif);
                  redirect("locationcms");
              }
      }elseif (isset($_POST['edit'])) {
      		if($jenis_lokasi->type_location_id == "TYPELOC01"){
             $this->editnegara();
          }
          if($jenis_lokasi->type_location_id == "TYPELOC02"){
      			  $this->editpropinsi();
          }
          if($jenis_lokasi->type_location_id == "TYPELOC03"){
      			  $this->editkota();
          }
      }elseif (isset($_POST['set_nonactive'])) {
              $set_aktif = $this->Locationcms_model->set_active($p_loc_no);
              if ($set_aktif) {
                $set_notif = array('notifsukses' => $set_aktif);
                $this->session->set_userdata($set_notif);
                redirect("locationcms");
            } else {
                $set_notif = array('notiferror' => $set_aktif);
                $this->session->set_userdata($set_notif);
                redirect("locationcms");
            }
        }elseif (isset($_POST['set_active'])) {
          //  die('e');
            $set_noaktif = $this->Locationcms_model->set_noactive($p_loc_no);
            if ($set_noaktif) {
              $set_notif = array('notifsukses' => $set_noaktif);
              $this->session->set_userdata($set_notif);
              redirect("locationcms");
            } else {
                $set_notif = array('notiferror' => $set_noaktif);
                $this->session->set_userdata($set_noaktif);
                redirect("locationcms");
            }
        }else{redirect("locationcms");}
    }


    public function ajaxProvinsi() {
        $idnegara = $this->input->post('id');
        if (!empty($idnegara)) {
            $data = $this->Locationcms_model->Ambil_data_propinsi_by_negara($idnegara);
            $list = '<option value="">Pilih Provinsi</option>';
            foreach ($data as $v) {
                $id = $v['location_no'];
                $name = $v['_name'];
                $list .= '<option value="' . $id . '">' . $name . '</option>';
            }
        } else {
            $list = '<option value="">Pilih Provinsi</option>';
        }
        echo $list;
    }


    public function validation($method) {

        if($method ==='negara'){
            $configValidation = array(
                array(
                    'field' => 'countryc',
                    'label' => 'Negara',
                    'rules' => 'required'
                ), array(
                    'field' => 'nameongmapsc',
                    'label' => 'Name On Gmaps',
                    'rules' => 'required'
                ), array(
                    'field' => 'descc',
                    'label' => 'Deskripsi',
                    'rules' => 'required'
                )
            );
        }elseif($method === 'provinsi'){
          // die('eleo');
            $configValidation = array(
                array(
                    'field'=>'provinsip',
                    'label'=>'Provinsi',
                    'rules'=>'required'
                ),
                array(
                    'field' => 'negarap',
                    'label' => 'Negara',
                    'rules' => 'required'
                ), array(
                    'field' => 'nameongmapsp',
                    'label' => 'Name On Gmaps',
                    'rules' => 'required'
                ), array(
                    'field' => 'descp',
                    'label' => 'Deskripsi',
                    'rules' => 'required'
                )
            );
        }elseif($method === 'kota'){
          $configValidation = array(
              array(
                  'field'=>'provinsik',
                  'label'=>'Provinsi',
                  'rules'=>'required'
              ),
              array(
                'field'=>'kotak',
                'label'=>'Kota',
                'rules'=>'required'
              ),
              array(
                  'field' => 'negarak',
                  'label' => 'Negara',
                  'rules' => 'required'
              ), array(
                  'field' => 'nameongmapsk',
                  'label' => 'Name On Gmaps',
                  'rules' => 'required'
              ), array(
                  'field' => 'desck',
                  'label' => 'Deskripsi',
                  'rules' => 'required'
              )
          );
        }

        return $configValidation;
    }










}
