<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_basket extends Crud{
	public function __construct () {
		parent::__construct();
		$this->table ='good';
		$this->idkey ='id';
		}
	public function __call($name,$data) {
		if ($name=='get_name'){
			$data=$this->get_name($data[0]);
			return $data;
		}/*else if($name=='levo_menu'){
			$data=$this->pages($data[0],$data[1]);
			return $data;
		}*/
	
	private get_name($id_good){
		$data=$this->Crud->get($id_good);
		var_dump($data);exit;
	} 

}