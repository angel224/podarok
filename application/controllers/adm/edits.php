<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Edits extends CI_Controller  {
	
public function __construct () {
		parent::__construct();
		$this->load->library('javascript');
		$this->load->helper('tinymce_helper');
		$this->load->model('Viev');
		$this->load->model('Mdl_Edit');
		nocache_headers ();//запрет кеширования
		}


//Функция предоставляет выбор страниц для редактирования или говорит о успехе в редактировании если оно произведено
public function index($edit=''){
	$this->load->helper('html');
	if($edit!=''){	
		$data=$this->Viev->levo_menu(1,1);
		$data['edit']=$edit;
		$this->lib_view->admin_page('edit',$data,'Редактирование страницы');
	}else{
		$data=$this->Viev->levo_menu(1,1);
		$this->lib_view->admin_page('edit',$data,'Редактирование страницы');
	}
}

// Функция выводит странички для редоктирования с контентом в зависимости от того что пользователь нажал в левом меню.
public function list_raz($id_razdel,$id_kategori='',$id_good=''){
	if(empty($id_good)){
		if(!empty($id_kategori)){
			if(is_numeric($id_kategori) and  is_numeric($id_razdel)){
				$data= $this->Viev->levo_menu(1,1);
				$this->Crud->idkey="id_kategori";
				$this->Crud->table='kategori';
				$data['edit']=$this->Crud->get($id_kategori);
				$data['edit']['content']=$data['edit']['description_kategori'];
				$this->lib_view->admin_page('edit_kat',$data,'Редактирование страницы');
			}else{
				$data=$this->Viev->levo_menu(1,1);
				$data['edit']['content']= '<b>ERROR 404: Нет такой категории</b>';
				$this->lib_view->admin_page('edit_kat',$data,'Редактирование страницы');
			}
		
		}else{
			if(is_numeric($id_razdel)){
				$data= $this->Viev->levo_menu(1,1);
				$this->Crud->idkey = 'id_razdel';
				$this->Crud->table='razdel';
				$data['edit']=$this->Crud->get($id_razdel);
				$data['edit']['content']=$data['edit']['description'];
				//var_dump($data);exit;
				$this->lib_view->admin_page('edit_razdel',$data,'Редактирование страницы');
			}else{
				$data=$this->Viev->levo_menu(1,1);
				$data['edit']['content']= '<b>ERROR 404: Нет такого раздела</b>';
				$this->lib_view->admin_page('edit',$data,'Редактирование страницы');
			}
		}
	}else{
		if(is_numeric($id_kategori) and  is_numeric($id_razdel) and is_numeric($id_good)){
			$data= $this->Viev->levo_menu(1,1);
			$this->Viev->table ='good';
			$this->Viev->idkey='id_good';
			$data['edit']= $this->Viev->get($id_good);
			$data['edit']['content']=$data['edit']['text'];
			$this->lib_view->admin_page('edit_good',$data,'Редактирование страницы');		
		}else{
			$data=$this->Viev->levo_menu(1,1);
			$data['edit']['content']= '<b>ERROR 404: Нет такого товара </b>';
			$this->lib_view->admin_page('edit',$data,'Редактирование страницы');
		}
	}
}

// Функция редактирует странички сайта или удалет их.
public function edit_padge () {
	$data=$this->input->post();	
	//var_dump($data);exit;
	if(isset($data['edit'])){
		switch ($data['edit']){
			case "Редактировать Раздел":
				$id=$data['id_razdel']*1;
				if($this->Mdl_Edit->edit_raz($id)){	
					$this->index('Вы успешно отредактировали раздел');	
				}else{
					$this->index('Операция редактирования ПРОВАЛЕННА!');	
				}
			break;
			case "Редактировать Категорию":
				$data['id_razdel']=$data['id_razdel']*1;
				$id=$data['id_kategori']*1;
				if($this->Mdl_Edit->edit_kat($id)){	
					$this->index('Вы успешно отредактировали категорию');
				}else{
					$this->index('Операция редактирования ПРОВАЛЕННА!');	
				}	
			break;
			case "Редактировать Товар":
				$data['id_razdel']=$data['id_razdel']*1;
				$data['id_kategori']=$data['id_kategori']*1;
				$id=$data['id_good']*1;
				if($this->Mdl_Edit->edit_good($id)){	
					$this->index('Вы успешно отредактировали товар');
				}else{
					$this->index('Операция редактирования ПРОВАЛЕННА!');	
				}	
			break;
			default:
				$this->index('Ваш IP отправлен в ФБР и ФСБ.АЛЕ!!АЛЕ!!Харе ломать! Сейчас вылезу с монитора и руки поотрываю.');	
		}
	
	}else if(isset($data['delete']) and isset($data['del'])){
		//var_dump($data);exit;
		if(isset($data['id_good'])){//Удаляем товар
			$id=$data['id_good']*1;
			//var_dump($id);exit;
			$this->Mdl_Edit->idkey='id_good';
			$this->Mdl_Edit->table='good';
			$this->Mdl_Edit->del($id);
			$this->index('Вы успешно удалили товар');
		}else if(isset($data['id_kategori'])){//Удаляем категорию
			$id=$data['id_kategori']*1;
			$this->Mdl_Edit->idkey='id_kategori';
			$this->Mdl_Edit->table='good';
			if($this->Mdl_Edit->chek_del($id)){
				$this->Mdl_Edit->table='kategori';
				$this->Mdl_Edit->del($id);
				$this->index('Вы успешно удалили категорию');
			}else {
				$this->index('Вау!Категория не пустая!Удалите сперва Все Товары!');
			}
		}else if(isset($data['id_razdel'])){//Удаляем раздел
			$id=$data['id_razdel']*1;
			$this->Mdl_Edit->idkey='id_razdel';
			$this->Mdl_Edit->table='kategori';
			if($this->Mdl_Edit->chek_del($id)){
				$this->Mdl_Edit->table='razdel';
				$this->Mdl_Edit->del($id);
				$this->index('Вы успешно удалили категорию');
			}else {
				$this->index('Вау!Раздел не пустой!Удалите сперва Все Категории и Товары!');
			}
		}
	}


	
	
}

public function status_padge($public,$id_razdel,$id_kategori='',$id_good=''){
	$public=$public*1;
	if(empty($id_kategori) and empty($id_good)){
		$id=$id_razdel*1;
		$this->Mdl_Edit->table='razdel';
		$this->Mdl_Edit->idkey='id_razdel';
		if($this->Mdl_Edit->edit_status($id,$public)){
			$this->index('Статус страницы изменен');	
		}else{
			$this->index('Статус страницы Не поменялся');	
		}
		
	}else if(empty($id_good) and $id_kategori>0 ){
		$id=$id_kategori*1;
		$this->Mdl_Edit->table='kategori';
		$this->Mdl_Edit->idkey='id_kategori';
		if($this->Mdl_Edit->edit_status($id,$public)){
			$this->index('Статус страницы изменен');	
		}else{
			$this->index('Статус страницы Не поменялся');	
		}
	}else {
		$id=$id_good*1;
		$this->Mdl_Edit->table='good';
		$this->Mdl_Edit->idkey='id_good';
		if($this->Mdl_Edit->edit_status($id,$public)){
			$this->index('Статус страницы изменен');	
		}else{
			$this->index('Статус страницы Не поменялся');	
		}
	}
		
}
}