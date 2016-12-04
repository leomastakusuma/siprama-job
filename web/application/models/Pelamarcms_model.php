<?php
class Pelamarcms_model extends CI_Model
{
    protected $_table = 'fe_tm_pelamar';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertPelamar($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function insertPelamarInfo($data) {
        return $this->db->insert('fe_tm_pelamar_personal_info', $data);

    }

    public function insertPelamarInfoHistory($data) {
        return $this->db->insert('fe_tm_pelamar_personal_info_history', $data);

    }
    public function insertPelamarFamily($data) {
        return $this->db->insert('fe_tm_pelamar_family_info', $data);

    }

    public function insertPelamarFamilyHistory($data) {
        return $this->db->insert('fe_tm_pelamar_family_info_history', $data);

    }


  	public function updatePelamar($updateData,$pelamanNO) {
				$this->db->where('fe_tm_pelamar.pelamar_no', $pelamanNO);
				return $this->db->update($this->_table, $updateData);
		}

    public function updatePelamarInfo($updateData,$personalInfo) {
        $this->db->where('fe_tm_pelamar_personal_info.pelamar_personal_info_no', $personalInfo);
        return $this->db->update('fe_tm_pelamar_personal_info', $updateData);
    }

    public function updatePelamarInfochildren($updateData,$pelamanNO){
        $this->db->where('fe_tm_pelamar_personal_info.pelamar_no', $pelamanNO);
        return $this->db->update('fe_tm_pelamar_personal_info', $updateData);
    }

    public function updatePelamarFamily($updateData,$pelamanNO) {
        $this->db->where('fe_tm_pelamar_family_info.pelamar_family_info_no', $pelamanNO);
        return $this->db->update('fe_tm_pelamar_family_info', $updateData);
    }

    public function searchPelamars($id){
       $query = "SELECT * from fe_tm_pelamar where pelamar_no='{$id}' ";
       $result = $this->db->query($query);
       return $result->row();
    }
    public function searchPelamar($id){
       $query = "SELECT * from fe_tm_pelamar where pelamar_no='{$id}' ";
       $result = $this->db->query($query);
       return $result->row_array();
    }

    public function searchChangePW($id,$password){
      $query = "SELECT * from fe_tm_pelamar where pelamar_no='{$id}' AND _password='{$password}'";
      $result = $this->db->query($query);
      return $result->row_array();
    }
    public function searchPelamarInfo($id){
       $query = "SELECT * from fe_tm_pelamar_personal_info where pelamar_no='{$id}' ";
       $result = $this->db->query($query);
       return $result->row();
    }

    public function searchPelamarExist($id){
       $query = "SELECT * from fe_tm_pelamar where _email='{$id}' AND _active='1' AND _delete='0'";
       $result = $this->db->query($query);
       return $result->num_rows();
    }

    public function searchPelamarExistKTP($id){
       $query = "SELECT * from fe_tm_pelamar_personal_info where _no_ktp='{$id}'";
       $result = $this->db->query($query);
       return $result->num_rows();
    }

    public function searchPelamarFamily($id){
       $query = "SELECT * from fe_tm_pelamar_family_info where pelamar_no='{$id}' AND _delete = '0' ";
       $result = $this->db->query($query);
       return $result->result();
    }


}


?>
