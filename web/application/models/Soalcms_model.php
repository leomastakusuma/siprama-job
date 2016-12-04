<?php
class Soalcms_model extends CI_Model
{
    protected $_table = 'cms_tm_soal';
    function __construct()
    {
          parent::__construct();
          $this->load->database();
    }

    public function typeSoal(){
        $sql = "SELECT type_id, _name FROM sys_type WHERE category_id = '20' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

    public function searchSoal($id,$opsi,$curentopsi,$score){
        $sql = "SELECT $opsi , $score FROM cms_tm_soal WHERE soal_id ='{$id}'";
        $query = $this->db->query($sql);
        return $result = $query->row();
    }

    public function TypeTanggungJawab(){
        $sql = "SELECT * FROM cms_tm_soal WHERE category_soal_id = 'CTGSOAL01' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }
    public function TypeIntegritasKejujuran(){
        $sql = "SELECT * FROM cms_tm_soal WHERE category_soal_id = 'CTGSOAL02' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }
    public function TypeInisitipKreatif(){
        $sql = "SELECT * FROM cms_tm_soal WHERE category_soal_id = 'CTGSOAL03' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }
    public function TypeTeamWork(){
        $sql = "SELECT * FROM cms_tm_soal WHERE category_soal_id = 'CTGSOAL04' AND _active='1' AND _delete='0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }




}


?>
