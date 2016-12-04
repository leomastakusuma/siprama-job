<?php

Class General_model extends CI_Model
{

    function __construct()
    {
        parent::__construct();
        $this->load->database();
        $this->db = $this->load->database('default', TRUE);
    }

    function checkUserAccess($level_id, $role_id)
    {
        if (is_array($role_id)) {
            $First = $role_id[0];
            $Second = $role_id[1];
            $sql = "SELECT
				  1
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac.role_id = '$First' OR uac.role_id = '$Second'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        } else {
            $sql = "SELECT
				  1
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac.role_id = '$role_id'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        }
        $query = $this->db->query($sql);

        $row = $query->num_rows();

        return $row;
    }


    function checkExist($table,$field,$value){
       $sql = "SELECT * FROM $table WHERE $field = '$value'";
       $query = $this->db->query($sql);
       $row = $query->num_rows();
       return $row;
    }

    function get_all_access($level_id)
    {
        $sql = "SELECT
				  uac.branch_role_id
				FROM cms_tm_user_access uac
				WHERE uac.user_level_id = '$level_id'
				  AND uac._active = '1'
				  AND uac._delete = '0' ";
        $query = $this->db->query($sql);
        $row = $query->result_array();
        return $row;
    }

    function getLowongan(){
       $sql = "SELECT type_id,_name FROM sys_type WHERE category_id = '21'";
       $query = $this->db->query($sql);
       return $query->result();
    }








}
