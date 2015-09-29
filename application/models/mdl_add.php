<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_add extends Viev{
	public function __construct (){
		parent::__construct();
		$this->lib_auth->check_admin();
	}
	
	public function __call($name,$data) {
			if ($name=='add'){
				if($this->add($data[0])){
					return true;
				}else{
					return $data;
				}
			}
			if ($name=='add_kategori'){
			if($this->add_kategori($data[0])){
				return true;
			}else{
				return $data;
			}
			}
			if ($name=='add_razdel'){
			if($this->add_razdel($data[0])){
				return true;
			}else{
				return $data;
			}
			}
	}
	
//Добавляет страницы в базу. Проверить и усложнить правила. Подумать над выбором картинки минимизаци и над именем вместо урла. Подумать как быть с урлом. Проверить все. Посмотреть ошибки при валидации и возращать не фалсе а страничку.При добавлении тоже страничку.Возможно просмотра.Да, к урлу надо добавлять полный путь. А доставку и паблик заделать булевыми.			
	private	function add($data){
		$this->add_rules = array (
					array(
						 'field'   => 'name', 
						 'label'   => 'имя товара', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
				   array(
						 'field'   => 'title_good', 
						 'label'   => 'Title страницы', 
						 'rules'   => 'min_length[6]|max_length[100]'
					  ),
					array(
						'field'   => 'description_good', 
						 'label'   => 'description страницы ', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
					  array(
						'field'   => 'cena', 
						 'label'   => 'цена ', 
						 'rules'   => 'numeric'
					  ),
					   array(
						'field'   => 'dostavka', 
						 'label'   => 'доставка', 
						 'rules'   => 'max_length[10]'
					  ),
					   array(
						'field'   => 'link2', 
						 'label'   => 'путь к картинке', 
						 'rules'   => 'required|prep_url'
					  ),
					  array(
						'field'   => 'key', 
						 'label'   => 'ключевые слова', 
						 'rules'   => 'required|max_length[100]'
					  ),
					  array(
						'field'   => 'text', 
						 'label'   => 'текст страницы в html', 
						 'rules'   => 'required'
					  ));
		$this->form_validation->set_rules($this->add_rules);
			if($this->form_validation->run()){
				$data["cena"]=$data["cena"]*1;
				if (isset($data["public"]) and $data["public"]=='on'){
					$data["public"]='1';
				}else {
					 $data["public"]='0';
				}
				if (isset($data["dostavka"]) and $data["dostavka"]=='on'){
					$data["dostavka"]=1;
				}else {
					 $data["dostavka"]=0;
				}
				if($data['select1']=='3'){
					$data['id_razdel']=$this->get_id($data['select2'])*1;
					$data['id_kategori']=$this->get_id($data['select3'],1)*1;
					}else if($data['select1']=='2'){
					$data['id_razdel']=$this->get_id($data['select2']);
				}
				$this->table='good';
				unset($data['select1']);
				unset($data['select2']);
				unset($data['select3']);
				$this->db->insert($this->table,$data);
				//return $this->db->insert_id();
				return true;
				
			}else {
				return $data;
			}
	
}	
//Добавляет категории в базу.
	private	function add_kategori($data){
		$this->add_rules = array (
					array(
						 'field'   => 'kategori', 
						 'label'   => 'имя категории', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
				   array(
						 'field'   => 'title_kategori', 
						 'label'   => 'Title страницы', 
						 'rules'   => 'min_length[6]|max_length[100]'
					  ),
					array(
						'field'   => 'description_kategori', 
						 'label'   => 'description страницы ', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
					array(
						'field'   => 'key_kategori', 
						 'label'   => 'ключевые слова', 
						 'rules'   => 'required|max_length[100]'
					  ));
		$this->form_validation->set_rules($this->add_rules);
			if($this->form_validation->run()){
				if (isset($data["public"]) and $data["public"]=='on'){
					$data["public"]='1';
				}else {
					 $data["public"]='0';
				}
				if($data['select1']=='2'){
					$data['id_razdel']=$this->get_id($data['select2']);
				}
				$this->table='kategori';
				unset($data['select1']);
				unset($data['select2']);
				unset($data['select3']);
				unset($data['cena']);
				unset($data['dostavka']);
				unset($data['text']);
				unset($data['link2']);
				$this->db->insert($this->table,$data);
				//return $this->db->insert_id();
				return true;
				
			}else {
				return $data;
			}
	
}
//Добавляет раздел в базу.
	private	function add_razdel($data){
		$this->add_rules = array (
					array(
						 'field'   => 'razdel', 
						 'label'   => 'имя раздела', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
				   array(
						 'field'   => 'title', 
						 'label'   => 'Title страницы', 
						 'rules'   => 'min_length[6]|max_length[100]'
					  ),
					array(
						'field'   => 'description', 
						 'label'   => 'description страницы ', 
						 'rules'   => 'min_length[6]|max_length[256]'
					  ),
					array(
						'field'   => 'key', 
						 'label'   => 'ключевые слова', 
						 'rules'   => 'required|max_length[100]'
					  ));
		$this->form_validation->set_rules($this->add_rules);
			if($this->form_validation->run()){
				if (isset($data["public"]) and $data["public"]=='on'){
					$data["public"]='1';
				}else {
					 $data["public"]='0';
				}
				$this->table='razdel';
				unset($data['select1']);
				unset($data['select2']);
				unset($data['select3']);
				unset($data['cena']);
				unset($data['dostavka']);
				unset($data['text']);
				unset($data['link2']);
				$this->db->insert($this->table,$data);
				//return $this->db->insert_id();
				return true;
				
			}else {
				return $data;
			}
	
}	
	
//Функция достает из названия категории и раздела их айдишники.Не факт что вообще нужна, так как функцию add из Crud полностью перегружена, тоесть можно и по названию выделываться.Подумать.
	private function get_id($name,$num=0){
		if($num==0){
		$this->db->select('id_razdel');
		$this->db->where('razdel',$name);
		$query = $this->db->get($this->table='razdel');
		 $row=$query->row_array();
		 return  $row["id_razdel"];
		 }else{
			 $this->db->select('id_kategori');
			$this->db->where('kategori',$name);
			$query = $this->db->get($this->table='kategori');
			$row=$query->row_array();
			return $row["id_kategori"];
		 }
	} 

}
?>
