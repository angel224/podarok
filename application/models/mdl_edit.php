<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Mdl_Edit extends Crud {
	public function __construct (){
	parent::__construct();
	
	}
//редактирует раздел  и правила валидации (над ними поработать надо)
	
public function edit_raz($id){
	$this->Crud->edit_rules= array (
				array(
                     'field'   => 'razdel', 
                     'label'   => 'имя раздела', 
                     'rules'   => 'min_length[6]|max_length[50]'
                  ),
               array(
                     'field'   => 'title', 
                     'label'   => 'Title раздела', 
                     'rules'   => 'min_length[6]|max_length[100]'
                  ),
                array(
                    'field'   => 'description', 
                     'label'   => 'описание раздела ', 
                     'rules'   => 'min_length[6]|max_length[256]'
                  ),
				  array(
                    'field'   => 'key', 
                     'label'   => 'ключевые слова', 
                     'rules'   => 'required'
                  ));
	$this->Crud->table='razdel';
	$this->Crud->idkey='id_razdel';
	if($this->Crud->edit($id)){
		return true;
	}else{
		return false;	
	}	
}
//редактикует  категорию и правила валидации (над ними поработать надо)
public function edit_kat($id){
	$this->Crud->edit_rules= array (
				array(
                     'field'   => 'kategori', 
                     'label'   => 'имя категории', 
                     'rules'   => 'min_length[6]|max_length[50]'
                  ),
               array(
                     'field'   => 'title_kategori', 
                     'label'   => 'Title категории', 
                     'rules'   => 'min_length[6]|max_length[100]'
                  ),
                array(
                    'field'   => 'description_kategori', 
                     'label'   => 'описание категории ', 
                     'rules'   => 'min_length[6]|max_length[256]'
                  ),
				  array(
                    'field'   => 'key_kategori', 
                     'label'   => 'ключевые слова', 
                     'rules'   => 'required'
                  ));
	$this->Crud->table='kategori';
	$this->Crud->idkey='id_kategori';
		if($this->Crud->edit($id)){
			return true;
		}else{
			return false;	
		}
}	

//редактикует товар и правила валидации (над ними поработать надо)
public function edit_good($id){
	$this->Crud->edit_rules= array (
				array(
                     'field'   => 'name', 
                     'label'   => 'имя товара', 
                     'rules'   => 'min_length[6]|max_length[50]'
                  ),
               array(
                     'field'   => 'title_good', 
                     'label'   => 'Title товара', 
                     'rules'   => 'min_length[6]|max_length[100]'
                  ),
				array(
                    'field'   => 'cena', 
                     'label'   => 'цена товара', 
                     'rules'   => 'required|numeric'
                  ),
				 array(
                    'field'   => 'link2', 
                     'label'   => 'картинка', 
                     'rules'   => 'required|prep_url'
                  ),
				array(
                    'field'   => 'text', 
                     'label'   => 'полный текст товара ', 
                     'rules'   => 'required'
                  ),	
                array(
                    'field'   => 'description_good', 
                     'label'   => 'описание товара', 
                     'rules'   => 'min_length[6]|max_length[256]'
                  ));
	$this->Crud->table='good';
	$this->Crud->idkey='id_good';
	if($this->Crud->edit($id)){
		return true;
	}else{
		return false;	
	}	
}

//Функция проверяет пустой ли раздел или категория
public function chek_del($id){
	$this->db->where($this->idkey,$id);
	$query = $this->db->get($this->table);
	if( $query->num_rows()>0){
		return false;
	}else{
		return true;
	}
	
}

//Функция меняет статус страницы
public function edit_status($id,$public){
	if($public==1 or $public==0){
		$data=array('public'=>$public);
		$this->db->where ($this->idkey, $id);
		if($this->db->update($this->table,$data)){
			return true;
		}else{
			return false;
		}
	}else {
		return false;
	}
	
	
}

}
?>