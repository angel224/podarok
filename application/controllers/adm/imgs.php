<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class Imgs extends CI_Controller {
private $file_info;
public function __construct () {
	parent::__construct();
	$this->load->model('Mdl_img');
	$this->lib_auth->check_admin();
	}


//Функция просмотра всех картинок	
public function imglist() {
$data['list']= $this->Mdl_img->data['list'];
			$caunt=0;
			foreach ($data['list'] as $img){
			if ($img=="smoll" or $img=="thumb"){
				}else{	 
				$peremen='img'.+$caunt;
				$caunt++;
			$res["$peremen"]=$this->Mdl_img->get($img);
			foreach ($res as $key=>$img_data)
						{
			$dataimg[$key]=$img_data;
							}
								}		
				}
if(!empty($dataimg)){
$this->lib_view->admin_page('imglist',$dataimg,'Работа с изображениями');}
else{
$img0='';
$this->lib_view->admin_page('imglist',$img0,'Работа с изображениями');
}
}


//Функция загрузки картинок на сервер
 public function imgnew(){
  if(!$this->input->post('userfile')){
	$this->file_info = $this->Mdl_img->imgnew();
  $data["error_valid"]=$this->resize();
  $data["upload_data"] = array('upload_data' => $this->upload->data());
     if(isset($data["error_valid"])){
	 $path='img/photo/'.$data["upload_data"]["upload_data"]["file_name"]; //создаем путь к картинке
	  	unlink($path);
		 redirect ('/admin/img');
	}else{
	$this->lib_view->admin_page('upload_success',$data,'Фото добавленно');
   }
   }
 }
 
 
//Функция удаления картинок с сервера
 public function imgdel($name_img){
  $this->Mdl_img->img_del($name_img);
 redirect ('/admin/img');
 }
 
 
//Функция редактирования картинок (редактирование альтов и титле)
  public function imgedit($name_img){
  if(!$this->Mdl_img->edit_text($name_img))$this->imglist();
  
  
}


//Функция создания миниатюры
protected function resize(){
$data=$this->Mdl_img->add($this->file_info['upload_data']['file_name']);
if(!$data['error_valid']){
$this->Mdl_img->wote_set($this->file_info['upload_data']['file_name']);	
$this->Mdl_img->resize1($this->file_info['upload_data']['file_name']);
$this->Mdl_img->resize2($this->file_info['upload_data']['file_name']);
}else
return $data;
 }
 

 
 


}
?>