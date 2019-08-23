<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* This is Example Controller
*/
class laporan extends CI_Controller
{

	function __construct() {
		parent::__construct();
      	$this->load->model('Minvoice_model');
      	$this->load->library('Pdf');
	}
	
	function pdf_hari()
	{
		$tanggal = $this->input->post('tanggal');
		if ($tanggal != ''){
			$harian = $this->Minvoice_model->get_invoicehari($tanggal);
 
	 		$pdf = new FPDF('p', 'mm', 'A4');
    	    $pdf->AddPage();
        	$pdf->SetFont('Arial','B', 12);
        	$pdf->Cell(190,7,'RUMAH HIJAB ALIEFAH',0,1,'C');
	        $pdf->Cell(190,7,'LAPORAN PENJUALAN HARIAN '.$tanggal,0,1,'C');
    	    $pdf->Cell(10,7,'',0,1);
        	$pdf->SetFont('Arial', 'B', 7);
	        $pdf->Cell(20,6,'No Struk',1,0);
	        $pdf->Cell(20,6,'Pelanggan',1,0);
    	    $pdf->Cell(20,6,'Asal',1,0);
        	$pdf->Cell(27,6,'Produk',1,0);
	        $pdf->Cell(17,6,'Satuan',1,0);
	        $pdf->Cell(8,6,'QTY',1,0);
    	    $pdf->Cell(17,6,'Sub total',1,0);
	        $pdf->Cell(17,6,'Diskon',1,0);
        	$pdf->Cell(18,6,'Total',1,0);
    	    $pdf->Cell(27,6,'Tanggal',1,1);
        	$pdf->SetFont('Arial', '', 7);
	        foreach ($harian as $row) {
				$pdf->Cell(20,6,$row->no_invoice,1,0);
				$pdf->Cell(20,6,$row->nm_invoice,1,0);
				$pdf->Cell(20,6,$row->kota_invoice,1,0);
				$pdf->Cell(27,6,$row->nm_produk,1,0);
				$pdf->Cell(17,6,$row->harga_di,1,0);
				$pdf->Cell(8,6,$row->qty_di,1,0);
				$pdf->Cell(17,6,$row->total_di,1,0);
				$pdf->Cell(17,6,$row->diskon_invoice,1,0);
				$pdf->Cell(18,6,$row->harga_invoice,1,0);
				$pdf->Cell(27,6,$row->tgl_invoice,1,1);
        	}
        
        	$pdf->Output();
    	}else{
    		echo "<script>alert('Masukkan tanggal terlebih dahulu');</script>";
    		echo "<script>window.close();</script>";
    	}
	}

	function pdf_minggu()
	{
		$tanggal = $this->input->post('tanggal');
		$harian = $this->Minvoice_model->get_invoicemi($tanggal);
 		
 			$pdf = new FPDF('p', 'mm', 'A4');
    	    $pdf->AddPage();
        	$pdf->SetFont('Arial','B', 12);
        	$pdf->Cell(190,7,'RUMAH HIJAB ALIEFAH',0,1,'C');
	        $pdf->Cell(190,7,'LAPORAN PENJUALAN MULAI TGL '.$tanggal." SAMPAI HARI INI",0,1,'C');
    	    $pdf->Cell(10,7,'',0,1);
        	$pdf->SetFont('Arial', 'B', 7);
	        $pdf->Cell(20,6,'No Struk',1,0);
	        $pdf->Cell(20,6,'Pelanggan',1,0);
    	    $pdf->Cell(20,6,'Asal',1,0);
        	$pdf->Cell(27,6,'Produk',1,0);
	        $pdf->Cell(17,6,'Satuan',1,0);
	        $pdf->Cell(8,6,'QTY',1,0);
    	    $pdf->Cell(17,6,'Sub total',1,0);
	        $pdf->Cell(17,6,'Diskon',1,0);
        	$pdf->Cell(18,6,'Total',1,0);
    	    $pdf->Cell(27,6,'Tanggal',1,1);
        	$pdf->SetFont('Arial', '', 7);
	        foreach ($harian as $row) {
				$pdf->Cell(20,6,$row->no_invoice,1,0);
				$pdf->Cell(20,6,$row->nm_invoice,1,0);
				$pdf->Cell(20,6,$row->kota_invoice,1,0);
				$pdf->Cell(27,6,$row->nm_produk,1,0);
				$pdf->Cell(17,6,$row->harga_di,1,0);
				$pdf->Cell(8,6,$row->qty_di,1,0);
				$pdf->Cell(17,6,$row->total_di,1,0);
				$pdf->Cell(17,6,$row->diskon_invoice,1,0);
				$pdf->Cell(18,6,$row->harga_invoice,1,0);
				$pdf->Cell(27,6,$row->tgl_invoice,1,1);

	 		}
        
        	$pdf->Output();
	}

	function pdf_bulan()
	{
		$tahun = $this->input->post('tahun');
		$bulan = $this->input->post('bulan');
		$harian = $this->Minvoice_model->get_invoicebu($tahun,$bulan);
 		
 			$pdf = new FPDF('p', 'mm', 'A4');
    	    $pdf->AddPage();
        	$pdf->SetFont('Arial','B', 12);
        	$pdf->Cell(190,7,'RUMAH HIJAB ALIEFAH',0,1,'C');
	        $pdf->Cell(190,7,'LAPORAN PENJUALAN BULAN '.$bulan." TAHUN ".$tahun,0,1,'C');
    	    $pdf->Cell(10,7,'',0,1);
        	$pdf->SetFont('Arial', 'B', 7);
	        $pdf->Cell(20,6,'No Struk',1,0);
	        $pdf->Cell(20,6,'Pelanggan',1,0);
    	    $pdf->Cell(20,6,'Asal',1,0);
        	$pdf->Cell(27,6,'Produk',1,0);
	        $pdf->Cell(17,6,'Satuan',1,0);
	        $pdf->Cell(8,6,'QTY',1,0);
    	    $pdf->Cell(17,6,'Sub total',1,0);
	        $pdf->Cell(17,6,'Diskon',1,0);
        	$pdf->Cell(18,6,'Total',1,0);
    	    $pdf->Cell(27,6,'Tanggal',1,1);
        	$pdf->SetFont('Arial', '', 7);
	        foreach ($harian as $row) {
				$pdf->Cell(20,6,$row->no_invoice,1,0);
				$pdf->Cell(20,6,$row->nm_invoice,1,0);
				$pdf->Cell(20,6,$row->kota_invoice,1,0);
				$pdf->Cell(27,6,$row->nm_produk,1,0);
				$pdf->Cell(17,6,$row->harga_di,1,0);
				$pdf->Cell(8,6,$row->qty_di,1,0);
				$pdf->Cell(17,6,$row->total_di,1,0);
				$pdf->Cell(17,6,$row->diskon_invoice,1,0);
				$pdf->Cell(18,6,$row->harga_invoice,1,0);
				$pdf->Cell(27,6,$row->tgl_invoice,1,1);

	 		}
        
        	$pdf->Output();
	}

	
}
