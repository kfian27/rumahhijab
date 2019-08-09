<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mgudang extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mgudang_model');
      $this->load->model('Mproduk_model');
      $this->load->model('minvoice_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('Mgudang_model');
		// $data['kategori'] = $this->Mgudang_model->get('status_kategori = '.STATUS_ACTIVE);
		// $this->load->view('admin/index.php');
		// $this->load->view('admin/menu.php');
		// $this->load->view('admin/kategori.php',$data);
		// $this->load->view('admin/footer.php');
    redirect(base_url("master/kategori"));
	}

	/*
	 * Get Detail
     * @author Fian Hidayah
	 *
	 * get data detail Survei
	 *
	 * @author	Fian Hidayah
	 * @access	public
	 * @return	void
	 */

	public function coba_insert($keterangan){   
	    if($keterangan == 'masuk'){
	      	$jumlah_stok = $_POST['jumlah_stok'];
	      	$data['detail'] = $this->Mproduk_model->get("id_produk = '".$_POST['id_produk']."'");
	      	foreach ($data['detail'] as $key) {
	      		$jumlah_stok = $jumlah_stok + $key->stok_produk;
	      	}
	        $insert_id = $this->Mgudang_model->masuk($_POST['id_produk'],$_POST['jumlah_stok']);
	        $this->Mproduk_model->update_stok($_POST['id_produk'],$jumlah_stok);
	      }
	      else {
	        $insert_id = $this->Mgudang_model->keluar($_POST['id_produk'],$_POST['jumlah_stok']);
	      }
	}
  public function masuk(){
  		$jumlah_stok = $_POST['jumlah_stok'];
      	$data['detail'] = $this->Mproduk_model->get("id_produk = '".$_POST['id_produk']."'");
      	foreach ($data['detail'] as $key) {
      		$jumlah_stok = $jumlah_stok + $key->stok_produk;
      	}
        $insert_id = $this->Mgudang_model->masuk($_POST['id_produk'],$_POST['jumlah_stok']);
        $this->Mproduk_model->update_stok($_POST['id_produk'],$jumlah_stok);
  }
  	public function keluar($idnya,$id_produk,$ambil,$nomer_invoice){
  		$jumlah_stok = '';
  		$data['detail'] = $this->Mproduk_model->get("id_produk = '".$id_produk."'");
  		foreach ($data['detail'] as $key) {
      		$jumlah_stok = $key->stok_produk - $ambil;
      	}
      	$data['data_invoice'] = $this->minvoice_model->get("id_invoice = ".$nomer_invoice);
      	$nomer_invoicenya = '';
      	foreach ($data['data_invoice'] as $key) {
      		$nomer_invoicenya = $key->no_invoice;
      	}
      	$insert_id = $this->Mgudang_model->keluar($id_produk,$ambil,$nomer_invoicenya);
        $this->Mproduk_model->update_stok($id_produk,$jumlah_stok);
        $this->Mgudang_model->update_di($idnya);
        $row1 = count($this->Mgudang_model->cek_row_di($nomer_invoice));
        $row2 = count($this->Mgudang_model->cek_row_kirim($nomer_invoice));
        if ($row1 == $row2) {
        	$this->minvoice_model->update_kirim($nomer_invoice);
        }
        redirect(base_url("gudang/b_out"));
  	}
	public function get_detail($id_cat)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Mgudang_model->get_by_id($id_cat);
		if($detail != null) ajax_response('ok', NULL, $detail);
		else ajax_response('failed', 'Gagal');
	}
	/**
	 * Delete Survei
     * @author Fian Hidayah
	 *
	 * delete Survei data
	 *
	 * @author	Fian Hidayah
	 * @access	public
	 * @return	void
	 **/
	public function delete($id_cat){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_cat)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Mgudang_model->delete($id_cat);
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>