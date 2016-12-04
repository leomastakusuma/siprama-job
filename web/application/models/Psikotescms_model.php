<?php
class Psikotescms_model extends CI_Model
{
    protected $_table = 'fe_tx_psikotes';
    function __construct()
    {
        parent::__construct();
        $this->load->database();
    }

		public function insertPsikotes($data) {
				return $this->db->insert($this->_table, $data);
		}

    public function insertPsikotesDetail($data) {
        return $this->db->insert('fe_tx_psikotes_detail', $data);

    }

  	public function updatePelamar($updateData,$pelamanNO) {
				$this->db->where('fe_tm_pelamar.pelamar_no', $pelamanNO);
				return $this->db->update($this->_table, $updateData);
		}




}


?>
