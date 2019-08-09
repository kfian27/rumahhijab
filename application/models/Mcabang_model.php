<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mcabang_model extends CI_Model {

	/**
	 * @author Fian Hidayah
	 * Constructor class
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->db_evin = $this->load->database('hijab', TRUE);
		//set waktu yang digunakan ke zona jakarta
		//$this->db_simpeg->query("SET time_zone='Asia/Jakarta'");
	}

		/**
		 * @author Fian Hidayah
		 * method untuk generate select query dari database
		 */
		public function select($selectcolumn=true){
	    	if($selectcolumn){
		    	$this->db_evin->select('id_cabang');
		    	$this->db_evin->select('nm_cabang');
		    	$this->db_evin->select('loc_cabang');
		    	$this->db_evin->select('st_cabang');
	    	}
            	$this->db_evin->from('cabang');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_cabang asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_cabang)
		 {
			if($id_cabang == null || trim($id_cabang) == "") return null;
			$result = $this->get("id_cabang = '".$id_cabang."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($nm_cabang=false,$loc_cabang=false)
		{
			$data = array();
			if($nm_cabang !== false)$data['nm_cabang'] = trim($nm_cabang);
			if($loc_cabang !== false)$data['loc_cabang'] = trim($loc_cabang);
			$data['st_cabang'] = STATUS_ACTIVE;
			$this->db_evin->insert('cabang', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_cabang=false,$nm_cabang=false,$loc_cabang=false)
		{
			$data = array();
      		if($nm_cabang !== false)$data['nm_cabang'] = trim($nm_cabang);
      		if($loc_cabang !== false)$data['loc_cabang'] = trim($loc_cabang);
			return $this->db_evin->update('cabang', $data, "id_cabang = $id_cabang");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_cabang)
		{
			$data = array();
			$data['st_cabang'] = STATUS_DELETE;
			$this->db_evin->update('cabang', $data, "id_cabang = $id_cabang");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('cabang');
		}
}
?>