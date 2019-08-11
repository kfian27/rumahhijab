<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class mgudang_model extends CI_Model {

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
		    	$this->db_evin->select('id_gudang');
		    	$this->db_evin->select('gudang.id_user');
		    	$this->db_evin->select('nm_produk');
		    	$this->db_evin->select('no_invoice');
		    	$this->db_evin->select('jumlah_stok');
		    	$this->db_evin->select('keterangan');
		    	$this->db_evin->select('up_gudang');
	    	}
            	$this->db_evin->from('gudang');
            	$this->db_evin->join('produk', 'produk.id_produk = gudang.id_produk');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "up_gudang desc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_gudang)
		{
		if($id_gudang == null || trim($id_gudang) == "") return null;
		$result = $this->get("id_gudang = '".$id_gudang."'");
		return count($result) == 0?null:$result[0];
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function masuk($id_produk=false,$jumlah_stok=false)
		{
			$data = array();
			$data['id_user']= $this->session->userdata('id');
			if($jumlah_stok !== false)$data['jumlah_stok'] = trim($jumlah_stok);
			if($id_produk !== false)$data['id_produk'] = trim($id_produk);
			$data['keterangan'] = 'Barang masuk';
			$data['up_gudang'] = now();
			$this->db_evin->insert('gudang', $data);
			return $this->db_evin->insert_id();
		}

		function keluar($id_produk=false,$jumlah_stok=false,$no_invoice=false)
		{
			$data = array();
			$data['id_user']= $this->session->userdata('id');
			if($jumlah_stok !== false)$data['jumlah_stok'] = trim($jumlah_stok);
			if($id_produk !== false)$data['id_produk'] = trim($id_produk);
			if($no_invoice !== false)$data['no_invoice'] = trim($no_invoice);
			$data['keterangan'] = 'Barang keluar';
			$data['up_gudang'] = now();
			$this->db_evin->insert('gudang', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_gudang=false,$id_user=false)
		{
			$data = array();
      		if($id_user !== false)$data['id_user'] = trim($id_user);

			return $this->db_evin->update('gudang', $data, "id_gudang = $id_gudang");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_gudang)
		{
			$data = array();
			$data['id_produk'] = STATUS_DELETE;
			$this->db_evin->update('gudang', $data, "id_gudang = $id_gudang");
		}

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('gudang');
		}
		function get_di_gudang(){
			$sql = "SELECT detail_invoice.id_di, detail_invoice.qty_di, detail_invoice.st_di, produk.nm_produk, produk.stok_produk, produk.id_produk, invoice.no_invoice, invoice.tgl_invoice, invoice.id_invoice FROM detail_invoice, produk, invoice WHERE detail_invoice.id_produk = produk.id_produk AND detail_invoice.id_invoice = invoice.id_invoice AND detail_invoice.st_di = 'gudang'";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function update_di($id_di=false)
		{
			$data = array();
      		$data['st_di'] = 'kirim';

			return $this->db_evin->update('detail_invoice', $data, "id_di = $id_di");
		}
		function cek_row_di($id_invoice){
			$sql = "SELECT * from detail_invoice where id_invoice = '$id_invoice'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function cek_row_kirim($id_invoice){
			$sql = "SELECT * from detail_invoice where id_invoice = '$id_invoice' and st_di = 'kirim'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function cek_nama($codenya){
			$sql = "select * from pro_alternatives WHERE pro_alternatives.code = '$codenya'";
			$query = $this->db->query($sql);
			return $query->result();
		}
}
?>