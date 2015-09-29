<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Mdl_img extends Crud {
public $data = array();
public function __construct () {
	parent::__construct();
	$this->idkey ='name';
	$this->table ='img';
	$this->load->helper('directory');
	$d=$this->config->item('upload_path');
	$this->data['list']=directory_map("$d",true);//Берем только картинки без минимизации
	return $this->data['list'];
	}

//Функция инициализации настроек для загрузки файлов
public function imgnew(){
$config['upload_path'] =$this->config->item('upload_path') ;
$config['allowed_types'] = $this->config->item('allowed_types');
$config['max_size']	= $this->config->item('max_size');
$config['max_width'] =$this->config->item('max_width');
$config['max_height'] =$this->config->item('max_height');
$this->load->library('upload',$config);
if ( !$this->upload->do_upload())
		{
			$data =array('error' => $this->upload->display_errors());
			$this->lib_view->admin_page('imglist',$data,'Раюбота с изображениями');
		}
		else
		{
		$data['upload_data'] = $this->upload->data();
		return $data;
		}
}



//Функция инициализации настроек для инимизации картинок
public function resize1($file_name){
$this->image_lib->clear();	
$config['image_library']=$this->config->item('image_library');
$config['source_image']	= $this->config->item('upload_path')."/".$file_name;
if($this->config->item('create_thumb')==True){$config['create_thumb'] =TRUE;}
if($this->config->item('maintain_ratio')==True){$config['maintain_ratio'] =TRUE;}
$config['width']=$this->config->item('width');
$config['height']= $this->config->item('height');
$url_img=explode(".",$file_name);
$config['new_image']=$this->config->item('upload_path').'/thumb/'.$url_img[0].'_thumb.'.$url_img[1];
//$this->load->library('image_lib',$config);
$this->image_lib->initialize($config);
$flag = $this->image_lib->resize();
if ( ! $flag)
{
   die ($this->image_lib->display_errors('<p>', '</p>'));
}
}



//Функция инициализации настроек для mинимизации картинок2
public function resize2($file_name){
$this->image_lib->clear();	
$config['image_library'] =$this->config->item('image_library');
$config['source_image']	= $this->config->item('upload_path')."/".$file_name;
if($this->config->item('create_thumb')==True){$config['create_thumb'] =TRUE;}
if($this->config->item('maintain_ratio')==True){$config['maintain_ratio'] =TRUE;}
$config['width']=500;
$config['height']= 500;
$config['new_image']=$this->config->item('upload_path').'/smoll/'.'500x500_'.$file_name;
$this->image_lib->initialize($config);
$this->image_lib->resize();
if ( ! $this->image_lib->resize())
{
  die ($this->image_lib->display_errors('<p>', '</p>'));
}
}


// dobavlenie kartinok
public function add($file_name){
 $this->add_rules = array (
				array(
                     'field'   => 'title_img', 
                     'label'   => 'Титл картинки', 
                     'rules'   => 'min_length[6]'
                  ),
               array(
                     'field'   => 'alt_img', 
                     'label'   => 'Альт картинки', 
                     'rules'   => 'min_length[6]'
                  )/*,
                array(
                    'field'   => 'userfile', 
                     'label'   => 'Файл путь ', 
                     'rules'   => 'min_length[6]'
                  )*/);
				  
$this->form_validation->set_rules($this->add_rules);
		if ($this->form_validation->run ()) {
			$data = array ();
			foreach ($this->add_rules as $one) {
				
				$f = $one['field'];
				
				$data[$f] = $this->input->post ($f);
				}
				$data['name']=$file_name;
				$url_img=explode(".",$file_name);
				$data['url_img']='http://test7.net.loc/img/photo/thumb/'.$url_img[0].'_thumb.'.$url_img[1];
				$this->db->insert ($this->table,$data);
				return $this->db->insert_id(); 
					} 
	else {
	 $data['error_valid']= validation_errors();
	 return $data;
		}
}
  
  
  
//Функция удаления картинок
public function img_del($name_img){
 $this->Mdl_img->del($name_img); //удаляем с базы
$this->load->helper('file');
 $path='img/photo/'.$name_img; //создаем путь к картинке
 unlink($path);
 $name_img=explode(".",$name_img);// вырезаем разширение
 $path2='img/photo/smoll/'.'500x500_'.$name_img[0].'.'.$name_img[1];//удаляем смолы
 unlink($path2);
 $path3='img/photo/thumb/'.$name_img[0].'_thumb'.'.'.$name_img[1];//удаляем миниатюры
  unlink($path3);
}


public function img_edit(){
}


//Функция редактирования альтов и титле картинок
public function edit_text($name_img){
$this->edit_rules = array (
				array(
                     'field'   => 'title_img', 
                     'label'   => 'Титл картинки', 
                     'rules'   => 'min_length[6]'
                  	),
               array(
                     'field'   => 'alt_img', 
                     'label'   => 'Альт картинки', 
                     'rules'   => 'min_length[6]'
					 )
					 );
$data['title_img']=$this->input->post('title_img');
$data['alt_img']=$this->input->post('alt_img');
$this->edit($name_img);
}

//Функция инициализации настроек для водяного знака
public function wote_set($file_name){
$url=$this->config->item('base_url');
$config['source_image']	= $this->config->item('upload_path')."/".$file_name;
$config['wm_text'] = 'Картинка принадлежит сайту : '.$url;
$config['new_image']=$this->config->item('upload_path').'/'.$file_name;
$config['wm_type'] = 'text';
$config['wm_font_path'] = './system/fonts/texb.ttf';
$config['wm_font_size']	= '20';
$config['wm_font_color'] = 'ffffff';
$config['wm_vrt_alignment'] ='middle';
$config['wm_hor_alignment'] ='center';
$config['wm_padding'] = '150';

$this->load->library('image_lib',$config);
$this->image_lib->watermark();
}

	



}
?>