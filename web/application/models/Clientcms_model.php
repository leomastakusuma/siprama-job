<?php
class Clientcms_model extends CI_Model
{
    protected $_table = 'cms_tm_client';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertClient($data) {
				return $this->db->insert($this->_table, $data);
		}
    public function listClient(){

         $this->db->select('cms_tm_client.*,sys_tm_branch._name as branchname');
         $this->db->from($this->_table);
         $where = array(
          //  'cms_tm_client._active'=>'0',
           'cms_tm_client._delete'=>'0',
         );

         $this->db->join('sys_tm_branch','sys_tm_branch.branch_id=cms_tm_client.branch_id');
         $this->db->where($where);
         $this->db->order_by("cms_tm_client.create_date", "desc");
         $query = $this->db->get();
         return $result = $query->result();

    }
    public function searchClient($clientID) {
        $this->db->select('*');
        $this->db->from('cms_tm_client');
        $this->db->where('cms_tm_client.client_id', $clientID);
        $query = $this->db->get();
        return $result = $query->row_array();
    }
		public function updateClient($updateData,$clientID) {
				$this->db->where('client_id', $clientID);
				$data = $this->db->update($this->_table, $updateData);
		}
    public function search($id){
       $query = "SELECT * from cms_tm_client where client_id'{$id}'";
       $result = $this->db->query($query);
       return $result->row_array();
    }

    public function ambil_data()
    {
        $kondisi = array(
            "cms_tm_client._delete"=>"0",
        );

        $this->db->select('*');
        $this->db->from('cms_tm_client');
        $this->db->order_by('cms_tm_Client.create_date');
        $this->db->where($kondisi);
        $query = $this->db->get();
        return $result = $query->result();

    }

    public function set_active($clientID)
    {

        $caridulu = "client_id  =" . "'" . $clientID . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_client');
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

            $this->db->where('client_id ', $clientID);
            $this->db->update('cms_tm_client', $data);
            return "Client berhasil diaktifkan.";
        }

    }

    public function set_noactive($clientID)
    {

        $caridulu = "client_id  =" . "'" . $clientID . "' AND " . "_delete =" . "'0' AND " . "_active =" . "'1'";
        $this->db->select('*');
        $this->db->from('cms_tm_client');
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

            $this->db->where('client_id ', $clientID);
            $this->db->update('cms_tm_client', $data);
            return "Client berhasil dinonaktifkan.";
        }

    }

    public function hapus_client($clientID)
    {

        $caridulu = "client_id  =" . "'" . $clientID . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_client');
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

            $this->db->where('client_id ', $clientID);
            $this->db->update('cms_tm_client', $data);
            return "Data berhasil dihapus.";
        }

    }

}


?>
