<?php
class Rolecms_model extends CI_Model
{
    protected $_table = 'sys_tm_role';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertRole($data) {
				return $this->db->insert($this->_table, $data);
		}
    public function listRole(){
         $this->db->select('*');
         $this->db->from($this->_table);
         $where = array(
           'sys_tm_role._active'=>'1',
           'sys_tm_role._delete'=>'0',
         );
         $this->db->where($where);
         $this->db->join('cms_tm_user', 'sys_tm_role.create_by=cms_tm_user.user_no');
         $this->db->order_by("sys_tm_role.create_date", "desc");
         $query = $this->db->get();
         return $result = $query->result();

    }
		public function updateRole($updateData,$roleID) {
				$this->db->where('role_id', $roleID);
				$data = $this->db->update($this->_table, $updateData);
		}
    public function search($id){
       $query = "SELECT * from sys_tm_role where role_id='{$id}'";
       $result = $this->db->query($query);
       return $result->row_array();
    }

}


?>
