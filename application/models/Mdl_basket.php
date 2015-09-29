<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_basket extends Crud{
	public $add_rules2 = '';
	public function __construct () {
		parent::__construct();
		$this->table ='good';
		$this->idkey ='id_good';
		$this->load->library('MY_Form_validation');
	}
		
		
	public function __call($name,$data) {
		if ($name=='get_name'){
			$data=$this->get_name($data[0]);
			return $data;
		}else if($name=='addorder'){
			$data=$this->addorder($data[0]);
			return $data;
		}else if($name=='index'){
			$data=$this->index($data[0]);
			return $data;
		}
	}

 

//Функция достает название товара от ид
	private function get_name($id){
		$data=$this->get($id);
		//var_dump($data);exit;
		return $data['name'];
	} 
	
// Функция готовит товары к хранению в БД в  формате Json
	protected function getJsonGoods($data) {
		$i=$data["caunt"];
		while($i>0){
		$resalt[$i]["id_good"] =$data["id_good".$data["caunt"]]*1;
		$resalt[$i]["quantity"] =$data["quantity".$data["caunt"]]*1;
			$i--;
		}
		$id_good_json=json_encode($resalt);
		return $id_good_json;
	}
	
	
	protected function addorder($data){
		//var_dump ($data);
		$this->add_rules = array (
						array(
							'field'   => 'cena', 
							 'label'   => 'цена ', 
							 'rules'   => 'trim|integer|required|xss_clean'
						  ),
						  array(
							'field'   => 'klient', 
							 'label'   => 'ФИО клиента', 
							 'rules'   => 'trim|max_length[50]|required|callback_mystring|xss_clean'
						  ),
						   array(
							'field'   => 'telephone', 
							 'label'   => 'телефон', 
							 'rules'   => 'trim|required|callback_tel|xss_clean'
						  ),
						   array(
							'field'   => 'email', 
							 'label'   => 'емаил', 
							 'rules'   => 'trim|required|valid_email|xss_clean'
						  ),
						  array(
							'field'   => 'timex', 
							 'label'   => 'дата до которой нужен заказ', 
							 'rules'   => 'trim|required|exact_length[10]|xss_clean'
							),
						  array(
							'field'   => 'citi', 
							 'label'   => 'город для доставки', 
							 'rules'   => 'trim|max_length[20]|xss_clean'
						  ),
						  array(
							'field'   => 'strit', 
							 'label'   => 'улца для доставки', 
							 'rules'   => 'trim|max_length[20]|xss_clean'
						  ),
						  array(
							'field'   => 'dom', 
							 'label'   => 'дом для доставки', 
							 'rules'   => 'trim|max_length[6]|xss_clean'
						  ),
						  array(
							'field'   => 'kv', 
							 'label'   => 'квартира для доставки', 
							 'rules'   => 'trim|integer|xss_clean|max_length[4]'
						  ),
						  array(
							'field'   => 'indeks', 
							 'label'   => 'индекс для доставки', 
							 'rules'   => 'trim|integer|xss_clean|max_length[7]'
						  ),
						  array(
							'field'   => 'pochta', 
							 'label'   => 'почта', 
							 'rules'   => 'trim|xss_clean|max_length[20]'
						  ),
						  array(
							'field'   => 'depot', 
							 'label'   => 'номер почты для доставки', 
							 'rules'   => 'trim|integer|xss_clean|max_length[4]'
						  ));
		if (!empty($data["dostavka"]) and $data["dostavka"]=='Доставка нужна'){
					$data["dostavka"]=1;					
			}else {
				$data["dostavka"]=0;
				$data["citi"]="no";
				$data["strit"]="no";
				$data["dom"]="no";
				$data["kv"]=0;
				$data["indeks"]=0;
				$data["depot"]=0;
			}
			if (!empty($data["timex"])){
					$time=explode('-',$data['timex']);
					$data["timex"]= mktime(0,0,0,$time[1],$time[2],$time[0]);
			}else {
				return false;
			}
		$data['id_sessions']= $this->session->userdata('session_id');
		unset($data['order']);
		unset($data['answer1']);
		$data["id_good"]=$this->getJsonGoods($data);
		$i=$data["caunt"];
		while($i>0){
			unset($data["id_good".$i]);
			unset($data["quantity".$i]);
			$i--;
		}
		unset($data['caunt']);
		$this->form_validation->set_rules($this->add_rules);
		//var_dump ($data);exit;
		if($this->form_validation->run()){
			$this->table='order';
			$this->db->insert($this->table,$data);
			return true;
		}else {
			$data['erorr_kapcha'] =$this->validation->error_string;
			return $data['erorr_kapcha'];
		}
		
	}
	
	 /*
     Функция проверки на наличие telephona
    */
	public function tel($str) {
        return ( ! preg_match("^((8|\+7)[\- ]?)?(\(?\d{3}\)?[\- ]?)?[\d\- ]{7,10}$", $str)) ? FALSE : TRUE;
    } 
	
	 /*
     Функция проверки на наличие букв с пробелами кирилицей и латинскими.
    */
	public function mystring($str) {
        return ( ! preg_match("/^[A-Za-zА-Яа-яЁё\s]+$/", $str)) ? FALSE : TRUE;
    }  		
	//
}