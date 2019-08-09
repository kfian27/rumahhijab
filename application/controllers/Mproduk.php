<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mproduk extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mproduk_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('mproduk_model');
		// $data['mproduk'] = $this->mproduk_model->get('status_mproduk = '.STATUS_ACTIVE);
		// $this->load->view('admin/index.php');
		// $this->load->view('admin/menu.php');
		// $this->load->view('admin/mproduk.php',$data);
		// $this->load->view('admin/footer.php');
    redirect(base_url("admin/mproduk"));
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

  public function coba_insert(){   
      if($_POST['id_produk'] == null || $_POST['id_produk'] == ""){
      $nama = 'user.png';
      if(!empty($_FILES['ft_produk']['tmp_name'])){ 
            $nama=time().$_FILES['ft_produk']['name'];
            move_uploaded_file($_FILES['ft_produk']['tmp_name'],"./assets/uploads/produk/" . basename($nama));
        }
        $insert_id = $this->Mproduk_model->insert(
            $_POST['id_cat'],$_POST['nm_produk'],'0',$_POST['harga_produk'],$_POST['beli_produk'],$nama);
      }
      else {
      $nama = $_POST['fotonya'];
      if(!empty($_FILES['ft_produk']['tmp_name'])){ 
            unlink("./assets/uploads/profil/$nama");
            $nama=time().$_FILES['ft_produk']['name'];
            move_uploaded_file($_FILES['ft_produk']['tmp_name'],"./assets/uploads/produk/" . basename($nama));
        }
        $this->Mproduk_model->update(
        	$_POST['id_produk'],$_POST['id_cat'],$_POST['nm_produk'],$_POST['harga_produk'],$_POST['beli_produk'],$nama);
      }
  }
	public function get_detail($id_produk)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Mproduk_model->get_by_id($id_produk);
		if($detail != null) ajax_response('ok', NULL, $detail);
		else ajax_response('failed', 'Gagal');
	}

	/*
	 * Save method
     * @author Fian Hidayah
	 *
	 * insert/update survei data
	 *
	 * @author	Fian Hidayah
	 * @access	private
	 * @return	void
	 */



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
	public function delete($id_produk,$ft_produk){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_produk)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Mproduk_model->delete($id_produk);
      if($ft_produk != 0)unlink("./assets/uploads/profil/$ft_produk");
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>