<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mcat extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mcat_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('Mcat_model');
		// $data['kategori'] = $this->Mcat_model->get('status_kategori = '.STATUS_ACTIVE);
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
      if($_POST['id_cat'] == null || $_POST['id_cat'] == ""){
        $insert_id = $this->Mcat_model->insert(
            $_POST['nm_cat']);
      }
      else {
        $this->Mcat_model->update($_POST['id_cat'],
            $_POST['nm_cat']);
      }
  }
	public function get_detail($id_cat)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Mcat_model->get_by_id($id_cat);
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
	public function delete($id_cat){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_cat)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Mcat_model->delete($id_cat);
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>