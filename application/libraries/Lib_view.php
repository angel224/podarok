<?php
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lib_view {

public function __call($name,$data){
	if ($name=='admin_page'){
	$this-> admin_page($data[0],$data[1],$data[2]);
	}else {
	$this->lib_view->simple_page('login',array (),'Вход администратора');
	}
}
	
	
	//Функция отображает страничку админки на основе хедера, футера и середины
public function admin_page($pagename, $data = array (), $title = '') {
		//Вначале выводим хедер - ему передаём только заголовок
		$d = array ();
		$d['title'] = $title;
		
		$CI = &get_instance(); //Доступ к CodeIgniter
		$CI->load->view('adm/heder.php',$d);
		
		//Теперь готовим вывод серединки
		$CI->load->view ('adm/'.$pagename.'.php', $data);
		
		//Данные для футера
		$fdata = array();
		$fdata['validation_errors'] = validation_errors ();
		
		//Здесь вывод футера
		$CI->load->view ('adm/foter.php',$fdata);		
	}
	
		
	//Функция отображает страничку на основе хедера, футера и середины - из файла
	function simple_page ($page, $data = array (), $title = '') {		
		
		$CI = &get_instance (); //Доступ к CodeIgniter
	
		//Вначале выводим хедер - ему передаём только заголовок
		$d = array ();
		$d['title'] = $title;
		$d['description'] = 'вход в админку';
		$d['key'] = 'пароль, логин';

		$CI->load->view ('heder.php',$d);		
		
		//Серединка		
		$CI->load->view ($page,$data);		
		
		//Данные для футера
		$fdata = array();
		$fdata['validation_errors'] = validation_errors ();
		
		//Здесь вывод футера
		$CI->load->view ('foter.php',$fdata);		
		
	}	 
	
	
}


?>