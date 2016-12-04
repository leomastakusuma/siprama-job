<?php
class Multimediacms_model extends CI_Model
{
    protected $_table = 'cms_tm_multimediabank';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertMultimedia($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function listMultimediaBank(){
       $sql = "SELECT  cms_tm_multimediabank.* , cms_tm_user._full_name FROM cms_tm_user, cms_tm_multimediabank WHERE
              cms_tm_user.user_no = cms_tm_multimediabank.create_by AND cms_tm_multimediabank._delete = '0'";
        $query = $this->db->query($sql);
        return $result = $query->result();
    }

    public function searchMultiMedia($multimediaId) {
        $this->db->select('*');
        $this->db->from('cms_tm_multimediabank');
        $this->db->where('cms_tm_multimediabank.multimediabank_no', $multimediaId);
        $query = $this->db->get();
        return $result = $query->row_array();
    }
		public function updateMultimedia($updateData,$idMultimedia) {
				$this->db->where('multimediabank_no', $idMultimedia);
				$data = $this->db->update($this->_table, $updateData);
		}

    public function hapus_multimedia($multimediaID)
    {
        $caridulu = "multimediabank_no  =" . "'" . $multimediaID . "' AND " . "_delete =" . "'0'";
        $this->db->select('*');
        $this->db->from('cms_tm_multimediabank');
        $this->db->where($caridulu);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() < 1) {
            return $no_brand;
        } else {
            $data = array(
                '_delete' => "1"
            );

            $this->db->where('multimediabank_no ', $multimediaID);
            $this->db->update('cms_tm_multimediabank', $data);
            return "Data berhasil dihapus.";
        }

    }

}


?>
