<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class master extends CI_Controller {

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
	public function produk()
	{
		// $this->cek_login();
		$this->load->model('mproduk_model');
		$this->load->model('mcat_model');
		$data['produk_detail'] = $this->mproduk_model->get();
		$data['kategori_detail'] = $this->mcat_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/produk.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function cat_produk()
	{
		// $this->cek_login();
		$this->load->model('mcat_model');
		$data['kategori_detail'] = $this->mcat_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/kategori_produk.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function cabang()
	{
		// $this->cek_login();
		$this->load->model('mcabang_model');
		$data['cabang_detail'] = $this->mcabang_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/cabang.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function user()
	{
		// $this->cek_login();
		$this->load->model('mcabang_model');
		$this->load->model('muser_model');
		$data['cabang_detail'] = $this->mcabang_model->get();
		$data['user_detail'] = $this->muser_model->get();
		$data['level_detail'] = $this->muser_model->get_lvl_user();
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/user.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function pelanggan()
	{
		// $this->cek_login();
		$this->load->model('mplg_model');
		$data['pelanggan_detail'] = $this->mplg_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/pelanggan.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function lvl()
	{
		// $this->cek_login();
		$this->load->model('mlvl_model');
		$data['lvl_detail'] = $this->mlvl_model->get("st_lvl = 1");
		$this->load->view('baseadmin/header.php');
		$this->load->view('master/user_lvl.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
}
?>