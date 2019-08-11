<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class invoice extends CI_Controller {

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
		$this->load->model('minvoice_model');
		$this->load->helper(array('form', 'url', 'file','download'));
    }
	public function index(){redirect(base_url("admin"));}
	public function t_invoice()
	{
		$this->cek_login();
		$this->load->model('mplg_model');
		$this->load->model('mproduk_model');
		$data['produk_detail'] = $this->mproduk_model->get();
		$data['pelanggan_detail'] = $this->mplg_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/invoice.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function l_invoice()
	{
		$this->cek_login();
		$data['totalsemuainvoice'] = $this->minvoice_model->get_totalsemuainvoice();
		$data['invoice_detail'] = $this->minvoice_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/l_invoice.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function c_invoice()
	{
		$this->cek_login();
		$data['totalsemuainvoice_c'] = $this->minvoice_model->get_totalsemuainvoice_c();
		$data['invoice_detail_c'] = $this->minvoice_model->get_c('DATE(tgl_invoice) = CURDATE();');
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/c_invoice.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function d_invoice($nomer_invoice){
		$this->cek_login();
		$data['invoice_detail'] = $this->minvoice_model->get_di_all($nomer_invoice);
		$data['data_invoice'] = $this->minvoice_model->get("id_invoice = ".$nomer_invoice);
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/d_invoice.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function ha_invoice()
	{
		$this->cek_login();
		$data['invoice_detailhari'] = $this->minvoice_model->get_detailhari('DATE(tgl_invoice)  = "2019-08-10"');
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/ha_invoice.php',$data);
		$this->load->view('baseadmin/footer.php');
	}
	public function get_invoicehari()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_invoicehari($tgl);
	    echo json_encode($detail);
	  }
	
	function pdf_hari()
	{
		$tanggal = $this->input->post('date');
		if ($tanggal != ''){
			$harian = $this->mlaporan->harian($tanggal);
 
	 		$pdf = new FPDF('p', 'mm', 'A4');
    	    $pdf->AddPage();
        	$pdf->SetFont('Arial','B', 12);
        	$pdf->Cell(190,7,'IKA KAIN KILOAN',0,1,'C');
	        $pdf->Cell(190,7,'LAPORAN PENJUALAN KAIN '.$tanggal,0,1,'C');
    	    $pdf->Cell(10,7,'',0,1);
        	$pdf->SetFont('Arial', 'B', 7);
	        $pdf->Cell(30,6,'Tanggal',1,0);
    	    $pdf->Cell(30,6,'Tanggal Bayar',1,0);
        	$pdf->Cell(30,6,'Kain',1,0);
	        $pdf->Cell(10,6,'QTY',1,0);
    	    $pdf->Cell(13,6,'Harga',1,0);
        	$pdf->Cell(28,6,'Pelanggan',1,0);
	        $pdf->Cell(23,6,'Ekspedisi',1,0);
    	    $pdf->Cell(30,6,'Status',1,1);
        	$pdf->SetFont('Arial', '', 7);
	        foreach ($harian as $row) {
				$pdf->Cell(30,6,$row->TR_TGL,1,0);
				$pdf->Cell(30,6,$row->TR_TGLBYR,1,0);
				$pdf->Cell(30,6,$row->KN_NAMA,1,0);
				$pdf->Cell(10,6,$row->DT_QTY,1,0);
				$pdf->Cell(13,6,$row->DT_HARGA,1,0);
				$pdf->Cell(28,6,$row->PLG_NAMA,1,0);
				$pdf->Cell(23,6,$row->ESK_NAMA,1,0);
				if ($row->TR_STATUS == 1) {
    	        	$pdf->Cell(30,6,'Menunggu Pembayaran',1,1); 
				} elseif ($row->TR_STATUS == 2) {
					$pdf->Cell(30,6,'Terbayar',1,1);
				} elseif ($row->TR_STATUS == 3) {
					$pdf->Cell(30,6,'Proses Pengiriman',1,1);
				} elseif ($row->TR_STATUS == 4) {
					$pdf->Cell(30,6,'Terkirim',1,1);
				} elseif ($row->TR_STATUS == 5) {
        			$pdf->Cell(30,6,'Dibatalkan',1,1);
				}
        	}
        
        	$pdf->Output();
    	}else{
    		echo "<script>alert('Masukkan tanggal terlebih dahulu');</script>";
    		echo "<script>window.close();</script>";
    	}
		

	}
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
	function save_tmp()
	{
		$id_produk = (int)$this->input->post('id_produk');
		$qty = (int)$this->input->post('qty');
		$harga_produk = ((int)$this->input->post('harga_produk')*$qty);
        $save_data = array(
          	'id_produk'   		=> $id_produk,
          	'id_invoice'      	=> $this->session->userdata('id'),
          	'qty_di'		=> $qty,
          	'total_di'		=> $harga_produk,
          	'st_di'   	=> STATUS_ACTIVE
        );
        $this->minvoice_model->save_tmp($save_data);
	}

	function get_tmp()
	{
		echo $this->minvoice_model->get_tmp();
	}

	function del_tmp()
	{
		echo $this->minvoice_model->del_tmp($this->input->post('id_di'));
	}

	function get_harga()
	{
		$output = array();
      	$data = $this->minvoice_model->get_harga();
      	foreach ($data as $row) 
      	{
        	$output['DT_TOTAL'] = $row->DT_TOTAL;
      	}
      	echo json_encode($output);
	}
	

	public function action()
    {
    	$tglnya = date('y/m/d');
    	$data = $this->minvoice_model->get_trid($tglnya);
    	$no_invoice = '';
    	$totalnya = $this->input->post('harga_invoice');
    	foreach ($data as $row) {
    		$nomernya = (int) substr($row->no_max, 9, 3);
    		$nomernya++;
    		if ($row->no_max == null || $row->no_max == ''){
    			$no_invoice = $tglnya."/001";
    		}
    		else{
    			$no_invoice = substr($row->no_max,0,9).sprintf("%03s",$nomernya);
    		}
    	}
    	if ($this->input->post('pelanggan') != '')
    	{
    		$status_bayar = "Lunas";
    		if ($this->input->post('bayar')<$totalnya) {
    			$status_bayar = "Belum lunas";
    		}
    		$insert_id = $this->minvoice_model->insert($no_invoice, $this->input->post('nm_plg'),$this->input->post('alm_plg'),$this->input->post('kota_plg'),$this->input->post('bayar'),$totalnya,$this->input->post('diskon'),$status_bayar);
    	}
    	$data = $this->minvoice_model->get_tmp_all();
    	foreach ($data as $row) 
      	{
      		$save_data = array(
      			'id_produk'			=> $row->id_produk,
				'id_invoice'			=> $insert_id,
				'qty_di'		=> $row->qty_di,
				'total_di'		=> $row->total_di,
				'st_di'		=> "gudang"
      		);
      		$this->minvoice_model->save_dt($save_data);
      	}
      	$this->minvoice_model->delete_tmp();
		redirect('invoice/t_invoice');
    }
}
?>