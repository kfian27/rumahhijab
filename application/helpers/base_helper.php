<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
 * Helper buat send response dalam bentuk json
 */
if ( ! function_exists('ajax_response'))
{
	function ajax_response($status='ok', $message=NULL, $data=NULL){	
		$CI =& get_instance();
		$CI->output->set_content_type('application/json');
		$CI->ajaxresponse->set_data($status, $message, $data);
		echo json_encode($CI->ajaxresponse);
		exit(0);
	}
}


/*
 * Helper buat upload 1 file ke server
 */
 if ( ! function_exists('copy_uploaded_file'))
{
	function copy_uploaded_file($input_name='',$dir=false){
		if(!isset($_FILES[$input_name]) || $_FILES[$input_name]['name'] == '') return false;
		$fileName = strtolower($_FILES[$input_name]["name"]);
		$extension = file_extension($fileName);
		$default_filename = substr($fileName, 0, strlen($fileName) - strlen($extension) - 1);
		$newUploadedName = guid() . '.' . $extension;
		if($dir==false)
			move_uploaded_file($_FILES[$input_name]["tmp_name"], "assets/uploads/" . $newUploadedName);
		else
		{
			if (!is_dir("assets/uploads/".$dir)) {
				mkdir("assets/uploads/".$dir, 0777, true);
				//return "error";
			}
			move_uploaded_file($_FILES[$input_name]["tmp_name"], "assets/uploads/" . $dir ."/". $newUploadedName);
			$newUploadedName = $dir ."/". $newUploadedName;
		}
		return $newUploadedName;
	}
}

/*
 * Helper buat upload multiple file ke server
 */
 if ( ! function_exists('copy_uploaded_file_arr'))
{
	function copy_uploaded_file_arr($input_name='', $index=0){
		if(!isset($_FILES[$input_name]) || $_FILES[$input_name]['name'][$index] == '') return false;
		$extension = file_extension($_FILES[$input_name]["name"][$index]);
		$default_filename = substr($_FILES[$input_name]["name"][$index], 0, strlen($_FILES[$input_name]["name"][$index]) - strlen($extension) - 1);
		$fileName = $_FILES[$input_name]["name"][$index];
		$newUploadedName = guid() . '.' . $extension;
		move_uploaded_file($_FILES[$input_name]["tmp_name"][$index], "assets/uploads/" . $newUploadedName);
		
		if($extension == "jpg" || $extension =="jpeg" || $extension == "png" ) {
			make_thumbnail( $newUploadedName, 'thumb/');
			$thumb = $newUploadedName;
		}
		else $thumb = "file.jpg";


		$upload_path_url = base_url()."assets/uploads/";

		$info = new StdClass;
        $info->name = $_FILES[$input_name]['name'][$index];
        $info->size = $_FILES[$input_name]['size'][$index];
        $info->type = $_FILES[$input_name]['type'][$index];
        $info->url = $upload_path_url . $newUploadedName;
        $info->thumbnailUrl = $upload_path_url . 'thumb/' . $thumb;
        $info->deleteUrl = base_url() . 'fileinfo/delete_file/' . $newUploadedName;
        $info->deleteType = 'DELETE';
        $info->error = null;
        $info->uploadName = $newUploadedName;

		return $info;
	}
}

if ( ! function_exists('delete file'))
{
	function delete_file($file_path=''){
		$upload_path_url = "./assets/uploads/";
		$base_path = $upload_path_url."$file_path";
		$thumb_path = $upload_path_url."thumb/$file_path";
		if(file_exists($base_path)){
			unlink($base_path);
		}
		if(file_exists($thumb_path)){
			unlink($thumb_path);
		}
	}
}

/*
 * Helper buat dapetin ekstensi dari sebuah file (nama file)
 */
if ( ! function_exists('file_extension'))
{
	function file_extension($filename='')
	{ 
		if($filename == '') return '';
		return pathinfo($filename, PATHINFO_EXTENSION);
	}
}


/*
 * Helper buat membuat combo box dari array
 */
if ( ! function_exists('make_combobox'))
{
	/*
	 *  object_array = object yang akan dibuat combo boxnya, dari db biasanya
	 *  combobox_attribute = attribute html dari combo box, misal id, name, class, dll
	 *  show_all_label = tampilkan label semua
	 *  all_first = letak diatas atau dibawah label semuanya
	 *  all_label = key pada language buat label all / semuanya
	 */
	function make_combobox($object_array = array(),$combobox_attribute = array(),
						   $show_all_label = true,$all_first = true,$all_label = 'Semua'){								  
		if(!is_array($object_array)){
			framework_error ('Lengkapi parameter fungsinya [Fungsi : make_combobox]');
			return;
		}
		
		$label_all = $all_label;		
		$allAttribute = array();
		foreach($combobox_attribute as $k => $v){
			$allAttribute[] = "$k=\"$v\"";
		}		
		$result = '<select ' . implode(" ", $allAttribute) . ' class="form-control">';
		if($show_all_label && $all_first) $result .= "<option value=\"0\">" . $label_all . "</option>";
		foreach($object_array as $k => $v){
			$result .= "<option value=\"" . $k . "\">" . $v . "</option>";
		}		
		if($show_all_label && !$all_first) $result .= "<option value=\"\">" . $label_all . "</option>";
		$result .= '</select>';
		echo $result;
	}
}

/*
 * Helper buat membuat combo box dari array object
 */
if ( ! function_exists('make_object_combobox'))
{
	/*
	 *  object_array = object yang akan dibuat combo boxnya, dari db biasanya
	 *  key_column = property yang mau dibuat key / valnya
	 *  val_column = property yang mau dibuat jadi text / labelnya
	 *  combobox_attribute = attribute html dari combo box, misal id, name, class, dll
	 *  show_all_label = tampilkan label semua
	 *  all_first = letak diatas atau dibawah label semuanya
	 *  all_label = key pada language buat label all / semuanya
	 */
	function make_object_combobox($object_array = array(),$key_column = '',$val_column = '', 
								  $combobox_attribute = array(),$show_all_label = true,$all_first = true,
								  $all_label = 'Semua'){								  
		if(!is_array($object_array) || $key_column == '' || $val_column == ''){
			framework_error ('Lengkapi parameter fungsinya [Fungsi : make_object_combobox]');
			return;
		}
		
		$passArray = array();
		foreach($object_array as $v){
			$passArray[$v->$key_column] = $v->$val_column;
		}
		
		make_combobox($passArray, $combobox_attribute, $show_all_label, $all_first, $all_label);
	}
}

if ( ! function_exists('make_multi_object_combobox'))
{
	/*
	 *  object_array = object yang akan dibuat combo boxnya, dari db biasanya
	 *  key_column = property yang mau dibuat key / valnya
	 *  val_column = property yang mau dibuat jadi text / labelnya
	 *  combobox_attribute = attribute html dari combo box, misal id, name, class, dll
	 *  show_all_label = tampilkan label semua
	 *  all_first = letak diatas atau dibawah label semuanya
	 *  all_label = key pada language buat label all / semuanya
	 */
	function make_multi_object_combobox($object_array = array(),$key_column = '',$val_column = array(), 
								  $combobox_attribute = array(),$show_all_label = true,$all_first = true,
								  $all_label = 'lbl_all'){								  
		if(!is_array($object_array) || $key_column == '' || $val_column == ''){
			framework_error ('Lengkapi parameter fungsinya [Fungsi : make_object_combobox]');
			return;
		}
		
		$passArray = array();
		foreach($object_array as $v){
			$valArray = array();
			foreach($val_column as $val)
			{
				$valArray[] = $v->$val;
			}
			$passArray[$v->$key_column] = implode(' - ', $valArray);
		}
		
		make_combobox($passArray, $combobox_attribute, $show_all_label, $all_first, $all_label);
	}
}

/*
 * Helper buat tanggal now
 */
if ( ! function_exists('now'))
{
	function now($date ='Y-m-d H:i:s')
	{ return print_date($date); }
}

/*
 * Helper buat print tanggal
 */
if ( ! function_exists('print_date'))
{
	function print_date($format = 'Y-m-d H:i:s')
	{ return date($format); }
}

/*
 * Helper buat print tanggal
 */
if ( ! function_exists('print_array_js'))
{
	function print_array_js($arr=array(), $var_name)
	{ 
		$result = "var $var_name = new Array();";	
		foreach($arr as $key => $val){
			$result .= "$var_name ['$key'] = '$val';";	
		}
		echo $result;
	}
}

/*
 * Helper buat print tanggal
 */
if ( ! function_exists('print_array_obj_js'))
{
	function print_array_obj_js($arr=array(), $var_name, $key, $val)
	{ 
		$result = "var $var_name = new Array();";	
		foreach($arr as $data){
			$result .= "$var_name ['" . $data->$key . "'] = '" . $data->$val . "';";	
		}
		echo $result;
	}
}

/*
 * Helper buat tanggal now
 */
if ( ! function_exists('replace_slash'))
{
	function replace_slash($text)
	{ return str_replace("'", "", $text); }
}

if ( ! function_exists('make_year_combobox'))
{

	function make_year_combobox($combobox_attribute = array(), $year = 2014, $length = 50){								  
	
		$allAttribute = array();
		foreach($combobox_attribute as $k => $v){
			$allAttribute[] = "$k=\"$v\"";
		}		
		$result = '<select ' . implode(" ", $allAttribute) . ' class="form-control">';
		for($i=$length;$i>=-$length;$i--){
			$value = $year-$i;
			$result .= "<option value=\"" . $value . "\">" . $value . "</option>";
		}
		$result .= '</select>';
		echo $result;
	}
}
/*
 * Helper buat create guid
 */
if ( ! function_exists('guid'))
{
	function guid($pad_left = '', $pad_right = ''){ 
		mt_srand((double)microtime()*10000);
        return md5($pad_left . uniqid(rand(), true) . $pad_right);
	}
}

if ( ! function_exists('create_rtf'))
{
	function create_rtf($tpl_file = '', $target = '', $data = null, $label = null)
	{
		if (file_exists($tpl_file)) {
			// Membuka file template
			$f = fopen($tpl_file, "r+");
			$isi = fread($f, filesize($tpl_file));
			fclose($f);
			//echo $isi;
			// Query menampilkan data
			$data = array();
			// Menempatkan data pribadi kedalam template
			$isi = str_replace('[tanggal]', date('d-m-Y'), $isi);
			foreach ($label as $key => $value)
			{
				$isi = str_replace($value, '['.$key.']', $isi);
			}
			// Merekam kembali file hasil parser
			echo json_encode(file_exists($target));
			$f = fopen($target, "w+");
			fwrite($f, $isi);
			fclose($f);
			// Otomatis membuka file hasil parser saat proses selesai
			redirect(base_url().$target);
			//echo "<META HTTP-EQUIV=\"Refresh\" CONTENT=0; URL=$target>"; 
		}
	}
}

/*
 * Helper buat make thumbnail
 */
if ( ! function_exists('make_thumbnail'))
{
	function make_thumbnail($imagePath = '', $destPath = '', $width = 69, $height = 69, $maintainRatio = true)
	{
		$base_path =  "./assets/uploads/";
		$CI =& get_instance();
		
		$config = array();
		$config['image_library']  = 'gd2';
		$config['source_image']	  = $base_path . $imagePath;
		$config['new_image']	  = $base_path . $destPath;
		$config['create_thumb']   = TRUE;
		$config['maintain_ratio'] = $maintainRatio;
		$config['width']	      = $width;
		$config['height']	      = $height;
		$config['thumb_marker']	  = '';

		$CI->load->library('image_lib', $config);
		$CI->image_lib->resize();
		if ( ! $CI->image_lib->resize())
		{
			echo $base_path . $destPath;
	        echo $CI->image_lib->display_errors();
		}
	}
}
