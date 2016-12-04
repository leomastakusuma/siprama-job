<?php

class Kontrakcms_model extends CI_Model {

    protected $_tableKontrakAtch = 'cms_tm_kontrak_attachment';
    protected $_tableKontrak = 'cms_tm_kontrak';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

   public function seletType(){
       $sql = "SELECT * FROM sys_type where category_id = '24'";
       $query = $this->db->query($sql);
       return $result = $query->result();

   }
   public function insertKontrak($data){
      return $this->db->insert($this->_tableKontrak,$data);
   }
   public function insertKontrakAtch($data){
      return $this->db->insert($this->_tableKontrakAtch,$data);
   }

   public function updateKontrakAtch($updateData, $kontrakTemp){
     $this->db->where('kontrak_temp_no', $kontrakTemp);
     $data = $this->db->update($this->_tableKontrakAtch, $updateData);
   }

   public function updateKontrak($updateData, $applyLowongan){
     $this->db->where('apply_lowongan_no', $applyLowongan);
     $data = $this->db->update($this->_tableKontrak, $updateData);
   }

   public function updateKontrakbyKontrak($updateData, $applyLowongan){
     $this->db->where('kontrak_no', $applyLowongan);
     $data = $this->db->update($this->_tableKontrak, $updateData);
   }

   public function getIDKontrakTemp(){
        $sql = "SELECT nextseq_daily('kontrak_temp') as nextval FROM DUAL";
        $query = $this->db->query($sql);
        return $result = $query->row();
   }

   public function getKontrakNO(){
       $sql = "SELECT nextseq_monthly('cms_tm_kontrak')  as nextval FROM DUAL";
       $query = $this->db->query($sql);
       return $result = $query->row();
   }

   public function checkExisKontrakAttch($kontrakTmp,$tipe,$kontrak_no=false){
      if($kontrak_no){
        $sql = "SELECT * FROM cms_tm_kontrak_attachment where kontrak_temp_no = '$kontrakTmp' OR kontrak_no = '$kontrak_no' AND 	type_attachment_id = '$tipe'";
      }else{
        $sql = "SELECT * FROM cms_tm_kontrak_attachment where kontrak_temp_no = '$kontrakTmp' AND 	type_attachment_id = '$tipe'";
      }
      $query = $this->db->query($sql);
      return $result = $query->row();
   }

   public function getIDKontrakAttch(){
      $sql = "SELECT nextseq_daily('kontrak_attachment') as nextval FROM DUAL";
      $query = $this->db->query($sql);
      return $result = $query->row();
   }

   public function setPosition($tempKontrak,$kontrak_no){
       $sql = "SELECT count(_position)+1 as posisi FROM `cms_tm_kontrak_attachment` WHERE cms_tm_kontrak_attachment._delete = '0' AND kontrak_temp_no = '$tempKontrak' OR kontrak_no ='$kontrak_no'";
       $query = $this->db->query($sql);
       return $result = $query->row();
   }

   public function selectKontrakTemp($kontrakTemp){
      $sql = "SELECT *
                      FROM cms_tm_kontrak_attachment, sys_type
                      WHERE cms_tm_kontrak_attachment.type_attachment_id=sys_type.type_id
                      AND cms_tm_kontrak_attachment.kontrak_temp_no= '$kontrakTemp' AND cms_tm_kontrak_attachment._delete='0'";
      $query = $this->db->query($sql);
      return $result = $query->result();
   }

   public function detailPelamarInfo($applylowongan){
     $sql = "SELECT cms_tm_client._name as ClientName, typepekerjaan._name as tipelowongan,fe_tx_apply_lowongan.create_date as tglLamaran,
                  			fe_tx_apply_lowongan.apply_lowongan_no as nomerLamaran, statuspelamar._name as statuspelamar,
                              fe_tx_apply_lowongan.last_update as tglstatus,
                              cms_tm_lowongan._name as posisi,
                              fe_tm_pelamar_personal_info._no_ktp,
                              fe_tm_pelamar_personal_info._no_ktp,
                              fe_tm_pelamar_personal_info._address_sekarang,
                              fe_tm_pelamar_personal_info._phone_primary,
                              fe_tm_pelamar_personal_info._bank_account_no,
                              fe_tm_pelamar_personal_info._fullname as namalengkap,
                              fe_tm_pelamar_personal_info._birthdate as tgllahir,
                              fe_tm_pelamar_personal_info._gender,
                              cms_tm_location._name as tempatlahir ,
                              agamapelamar._name as agama,
                              fe_tm_pelamar_personal_info._weight as berat,
                              fe_tm_pelamar_personal_info._height as tinggi,
                              cms_tm_lowongan.type_lowongan_id as tipelowonganid,
                              warnakulitpelamar._name as warnaklt,
                              sys_tm_branch._name as branch,
                              sys_tm_branch._address as alamatbranch
                	FROM 		fe_tx_apply_lowongan ,
                    			cms_tm_lowongan ,
                          cms_tm_client ,
                    			cms_tm_pekerjaan,
                          cms_tm_pekerjaan_branch,
                          sys_type as typepekerjaan,
                          sys_type as statuspelamar,
                          sys_type as agamapelamar,
                          sys_type as warnakulitpelamar,
                          cms_tm_location,
                          fe_tm_pelamar,
                          fe_tm_pelamar_personal_info,
                          sys_tm_branch
		              WHERE   fe_tx_apply_lowongan.lowongan_no = cms_tm_lowongan.lowongan_no
        				          AND cms_tm_client.client_id = cms_tm_lowongan.client_id
                          AND cms_tm_pekerjaan_branch.pekerjaan_id = cms_tm_pekerjaan.pekerjaan_id
                          AND cms_tm_pekerjaan_branch.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no
                          AND typepekerjaan.type_id = cms_tm_lowongan.type_lowongan_id
                          AND statuspelamar.type_id = fe_tx_apply_lowongan.status_apply_lowongan_id
                          AND fe_tm_pelamar.pelamar_no = fe_tx_apply_lowongan.pelamar_no
                          AND fe_tm_pelamar_personal_info.pelamar_no = fe_tm_pelamar.pelamar_no
                          AND cms_tm_location.location_no = fe_tm_pelamar_personal_info.place_birth
                          AND agamapelamar.type_id = fe_tm_pelamar_personal_info.religion_id
                          AND warnakulitpelamar.type_id = fe_tm_pelamar_personal_info.skin_color_id
                          AND sys_tm_branch.branch_id = cms_tm_client.branch_id
                          AND fe_tx_apply_lowongan.apply_lowongan_no = '$applylowongan'";
                          $query = $this->db->query($sql);
                          return $result = $query->row();
   }


   public function listkontrak(){
      $sql = "SELECT apply_lowongan_no from cms_tm_kontrak where _delete = '0'";
      $query = $this->db->query($sql);
      return $result = $query->result();
   }

   public function listInterviewClient($wherein = false){
       if($wherein){
         $sql = "SELECT
                    ap.apply_lowongan_no,
                    ap.branch_id,
                    ap.lowongan_no,
                    l.type_lowongan_id,
                    tl._name as type_lowongan_name,
                    l._name as lowongan_name,
                    p._name as lowongan_posisi,
                    stlw._name as status_interview_client_name,
                    c._name as clientname,
                    ap.pelamar_no,
                    ap.last_update,
                    pe._fullname as namalengkap,
                    ps.psikotes_no,
                    intv.interview_no,
                    intvc.status_interview_client_id,
                    intvc.interview_client_no
                 FROM  cms_tx_interview_client intvc, cms_tx_interview as intv, fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                 WHERE
                   ap.lowongan_no = l.lowongan_no
                   AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                   AND pb.pekerjaan_id = p.pekerjaan_id
                   AND l.client_id = c.client_id
                   AND l.type_lowongan_id = tl.type_id
                   AND pe.pelamar_no = ap.pelamar_no
                   AND ps.apply_lowongan_no = ap.apply_lowongan_no
                   AND intv.psikotes_no = ps.psikotes_no
                   AND intvc.interview_no = intv.interview_no
                   AND intvc.status_interview_client_id = stlw.type_id
                   AND ap._cancel ='0'
                   AND ps.follow_up_by != ''
                   AND intvc.status_interview_client_id='STATUSINTCL01'
                   AND ap.apply_lowongan_no NOT IN ($wherein)";
       }else{
           $sql = "SELECT
                      ap.apply_lowongan_no,
                      ap.branch_id,
                      ap.lowongan_no,
                      l.type_lowongan_id,
                      tl._name as type_lowongan_name,
                      l._name as lowongan_name,
                      p._name as lowongan_posisi,
                      stlw._name as status_interview_client_name,
                      c._name as clientname,
                      ap.pelamar_no,
                      ap.last_update,
                      pe._fullname as namalengkap,
                      ps.psikotes_no,
                      intv.interview_no,
                      intvc.status_interview_client_id,
                      intvc.interview_client_no
                   FROM  cms_tx_interview_client intvc, cms_tx_interview as intv, fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                   WHERE
                     ap.lowongan_no = l.lowongan_no
                     AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                     AND pb.pekerjaan_id = p.pekerjaan_id
                     AND l.client_id = c.client_id
                     AND l.type_lowongan_id = tl.type_id
                     AND pe.pelamar_no = ap.pelamar_no
                     AND ps.apply_lowongan_no = ap.apply_lowongan_no
                     AND intv.psikotes_no = ps.psikotes_no
                     AND intvc.interview_no = intv.interview_no
                     AND intvc.status_interview_client_id = stlw.type_id
                     AND ap._cancel ='0'
                     AND intvc.status_interview_client_id='STATUSINTCL01'
                     AND ps.follow_up_by != ''";

       }
       $query = $this->db->query($sql);
       return $result = $query->result();

   }

   public function Interviewclient($id){
        $sql = "SELECT
                 ap.apply_lowongan_no,
                 ap.branch_id,
                 ap.lowongan_no,
                 l.type_lowongan_id,
                 tl._name as type_lowongan_name,
                 l._name as lowongan_name,
                 p._name as lowongan_posisi,
                 c._name, c._logo_enc_name,
                 ap.create_date as tanggal_lamar,
                 ap._cancel,
                 ap._cancel_reason,
                 ap.last_update,
                 pe._fullname,
                 pe.pelamar_no,
                 ps.psikotes_no,
                 sp._name as status_psikotes,
                 ps._analisa,
                 ps._score,
                 ps.create_date as tglPsikotes,
                 intv.interview_no,
                 stlw._name as status_interview_name,
                 intv._analisa_interview,
                 intv.status_interview_id,
                 intvc.status_interview_client_id,
                 intvc.interview_client_no,
                 intvc.last_update as tglInterviewClient,
                 intvc._analisa_interview as analisainterviewclient,
                 stp._name as selecStatusInterviewName
              FROM sys_type as stp,cms_tx_interview_client intvc,cms_tx_interview as intv,fe_tx_psikotes ps,fe_tx_apply_lowongan ap,fe_tm_pelamar_personal_info pe, cms_tm_lowongan l, sys_type sp, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
              WHERE
                ap.lowongan_no = l.lowongan_no
                AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                AND pb.pekerjaan_id = p.pekerjaan_id
                AND l.client_id = c.client_id
                AND l.type_lowongan_id = tl.type_id
                AND ps.status_psikotes_id = sp.type_id
                AND pe.pelamar_no = ap.pelamar_no
                AND intv.psikotes_no = ps.psikotes_no
                AND ap.apply_lowongan_no = ps.apply_lowongan_no
                AND intv.psikotes_no = ps.psikotes_no
                AND intv.status_interview_id = stlw.type_id
                AND intvc.interview_no = intv.interview_no
                AND intvc.status_interview_client_id = stp.type_id
                AND intvc.status_interview_client_id = 'STATUSINTCL01'
                AND ap.apply_lowongan_no = '{$id}'";
                $query = $this->db->query($sql);
                // echo $this->db->last_query();die;
                return $result = $query->row();

    }


    public function getKontrak(){
          $sql = "SELECT
                     ap.apply_lowongan_no,
                     ap.branch_id,
                     ap.lowongan_no,
                     l.type_lowongan_id,
                     tl._name as type_lowongan_name,
                     l._name as lowongan_name,
                     p._name as lowongan_posisi,
                     stlw._name as status_interview_client_name,
                     c._name as clientname,
                     ap.pelamar_no,
                     ap.last_update,
                     pe._fullname as namalengkap,
                     ps.psikotes_no,
                     intv.interview_no,
                     intvc.status_interview_client_id,
                     intvc.interview_client_no,
                     cms_tm_kontrak.kontrak_no,
                     cms_tm_kontrak._print
                  FROM  cms_tm_kontrak,cms_tx_interview_client intvc, cms_tx_interview as intv, fe_tx_psikotes ps,fe_tm_pelamar_personal_info pe,fe_tx_apply_lowongan ap, cms_tm_lowongan l, sys_type tl, cms_tm_client c, cms_tm_pekerjaan_branch pb, cms_tm_pekerjaan p, sys_type stlw
                  WHERE
                    ap.lowongan_no = l.lowongan_no
                    AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                    AND pb.pekerjaan_id = p.pekerjaan_id
                    AND l.client_id = c.client_id
                    AND l.type_lowongan_id = tl.type_id
                    AND pe.pelamar_no = ap.pelamar_no
                    AND ps.apply_lowongan_no = ap.apply_lowongan_no
                    AND intv.psikotes_no = ps.psikotes_no
                    AND intvc.interview_no = intv.interview_no
                    AND intvc.status_interview_client_id = stlw.type_id
                    AND ap._cancel ='0'
                    AND cms_tm_kontrak.apply_lowongan_no = ap.apply_lowongan_no
                    AND cms_tm_kontrak._delete='0'
                    AND ps.follow_up_by != ''
                    AND intvc.status_interview_client_id = 'STATUSINTCL01'";

                    $query = $this->db->query($sql);
                    return $result = $query->result();
    }

    public function getdetailKontrak($lowongan){
        $sql = "SELECT * FROM cms_tm_kontrak where cms_tm_kontrak.apply_lowongan_no = '$lowongan'";
        $query = $this->db->query($sql);
        return $result = $query->row();
    }

    public function deleteKontrakAtch($idKontrakAtch){
      $this->db->where('kontrak_attachment_no',$idKontrakAtch);
      return $this->db->delete('cms_tm_kontrak_attachment');
      //  $sql ="DELETE * FROM cms_tm_kontrak_attachment where kontrak_attachment_no='$idKontrakAtch'";
    }
    public function getdetailKontrakAtch($kontrak_no){
        $sql = "SELECT cms_tm_kontrak._print, sys_type._name as rincian,sys_type._name , cms_tm_kontrak_attachment.*
                        FROM cms_tm_kontrak,cms_tm_kontrak_attachment,sys_type
                        where cms_tm_kontrak_attachment.type_attachment_id = sys_type.type_id
                        AND cms_tm_kontrak.kontrak_no = cms_tm_kontrak_attachment.kontrak_no
                        AND cms_tm_kontrak_attachment.kontrak_no = '$kontrak_no'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

}


?>
