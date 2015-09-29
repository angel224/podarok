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
			$data=$this->edit_order($data[0],$data[1] );
			return $data;
		}else if($name=='get_stori'){
			$data=$this->get_stori($data[0]);
			return $data;
		}else if($name=='index'){
			$data=$this->index($data[0]);
			return $data;
		}
	}
	
// Функция достает и возвращает массив ордеров и масивы товаров под именем клиента
	private function index($data=""){
	$this->lib_auth->check_admin();
	$this->table= "order";
	//$this->idkey ='id_sessions';
	$query = $this->db->get($this->table);
	$res= $query->result_array();
	//var_dump($res);exit;
	foreach ($res as $key=>$val){
		$id=$val['klient'];
		$good=$val['id_good'];
		$resalt = json_decode($good);// в $resalt обекты с товарами.Их может быть несколько
		//var_dump($resalt);exit;
			foreach($resalt as $key1=>$one){
				foreach ($one as $key2=>$too){
					if($key2=="id_good"){
						$this->load->model('Mdl_basket');
						$res[$id]["$key2".$key1]=$this->Mdl_basket->get_name($too);
					}else{
						$res[$id]["$key2".$key1]=$too;
					}
				}
				
			}
	}
	return $res;
}

	
	//Функция удаления ордеров
	private function del_order ($id){
		$this->Crud->table='order';
		$this->Crud->idkey ='id_sessions';
		if ($this->Crud->del($id)){
			return true;
		}else{
			return false;
		}
	}
	
	//Функция редактирования истории ордера
	private function edit_order ($id , $data){
		$this->add_rules = array (
						array(
							'field'   => 'prim', 
							 'label'   => 'примечания', 
							 'rules'   => 'trim|required|xss_clean'
						  ),
						array(
							'field'   => 'id_sessions', 
							 'label'   => 'ид сесии', 
							 'rules'   => 'trim|integer|xss_clean|max_length[4]'
						  ));
						  
		$this->form_validation->set_rules($this->add_rules);
		if($this->form_validation->run()){
			$this->table='order';
			$data1["prim"]=$data;
			$data1["time"]=time();
			$histori=$this->get_stori ($id);
			$a=count($histori)-1;
			if($histori){
				if(count ($histori)==1){
					foreach($histori as $key1=>$one){
						$res[$key1]=$one;
						$data2= array( 0=>$data1,1=>$res[0]);
					}
				}else{
					$data2= array(0=>$data1);
					for ($i = 0; $i <= $a; $i++) {
						$index=$i+1;
						foreach($histori[$i] as $key2=>$too){
							$res1[$key2]=$too;
						}
						$data2[$index]=$res1;
									
					}
				}
				
			}else{
				$data2= array(0=>$data1);
			}
			$json_stori = json_encode($data2);
			$data =array(
							'prim'   => $json_stori
							
						  );
			$this->db->where($this->idkey,$id);
			$this->db->update($this->table,$data);
			return true;
		}else {
			return false;
		}
	}
	
	
	// Функция получения истории ордера
	private function get_stori ($id=""){
		$res=$this->get($id);
		if($res){
		$msg1=json_decode($res["prim"]);
		return $msg1;
		}else{
			return $res;
		}
	}

}
?>