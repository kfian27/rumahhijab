<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * class ini untuk menghandle page home coba
 */
class login extends CI_Controller {
	 //constructor class
    public function __construct() {
		parent::__construct();
		$this->load->model('Muser_model');
		$this->load->model('login_model');
		$this->load->helper(array('url'));
    }
	public function index()
	{
		if ($this->session->userdata('name')!=null){
			redirect(base_url("admin"));
		}
		else{
			$this->load->view('baseadmin/login.php');
		}
	}
	function masuk(){
		$username = trim($this->input->post('username'));
		$password = trim(md5($this->input->post('password')));
		$data['status'] = $this->login_model->cek_login($username,$password);
		$id_user = "";
		$foto_user = "";
		$last="";
		$level="";
		$cabang="";
		if(!empty($data['status'])){
			foreach ($data['status'] as $row){
				$id_user = $row->id_user;
				$foto_user = $row->ft_user;
				$last=$row->last_user;
				$level=$row->id_lvl;
				$cabang=$row->id_cabang;
			}
		// $cek = $this->login_model->cek_login($username,$password)->num_rows()
			$session_user = array(
				'pass'=>$password,
				'id'=>$id_user,
				'name'=>$username,
				'last'=>$last,
				'foto'=>$foto_user,
				'level'=>$level,
				'cabang'=>$cabang); 
			$this->session->set_userdata($session_user);
			// echo $level;
			if($level=='1' || $level=='2'){
				redirect(base_url("admin"));
			}elseif ($level=="3") {
				redirect(base_url("gudang/list_b"));
			}
			elseif ($level=="4") {
				redirect(base_url("invoice/l_invoice"));
			}
		}
		else{
			echo ("<script language='javascript'>alert('Invalid username or password');document.location='../'</script>");
		}
	}
	function log_out(){
		$this->Muser_model->last_sign($this->session->userdata('id'));
		$this->session->sess_destroy();
		redirect(base_url());
	}
}
?>