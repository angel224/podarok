<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_order extends Crud {
	public function __construct () {
		parent::__construct();
		$this->table ='order';
		$this->idkey ='id_sessions';
		$this->lib_auth->check_admin();
	}
	
	public function __call($name,$data) {
		if ($name=='del_order'){
			$data=$this->del_order($data[0]);
			return $data;
		}else if($name=='edit_order'){
			$data=$this->edit_order($data[0]);
			return $data;
		}else if($name=='get_stori'){
			$data=$this->get_stori($data[0]);
			return $data;
		}
	}
	
	//Функция удаления ордеров
	private function del_order (id=""){
		
	}
	
	//Функция редактирования истории ордера
	private function edit_order (id=""){
		
	}
	
	
	// Функция получения истории ордера
	private function del_order (id=""){
		
	}
	
}
?>