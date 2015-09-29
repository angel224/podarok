<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

	//¬озвращает код редактора дл¤ элемента с указанным ID 
	function show_tinymce ($id) {
		
		$CI = &get_instance ();
		
		$data = array ();
		$data['id'] = $id;
		
		//—читываем код из файла		
		$code = $CI->load->view ('tinymce',$data,TRUE);
		
		return $code;
			
	}
	
	//‘ункци¤ выводит Header-ы, отмен¤ющие кэширование
	function nocache_headers () {
		// HTTP/1.1
		header("Cache-Control: no-store, no-cache, must-revalidate");
		header("Cache-Control: post-check=0, pre-check=0", false);
	}			

?>