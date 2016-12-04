<?php
class Corporatecms_model extends CI_Model
{
    protected $_table = 'sys_tm_corporate';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertCorporate($data) {
				return $this->db->insert($this->_table, $data);
		}
    public function listCorporate(){
         $this->db->select('*');
         $this->db->from($this->_table);
         $where = array(
           'sys_tm_corporate._active'=>'1',
           'sys_tm_corporate._delete'=>'0',
         );
         $this->db->where($where);
         $this->db->order_by("sys_tm_corporate.create_date", "desc");
         $query = $this->db->get();
         return $result = $query->result_array();

    }
    public function searchCorporate($corporateID) {
        $this->db->select('*');
        $this->db->from('sys_tm_corporate');
        $this->db->where('sys_tm_corporate.corporate_id', $corporateID);
        $query = $this->db->get();
        return $result = $query->row_array();
    }
		public function updateCorporate($updateData,$corporateID) {
				$this->db->where('corporate_id', $corporateID);
				$data = $this->db->update($this->_table, $updateData);
		}
    public function search($id){
       $query = "SELECT * from sys_tm_corporate where corporate_id='{$id}'";
       $result = $this->db->query($query);
       return $result->row_array();
    }

    public function ambil_data()
    {
        $kondisi = array(
            "sys_tm_corporate._delete"=>"0",
            // "sys_tm_corporate._active"=>"1"
        );

        $this->db->select('*');
        $this->db->from('sys_tm_corporate');
        $this->db->order_by('sys_tm_corporate.create_date');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();

    }

    public function set_active($corporateID)
    {

        $caridulu = "corporate_id  =" . "'" . $corporateID . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_corporate');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "1",
                '_delete' => "0"
            );

            $this->db->where('corporate_id ', $corporateID);
            $this->db->update('sys_tm_corporate', $data);
            return "Corporate berhasil diaktifkan.";
        }

    }

    public function set_noactive($corporateID)
    {

        $caridulu = "corporate_id  =" . "'" . $corporateID . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('sys_tm_corporate');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
            return "Data tidak valid 3.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "0"
            );

            $this->db->where('corporate_id ', $corporateID);
            $this->db->update('sys_tm_corporate', $data);
            return "Corporate berhasil dinonaktifkan.";
        }

    }

    public function hapus_corp($corporateID)
    {

        $caridulu = "corporate_id  =" . "'" . $corporateID . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('sys_tm_corporate');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return $no_brand;
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "1"
            );

            $this->db->where('corporate_id ', $corporateID);
            $this->db->update('sys_tm_corporate', $data);
            return "Data berhasil dihapus.";
        }

    }

}


?>
