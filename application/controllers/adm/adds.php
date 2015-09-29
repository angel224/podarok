<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Adds extends CI_Controller  {
	public function __construct () {
			parent::__construct();
			$this->load->model('Mdl_add');
			$this->load->library('javascript');
			$this->load->helper('tinymce_helper');
			nocache_headers ();
	}
		
//Функция просмотра и выбора страниц
	public function index(){
	nocache_headers ();
	$data['razdel']=$this->Mdl_add->mylist();
	$data['img']=$this->get_miniaturs();
	$this->lib_view->admin_page('add',$data,'Добавление страницы');
	//$this->imgtiny(); Раскоментировать для просмотра массива картинок.
	}


//
	public function ajax(){
		$id_razdel=$this->input->get_post('id_razdel',TRUE);
		$kategori=$this->Mdl_add->kategori($id_razdel);
		$msg="<td align=\"right\"><b>В категорию:</b></td><td align=\"left\" ><select id=\"s3\" name=\"select3\">";
		$msg.="<option>{Выбирите}</option>";
		foreach ($kategori as $kat_id=>$kat){
			$msg.="<option id=".$kat_id.">".$kat."</option>";
		}
		$msg.="</select></td>";
		$data['msg']=$msg;
		$this->load->view("adm/kategori",$data);
		//echo $msg;
	}


// функция для показа картинок в TinyMCE
	 public function imgtiny() {
		//формируем список $code.  Начало
	 $code='var tinyMCEImageList= new Array (';
		//достаем фотки
	 $this->load->helper('directory');
	 $falelist= directory_map('./img/Photo',true);
	 $firstelement=true;
		//проходимся в цикле по фоткам
	 foreach ($falelist as $img){
		if($firstelement){
		 $firstelement=false;
		}else{
		$code.=', ';
		}
		//если фотка имеет название директории то уходим на рекурсию
		if($img!=='smoll' and $img!=='thumb'){
		$code.='["'.$img.'","'.base_url().'img/Photo/'.$img.'"]';
		//$code.='["'.$img.'","'.base_url().'img/Photo/'.$img.'","alt","title"]'; Пробовал достать альты и титле.не понятно как передаються.Картинки не явл. объектами. Так как список формируеться массивом. Возможно при выборе появляеться обект-конкретная картинка.И там появляеться свойство тиле и альт.
		}else {
		$get= directory_map('./img/Photo/'.$img,true);
		// тут достаем фотки маленького размера
		foreach ($get as $img1){
		if($get){
		 $get=false;
		}else{
		$code.=', ';
		}
		$code.='["'.$img1.'","'.base_url().'img/Photo/'.$img.'/'.$img1.'"]';
		}
		}
	  }
		// заканчиваем формирование масива  фоток $code
	$code.=" );";
		// выводим фотки
	echo $code;
	 }



//Функция добавления в базу
public function add (){
	$data=$this->input->post();
	$data["select1"]==$data["select1"]*1;
	if($data["select1"]==3){
		if($this->Mdl_add->add($data)){
		unset ($data);	
		header('Location: '.base_url().'/adm/adds/index');
		}else{
		$this->lib_view->admin_page('add',$data,'Добавление страницы');
		}
	}else if($data["select1"]==2){
		if($this->Mdl_add->add_kategori($data)){
		unset ($data);	
		header('Location: '.base_url().'/adm/adds/index');
		}else{
		$this->lib_view->admin_page('add',$data,'Добавление страницы');
		}
	}else if($data["select1"]==1){
		if($this->Mdl_add->add_razdel($data)){
		unset ($data);	
		header('Location: '.base_url().'/adm/adds/index');
		}else{
		$this->lib_view->admin_page('add',$data,'Добавление страницы');
		}
	}
}

//функция выдает все миниатюры
	protected function get_miniaturs() {
		$this->load->model('Mdl_img');
		$data['list']= $this->Mdl_img->data['list'];
		$caunt=0;
		foreach ($data['list'] as $img){
					if ($img=="smoll" or $img=="thumb"){
						}else{	 
						$peremen='img'.+$caunt;
						$caunt++;
					$img=$this->Mdl_img->get($img);
					$res["$peremen"]=$img['url_img'];
					}
				}
				return $res;
	}
}