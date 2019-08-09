<?php
/**
 * class untuk handle survei
 * @author Fian Hidayah
 */
class mlvl extends CI_Controller {
   //constructor class
    public function __construct() {
      parent::__construct();
      //if(!$this->auth->validate(true)) exit(0);
      $this->load->model('Mlvl_model');
      $this->load->helper(array('form', 'url'));
    }

  public function index(){
      // $this->load->model('Mlvl_model');
    // $data['kategori'] = $this->Mlvl_model->get('status_kategori = '.STATUS_ACTIVE);
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
   * @author  Fian Hidayah
   * @access  public
   * @return  void
   */

  public function coba_insert(){   
      if($_POST['id_lvl'] == null || $_POST['id_lvl'] == ""){
        $insert_id = $this->Mlvl_model->insert(
            $_POST['nm_lvl']);
      }
      else {
        $this->Mlvl_model->update($_POST['id_lvl'],
            $_POST['nm_lvl']);
      }
  }
  public function get_detail($id_lvl)
  {
    if(!$this->input->is_ajax_request()) show_404();

    $detail = $this->Mlvl_model->get_by_id($id_lvl);
    if($detail != null) ajax_response('ok', NULL, $detail);
    else ajax_response('failed', 'Gagal');
  }
  public function get_by_id()
    {
      $output = array();
      $data = $this->Mlvl_model->get('id_lvl = '.$_POST["id_lvl"]);
      foreach ($data as $row) 
      {
        $output['id_lvl'] = $row->id_lvl;
        $output['nm_lvl'] = $row->nm_lvl;
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
   * @author  Fian Hidayah
   * @access  private
   * @return  void
   */



  /**
   * Delete Survei
     * @author Fian Hidayah
   *
   * delete Survei data
   *
   * @author  Fian Hidayah
   * @access  public
   * @return  void
   **/
  public function delete($id_lvl){
    if(!$this->input->is_ajax_request()) show_404();

    if($id_lvl)
    {
      /* remove this if want use validate contraint
      if($this->violated_constraint($this->input->post('jns_id'))){
        ajax_response('failed', lang_value('jnsab_constraint_failed'));
      }*/
      //add_individual_data_log('Mjnssrt_model', $this->input->post('jns_id'), array('fld_uri'));
      $this->Mlvl_model->delete($id_lvl);
    }
    else
    {
      ajax_response('failed', 'Gagal');
    }
    ajax_response();
  }
}
?>