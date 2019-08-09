<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mplg extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mplg_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('Mplg_model');
		// $data['kategori'] = $this->Mplg_model->get('status_kategori = '.STATUS_ACTIVE);
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
      if($_POST['id_plg'] == null || $_POST['id_plg'] == ""){
        $insert_id = $this->Mplg_model->insert(
            $_POST['nm_plg'],$_POST['alm_plg'],$_POST['kota_plg']);
      }
      else {
        $this->Mplg_model->update($_POST['id_plg'],
            $_POST['nm_plg'],$_POST['alm_plg'],$_POST['kota_plg']);
      }
  }
	public function get_detail($id_plg)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Mplg_model->get_by_id($id_plg);
		if($detail != null) ajax_response('ok', NULL, $detail);
		else ajax_response('failed', 'Gagal');
	}
	public function get_by_id()
    {
      $output = array();
      $data = $this->Mplg_model->get('id_plg = '.$_POST["id_plg"]);
      foreach ($data as $row) 
      {
        $output['id_plg'] = $row->id_plg;
        $output['nm_plg'] = $row->nm_plg;
        $output['alm_plg'] = $row->alm_plg;
        $output['kota_plg'] = $row->kota_plg;
      }
      echo json_encode($output);
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
	public function delete($id_plg){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_plg)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Mplg_model->delete($id_plg);
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>