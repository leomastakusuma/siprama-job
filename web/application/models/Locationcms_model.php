<?php

class Locationcms_model extends CI_Model {

    protected $_table = 'cms_tm_location';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }
    public function insertLocation($data) {
          return $this->db->insert($this->_table, $data);
    }
    public function updatelocation($updateData,$lokid) {
        $this->db->where('location_no', $lokid);
        $data = $this->db->update($this->_table, $updateData);
    }
    function select($data) {
        $this->db->select($data);
        $this->db->where("_delete", "0");
        $query = $this->db->get("cms_tm_location");

        return $query->result_array();
    }

    function Ambil_data_propinsi_by_negara($idnegara) {
        $this->db->select('location_no,_name');
        $this->db->where(array('_delete' => "0", "_parent_location_no" => $idnegara));
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    function Ambil_data_propinsi_semua() {
        $this->db->select('location_no,_name');
        $this->db->where(array('_delete' => "0", "type_location_id" => "2"));
        $query = $this->db->get($this->_table);
        return $query->result_array();
    }

    public function ambil_data() {

        $this->db->select('*');
        $this->db->from('cms_tm_location');
        $this->db->where("_delete", "0");
        $this->db->order_by("type_location_id", "asc");
        $this->db->order_by("create_date", "desc");
        $query = $this->db->get();
        return $result = $query->result();
    }

	  public function Ambil_country_id(){
        $query = $this->db->query("SELECT * FROM cms_tm_location WHERE type_location_id='TYPELOC01' AND _delete='0' AND _active='1'");
        return $query->result();
    }
  	public function Ambil_province_id(){
        $query = $this->db->query("SELECT * FROM cms_tm_location WHERE type_location_id='TYPELOC02' AND _delete='0' AND _active='1'");
        return $query->result();
    }
		public function Ambil_province_id_by_negara($idnegara){
        $query = $this->db->query("SELECT * FROM cms_tm_location WHERE _parent_location_no=".$idnegara."  AND type_location_id='2' AND _delete='0' AND _active='1'");
        return $query->result();
    }

	 public function Ambil_location_type(){
        $query = $this->db->query("SELECT * FROM sys_type WHERE _delete='0' AND _active='1' AND category_id='10'");
        return $query->result();
   }

   public function ambil_edit_data($user_no) {

        $kondisi = "location_no =" . "'" . $user_no . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_location');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();
    }

    public function ambil_jenis_lokasi($no) {

        $kondisi = "location_no =" . "'" . $no . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('type_location_id');
        $this->db->from('cms_tm_location');
        $this->db->where($kondisi);
        $query = $this->db->get();
		    $output = $query->row();
        return $output;
    }



    public function hapus_loc($no_loc) {

        $caridulu = "location_no =" . "'" . $no_loc . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_location');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "1"
            );

            $this->db->where('location_no', $no_loc);
            $hapus = $this->db->update('cms_tm_location', $data);
            if ($hapus) {
                return "Data lokasi berhasil dihapus.";
            } else {
                return "Data lokasi gagal dihapus.";
            }
        }
    }

    public function set_active($no_key) {

        $caridulu = "location_no =" . "'" . $no_key . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_location');
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

            $this->db->where('location_no', $no_key);
            $set_aktif = $this->db->update('cms_tm_location', $data);
            if ($set_aktif) {
                return "Lokasi berhasil diaktifkan.";
            } else {
                return "Lokasi gagal diaktifkan.";
            }
        }
    }

    public function set_noactive($no_key) {

        $caridulu = "location_no =" . "'" . $no_key . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_location');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {

            return "Data tidak valid.";
        } else {
            $data = array(
                '_active' => "0",
                '_delete' => "0"
            );

            $this->db->where('location_no', $no_key);
            $this->db->update('cms_tm_location', $data);
            return "Lokasi berhasil dinonaktifkan.";
        }
    }



}


?>
