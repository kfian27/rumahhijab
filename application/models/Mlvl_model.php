<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mlvl_model extends CI_Model {

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
		    	$this->db_evin->select('id_lvl');
		    	$this->db_evin->select('nm_lvl');
		    	$this->db_evin->select('st_lvl');
	    	}
            	$this->db_evin->from('user_level');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_lvl asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_lvl)
		 {
			if($id_lvl == null || trim($id_lvl) == "") return null;
			$result = $this->get("id_lvl = '".$id_lvl."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($nm_lvl=false)
		{
			$data = array();
			if($nm_lvl !== false)$data['nm_lvl'] = trim($nm_lvl);
			$data['st_lvl'] = STATUS_ACTIVE;
			$this->db_evin->insert('user_level', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_lvl=false,$nm_lvl=false)
		{
			$data = array();
      		if($nm_lvl !== false)$data['nm_lvl'] = trim($nm_lvl);
			return $this->db_evin->update('user_level', $data, "id_lvl = $id_lvl");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_lvl)
		{
			$data = array();
			$data['st_lvl'] = STATUS_DELETE;
			$this->db_evin->update('user_level', $data, "id_lvl = $id_lvl");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('user_level');
		}
}
?>