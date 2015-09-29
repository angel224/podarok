<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Settings extends CI_Controller {
	 function __construct(){
		parent::__construct();
		//Проверяем - вошёл ли администратор
		$this->lib_auth->check_admin();
		header('Content-type: text/html; charset=utf-8');
	}
	
	//Собственно функция 
	function index () {
		
		//Правила для валидации
		$rules = array (
		
			array (
				'field' => 'admin_login',
				'label' => 'Логин',
				'rules' => 'required|az_numeric',
			),
			
			array (
				'field' => 'admin_pass',
				'label' => 'Пароль',
				'rules' => 'required|max_length[40]',
			),

			array (
				'field' => 'per_page',
				'label' => 'Записей на страницу',
				'rules' => 'required|numeric',
			),
			array (
				'field' => 'upload_path',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'allowed_types',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'max_size',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'max_width',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'max_height',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'create_thumb',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'maintain_ratio',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'width',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
			array (
				'field' => 'height',
				'label' => 'Записей на страницу',
				'rules' => 'required',
			),
		
		);
		
		//Применяем правила
		$this->form_validation->set_rules($rules);
		
		//Проверяем форму на валидность
		if ($this->form_validation->run ()) {
			//Если всё правильно - сохраняем настройки
			//Так как их немного - можно не усложнять и не использовать циклы
			$data = array ();
			$data['cms_admin_login'] = $this->input->post ('admin_login');
			$data['cms_admin_pass'] = $this->input->post ('admin_pass');
			$data['cms_per_page'] = $this->input->post ('per_page');
			$data['upload_path'] = $this->input->post ('upload_path');
			$data['allowed_types'] = $this->input->post ('allowed_types');
			$data['max_size'] = $this->input->post ('max_size');
			$data['max_width'] = $this->input->post ('max_width');
			$data['max_height'] = $this->input->post ('max_height');
			$data['create_thumb'] = $this->input->post ('create_thumb');
			$data['maintain_ratio'] = $this->input->post ('maintain_ratio');
			$data['width'] = $this->input->post ('width');
			$data['height'] = $this->input->post ('height');
			
			//Теперь в цикле - для каждой настройки делаем отдельную
			//операцию UPDATE
			foreach ($data as $key=>$one) {
				$this->db->where ('name',$key);
				//Для update нужен МАССИВ - потому второй параметр массив
				$this->db->update ('tsh_nastroika',array ('znachenie' => $one));			
			}
			
			//После сохранения настроек - перекидываем на главную
			redirect ('adm/orders/index/');
			
			//Обратите внимание - если был сменён пароль, то дополнительная
			//защита (по хэшу) перекинет на страничку ВХОДА заново			
			
		} else {
			//Иначе - показ формы
			$this->lib_view->admin_page ('set',array(),'Настройки');
			
			//Второй параметр пустой - т.к. значения по умолчанию считает ВИД
		}
		
		
	}

	
}

?>