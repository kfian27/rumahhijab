<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class login_model extends CI_Model {

	/**
	 * @author Fian Hidayah
	 * Constructor class
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->db_evin = $this->load->database('hijab', TRUE);
	}
	function cek_login($username,$password){
		$sql = "select * from user where username = '$username' and password = '$password'";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function j_cabang(){
		$sql = "select count(id_cabang) as jumlah from cabang";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function j_tr(){
		$sql = "SELECT COUNT(id_invoice) AS total FROM invoice WHERE DATE(tgl_invoice) = CURDATE();";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function j_proses(){
		$sql = "SELECT * from (SELECT COUNT(id_invoice) as gudangnya FROM invoice WHERE st_invoice LIKE '%gudang') as a, (SELECT COUNT(id_invoice) as kirimnya FROM invoice WHERE st_invoice LIKE '%kirim') as b";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function most_brg(){
		$sql = "SELECT SUM(gudang.jumlah_stok) as jumlah_stoknya, nm_produk, ft_produk FROM gudang, produk WHERE produk.id_produk = gudang.id_produk AND gudang.keterangan = 'Barang keluar' AND MONTH(up_gudang) = MONTH(CURDATE()) GROUP BY nm_produk ORDER BY jumlah_stoknya desc LIMIT 5";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function grafik($bulan){
		$sql = "SELECT SUM(qty_di) AS jumlah FROM detail_invoice, invoice WHERE detail_invoice.id_invoice = invoice.id_invoice AND MONTH (tgl_invoice) = '$bulan'";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
}
?>