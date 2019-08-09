<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mproduk_model extends CI_Model {

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
		    	$this->db_evin->select('id_produk');
		    	$this->db_evin->select('id_user');
		    	$this->db_evin->select('id_cat');
		    	$this->db_evin->select('nm_produk');
		    	$this->db_evin->select('stok_produk');
		    	$this->db_evin->select('harga_produk');
		    	$this->db_evin->select('beli_produk');
		    	$this->db_evin->select('ft_produk');
		    	$this->db_evin->select('up_produk');
		    	$this->db_evin->select('st_produk');
	    	}
            	$this->db_evin->from('produk');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_produk asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_produk)
		 {
			if($id_produk == null || trim($id_produk) == "") return null;
			$result = $this->get("id_produk = '".$id_produk."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($id_cat=false,$nm_produk=false,$stok_produk=false,$harga_produk=false,$beli_produk=false,$ft_produk=false)
		{
			$data = array();
      		$data['id_user']= $this->session->userdata('id');
			if($id_cat !== false)$data['id_cat'] = trim($id_cat);
			if($nm_produk !== false)$data['nm_produk'] = trim($nm_produk);
			if($stok_produk !== false)$data['stok_produk'] = trim($stok_produk);
			if($harga_produk !== false)$data['harga_produk'] = trim($harga_produk);
			if($beli_produk !== false)$data['beli_produk'] = trim($beli_produk);
			if($ft_produk !== false)$data['ft_produk'] = trim($ft_produk);
			$data['up_produk'] = now();
			$data['st_produk'] = TERSEDIA;
			$this->db_evin->insert('produk', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_produk=false,$id_cat=false,$nm_produk=false,$harga_produk=false,$beli_produk=false,$ft_produk=false)
		{
			$data = array();
      		$data['id_user']= $this->session->userdata('id');
			if($id_cat !== false)$data['id_cat'] = trim($id_cat);
			if($nm_produk !== false)$data['nm_produk'] = trim($nm_produk);
			if($harga_produk !== false)$data['harga_produk'] = trim($harga_produk);
			if($beli_produk !== false)$data['beli_produk'] = trim($beli_produk);
			if($ft_produk !== false)$data['ft_produk'] = trim($ft_produk);
			$data['up_produk'] = now();;

			return $this->db_evin->update('produk', $data, "id_produk = $id_produk");
		}
		function update_stok($id_produk=false,$stok_produk=false)
		{
			$data = array();
      		$data['id_user']= $this->session->userdata('id');
			if($stok_produk !== false)$data['stok_produk'] = trim($stok_produk);
			$data['up_produk'] = now();;

			return $this->db_evin->update('produk', $data, "id_produk = $id_produk");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_produk)
		{
			$data = array();
			$data['st_produk'] = TIDAK_TERSEDIA;
			$this->db_evin->update('produk', $data, "id_produk = $id_produk");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('produk');
		}
}
?>