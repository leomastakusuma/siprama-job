<?php
class Pelamarcms_model extends CI_Model
{
    protected $_table = 'cms_tm_pelamar';

    public function __construct(){
        parent::__construct();
        $this->load->database();
    }

    public function getPelamar(){
        $sql = "SELECT  fe_tm_pelamar.pelamar_no, personalInfo._fullname, sys_type._name as pendidikan,
                        cms_tm_pekerjaan._name as pekerjaan,
                        personalInfo._phone_home,apply.create_date as tanggalMelamar,
                        personalInfo._phone_primary ,personalInfo._address_sekarang
  		            FROM fe_tm_pelamar
                     JOIN fe_tm_pelamar_personal_info as personalInfo
                        ON personalInfo.pelamar_no = fe_tm_pelamar.pelamar_no
                     JOIN fe_tx_apply_lowongan as apply
                        on apply.pelamar_no = fe_tm_pelamar.pelamar_no
                     JOIN cms_tm_lowongan
                        ON cms_tm_lowongan.lowongan_no = apply.lowongan_no
                     JOIN cms_tm_pekerjaan_branch
                        ON cms_tm_pekerjaan_branch.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no
                     JOIN cms_tm_pekerjaan
                        ON cms_tm_pekerjaan.pekerjaan_id = cms_tm_pekerjaan_branch.pekerjaan_id
                     JOIN sys_type
                        ON sys_type.type_id = personalInfo.pendidikan_id";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }


    public function getPelamarTidakLolos($start,$end){
        $sql ="SELECT ps.psikotes_no, c._name as client_name, p._name as pekerjaan_name, l._name as lowongan_name,
                        ppi._fullname as pelamar_name
                      FROM cms_tx_interview_client ic, cms_tx_interview i, fe_tx_psikotes ps
                            , fe_tx_apply_lowongan apl
                            , cms_tm_lowongan l
                            , cms_tm_client c
                            , cms_tm_pekerjaan_branch pb
                            , cms_tm_pekerjaan p
                            , fe_tm_pelamar_personal_info ppi
                      WHERE
                        ic.interview_no = i.interview_no
                        AND i.psikotes_no = ps.psikotes_no
                        AND ps.apply_lowongan_no = apl.apply_lowongan_no
                        AND l.lowongan_no = apl.lowongan_no
                        AND l.client_id = c.client_id
                        AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                        AND pb.pekerjaan_id = p.pekerjaan_id
                        AND apl.pelamar_no = ppi.pelamar_no
                        AND ic.status_interview_client_id = 'STATUSINTCL02' OR ic.status_interview_client_id ='STATUSINT02'
                        AND DATE_FORMAT(ic.create_date, '%Y-%m-%d') >= STR_TO_DATE('$start', '%Y-%m-%d')
                        AND DATE_FORMAT(ic.create_date, '%Y-%m-%d') <= STR_TO_DATE('$end', '%Y-%m-%d')";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

    public function getPelamarLolos($start,$end){
        $sql = "SELECT ps.psikotes_no, c._name as client_name, p._name as pekerjaan_name, l._name as lowongan_name,
                        ppi._fullname as pelamar_name,k.create_date
                      FROM cms_tx_interview_client ic, cms_tx_interview i, fe_tx_psikotes ps
                            , fe_tx_apply_lowongan apl
                            , cms_tm_lowongan l
                            , cms_tm_client c
                            , cms_tm_pekerjaan_branch pb
                            , cms_tm_pekerjaan p
                            , fe_tm_pelamar_personal_info ppi
                            , cms_tm_kontrak k

                      WHERE
                        ic.interview_no = i.interview_no
                        AND i.psikotes_no = ps.psikotes_no
                        AND ps.apply_lowongan_no = apl.apply_lowongan_no
                        AND l.lowongan_no = apl.lowongan_no
                        AND l.client_id = c.client_id
                        AND l.pekerjaan_branch_no = pb.pekerjaan_branch_no
                        AND pb.pekerjaan_id = p.pekerjaan_id
                        AND apl.pelamar_no = ppi.pelamar_no
                        AND k.apply_lowongan_no = apl.apply_lowongan_no
                        AND k._delete = '0'
                        AND DATE_FORMAT(k.create_date, '%Y-%m-%d') >= STR_TO_DATE('$start', '%Y-%m-%d')
		                    AND DATE_FORMAT(k.create_date, '%Y-%m-%d') <= STR_TO_DATE('$end', '%Y-%m-%d')
                        AND ic.status_interview_client_id = 'STATUSINTCL01'";
        $query = $this->db->query($sql);
        return $result = $query->result();

    }

    public function rekapitulasiLolos($start,$end){
      $sql = "SELECT  cms_tm_client._name as klien, count(cms_tx_interview_client.interview_client_no) as totalLOLOS
                  FROM fe_tm_pelamar
                     JOIN fe_tm_pelamar_personal_info as personalInfo
                        ON personalInfo.pelamar_no = fe_tm_pelamar.pelamar_no
                     JOIN fe_tx_apply_lowongan as apply
                        on apply.pelamar_no = fe_tm_pelamar.pelamar_no
                     JOIN cms_tm_lowongan
                        ON cms_tm_lowongan.lowongan_no = apply.lowongan_no
                     JOIN cms_tm_pekerjaan_branch
                        ON cms_tm_pekerjaan_branch.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no
                     JOIN cms_tm_pekerjaan
                        ON cms_tm_pekerjaan.pekerjaan_id = cms_tm_pekerjaan_branch.pekerjaan_id
                     JOIN cms_tm_client
                      ON cms_tm_client.client_id = cms_tm_lowongan.client_id
                     JOIN cms_tx_interview
                      ON cms_tx_interview.pelamar_no = personalInfo.pelamar_no
                     JOIN cms_tx_interview_client
                      ON cms_tx_interview_client.interview_no = cms_tx_interview.interview_no
                     JOIN cms_tm_kontrak
                       ON cms_tm_kontrak.apply_lowongan_no = apply.apply_lowongan_no
                       AND cms_tm_kontrak._delete = '0'
                     WHERE cms_tx_interview_client.status_interview_client_id = 'STATUSINTCL01'
                     AND cms_tx_interview_client.create_date >= '$start' AND cms_tx_interview_client.create_date <= '$end'
                     GROUP BY cms_tm_client.client_id";
         $query = $this->db->query($sql);
         return $result = $query->result();

    }






    public function getPelamarPersonalDetail($id){
        $sql = "SELECT lokasikota._name as kotasekarang,lokasikotaktp._name as kotaktp, cms_tm_pekerjaan._name as namapekerjaan, fe_tx_apply_lowongan.create_date as tglMelamar, fe_tm_pelamar.*, pendidikan._name as pedidikannama, bank._name as namabank, kendaraan._name as kepemilikankendaraan, fe_tm_pelamar_personal_info.*,statusp._name as statuspernikahan, wkulit._name as warnakulit, lokasi._name as tempatlahir, typeReligi._name as agama FROM fe_tm_pelamar_personal_info
                JOIN cms_tm_location as lokasi
                ON lokasi.location_no = fe_tm_pelamar_personal_info.place_birth

                JOIN cms_tm_location as lokasikotaktp
                ON lokasikotaktp.location_no = fe_tm_pelamar_personal_info.address_ktp_kota
                JOIN cms_tm_location as lokasikota
                ON lokasikota.location_no = fe_tm_pelamar_personal_info.address_sekarang_kota
              	JOIN fe_tm_pelamar
                  ON fe_tm_pelamar.pelamar_no = fe_tm_pelamar_personal_info.pelamar_no
                JOIN sys_type as typeReligi
                  ON  typeReligi.type_id = fe_tm_pelamar_personal_info.religion_id
                JOIN sys_type as wkulit
                  ON  wkulit.type_id = fe_tm_pelamar_personal_info.skin_color_id
                JOIN sys_type as statusp
                  ON  statusp.type_id = fe_tm_pelamar_personal_info.relationship_id
                JOIN sys_type as kendaraan
                  ON  kendaraan.type_id = fe_tm_pelamar_personal_info.owned_kendaraan_id
                JOIN sys_type as bank
                  ON  bank.type_id = fe_tm_pelamar_personal_info.bank_id
                JOIN sys_type as pendidikan
                  ON  pendidikan.type_id = fe_tm_pelamar_personal_info.pendidikan_id
                JOIN fe_tx_apply_lowongan
                  ON   fe_tx_apply_lowongan.pelamar_no = fe_tm_pelamar.pelamar_no
                JOIN cms_tm_lowongan
                  ON cms_tm_lowongan.lowongan_no = fe_tx_apply_lowongan.lowongan_no
                JOIN cms_tm_pekerjaan_branch
                  ON cms_tm_pekerjaan_branch.pekerjaan_branch_no = cms_tm_lowongan.pekerjaan_branch_no
                JOIN cms_tm_pekerjaan
                  ON cms_tm_pekerjaan.pekerjaan_id = cms_tm_pekerjaan_branch.pekerjaan_id
                WHERE fe_tm_pelamar_personal_info.pelamar_no = '$id'";

        $query = $this->db->query($sql);
        return $result = $query->row();
    }

    public function getPelamarPersonalFamilyDetail($id){
        $sql = "SELECT fe_tm_pelamar_family_info.* FROM fe_tm_pelamar_personal_info
                JOIN fe_tm_pelamar
                  ON fe_tm_pelamar.pelamar_no = fe_tm_pelamar_personal_info.pelamar_no
                JOIN fe_tm_pelamar_family_info
                  ON fe_tm_pelamar_family_info.pelamar_no = fe_tm_pelamar.pelamar_no
                  WHERE fe_tm_pelamar_personal_info.pelamar_no = '$id'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }




}
