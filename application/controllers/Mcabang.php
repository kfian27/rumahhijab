<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mcabang extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mcabang_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('Mcabang_model');
		// $data['kategori'] = $this->Mcabang_model->get('status_kategori = '.STATUS_ACTIVE);
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

  public function coba_insert(){   
      if($_POST['id_cabang'] == null || $_POST['id_cabang'] == ""){
        $insert_id = $this->Mcabang_model->insert(
            $_POST['nm_cabang'],$_POST['loc_cabang']);
      }
      else {
        $this->Mcabang_model->update($_POST['id_cabang'],
            $_POST['nm_cabang'],$_POST['loc_cabang']);
      }
  }
	public function get_detail($id_cabang)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Mcabang_model->get_by_id($id_cabang);
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
	public function delete($id_cabang){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_cabang)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Mcabang_model->delete($id_cabang);
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>