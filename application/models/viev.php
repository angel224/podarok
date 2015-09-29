<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Viev extends Crud {
	protected $p ;// опубликована ли страница, ели 0 то нет, если 1 то да	
public function __construct () {
		parent::__construct();
		$this->table ='menu';
		$this->idkey ='id';
		$this->p=1;
		header('Content-type: text/html; charset=utf-8');
		}
	  
	  
	public function __call($name,$data) {
		if ($name=='add'){
			$this->lib_auth->check_admin();
			$this->add($data[0]);
		}else if($name=='levo_menu'){
			$data=$this->pages($data[0],$data[1]);
			return $data;
		}
	}
		
	  
	  
//Pokazivaet razdeli
public function mylist($p=1){
		$this->p=$p;
		$this->table='razdel';
		$this->db->select('razdel');
		$this->db->select('id_razdel');
		if($this->p==1){
			$this->db->where('public',1);
			$query = $this->db->get($this->table);
			$res= $query->result_array();
			foreach($res as $row)
						{
					   $resalt[$row['id_razdel']]=$row['razdel'];
					  }
			return $resalt;	
		}else if ($this->p==0){
			$this->lib_auth->check_admin();	
			$query = $this->db->get($this->table);
				$res= $query->result_array();
				foreach($res as $row)
							{
						   $resalt[$row['id_razdel']]=$row['razdel'];
						  }
				return $resalt;	
		}else{
			return false;
		}
		
}
		
//Pokazivaet kategorii
public function kategori($id_razdel,$id_kategori=''){
	if($this->p==1){
		$this->db->where('public',1);
	}else if($this->p==0){
		$this->lib_auth->check_admin();
	}else{
		return flse;
	}
	if(is_numeric($id_razdel) ){
			$this->table ='kategori';
			$this->db->where('id_razdel',$id_razdel);
			if (empty($id_kategori)){//Если $id_kategori не передано получаем список категорий в разделе
					$query = $this->db->get($this->table);
					$res= $query->result_array();
					if($res){
						foreach($res as $row)
							{
							$kategori[$row['id_kategori']]=$row['kategori'];
							}
						return $kategori;
					}else {
						return false;
					}
			} else{ //Если $id_kategori передано получаем данные с категории
				$this->db->where('id_kategori',$id_kategori);
				$query = $this->db->get($this->table);
				$res= $query->result_array();
				if($res){
					foreach($res as $row)
						{
							$kategori['title']= $row['title_kategori'];
							$kategori['key']= $row['key_kategori'];
							$kategori['description']= $row['description_kategori'];
							   
						}
					return $kategori;
						}else{
						return false;
						}
			}
		}	
	}	

		
//Pokazivaet tovari
public function goods($id_kategori,$p=1){
		$this->p=$p;
		if($this->p==1){
			$this->db->where('public',1);
			$this->table ='good';
			$this->db->where('id_kategori',$id_kategori);
			$query = $this->db->get($this->table);
			$res= $query->result_array();
				foreach($res as $row){
						   $good['goods'][$row['id_good']]['description_good']=$row['description_good'];
						   $good['goods'][$row['id_good']]['name']=$row['name'];
						   $good['goods'][$row['id_good']]['img']=$row['link2'];
						   $good['goods'][$row['id_good']]['id_good']=$row['id_good'];
				}
			return $good;
		}else if($this->p==0){
			$this->lib_auth->check_admin();
			$this->table ='good';
			$this->db->where('id_kategori',$id_kategori);
			$query = $this->db->get($this->table);
			$res= $query->result_array();
			foreach($res as $row){
					   $good['goods'][$row['id_good']]['description_good']=$row['description_good'];
					   $good['goods'][$row['id_good']]['name']=$row['name'];
					   $good['goods'][$row['id_good']]['img']=$row['link2'];
					   $good['goods'][$row['id_good']]['id_good']=$row['id_good'];
			}
			return $good;
		}else{
			return false;
		}
}		

//Функция выводит меню слева 
	protected function pages($id_razdel=1,$id_kategori=1){
				$this->p=0;
				$data['razdel']=$this->Viev->mylist($this->p);			
				foreach($data['razdel'] as $id_razdel=>$raz){
						$data['kategori'][$raz]=$this->kategori($id_razdel);
						foreach ($data['kategori'][$raz] as $id_kategori=>$kat){
						$data['goods'][$raz][$kat]=$this->goods($id_kategori,$this->p);
						}
									}
				return $data;
			}	
}