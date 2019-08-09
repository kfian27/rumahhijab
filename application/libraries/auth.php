<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * class untuk authentification
 */
class auth {
	private $CI;
	/* akses */
	private $mainAccess = '';
	private $detailAccess = array();

	/**
	 * Constructor 
	 */
	public function __construct()
	{
		$this->CI =& get_instance();
	}

	// =================== KHUSUS AKSES ===================//
	public function set_main_access($access){
		$this->mainAccess = $access;
	}

	public function add_detail_akses($detailAkses){
		$this->detailAccess[] = $detailAkses;
	}
	
	private function get_all_access(){
		if($this->mainAccess == '') return false;
		
		$allAccess = array();
		$allAccess[] = "access = '$mainAccess'";
		
		foreach($this->detailAccess as $dAccess){
			$allAccess[] = "access = '$mainAccess'";
		}
		
		return implode(" or ", $allAccess);
	}
	// ============== END KHUSUS AKSES ===============//
	
	public function get_akses(){
		$this->CI->load->model('user_model');
		$id_usergroup = $this->get_user()->id_usergroup;
		return $this->CI->user_model->get_akses($id_usergroup);
	}
	
	public function get_name(){
		if($this->is_root()) return "root";
		$user = $this->get_user();
		if(!$user) return "Unknown user";
		return $user->username;
	}
	
	public function get_menu(){
		if(!$this->is_login()) return "";
		if($this->get_user_akses()==1) 
			return $this->CI->load->view('base/menu/menu_dosen', '', true);
		else if($this->get_user_akses()==2) 
			return $this->CI->load->view('base/menu/menu_karyawan', '', true);
		else if($this->get_user_akses()==3) 
			return $this->CI->load->view('base/menu/menu_admin', '', true);
		else 
			return $this->CI->load->view('base/menu/menu_superadmin', '', true);
	}

	public function get_user(){
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		if(!$this->is_login()) return false;
		if(!$a['CURRENT_USER']) return FALSE;
		return $a['CURRENT_USER'];
	}
	public function get_pegawai(){
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		if(!$this->is_login()) return false;
		if(!$a['CURRENT_PEGAWAI']) return FALSE;
		return $a['CURRENT_PEGAWAI'];
	}
	
	public function get_user_akses(){
		$a = $this->CI->session->userdata('USER');
		return $a['USER_AKSES'];
	}
	
	public function is_login(){
		
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		return $a['USER_ID'] != false;
	}

	//buat ngetauin ini root atau bukan
	public function is_root(){
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		return $a['IS_ROOT'] == true;
	}

	public function renew_session(){
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		if($this->is_login())
		{
			session_start();
			$_SESSION['USER_GROUP'] = $a['USER_GROUP'];
		}
	}

	public function validate(){
		$restrictedUrl = get_setting('restricted_access');
		$a  = $this->CI->session->userdata('USER');//diganti jadi seperti ini bari di php versi lain ndak ada masalah by : yasin
		//cek sessionnya
		if($this->is_login()){
			//get user id dan user group
			$id = $a['USER_ID'];
			$user_group = $a['USER_GROUP'];

			if($this->is_root()) return true;

			//load user
			$this->CI->load->model('user_model');
			$user = $this->CI->user_model->get_by_id($id);

			if($user != null)
			{
				$allAccess = $this->get_all_access();
				if(!$allAccess){
					echo '<h1 style="color: red;">Note Buat Developer : Set Dulu Akses Di Controllermu</h1>';
					exit(0);
				}
				
				$this->load->model('m_access');
				$dbAccess = $this->m_access->get("acc_delete = 0 and ( $allAccess )", false, 1, 0);
				if(count($dbAccess) > 0) return true;				
			}
		}
		
		if(!$this->CI->input->is_ajax_request())
		{
			redirect($restrictedUrl);
		}
		else
		{
			echo base_url() . $restrictedUrl;
			return FALSE;
		}
	}

	public function get_notif(){
		 $id_pegawai = $this->get_pegawai()->id;
		 if($id_pegawai) {
		 	$this->CI->load->model('Suratmasuk_model');
		 	return $this->CI->Suratmasuk_model->get('dis_status = 0 and dis_pegawaitujuan = '.$id_pegawai);
		 }
	}
}

?>