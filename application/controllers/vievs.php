<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vievs extends CI_Controller {
	function __construct()
	 {
	 parent::__construct();
	$this->load->model('Viev');
	}
//Подумать таки над функцией отображения в библиотеку. С помощу кейсов мона заделать.Функцию отражения левого меню можно тоже как нить вынести.

//Функция выводит контент в зависимости от того что запросили в верхнем меню.	
public function index($id){
	if(!empty($data)){
		$data['erorr_kapcha']=$data;
	}
	$data= $this->Viev->get($id);
	$this->load->view('heder',$data);
		if ($id==1){
			$this->levo_menu();
			$this->load->view('glavnaja',$data);
			$this->load->view('foter');
		}else if($id==3){ // Если троечка то выводим баскет
			$session_id = $this->session->userdata('session_id');
			if($this->session->userdata('basket')){
				$caunt=$this->session->userdata('basket');
				$data["caunt"]=$caunt;
				while($this->session->userdata("user_$caunt")){
						$user_basket=$this->session->userdata("user_$caunt");
						list($name_user,$id_good_user,$quantity_user,$cena_user,$link2_user)=explode ('|',$user_basket);
						$data['good'][$caunt]['name']=$name_user;
						$data['good'][$caunt]['id']=$id_good_user;
						$data['good'][$caunt]['quantity']=$quantity_user;
						$data['good'][$caunt]['cena']=$cena_user;
						$data['good'][$caunt]['link2']=$link2_user;
						$caunt--;
				}
				
			}
			if( $this->session->userdata('erorr_kapcha') ){
				$data['erorr_kapcha']=$this->session->userdata('erorr_kapcha');
				$this->session->unset_userdata('erorr_kapcha');
				//$data['erorr_kapcha']= "Вы не правильно ввели символы на картинке. Будьте внимательны и повторите попытку";
			}
			if($this->session->userdata('data')){
				$data['klient']=$this->session->userdata('data');			
			}
			$this->load->view('basket', $data);
			$this->load->view('foter');
		}else{
			$this->load->view('glavnaja',$data);
			$this->load->view('foter');
		}
}


	
//Функция выводит контент в зависимости от того, что запросили в левом меню.		
public function levo($id_razdel='1',$id_kategori=''){
	//Начинаеться вывод товаров
	if(!empty($id_kategori)){
	$data= $this->Viev->kategori($id_razdel,$id_kategori);
		if($data){
			$this->load->view('heder',$data);
			$this-> levo_menu();
			$data['goods'] = $this->Viev->goods($id_kategori);
			//var_dump($data['goods']);exit;
			$this->load->view('goods',$data['goods']);
			$this->load->view('foter');
			}else{
			$this->erorr404();
			}
	} else {
		//Вывод разделов и категорий
		if(is_numeric($id_razdel) or !empty($id_razdel)){
			$this->Viev->table ='razdel';
			$this->Viev->idkey ='id_razdel';
			$data= $this->Viev->get($id_razdel);
			$this->load->view('heder',$data);
			$this-> levo_menu();
			$data['text']=$data['description'];
			$this->load->view('glavnaja',$data);
			$this->load->view('foter');
			}else{
			$this->erorr404();
			}
		}
}	

//Функция выводит меню слева
protected function levo_menu($id_razdel=1,$id_kategori=1){
			$data['razdel']=$this->Viev->mylist();		
				foreach($data['razdel'] as $id_razdel=>$raz){
						$data['kategori'][$raz]=$this->Viev->kategori($id_razdel);
						
				}
			$this->load->view('levo',$data);
	}
	


public function show_good($good,$data_error=""){
	if( is_numeric($good)){
		$this->Viev->table ='good';
		$this->Viev->idkey='id_good';
		$data= $this->Viev->get($good);
			if(!empty($data)){
			$data['description']=$data['description_good'];
			$data['title']=$data['title_good'];
			$this->load->view('heder',$data);
			$this->levo_menu();
			if(!$data['basket']=$this->session->userdata('basket'))
				$data['basket']=' нет';
			
			if( !empty($data_error) ){
				if($data_error ==2){
					$data['erorr_kapcha']= "Вы не правильо ввели символы на картинке. Будьте внимательны и повторите попытку";
					
				}else {
					$data['erorr_kapcha']= "Что то пошло не так. Попробуйте еще раз";
				}
				//var_dump($data);exit;
			}
			$this->load->view('good_page',$data);
			$this->load->view('foter');
			}else{
			$this->erorr404();
			}
	}else {
			$this->erorr404();
			}
}
	
public function erorr404() {
	$data['title']='404 Page Not Found';
	$data['key']=$data['title'];
	$data['description']=$data['title'];
	$data['text']='<h1>404 Page Not Found</h1>';
	$this->load->view('heder',$data);
	$this->levo_menu();
	$this->load->view('glavnaja',$data);
	$this->load->view('foter');
}

// Отрисовывает каптчу
public function get_captcha(){
	$this->load->helper('My_captcha_helper');
	$this->load->helper('string');
	$string =random_string('alpha',5);
	$prefs = array(				// настройки капчи, все элементы являются необязательными
		'word'	 => $string,		// текст
		'img_width' => 100,			// ширина изображения (int)
		'img_height' => 30,			// высота изображения (int)
		'random_str_length' => 5,		// длина случайной строки (int)
		'border' => FALSE,			// добавлять рамку (bool)
		'font_path' => './sistem/fonts/texb.ttf'	// путь к файлу шрифта
    );
	$word = create_captcha_stream($prefs);
    $this->session->set_flashdata('word', $word);
}


}
