<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/controllers/General.php';

class Psikotes extends General {
    public function __construct()
    {
          parent::__construct();
          $this->load->helper('url');
          $this->load->model("Lowongancms_model");
          $this->load->model("Soalcms_model");
          $this->load->model('Sequencecms_model');
          $this->load->model('Psikotescms_model');
          $this->load->model('Pelamarcms_model');

          $this->checkLogin();
    }

    public function Index()
  	{
          #Jika Belum mengisi data diri lengkap diarahkan untuk mengisi secara Lengkap
          $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          if(empty($data['personalInfo'])){
            $this->session->set_flashdata('error', 'Harap lengkapi data personal anda. Terima kasih.');
            redirect('Register/step2');
          }
          $lowonganNO = $_POST['lowongan_no'];
          $checkApply = $this->Lowongancms_model->searchApplyLowongan($lowonganNO,$this->userInfo()->pelamar_no);
          if($checkApply){
              $this->session->set_flashdata('error','Tidak Bisa Apply Lebih Dari Sekali');
              redirect('Index');
          }else{
              #insert Lowongan
              $IDApplyLowongan = $this->Sequencecms_model->next('fe_tx_apply_lowongan');
                $dataApply = array(
                    'apply_lowongan_no' => $IDApplyLowongan['nextval'],
                    'branch_id'=> branchID,
                    'lowongan_no'=>$lowonganNO,
                    'pelamar_no'=>$this->userInfo()->pelamar_no,
                    'status_apply_lowongan_id'=>'STATUS01',
                    '_cancel'=>'0',
                    '_active'=>'1',
                    '_delete'=>'0',
                    'create_date'=>date('Y-m-d H:i:s')
                );

              $this->session->set_userdata('lowonganApply', $IDApplyLowongan['nextval']);
              $this->Lowongancms_model->insertApplyLowongan($dataApply);
              $this->load->view('psikotes/index');
          }


  	}

    public function start(){
          #Jika Belum mengisi data diri lengkap diarahkan untuk mengisi secara Lengkap
          $data['personalInfo']= $this->Pelamarcms_model->searchPelamarInfo($this->userInfo()->pelamar_no);
          if(empty($data['personalInfo'])){
            $this->session->set_flashdata('error', 'Harap lengkapi data personal anda. Terima kasih.');
            redirect('Register/step2');
          }
          $data['TanjungJawab'] = $this->Soalcms_model->TypeTanggungJawab();
          $data['IntegritasKejujuran']  = $this->Soalcms_model->TypeIntegritasKejujuran();
          $data['InisiatifKreatifitas'] = $this->Soalcms_model->TypeInisitipKreatif();
          $data['Teamwork'] = $this->Soalcms_model->TypeTeamWork();
          $data['TypeSoal'] = $this->Soalcms_model->typeSoal();
          // $this->pr($data);

          $this->load->view('psikotes/start',$data);

    }

    public function simpanjawaban(){
        if(!empty($_POST)){
           $totalSoal = 0;
           $IDPsikotes = $this->Sequencecms_model->next('fe_tx_psikotes');
           $lowonganApply = $this->session->userdata('lowonganApply');
           $totalScore = 0;
           foreach ($_POST as $key => $value) {
             $keyCount = substr($key,0,4);
               if($keyCount === 'SOAL'){
                     $opsi = '_opsi_'.$value;
                     $curentopsi = '_opsi_'.$value;
                     $score = '_score_'.$value;
                     $IDPsikotesDetail = $this->Sequencecms_model->next('fe_tx_psikotes_detail');
                     $soal = $this->Soalcms_model->searchSoal($key,$opsi,$curentopsi,$score);
                     $totalScore  += $soal->$score;
                     $dataInsert[] = array(
                         'psikotes_detail_no' =>$IDPsikotesDetail['nextval'],
                         'psikotes_no'=>$IDPsikotes['nextval'],#'PSI00000001213102016',#$IDPsikotes['nextval'],
                         'soal_id' =>$key,
                         '_opsi'=>$value,
                         '_current_opsi'=>$soal->$opsi,
                         '_current_score'=>$soal->$score,
                         'create_date'=>date('Y-m-d H:i:s')
                     );
                     $totalSoal++;
               }

           }
           $dataPsikotes = array(
                 'psikotes_no'=>$IDPsikotes['nextval'],
                 'branch_id'=>branchID,
                 'apply_lowongan_no'=>$lowonganApply,
                 '_score'=>$totalScore,
                 '_jumlah_soal'=>$totalSoal,
                 'status_psikotes_id'=>'STATUSPSI00',
                 '_active'=>'1',
                 '_delete'=>'0',
                 'create_date'=>date('Y-m-d H:i:s')
           );
          $this->Psikotescms_model->insertPsikotes($dataPsikotes);
          foreach ($dataInsert as $key => $value) {
             $this->Psikotescms_model->insertPsikotesDetail($value);
          }
          $this->session->unset_userdata('lowonganApply');
          echo "<script language='javascript'>alert('Psikotes Telah Selesai')</script>";

          $data = array();
          $page = isset($_GET['page']) ? $_GET['page'] : 0;
          $data['lowongan'] = $this->Lowongancms_model->listLowongan($page);
          $data['lowonganPromoted'] = $this->Lowongancms_model->listLowonganPromoted();
          $data['total'] = $this->Lowongancms_model->selectCount();
          $max = count($data['lowongan']);
          // $max= $this->Lowongancms_model->record_count();
          if($page < $max){
              $data['now']  = $page;
              $next = $page + 2;
              if($page != 0){
                $data['prev'] = $page - 2;
              }
              if($next < $max){
                $data['next'] = $page + 2;
              }
          }
          $this->load->view('index',$data);
        }
    }

    public function updateApplyLowongan(){
        if(!empty($_POST)){
            $data = array(
               '_cancel'=>'1',
               'last_update'=>date('Y-m-d H:i:s')
            );
            $this->Lowongancms_model->updateApplyLowongan($data,$_POST['apply_lowongan_no']);
            redirect('Lamaran');
        }

    }


}
