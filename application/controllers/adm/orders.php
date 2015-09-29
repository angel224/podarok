<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Orders extends CI_Controller  {
	public function __construct () {
		parent::__construct();
		$this->lib_auth->check_admin();
		$this->load->model('Mdl_order');
		//$this->load->model('Viev');
		//$this->load->helper('file');
		
	}
	
	public function __call ($name , $data) {
		if ($name == 'del_order'){
			$this->del_order($data[0]);
			//return $data;
		}else if($name == 'edit_order'){
			$this->edit_order($data[0]);
			//return $data;
		}else if($name =="get_stori"){
			$this->get_stori( $data[0] );
			//return $data;
		}else if($name=='index'){
			$this->index($data[0]);
			//return $data;
		}
	}
	
	public function index ($data1=""){
		if(empty($data1)){
		$data['order'] = $this->Mdl_order->index("");
			$this->lib_view->admin_page('index',$data,'Панель администратора');
		}else{
			$data["msg"]=$data1;
			$data['order'] = $this->Mdl_order->index("");
			$this->lib_view->admin_page('index',$data,'Панель администратора');
		}
	}
	
	//Функция удаления ордеров
	public function del_order ($id){
			//var_dump($next);exit;
		if ($this->Mdl_order->del_order($id)){
			$this->index("Удаление успешо");
		}else{
			$this->index("Произошла ошибка");
		}
	
	}
	
	//Функция редактирования истории ордера
	public function edit_order ($id=""){
		$data = $this->input->post('prim');
		if(isset($data)){
			if($this->Mdl_order->edit_order($id, $data)){
				$this->index("История добавленна");
			}else{
				$this->index("Что то пошло не так обратитесь к администратору");
			}
			
		}
		
	}
	
	
	// Функция получения истории ордера
	public function get_stori($id){
		$msg1=$this->Mdl_order->get_stori($id);
		if($msg1){
			foreach($msg1 as $key1=>$one){
				foreach($one as $key2=>$too){
					$res[$key1][$key2]=$too;
				}
			}
			$msg2="";
			for ($i = 0; $i <=count($res)-1; $i++) {
				$msg2.= "<tr>
							<td>". date ("d/m/o G:i:s ",$res[$i]['time'] )."</td>
							<td>".$res[$i]['prim']."</td>
						</tr>";
				
			}
			$msg="<table>
							<tr>
								<th>Дата:</th>
								<th class='big'>Запись</th>
							</tr>
					".$msg2.
					"</table>";
			echo $msg;
		}else{
			$msg="<p>История пока не была добавлена!!</p>";
			echo $msg;
		}
	}
	
}	
?>