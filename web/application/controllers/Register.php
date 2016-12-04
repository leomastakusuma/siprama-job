<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Register extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');
          $this->load->library('form_validation');
          $this->load->model('Sequencecms_model');
          $this->load->model('Pelamarcms_model');
          $this->load->model('General_model');

    }

    public function Index()
  	{
          $this->session->unset_userdata('pelamar_no');
   		    $this->load->view('register/step_1');

  	}

    public function Step1(){

        if(!empty($_POST)){
          $this->form_validation->set_rules('email', 'email', 'required|valid_email');
          $this->form_validation->set_rules('password', 'password', 'required');

          if ($this->form_validation->run() == true) {
             if(!empty($_FILES['resume'])){
               #FIRST CheckEksis email
              //  $this->pr($_FILES['resume']);
               $maxFle = 1000000; #one MB;
               if($_FILES['resume']['size'] > $maxFle){
                 $this->session->set_flashdata('error', 'Resume (CV) Tidak Boleh Lebih Dari 1 MB.');
                 redirect('Register');
               }
               $email = $this->input->post('email');
               $checkExistEmail = $this->Pelamarcms_model->searchPelamarExist($email);
               if($checkExistEmail > 0){
                 $this->session->set_flashdata('error', 'Email Telah Terdaftar, Silahkan masukan email yang lain.');
                 redirect('Register');
               }else{
                       $resume = $_FILES['resume'];
                       $uploadResume = $this->UploadCV($resume['name'],$resume['tmp_name']);

                       $IDPelamar   = $this->Sequencecms_model->next('fe_tm_pelamar');
                       if(!empty($uploadResume["success"])){
                          $dataPelamar = array(
                            'pelamar_no' =>$IDPelamar['nextval'],
                            'branch_id' =>branchID,
                            '_email'=> $this->input->post('email'),
                            '_password'=>encText($this->input->post('password')),
                            '_resume_enc_name'=>$uploadResume['_resume_real_name'],
                            '_resume_url'=>$uploadResume['_resume_url'],
                            '_resume_real_name'=>$uploadResume['_resume_real_name'],
                            '_resume_date'=>date('Y-m-d H:i:s'),
                            '_active'=>'1',
                            '_delete'=>'0',
                            'create_date'=>date('Y-m-d H:i:s'),
                          );
                          $this->Pelamarcms_model->insertPelamar($dataPelamar);
                          $this->session->set_userdata('pelamar_no', $IDPelamar['nextval']);
                          redirect('Register/step2');
                       }else{
                         $this->session->set_flashdata('error', 'Format Resume Salah, Hanya Format (doc/docx/pdf) yang di izinkan');
                         redirect('Register');
                       }
                   }
             }

          }else{
            $this->load->view('register/step_1');
          }

        }

    }

    public function step2(){
      $data['religion'] = $this->General_model->getReligion();
      $data['pendidikan'] = $this->General_model->getPendidikan();
      $data['warnakulit'] = $this->General_model->getWarnaKulit();
      $data['statuspernikahan'] = $this->General_model->getStatusPernikahan();
      $data['bank'] = $this->General_model->getBank();
      $data['kendaraan']=$this->General_model->getKendaraan();
      $data['asuransi'] = $this->General_model->getAsuransi();
      $data['kota']=$this->General_model->getKota();

      $IDPelamar = !empty($_SESSION['pelamar_no']) ? $_SESSION['pelamar_no'] : (!empty($this->userInfo()->pelamar_no) ? $this->userInfo()->pelamar_no : '' );
      // if(empty($IDPelamar)){
      //   $this->session->set_flashdata('error', 'Silahkan Register Tahap Awal Terlebih dahulu.');
      //   redirect('Register');
      // }
      if(!empty($_POST)){
              $configValidation = $this->Validation();
              $this->load->helper(array('form', 'url'));
              $this->load->library('form_validation');
              $this->form_validation->set_rules($configValidation);
              if($this->form_validation->run()===TRUE){
                      /*Cek KTP EKSIS */
                      $check = $this->Pelamarcms_model->searchPelamarExistKTP($this->input->post('n_ktp'));
                      if($check){
                        $this->session->set_flashdata('error','Nomer KTP Telah Terdaftar Silahkan Periksa Nomer KTP Anda atau hubungi call center .');
                        redirect ('Register/step2');
                      }

                      $IDPelamarInfo = $this->Sequencecms_model->next('fe_tm_pelamar_personal_info');
                      $dataPelamarInfo = array(
                          'pelamar_personal_info_no'=>$IDPelamarInfo['nextval'],
                          'pelamar_no'=>$IDPelamar,
                          '_no_ktp'=>$this->input->post('n_ktp'),
                          '_fullname'=>$this->input->post('n_lengkap'),
                          'place_birth'=>$this->input->post('tempat_lahir'),
                          '_birthdate'=>$this->input->post('tgl_lahir'),
                          '_gender'=>$this->input->post('j_kelamin'),
                          '_closer_person_fullname'=>$this->input->post('n_orang_t'),
                          '_closer_person_phone'=>$this->input->post('t_orang_t'),
                          'religion_id'=>$this->input->post('agama'),
                          '_address_ktp'=>$this->input->post('alamatktp'),
                          '_address_ktp_kelurahan'=>$this->input->post('kelurahan'),
                          '_address_ktp_kecamatan'=>$this->input->post('kecamatan'),
                          'address_ktp_kota'=>$this->input->post('ktp'),
                          '_address_sekarang'=>$this->input->post('alamat_sekarang'),
                          'address_sekarang_kota'=>$this->input->post('kota_sekarang'),
                          '_height'=>$this->input->post('beratbadan'),
                          '_weight'=>$this->input->post('tinggibandan'),
                          'skin_color_id'=>$this->input->post('warnakulit'),
                          '_phone_home'=>$this->input->post('t_rumah'),
                          '_phone_primary'=>$this->input->post('t_hpke_1'),
                          '_phone_secondary'=>$this->input->post('t_hpke_2'),
                          'relationship_id'=>$this->input->post('s_pernikahan'),
                          '_total_children'=>$this->input->post('jumlahanak'),
                          '_no_sim_a'=>$this->input->post('n_sim_a'),
                          '_no_sim_b1'=>$this->input->post('n_sim_b1'),
                          '_no_sim_b2'=>$this->input->post('n_sim_b2'),
                          '_no_sim_c'=>$this->input->post('n_simc'),
                          'owned_kendaraan_id'=>$this->input->post('k_yang_dimiliki'),
                          '_no_npwp'=>$this->input->post('npwp'),
                          '_no_bpjs_tk'=>$this->input->post('bpjs_k'),
                          '_no_bpjs_kesehatan'=>$this->input->post('bpjs_kes'),
                          'insurance_id'=>$this->input->post('p_asuransi'),
                          '_no_insurance'=>$this->input->post('p_asuransi_rek'),
                          'pendidikan_id'=>$this->input->post('pendidikan'),
                          '_pendidikan_place'=>$this->input->post('t_pendidikan'),
                          '_pendidikan_year'=>$this->input->post('t_lulus'),
                          'bank_id'=>$this->input->post('p_bank'),
                          '_bank_account_no'=>$this->input->post('p_bank_rek'),
                          '_experience'=>$this->input->post('pengalaman'),
                          'create_date'=>date ('Y-m-d H:i:s'),
                      );
                      #upload Foto
                      if(!empty($_FILES['profile'])){
                        $profile = $_FILES['profile'];
                        $maxFle = 1000000; #one MB;
                        if($profile['size'] > $maxFle){
                          $this->session->set_flashdata('error', 'Photo Profile Tidak Boleh Lebih Dari 1 MB');
                          redirect('Register/step2');
                        }
                        $uploadProfile = $this->uploadImage($profile['name'],$profile['tmp_name']);
                        if($uploadProfile['success']){
                          $dataPelamarInfo['_photo_url']= $uploadProfile['_photo_url'] ;
                          $dataPelamarInfo['_photo_real_name']= $uploadProfile['_photo_real_name'];
                          $dataPelamarInfo['_photo_enc_name']= $uploadProfile['_photo_enc_name'];
                        }
                      }
                      $this->db->trans_start();
                      #insert pelamar Info
                      $this->Pelamarcms_model->insertPelamarInfo($dataPelamarInfo);

                      #insertPelamarInfoFamily
                      if(!empty($this->input->post('s_pernikahan')) && $this->input->post('s_pernikahan') !='RELATIONSHIP02' ){
                          $jkelamin = $this->input->post('j_kelamin');
                          if($j_kelamin == 0){
                             $familyType = 'FAMILY02';
                          }else{
                            $familyType = 'FAMILY01';
                          }
                          $IDPelamarInfoFamily = $this->Sequencecms_model->next('fe_tm_pelamar_family_info');
                          $dataSOI = array(
                              'pelamar_family_info_no'=>$IDPelamarInfoFamily['nextval'],
                              'pelamar_no'=>$IDPelamar,
                              'family_type_id'=>$familyType,
                              '_name' =>$_POST['n_soi'] ,
                              '_phone'=> !empty($_POST['telp']) ? $_POST['telp'] : null,
                              '_delete'=>'0',
                              'create_date'=>date('Y-m-d H:i:s'),
                          );
                          #Insert Family
                          $this->Pelamarcms_model->insertPelamarFamily($dataSOI);
                          #Insert Family History
                          // $IDPelamarInfoFamilyHis = $this->Sequencecms_model->next('fe_tm_pelamar_family_info_history');
                          // $dataSOI['pelamar_family_info_history_no'] =$IDPelamarInfoFamilyHis['nextval'];
                          // unset($dataSOI['_phone']);
                          // $dataSOI['type_history_id']='TYPEHSTCRTBY02';
                          // $dataSOI['_create_by']= $IDPelamar;
                          // $this->Pelamarcms_model->insertPelamarFamilyHistory($dataSOI);
                      }
                      if(!empty($this->input->post('jumlahanak'))){
                          $jumlahAnak = $this->input->post('jumlahanak');
                          for($i=0 ;$i<$jumlahAnak ; $i++){
                              $IDPelamarInfoFamily = $this->Sequencecms_model->next('fe_tm_pelamar_family_info');
                              $dataAnak = array(
                                  'pelamar_family_info_no'=>$IDPelamarInfoFamily['nextval'],
                                  'pelamar_no'=>$IDPelamar,
                                  'family_type_id'=>'FAMILY03',
                                  '_name' =>$_POST['namaanak'.$i] ,
                                  '_phone'=> !empty($_POST['telpanak'.$i]) ? $_POST['telpanak'.$i] : null,
                                  '_delete'=>'0',
                                  'create_date'=>date('Y-m-d H:i:s'),
                              );
                              #Insert Family
                              $this->Pelamarcms_model->insertPelamarFamily($dataAnak);
                              // #Insert Family History
                              // unset($dataAnak['_phone']);
                              // $IDPelamarInfoFamilyHis = $this->Sequencecms_model->next('fe_tm_pelamar_family_info_history');
                              // $dataAnak['pelamar_family_info_history_no'] =$IDPelamarInfoFamilyHis['nextval'];
                              // $dataAnak['type_history_id'] = 'TYPEHSTCRTBY02';
                              // $dataAnak['_create_by']=$IDPelamar;
                              // $this->Pelamarcms_model->insertPelamarFamilyHistory($dataAnak);
                          }
                      }


                      $this->db->trans_complete();
                      if ($this->db->trans_status() === FALSE)
                      {
                          $this->session->set_flashdata('error','Data Tidak Berhasil Disimpan');
                          redirect ('Register/step2');
                          $this->db->trans_rollback();
                      }else{
                          $this->db->trans_commit();
                          #insert History Pesonal Info
                          $IDPelamarInfoHistory = $this->Sequencecms_model->next('fe_tm_pelamar_personal_info_history');
                          $dataPelamarInfo['pelamar_personal_info_history_no'] =$IDPelamarInfoHistory['nextval'];
                          $dataPelamarInfo['type_history_id']  = 'TYPEHST01';
                          $dataPelamarInfo['pelamar_personal_info_no'] =$IDPelamarInfo['nextval'];
                          $dataPelamarInfo['create_by_source']="TYPEHSTCRTBY02";
                          $dataPelamarInfo['create_by_pelamar_no']=$IDPelamar;
                          $this->Pelamarcms_model->insertPelamarInfoHistory($dataPelamarInfo);


                          $this->session->unset_userdata('pelamar_no');
                          redirect('');
                      }
              }else{
                // $this->load->view('register/step_2',$data);
                // $this->pr($_POST);
              }

      }
      $this->load->view('register/step_2',$data);

    }

    public function Validation() {
        $configValidation = array(
                array(
                    'field' => 'n_ktp',
                    'label' => 'Nomer KTP',
                    'rules' => 'required'
                ), array(
                    'field' => 'n_lengkap',
                    'label' => 'Nama Lengkap',
                    'rules' => 'required'
                ), array(
                    'field' => 'j_kelamin',
                    'label' => 'Jenis Kelamin',
                    'rules' => 'required'
                ), array(
                    'field' => 'agama',
                    'label' => 'Agama',
                    'rules' => 'required'
                ), array(
                    'field' => 'alamatktp',
                    'label' => 'Alamat (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'kelurahan',
                    'label' => 'Kelurahan (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'kecamatan',
                    'label' => 'Kecamatan (KTP)',
                    'rules' => 'required'
                ),array(
                    'field' => 'ktp',
                    'label' => 'Kota (KTP)',
                    'rules' => 'required'
                ), array(
                    'field' => 'alamat_sekarang',
                    'label' => 'Alamat Sekarang',
                    'rules' => 'required'
                ), array(
                    'field' => 'kota_sekarang',
                    'label' => 'Kota Sekarang',
                    'rules' => 'required'
                ), array(
                    'field' => 'warnakulit',
                    'label' => 'Warna Kulit',
                    'rules' => 'required'
                ), array(
                    'field' => 's_pernikahan',
                    'label' => 'Status Pernikahan',
                    'rules' => 'required'
                ), array(
                    'field' => 't_hpke_1',
                    'label' => 'Nomer Telpon HP Ke 1',
                    'rules' => 'required'
                ), array(
                    'field' => 'n_orang_t',
                    'label' => 'Nama Orang Terdedat',
                    'rules' => 'required'
                ), array(
                    'field' => 't_orang_t',
                    'label' => 'Nomer Telpon Orang Terdekat',
                    'rules' => 'required'
                ), array(
                    'field' => 'k_yang_dimiliki',
                    'label' => 'Kendaraan Yang Dimiliki',
                    'rules' => 'required'
                ), array(
                    'field' => 'p_asuransi',
                    'label' => 'Provider Asuransi',
                    'rules' => 'required'
                ), array(
                    'field' => 'pendidikan',
                    'label' => 'Pendidikan',
                    'rules' => 'required'
                ), array(
                    'field' => 't_lulus',
                    'label' => 'Tahun Lulus',
                    'rules' => 'required'
                ), array(
                    'field' => 'p_bank',
                    'label' => 'Provider Bank',
                    'rules' => 'required'
                ), array(
                    'field' => 'pengalaman',
                    'label' => 'Pegalaman',
                    'rules' => 'required'
                )
            );

        return $configValidation;
    }


}
