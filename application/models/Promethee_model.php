<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
	/**
     * @author Fian Hidayah
	 * Model untuk table
	 */
class promethee_model extends CI_Model {

	/**
	 * @author Fian Hidayah
	 * Constructor class
	 */
	function __construct() {
		// Call the Model constructor
		parent::__construct();
		$this->db_evin = $this->load->database('hijab', TRUE);
	}
	function promethee_get_hasil(){
		$sql = "SELECT  
	        a.id_alternative,c.name AS alternative, c.code,  
	        a.id_sub_criteria,a.value,  
	        b.id_criteria, b.id_type, b.p,b.q,b.s 
	      FROM  
	        pro_evaluations a 
	        JOIN pro_sub_criterias b USING(id_sub_criteria) 
	        JOIN pro_alternatives c USING(id_alternative) 
	      ORDER BY  
        a.id_alternative,a.id_sub_criteria";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function promethee_get_data_lalu(){
		$sql = "SELECT produk.nm_produk, qty_di, produk.stok_produk, produk.harga_produk FROM detail_invoice, produk, invoice WHERE detail_invoice.id_produk = produk.id_produk AND invoice.id_invoice = detail_invoice.id_invoice AND MONTH (tgl_invoice) = MONTH (NOW())-1 GROUP BY nm_produk";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function promethee_get_data(){
		$sql = "SELECT produk.nm_produk, qty_di, produk.stok_produk, produk.harga_produk FROM detail_invoice, produk, invoice WHERE detail_invoice.id_produk = produk.id_produk AND invoice.id_invoice = detail_invoice.id_invoice AND MONTH (tgl_invoice) = MONTH (NOW()) GROUP BY nm_produk";
		$query = $this->db_evin->query($sql);
		return $query->result();
	}
	function hapus_semua_data(){
		$sql = "TRUNCATE pro_alternatives";
		$query = $this->db_evin->query($sql);
		// return $query->result();
	}
	function hapus_data_hasil(){
		$sql = "TRUNCATE pro_evaluations";
		$query = $this->db_evin->query($sql);
		// return $query->result();
	}
	function insert_alternatif($name=false,$code=false)
	{
		$data = array();
		if($name !== false)$data['name'] = trim($name);
		if($code !== false)$data['code'] = trim($code);
		$this->db_evin->insert('pro_alternatives', $data);
		return $this->db_evin->insert_id();
	}
	function insert_eval($id_alternative=false,$id_sub_criteria=false,$value=false)
	{
		$data = array();
		if($id_alternative !== false)$data['id_alternative'] = trim($id_alternative);
		if($id_sub_criteria !== false)$data['id_sub_criteria'] = trim($id_sub_criteria);
		if($value !== false)$data['value'] = $value;
		return $this->db_evin->insert('pro_evaluations', $data);
	}
}
?>