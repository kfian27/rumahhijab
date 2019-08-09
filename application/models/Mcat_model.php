<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mcat_model extends CI_Model {

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
		    	$this->db_evin->select('id_cat');
		    	$this->db_evin->select('nm_cat');
		    	$this->db_evin->select('st_cat');
	    	}
            	$this->db_evin->from('kategori_produk');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_cat asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_cat)
		 {
			if($id_cat == null || trim($id_cat) == "") return null;
			$result = $this->get("id_cat = '".$id_cat."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($nm_cat=false)
		{
			$data = array();
			if($nm_cat !== false)$data['nm_cat'] = trim($nm_cat);
			$data['st_cat'] = STATUS_ACTIVE;
			$this->db_evin->insert('kategori_produk', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_cat=false,$nm_cat=false)
		{
			$data = array();
      		if($nm_cat !== false)$data['nm_cat'] = trim($nm_cat);

			return $this->db_evin->update('kategori_produk', $data, "id_cat = $id_cat");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_cat)
		{
			$data = array();
			$data['st_cat'] = STATUS_DELETE;
			$this->db_evin->update('kategori_produk', $data, "id_cat = $id_cat");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('kategori_produk');
		}
}
?>