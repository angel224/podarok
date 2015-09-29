<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Baskets extends CI_Controller  {
	public function __construct () {
		parent::__construct();
		$this->load->model('Mdl_basket');
		$this->load->model('Viev');
		$this->load->helper('file');
		
	}
	
// Фукция добавляет товар в сесию, считает количество товаров
	public function addbasket(){
		$next=$_SERVER['HTTP_REFERER'];
		$data=$this->input->post();
			if($data["answer"]==$this->session->flashdata('word')){
				$quantity=$data['quantity']*1;
				$id_good=$data["id_good"]*1;
				$cena=$data["cena"]*1;
				$name=$data["name"];
				$link2=$data["link2"];
				if($this->Mdl_basket->get_name($id_good)==$name){
					$caunt=$this->session->userdata('basket');
					if($caunt){
						$caunt++;
					}else{
						$caunt=1;
					}
					$this->session->set_userdata('basket',$caunt);
					$user="$name|$id_good|$quantity|$cena|$link2";
					$this->session->set_userdata("user_$caunt",$user);
					header("Location: $next");
				}else{
					$data['erorr_kapcha']=1;
					header("Location: $next".'/'.$data['erorr_kapcha']);
				}
			}else {
				$data['erorr_kapcha']=2;
				header("Location: $next".'/'.$data['erorr_kapcha']);
			}
	
	}
	
	
	//Удаляет данные по товарам из сесии.
	public function delbasket(){
		$caunt=$this->session->userdata('basket');
		while($caunt>0){
			$this->session->unset_userdata("user_$caunt");
			$caunt--;
		}
		$this->session->unset_userdata("basket");
		$this->session->sess_update(1);
		//$data['id_sessions']= $this->session->userdata('session_id');
	}
	
	// Функция добавляет заказ в базу
	public function addorder() {
		$next=$_SERVER['HTTP_REFERER'];
		$data=$this->input->post();
		//var_dump($next);exit;
		if($data["answer1"]==$this->session->flashdata('word')){
			$data['validarion']=$this->Mdl_basket->addorder($data);
			if($data['validarion']==true){
				//var_dump($data);exit;
				$this->delbasket();
				$this->session->set_userdata('data',$data);
				header("Location: ../vievs/index/1");
			}else{
				$this->session->set_userdata('data',$data);
				$data['erorr_kapcha'] =$data['validarion'];
				header("Location: ../vievs/index/3/".$data['erorr_kapcha']);
			}
		}else{
			$this->session->set_userdata('data',$data);
			$this->session->set_userdata("data['erorr_kapcha']","Вы не правильно ввели символы на картинке. Будьте внимательны и повторите попытку");
			header("Location: $next");
			
		}	
		
			
		
	
	}
	
}