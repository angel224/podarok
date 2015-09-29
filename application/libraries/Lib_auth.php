<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');


class Lib_auth {
	
	//Выполняет проверку на соответствие логина и пароля
	//В случае удачи - авторизирует
	function do_login ($login, $pass) {
		$CI = &get_instance ();
		
		//Правильные данные
		$right_login = $CI->config->item ('cms_admin_login');
		$right_pass = $CI->config->item ('cms_admin_pass');
		
		//Проверка на соответствие
		if (($right_login==$login) && ($right_pass==$pass)) {
			//Если правильно - записываем сессию
			$ses = array ();
			$ses['admin_logined'] = 'ok'; //Админ вошёл
			//Дополнительная защита - хэш
			$ses['admin_hash'] = $this->the_hash ();
			//Запись
			$CI->session->set_userdata($ses);
		
			//Редирект на главную
			redirect ('adm/lunit/index');
			
		} else {
			//Иначе - редирект на страничку входа
			redirect ('adm/lunit/login');}
		
	}
	
	//Формирует дополнительный хэш проверки 
	function the_hash () {
		
		$CI = &get_instance ();
		
		//Формируем хеш: пароль+IP+доп.слово
		$hash = md5 ($CI->config->item('pass').$_SERVER['REMOTE_ADDR'].'CICMS');
		
		return $hash;
		
	}
	
	//Проверка - выполнен ли вход
	function check_admin () {
		
		$CI = &get_instance ();
		
		if (($CI->session->userdata('admin_logined')=='ok')
				&& ($CI->session->userdata('admin_hash')==$this->the_hash())) {
					
					return TRUE; //Если всё в порядке - просто возврат 
					
				} else {
					
					//Иначе редирект на страницу входа
					redirect ('admin/login');
				}
		
	}
	
	//Логаут - чистим сессию
	function logout(){
		
		$CI = &get_instance();
		$ses = array ();
		$ses['admin_logined'] = ''; 
		$ses['admin_hash'] = '';
			
		$CI->session->unset_userdata($ses); //Удаляем сессию
		
		//Редирект на страничку входа
		redirect ('admin/login');
		}
}
?>