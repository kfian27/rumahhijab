<?php
require APPPATH . 'libraries\escpos-php\autoload.php';
use Mike42\Escpos\Printer;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\EscposImage;

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
		$this->load->model('Mgudang_model');
		$this->load->model('Mproduk_model');
		$this->load->model('Muser_model');
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
		$this->load->model('login_model');
		$data['j_tr'] = $this->login_model->j_tr();
		$data['totalsemuainvoice_c'] = $this->minvoice_model->get_totalsemuainvoice_c();
		$data['totalproduk_c'] = $this->minvoice_model->get_totalproduk_c();
		$data['produkmasuk_c'] = $this->minvoice_model->get_produkmasuk_c();
		$data['invoice_detail_c'] = $this->minvoice_model->get_c();
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
	public function cek_login(){
		if ($this->session->userdata('name')==null){
			redirect(base_url("admin/login"));
		}	
	}
	function save_tmp()
	{
		$id_produk = (int)$this->input->post('id_produk');
		$qty = (int)$this->input->post('qty');
		$harga = (int)$this->input->post('harga_produk');
		$harga_total = ((int)$this->input->post('harga_produk')*$qty);
			$save_data = array(
	          	'id_produk'   	=> $id_produk,
	          	'id_invoice'    => $this->session->userdata('id'),
	          	'harga_di'		=> $harga,
	          	'qty_di'		=> $qty,
	          	'total_di'		=> $harga_total,
	          	'st_di'   		=> STATUS_ACTIVE
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
    	$totalh = $this->input->post('totalHidden');
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
    		$insert_id = $this->minvoice_model->insert($no_invoice, $this->input->post('nm_plg'),$this->input->post('alm_plg'),$this->input->post('kota_plg'),$this->input->post('bayar'),$totalnya,$this->input->post('diskon'),$totalh,$status_bayar);
    	}
    	$data = $this->minvoice_model->get_tmp_all();
    	foreach ($data as $row) 
      	{
      		$save_data = array(
      			'id_produk'			=> $row->id_produk,
				'id_invoice'			=> $insert_id,
				'harga_di'		=> $row->harga_di,
				'qty_di'		=> $row->qty_di,
				'total_di'		=> $row->total_di,
				'st_di'		=> "gudang"
      		);
      		$idnya = $this->minvoice_model->save_dt($save_data);
      		$this->keluar($idnya,$row->id_produk,$row->qty_di,$no_invoice);
      	}
      	$this->print_nota($no_invoice,$insert_id);
      	$this->load->library('session');
      	$this->session->set_tempdata('no_invoice', $no_invoice, 7200);
      	$this->minvoice_model->delete_tmp();
		redirect('invoice/t_invoice');
    }

    function print_nota($no_invoice,$insert_id)
    {
    	$Pelanggan = ''; $NO = ''; $Tagihan_Awal = ''; $Diskon = ''; $Tagihan_Akhir = ''; $Bayar = ''; $TGL = ''; $Kasir = '';
    	$data = $this->minvoice_model->print("no_invoice = '".$no_invoice."'");
    	foreach ($data as $row) {
    		$NO = $row->no_invoice; $Pelanggan = $row->nm_invoice; 
    		$Tagihan_Awal = $row->tagihan_invoice;
    		$Diskon = $row->diskon_invoice;
    		$Tagihan_Akhir = $row->harga_invoice;
    		$Bayar = $row->byr_invoice;
    		$TGL = $row->tgl_invoice;
    		$Kasir = $row->name_user;
    	}
    	$Produk = ''; $QTY = ''; $Harga_Satuan = '';
    	$plg = $this->minvoice_model->get_detail($insert_id);
    		foreach ($plg as $key) {
    			$Produk = $key->nm_produk;
    			$QTY = $key->qty_di;
    			$Harga_Satuan = $key->harga_di;
    		}
		try {
			// Enter the device file for your USB printer here
	  		$connector = new WindowsPrintConnector("XP-58");
		   
			/* Print a "Hello world" receipt" */
			$printer = new Printer($connector);
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text("RUMAH HIJAB ALIEFAH\n");
			// $printer -> text("--------------------------------\n");
			// $printer -> text("Jl. Medayu Utara XXX D4-No. 4\n");
			$printer -> text("Sidokare - Sidoarjo - SDA\n");
			// $printer -> text("Telp. 0857-3142-2142\n");
			$printer -> text("--------------------------------\n");
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("No.       : ");
			$printer -> text($no_invoice."\n");
			$printer -> text("Tanggal   : ");
			$printer -> text(date('d-m-Y H:i:s')."\n");
			$printer -> text("Kasir     : ");
			$printer -> text($Kasir."\n");
			$printer -> text("Pelanggan : ");
			$printer -> text($Pelanggan."\n");
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("Hijab/Krudung      QTY     Harga\n");
    			$printer -> text($Produk);
    			$printer -> setJustification(Printer::JUSTIFY_RIGHT);
    			$printer -> text(sprintf("%6d", $QTY)."  ");
    			$printer -> text(sprintf("%10d",$Harga_Satuan)."\n");
			$printer -> feed();
			$printer -> setJustification(Printer::JUSTIFY_LEFT);
			$printer -> text("  Tagihan Awal  :     ");
			$printer -> text(sprintf("%10d",$Tagihan_Awal)."\n");
			$printer -> text("  Diskon (Rp.)  :     ");
			$printer -> text(sprintf("%10d",$Diskon)."\n");
			$printer -> text("  ----------------------------.-\n");
			$printer -> text("  Tagihan Akhir :     ");
			$printer -> text(sprintf("%10d",$Tagihan_Akhir)."\n");
			$printer -> text("  Tunai         :     ");
			$printer -> text(sprintf("%10d",$Bayar)."\n");
			$printer -> text("  Kembalian     :     ");
			$printer -> text(sprintf("%10d",(int)$Bayar - (int)$Tagihan_Akhir)."\n");
			$printer -> setJustification(Printer::JUSTIFY_CENTER);
			$printer -> text("Terima Kasih Telah Belanja di\n");
			$printer -> text("RUMAH HIJAB ALIEFAH\n");
			$printer -> text("*Barang yang sudah dibeli\n");
			$printer -> text(" tidak dapat dikembalikan\n");
			$printer -> feed(3);

			/* Close printer */
			$printer -> close();
		} catch (Exception $e) {
			echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
		}
    }

    public function keluar($idnya,$id_produk,$ambil,$nomer_invoice){
  		$jumlah_stok = '';
  		$data['detail'] = $this->Mproduk_model->get("id_produk = '".$id_produk."'");
  		foreach ($data['detail'] as $key) {
      		$jumlah_stok = $key->stok_produk - $ambil;
      	}
      	$data['data_invoice'] = $this->minvoice_model->get("no_invoice = '".$nomer_invoice."'");
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
        // redirect(base_url("gudang/b_out"));
  	}

    //Harian
    public function ha_invoice()
	{
		$this->cek_login();
		$this->load->model('mcat_model');
		$data['kategori_detail'] = $this->mcat_model->get();
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/ha_invoice.php', $data);
		$this->load->view('baseadmin/footer.php');
	}
	public function get_invoicehari()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_invoicehari($tgl);
	    echo json_encode($detail);
	  }
	  public function get_invoiceharii()
	  {
	    $tgl = $this->input->post("tgl");
	    $cat = $this->input->post("cat");
	    $detail = $this->minvoice_model->get_invoiceharii($tgl,$cat);
	    echo json_encode($detail);
	  }
	  public function get_invoicehari1()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_totalsemuainvoice_h($tgl);
	    echo json_encode($detail);
	  }
	  public function get_invoicehari2()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->j_trha($tgl);
	    echo json_encode($detail);
	  }
	   public function get_invoicehari3()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_totalproduk_ha($tgl);
	    echo json_encode($detail);
	  }
	   public function get_invoicehari4()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_produkmasuk_ha($tgl);
	    echo json_encode($detail);
	  }

	  //Mingguan
    public function mi_invoice()
	{
		$this->cek_login();
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/mi_invoice.php');
		$this->load->view('baseadmin/footer.php');
	}
	public function get_invoicemi()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_invoicemi($tgl);
	    echo json_encode($detail);
	  }
	public function get_invoicemi1()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_totalsemuainvoice_mi($tgl);
	    echo json_encode($detail);
	  }
	  public function get_invoicemi2()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->j_trmi($tgl);
	    echo json_encode($detail);
	  }
	   public function get_invoicemi3()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_totalproduk_mi($tgl);
	    echo json_encode($detail);
	  }
	   public function get_invoicemi4()
	  {
	    $tgl = $this->input->post("tgl");
	    $detail = $this->minvoice_model->get_produkmasuk_mi($tgl);
	    echo json_encode($detail);
	  }

	  //Bulanan
    public function bu_invoice()
	{
		$this->cek_login();
		$this->load->view('baseadmin/header.php');
		$this->load->view('invoice/bu_invoice.php');
		$this->load->view('baseadmin/footer.php');
	}
	public function get_invoicebu()
	  {
	    $tah = $this->input->post("tah");
	    $bul = $this->input->post("bul");
	    $detail = $this->minvoice_model->get_invoicebu($tah,$bul);
	    echo json_encode($detail);
	  }
	  public function get_invoicebu1()
	  {
	    $tah = $this->input->post("tah");
	    $bul = $this->input->post("bul");
	    $detail = $this->minvoice_model->get_totalsemuainvoice_bu($tah,$bul);
	    echo json_encode($detail);
	  }
	  public function get_invoicebu2()
	  {
	    $tah = $this->input->post("tah");
	    $bul = $this->input->post("bul");
	    $detail = $this->minvoice_model->j_trbu($tah,$bul);
	    echo json_encode($detail);
	  }
	   public function get_invoicebu3()
	  {
	    $tah = $this->input->post("tah");
	    $bul = $this->input->post("bul");
	    $detail = $this->minvoice_model->get_totalproduk_bu($tah,$bul);
	    echo json_encode($detail);
	  }
	   public function get_invoicebu4()
	  {
	    $tah = $this->input->post("tah");
	    $bul = $this->input->post("bul");
	    $detail = $this->minvoice_model->get_produkmasuk_bu($tah,$bul);
	    echo json_encode($detail);
	  }

	  //Tahunan
	public function get_invoiceta()
	  {
	    $tah = $this->input->post("tah");
	    $detail = $this->minvoice_model->get_invoiceta($tah);
	    echo json_encode($detail);
	  }
	  public function get_invoiceta1()
	  {
	    $tah = $this->input->post("tah");
	    $detail = $this->minvoice_model->get_totalsemuainvoice_ta($tah);
	    echo json_encode($detail);
	  }
	  public function get_invoiceta2()
	  {
	    $tah = $this->input->post("tah");
	    $detail = $this->minvoice_model->j_trta($tah);
	    echo json_encode($detail);
	  }
	   public function get_invoiceta3()
	  {
	    $tah = $this->input->post("tah");
	    $detail = $this->minvoice_model->get_totalproduk_ta($tah);
	    echo json_encode($detail);
	  }
	   public function get_invoiceta4()
	  {
	    $tah = $this->input->post("tah");
	    $detail = $this->minvoice_model->get_produkmasuk_ta($tah);
	    echo json_encode($detail);
	  }

	public function cek(){
    $produk= $this->input->post("produk");
    $detail = $this->minvoice_model->cek($produk);
    echo json_encode($detail);
  	}

}
?>