<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class muser extends CI_Controller {
	 //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Muser_model');
      $this->load->helper(array('form', 'url'));
    }

	public function index(){
  		// $this->load->model('Muser_model');
		// $data['muser'] = $this->Muser_model->get('status_muser = '.STATUS_ACTIVE);
		// $this->load->view('admin/index.php');
		// $this->load->view('admin/menu.php');
		// $this->load->view('admin/muser.php',$data);
		// $this->load->view('admin/footer.php');
    redirect(base_url("admin/muser"));
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
      if($_POST['id_user'] == null || $_POST['id_user'] == ""){
      $nama = 'user.png';
      if(!empty($_FILES['ft_user']['tmp_name'])){ 
            $nama=time().$_FILES['ft_user']['name'];
            move_uploaded_file($_FILES['ft_user']['tmp_name'],"./assets/uploads/profil/" . basename($nama));
        }
        $insert_id = $this->Muser_model->insert(
            $_POST['username'],md5($_POST['password']),$nama,$_POST['id_lvl'],$_POST['id_cabang']);
      }
      else {
      $nama = $_POST['fotonya'];
      if(!empty($_FILES['ft_user']['tmp_name'])){ 
            unlink("./assets/uploads/profil/$nama");
            $nama=time().$_FILES['ft_user']['name'];
            move_uploaded_file($_FILES['ft_user']['tmp_name'],"./assets/uploads/profil/" . basename($nama));
        }
        $this->Muser_model->update(
        	$_POST['id_user'],$_POST['username'],$nama,$_POST['id_lvl'],$_POST['id_cabang']);
      }
  }
	public function get_detail($id_user)
	{
		if(!$this->input->is_ajax_request()) show_404();

		$detail = $this->Muser_model->get_by_id($id_user);
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
	public function delete($id_user,$ft_user){
		if(!$this->input->is_ajax_request()) show_404();

		if($id_user)
		{
			/* remove this if want use validate contraint
			if($this->violated_constraint($this->input->post('jns_id'))){
				ajax_response('failed', lang_value('jnsab_constraint_failed'));
			}*/
			//add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
			$this->Muser_model->delete($id_user);
      if($ft_user != 0)unlink("./assets/uploads/profil/$ft_user");
		}
		else
		{
			ajax_response('failed', 'Gagal');
		}
		ajax_response();
	}
}
?>