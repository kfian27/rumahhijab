<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class gudang extends CI_Controller {

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
	 * Model untuk select data untuk master
	 */
	 public function __construct() {
		parent::__construct();
		$this->load->database();
		$this->load->helper(array('form', 'url', 'file','download'));
    }
	public function index(){redirect(base_url("admin"));}
	public function b_in()
	{
		// $this->cek_login();
		$this->load->model('mproduk_model');
		$data['produk_detail'] = $this->mproduk_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('gudang/b_in.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function b_out()
	{
		// $this->cek_login();
		$this->load->model('mgudang_model');
		$data['out_detail'] = $this->mgudang_model->get_di_gudang();
		$this->load->view('baseadmin/header.php');
		$this->load->view('gudang/b_out.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function list_b()
	{
		// $this->cek_login();
		$this->load->model('mgudang_model');
		$data['gudang_detail'] = $this->mgudang_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('gudang/list_b.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>