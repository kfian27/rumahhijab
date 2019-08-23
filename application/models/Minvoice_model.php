<?php
	class minvoice_model extends CI_Model {

		function __construct() {
			// Call the Model constructor
			parent:: __construct();
			$this->db = $this->load->database('hijab', TRUE);
			//set waktu yang digunakan ke zona jakarta
			//$this->db->query("SET time_zone='Asia/Jakarta'");
		}
		public function select($selectcolumn=true){
	    	if($selectcolumn){
		    	$this->db->select('id_invoice');
		    	$this->db->select('id_user');
		    	$this->db->select('no_invoice');
		    	$this->db->select('nm_invoice');
		    	$this->db->select('alm_invoice');
		    	$this->db->select('kota_invoice');
		    	$this->db->select('byr_invoice');
		    	$this->db->select('harga_invoice');
		    	$this->db->select('diskon_invoice');
		    	$this->db->select('tgl_invoice');
	    	}
            	$this->db->from('invoice');
		}
		function get($where = "", $order = "", $limit=null, $offset=null, $selectcolumn = true){
  			 $this->select($selectcolumn);
  			 if($limit != null) $this->db->limit($limit, $offset);
  			 if($where != "") $this->db->where($where);
  			 $this->db->order_by($order);
  			 $query = $this->db->get();
  			 return $query->result();
        }
        function cek($produk){
			$sql= "select * from produk where id_produk = '$produk'";
			$query= $this->db->query($sql);
			return $query->result();
		}
        
        function insert($no_invoice=false,$nm_invoice=false,$alm_invoice=false,$kota_invoice=false,$byr_invoice=false,$harga_invoice=false,$diskon_invoice=false,$tagihan_invoice=false,$status_bayar=false)
		{
			$data = array();
			if($no_invoice !== false)$data['no_invoice'] = trim($no_invoice);
			if($nm_invoice !== false)$data['nm_invoice'] = trim($nm_invoice);
			if($alm_invoice !== false)$data['alm_invoice'] = trim($alm_invoice);
			if($kota_invoice !== false)$data['kota_invoice'] = trim($kota_invoice);
			if($harga_invoice !== false)$data['harga_invoice'] = trim($harga_invoice);
			if($byr_invoice !== false)$data['byr_invoice'] = trim($byr_invoice);
			if($diskon_invoice !== false)$data['diskon_invoice'] = trim($diskon_invoice);
			if($tagihan_invoice !== false)$data['tagihan_invoice'] = trim($tagihan_invoice);
			if($status_bayar !== false)$data['status_bayar'] = trim($status_bayar);
			$data['tgl_invoice'] = now();
			$data['id_user']= $this->session->userdata('id');
			$data['st_invoice'] = "Proses Gudang";
			$this->db->insert('invoice', $data);
			return $this->db->insert_id();
		}
		function delete_tmp()
		{
			$param= $this->session->userdata('id');
			$sql = "DELETE FROM detail_invoice_tmp WHERE id_invoice = $param";
			$this->db->query($sql);
		}
		function save_tmp($data){
			$this->db->insert('detail_invoice_tmp', $data);
		}

		function save_tr($data){
			$this->db->insert('invoice', $data);
		}

		function save_dt($data){
			$this->db->insert('detail_invoice', $data);
		}		

		function get_trid($no_invoice){
        	$sql = "SELECT MAX(no_invoice) AS no_max FROM invoice WHERE no_invoice LIKE '%$no_invoice%'";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_tmp(){
			$this->db->select('dt.id_produk');
			$this->db->select('id_di');
			$this->db->select('nm_produk');
			$this->db->select('harga_produk');
			$this->db->select('harga3_produk');
			$this->db->select('harga6_produk');
			$this->db->select('harga10_produk');
			$this->db->select('harga20_produk');
			$this->db->select('qty_di');
			$this->db->select('total_di');
			$this->db->from('detail_invoice_tmp dt');
			$this->db->join('produk k', 'k.id_produk = dt.id_produk');
			$query = $this->db->get();
			$output = '<tr></tr>';
			$i = 0;
			foreach ($query->result() as $row) {
				$i++;
				if($row->qty_di < 3){
					$output .= '<tr><td>'.$i.'</td><td>'.$row->nm_produk.'</td><td>'.$row->harga_produk.'</td><td>'.$row->qty_di.'</td><td>'.$row->total_di.'</td><td><button id="del" dt-id="'.$row->id_di.'" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td></tr>';
				}
				elseif($row->qty_di >= 3 && $row->qty_di < 6){
					$output .= '<tr><td>'.$i.'</td><td>'.$row->nm_produk.'</td><td>'.$row->harga3_produk.'</td><td>'.$row->qty_di.'</td><td>'.$row->total_di.'</td><td><button id="del" dt-id="'.$row->id_di.'" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td></tr>';
				}
				elseif($row->qty_di >= 6 && $row->qty_di < 10){
					$output .= '<tr><td>'.$i.'</td><td>'.$row->nm_produk.'</td><td>'.$row->harga6_produk.'</td><td>'.$row->qty_di.'</td><td>'.$row->total_di.'</td><td><button id="del" dt-id="'.$row->id_di.'" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td></tr>';
				}
				elseif($row->qty_di >= 10 && $row->qty_di < 20){
					$output .= '<tr><td>'.$i.'</td><td>'.$row->nm_produk.'</td><td>'.$row->harga10_produk.'</td><td>'.$row->qty_di.'</td><td>'.$row->total_di.'</td><td><button id="del" dt-id="'.$row->id_di.'" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td></tr>';
				}
				elseif($row->qty_di >= 20){
					$output .= '<tr><td>'.$i.'</td><td>'.$row->nm_produk.'</td><td>'.$row->harga20_produk.'</td><td>'.$row->qty_di.'</td><td>'.$row->total_di.'</td><td><button id="del" dt-id="'.$row->id_di.'" type="button" class="btn btn-danger btn-xs"><i class="fa fa-times"></i></button></td></tr>';
				}
				
			}

			return $output;
		}
		function get_tmp_all(){
			$this->db->where('id_invoice', $this->session->userdata('id'));
			$query = $this->db->get('detail_invoice_tmp');
			return $query->result();
		}

		function get_harga(){
			$sql = "select sum(total_di) as DT_TOTAL FROM detail_invoice_tmp";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_totalsemuainvoice(){
			$sql = "select SUM(harga_invoice) AS total FROM invoice";
			$query = $this->db->query($sql);
			return $query->result();
		}

		function get_totalsemuainvoice_c(){
			$sql = "SELECT SUM(harga_invoice) AS total FROM invoice WHERE DATE(tgl_invoice) = CURDATE();";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_totalproduk_c(){
			$sql = "SELECT SUM(qty_di) AS total from detail_invoice AS di JOIN invoice AS i ON di.id_invoice=i.id_invoice WHERE DATE(tgl_invoice) = CURDATE();";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_produkmasuk_c(){
			$sql = "SELECT SUM(jumlah_stok) AS total from gudang WHERE DATE(up_gudang) = CURDATE() AND keterangan LIKE '%masuk'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function del_tmp($id_di){
			$this->db->where('id_di', $id_di);
			$this->db->delete('detail_invoice_tmp');
		}

		function get_detail($id_invoice)
        {
			$this->db->select('id_di');
			$this->db->select('nm_produk');
			$this->db->select('harga_produk');
			$this->db->select('qty_di');
			$this->db->select('total_di');
			$this->db->where('id_invoice', $id_invoice);
			$this->db->from('detail_invoice dt');
			$this->db->join('produk k', 'k.id_produk = dt.id_produk');
			$query = $this->db->get();
			return $query->result();
        }

        function get_total($id_invoice){
        	$this->db->select_sum('total_di', 'TOTAL');
			$this->db->where('id_invoice', $id_invoice);
			$this->db->from('detail_invoice dt');
			$query = $this->db->get();
			return $query->result();
		}

		function get_di_all($nomer_invoice){
			$sql = "SELECT
						i.id_invoice AS id_invoice,
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.alm_invoice AS alm_invoice,
						i.byr_invoice AS byr_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice
					FROM
						detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
						WHERE i.id_invoice = '$nomer_invoice' ORDER BY no_invoice DESC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_c(){
			$sql = "SELECT *
					FROM invoice
					WHERE DATE(tgl_invoice)  = CURRENT_DATE ORDER BY no_invoice DESC";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function update_kirim($id_invoice=false)
		{
			$data = array();
      		$data['st_invoice'] = 'Proses kirim';

			return $this->db->update('invoice', $data, "id_invoice = $id_invoice");
		}
		function update_invo($id_invoice=false,$harga_invoice=false)
		{
			$data = array();
      		if($harga_invoice !== false)$data['harga_invoice'] = trim($harga_invoice);

			return $this->db_evin->update('invoice', $data, "id_invoice = $id_invoice");
		}
		function edit_data(){
			$sql = "SELECT id_invoice, SUM(total_di) as total_harga FROM detail_invoice GROUP BY id_invoice";
			$query = $this->db_evin->query($sql);
			return $query->result();
		}

		// Harian
		function get_invoicehari($tanggal)
         {
            $query = "SELECT
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice
					FROM
						detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
						WHERE DATE(tgl_invoice)  = '$tanggal' ORDER BY no_invoice DESC";
            $sql = $this->db->query($query);
            return $sql->result();
         }
         function get_invoiceharii($tanggal,$id_cat)
         {
            $query = "SELECT
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice
					FROM
						detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
						WHERE DATE(tgl_invoice)  = '$tanggal' AND id_cat = '$id_cat' 
						order by no_invoice DESC";
            $sql = $this->db->query($query);
            return $sql->result();
         }
        function get_totalsemuainvoice_h($tanggal){
			$sql = "SELECT SUM(harga_invoice) AS total FROM invoice WHERE DATE(tgl_invoice) = '$tanggal'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function j_trha($tanggal){
		$sql = "SELECT COUNT(id_invoice) AS total FROM invoice WHERE DATE(tgl_invoice) = '$tanggal'";
		$query = $this->db->query($sql);
		return $query->result();
		}
		function get_totalproduk_ha($tanggal){
			$sql = "SELECT SUM(qty_di) AS total from detail_invoice AS di JOIN invoice AS i ON di.id_invoice=i.id_invoice WHERE DATE(tgl_invoice) = '$tanggal'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_produkmasuk_ha($tanggal){
			$sql = "SELECT SUM(jumlah_stok) AS total from gudang WHERE DATE(up_gudang) = '$tanggal' AND keterangan LIKE '%masuk'";
			$query = $this->db->query($sql);
			return $query->result();
		}

		//Hari-hari
		function get_invoicemi($tanggal)
         {
            $query = "SELECT
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice 
					FROM detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
					WHERE
						DATE( tgl_invoice ) >= '$tanggal' 
						AND DATE( tgl_invoice ) <= CURRENT_DATE 
					ORDER BY no_invoice DESC";
            $sql = $this->db->query($query);
            return $sql->result();
         }
        function get_totalsemuainvoice_mi($tanggal){
			$sql = "SELECT SUM(harga_invoice) AS total FROM invoice WHERE DATE( tgl_invoice ) >= '$tanggal' 
						AND DATE( tgl_invoice ) <= CURRENT_DATE";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function j_trmi($tanggal){
		$sql = "SELECT COUNT(id_invoice) AS total FROM invoice WHERE DATE( tgl_invoice ) >= '$tanggal' 
						AND DATE( tgl_invoice ) <= CURRENT_DATE";
		$query = $this->db->query($sql);
		return $query->result();
		}
		function get_totalproduk_mi($tanggal){
			$sql = "SELECT SUM(qty_di) AS total from detail_invoice AS di JOIN invoice AS i ON di.id_invoice=i.id_invoice WHERE DATE( tgl_invoice ) >= '$tanggal' 
						AND DATE( tgl_invoice ) <= CURRENT_DATE";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_produkmasuk_mi($tanggal){
			$sql = "SELECT SUM(jumlah_stok) AS total from gudang WHERE DATE( up_gudang ) >= '$tanggal' 
						AND DATE( up_gudang ) <= CURRENT_DATE AND keterangan LIKE '%masuk'";
			$query = $this->db->query($sql);
			return $query->result();
		}

		//Bulanan
		function get_invoicebu($tahun, $bulan)
         {
            $query = "SELECT
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice 
					FROM
						detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
					WHERE
						MONTH ( tgl_invoice ) = '$bulan' 
						AND YEAR ( tgl_invoice ) = '$tahun' 
					ORDER BY
						no_invoice DESC";
            $sql = $this->db->query($query);
            return $sql->result();
         }
         function get_totalsemuainvoice_bu($tahun,$bulan){
			$sql = "SELECT SUM(harga_invoice) AS total FROM invoice 
					WHERE MONTH ( tgl_invoice ) = '$bulan' AND YEAR ( tgl_invoice ) = '$tahun'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function j_trbu($tahun,$bulan){
		$sql = "SELECT COUNT(id_invoice) AS total FROM invoice 
				WHERE MONTH ( tgl_invoice ) = '$bulan' AND YEAR ( tgl_invoice ) = '$tahun'";
		$query = $this->db->query($sql);
		return $query->result();
		}
		function get_totalproduk_bu($tahun,$bulan){
			$sql = "SELECT SUM(qty_di) AS total from detail_invoice AS di 
					JOIN invoice AS i ON di.id_invoice=i.id_invoice 
					WHERE MONTH ( tgl_invoice ) = '$bulan' AND YEAR ( tgl_invoice ) = '$tahun'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_produkmasuk_bu($tahun,$bulan){
			$sql = "SELECT SUM(jumlah_stok) AS total from gudang 
					WHERE MONTH ( up_gudang ) = '$bulan' AND YEAR ( up_gudang ) = '$tahun' 
					AND keterangan LIKE '%masuk'";
			$query = $this->db->query($sql);
			return $query->result();
		}

		//Tahunan
		function get_invoiceta($tahun)
         {
            $query = "SELECT
						i.no_invoice AS no_invoice,
						i.nm_invoice AS nm_invoice,
						i.kota_invoice AS kota_invoice,
						p.nm_produk AS nm_produk,
						di.harga_di AS harga_di,
						di.qty_di AS qty_di,
						di.total_di AS total_di,
						i.harga_invoice AS harga_invoice,
						i.diskon_invoice AS diskon_invoice,
						i.tgl_invoice AS tgl_invoice 
					FROM
						detail_invoice di
						JOIN invoice i ON i.id_invoice = di.id_invoice
						JOIN produk p ON p.id_produk = di.id_produk 
					WHERE
						YEAR ( tgl_invoice ) = '$tahun' 
					ORDER BY
						no_invoice DESC";
            $sql = $this->db->query($query);
            return $sql->result();
         }
         function get_totalsemuainvoice_ta($tahun){
			$sql = "SELECT SUM(harga_invoice) AS total FROM invoice 
					WHERE YEAR ( tgl_invoice ) = '$tahun'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function j_trta($tahun){
		$sql = "SELECT COUNT(id_invoice) AS total FROM invoice 
				WHERE YEAR ( tgl_invoice ) = '$tahun'";
		$query = $this->db->query($sql);
		return $query->result();
		}
		function get_totalproduk_ta($tahun){
			$sql = "SELECT SUM(qty_di) AS total from detail_invoice AS di 
					JOIN invoice AS i ON di.id_invoice=i.id_invoice 
					WHERE YEAR ( tgl_invoice ) = '$tahun'";
			$query = $this->db->query($sql);
			return $query->result();
		}
		function get_produkmasuk_ta($tahun){
			$sql = "SELECT SUM(jumlah_stok) AS total from gudang 
					WHERE YEAR ( up_gudang ) = '$tahun' 
					AND keterangan LIKE '%masuk'";
			$query = $this->db->query($sql);
			return $query->result();
		}

	}
?>
