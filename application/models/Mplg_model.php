<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mplg_model extends CI_Model {

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
		    	$this->db_evin->select('id_plg');
		    	$this->db_evin->select('nm_plg');
		    	$this->db_evin->select('alm_plg');
		    	$this->db_evin->select('kota_plg');
		    	$this->db_evin->select('st_plg');
	    	}
            	$this->db_evin->from('pelanggan');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_plg asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_plg)
		 {
			if($id_plg == null || trim($id_plg) == "") return null;
			$result = $this->get("id_plg = '".$id_plg."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($nm_plg=false,$alm_plg=false,$kota_plg=false)
		{
			$data = array();
			if($nm_plg !== false)$data['nm_plg'] = trim($nm_plg);
			if($alm_plg !== false)$data['alm_plg'] = trim($alm_plg);
			if($kota_plg !== false)$data['kota_plg'] = trim($kota_plg);
			$data['st_plg'] = STATUS_ACTIVE;
			$this->db_evin->insert('pelanggan', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_plg=false,$nm_plg=false,$alm_plg=false,$kota_plg=false)
		{
			$data = array();
      		if($nm_plg !== false)$data['nm_plg'] = trim($nm_plg);
			if($alm_plg !== false)$data['alm_plg'] = trim($alm_plg);
			if($kota_plg !== false)$data['kota_plg'] = trim($kota_plg);
			return $this->db_evin->update('pelanggan', $data, "id_plg = $id_plg");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_plg)
		{
			$data = array();
			$data['st_plg'] = STATUS_DELETE;
			$this->db_evin->update('pelanggan', $data, "id_plg = $id_plg");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('pelanggan');
		}
}
?>