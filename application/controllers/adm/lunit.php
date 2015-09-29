<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lunit extends CI_Controller {
	
	function login () {
		header('Content-type: text/html; charset=utf-8');
		
		//Правила валидации
		$rules = array (
		
			array (
				'field' => 'login',
				'label' => 'Логин',
				'rules' => 'required|az_numeric',
			),
			
			array (
				'field' => 'pass',
				'label' => 'Пароль',
				'rules'	=> 'required|max_length[40]'			
			),
		
		);
		
		$this->form_validation->set_rules($rules);
		
		//Если валидация прошла - пытаемся сделать вход
		if ($this->form_validation->run ()) {
			
			$this->lib_auth->do_login ($this->input->post ('login'),$this->input->post('pass'));
			
		} else {
			//Иначе - показываем форму
			$this->lib_view->simple_page('login',array (),'Вход администратора');
		}
		
	}
	
	
	function logout () {
		//Проверка или был вход
		$this->lib_auth->check_admin();
		
		$this->lib_auth->logout ();
	}
	
	
	function index () {
		header('Content-type: text/html; charset=utf-8');
		
		//Проверка или был вход
		$this->lib_auth->check_admin();
		header("Location: ../orders/index/");
		
		}
	
	
}


?>