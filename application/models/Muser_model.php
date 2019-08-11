<?php

	class Muser_model extends CI_Model {

		/**
		 * @author Fian Hidayah
		 * Constructor class
		 */
		function __construct() {
			// Call the Model constructor
			parent::__construct();
			$this->db_evin = $this->load->database('hijab', TRUE);
		}

		/**
		 * @author Fian Hidayah
		 * method untuk generate select query dari database
		 */
		public function select($selectcolumn=true){
	    	if($selectcolumn){
		    	$this->db_evin->select('id_user');
		    	$this->db_evin->select('id_lvl');
		    	$this->db_evin->select('name_user');
		    	$this->db_evin->select('username');
		    	$this->db_evin->select('password');
		    	$this->db_evin->select('ft_user');
		    	$this->db_evin->select('email');
		    	$this->db_evin->select('last_user');
		    	$this->db_evin->select('st_user');
	    	}
            	$this->db_evin->from('user');
		}

		/**
         * @author Fian Hidayah
         * method untuk mendapatkan data dari tabel survei
         * @param type $limit jumlah yang mau diambil
         * @param type $offset mulai dari mana
         * @return type hasil query dari database
         */
        function get($where = "", $order = "id_user asc", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db_evin->limit($limit, $offset);
  			 if($where != "") $this->db_evin->where($where);
  			 $this->db_evin->order_by($order);
  			 $query = $this->db_evin->get();
  			 return $query->result();
        }
        function get_by_id($id_user)
		 {
			if($id_user == null || trim($id_user) == "") return null;
			$result = $this->get("id_user = '".$id_user."'");
			return count($result) == 0?null:$result[0];
		 }

		/**
		 * @author Fian Hidayah
		 * Fungsi untuk insert data ke tabel survei
		 */
		function insert($name_user=false,$username=false,$password=false,$ft_user=false,$id_lvl=false)
		{
			$data = array();
			if($name_user !== false)$data['name_user'] = trim($name_user);
			if($username !== false)$data['username'] = trim($username);
			if($password !== false)$data['password'] = trim($password);
			if($ft_user !== false)$data['ft_user'] = trim($ft_user);
			if($id_lvl !== false)$data['id_lvl'] = trim($id_lvl);
      		$data['st_user']= STATUS_ACTIVE;
      		$data['last_user'] = now();
			$this->db_evin->insert('user', $data);
			return $this->db_evin->insert_id();
		}

		function update($id_user=false,$name_user=false,$username=false,$ft_user=false,$id_lvl=false)
		{
			$data = array();
			if($name_user !== false)$data['name_user'] = trim($name_user);
			if($username !== false)$data['username'] = trim($username);
			if($ft_user !== false)$data['ft_user'] = trim($ft_user);
			if($id_lvl !== false)$data['id_lvl'] = trim($id_lvl);

			return $this->db_evin->update('user', $data, "id_user = $id_user");
		}

		 /* @author Fian Hidayah
		 * Fungsi untuk delete data dari tabel Survei
		 */
		function delete($id_user)
		{
			$data = array();
			$data['st_user'] = STATUS_DELETE;
			return $this->db_evin->update('user', $data, "id_user = $id_user");
		}

		function last_sign($user_id)
		{
			$data = array();
			$data['last_user'] = now();
			return $this->db_evin->update('user', $data, "id_user = $user_id");
		}
		function get_lvl_user(){
			$sql = "select * from user_level";
			$query = $this->db_evin->query($sql);
			return $query->result();
		}
		/**
		 * @author Fian Hidayah
		 * Fungsi untuk menghitung jumlah row dari tabel survei
		 * @param type $where custome where
		 */
		function count_all($where = "")
		{
			if($where != null)$this->db_evin->where($where);
			return $this->db_evin->count_all_results('user');
		}
	}
?>