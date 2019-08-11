<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see https://codeigniter.com/user_guide/general/urls.html
	 */
	 /**
     * @author Fian Hidayah
	 * Model untuk select data untuk home
	 */
	 public function __construct() {
		parent::__construct();
		$this->load->model('mgudang_model');
		// $this->load->model('promethee_model');
		$this->db_evin = $this->load->database('hijab', TRUE);
		$this->load->helper(array('form', 'url', 'file','download'));
    }
	public function index()
	{
		// $this->cek_login();
		// $this->login();
		$this->load->model('login_model');
		$this->load->model('mgudang_model');
		$data['j_tr'] = $this->login_model->j_tr();
		$data['j_proses'] = $this->login_model->j_proses();
		$data['m_brg'] = $this->login_model->most_brg();
		// $data['prioritas_lalu'] = $this->rangking("lalu");
		// $data['prioritas_skr'] = $this->rangking("skr");
		// print_r($data['prioritas_skr']);
		// print_r($data['prioritas_lalu']);
		$this->load->view('baseadmin/header.php');
		$this->load->view('baseadmin/home.php',$data);
		$this->load->view('baseadmin/footer.php');
		
	}
	public function login(){
		if ($this->session->userdata('name')==null){
			$this->load->view('baseadmin/login.php');
		}
		else{
			if($this->session->userdata('level')=='1' || $this->session->userdata('level')=='2'){
				redirect(base_url("admin"));
			}
			elseif ($this->session->userdata('level')=="3") {
				redirect(base_url("invoice/t_invoice"));
			}
			// elseif ($this->session->userdata('level')=="4") {
			// 	redirect(base_url("invoice/l_invoice"));
			// }
		}
	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>