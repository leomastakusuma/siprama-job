<?php

class About_model extends CI_Model {

    protected $_table = 'cms_tm_about';

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function insert($data) {
        return $this->db->insert($this->_table, $data);
    }

    public function selectAll(){
          $this->db->select('*');
          $query = $this->db->get($this->_table);
          return $query->result_array();
    }

    function update($about_no, $updateData) {
        $this->db->where('about_no', $about_no);
        $this->db->update('cms_tm_about', $updateData);
        return true;
    }

    public function get($about_no){
          $this->db->select('cms_tm_about.*');
          $this->db->where(array('cms_tm_about.about_no' => $about_no));
          $query = $this->db->get($this->_table);
          return $query->row_array();
    }

}
