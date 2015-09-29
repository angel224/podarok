<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Crud extends CI_Model {
	public $table; //РРјСЏ С‚Р°Р±Р»РёС†С‹
	public $idkey; //РљР»СЋС‡ ID
	public $add_rules = array (); //РџСЂР°РІРёР»Р° РІР°Р»РёРґР°С†РёРё РґР»СЏ РґРѕР±Р°РІР»РµРЅРёСЏ
	public $edit_rules = array (); //РџСЂР°РІРёР»Р° РІР°Р»РёРґР°С†РёРё РґР»СЏ СЂРµРґР°РєС‚РёСЂРѕРІР°РЅРёСЏ
	public	function __construct () {
			parent::__construct();
			header('Content-type: text/html; charset=utf-8');
			}
	
		
	public function __call($name,$data='') {
				$this->lib_auth->check_admin();
				switch ($name){
				case 'add_p':
					if(!$this->_add)return false;
					break;
				case 'edit':
					if($this->_edit($data[0]))return true;
					break;
				case 'del':
					if($this->_del($data[0])){
					return true;
					}
					break;
				default:
					header('Location: '.base_url());
					exit;
				
				}
			}
	
	
	/**
 	* Р¤СѓРЅРєС†РёСЏ РґР»СЏ РґРѕР±Р°РІР»РµРЅРёСЏ 
	*/	
	private function _add() {
			$this->form_validation->set_rules($this->add_rules);
			if ($this->form_validation->run ()) {
				$data = array ();
				
				foreach ($this->add_rules as $one) {
					
					$f = $one['field'];
					
					$data[$f] = $this->input->post($f);
					}
							$this->db->insert ($this->table,$data);
				return $this->db->insert_id(); //Р’РѕР·РІСЂР°С‰Р°РµС‚ РЅРѕРјРµСЂ С‚РѕРІР°СЂ
				
		} else {
				return FALSE;
				
			}
		}
	
	/**
	 * Р¤СѓРЅРєС†РёСЏ РґР»СЏ СЂРµРґР°РєС‚РёСЂРѕРІР°РЅРёСЏ
	 */
	private function _edit ($id) {
				$this->form_validation->set_rules($this->edit_rules);
				if ($this->form_validation->run ()) {
				
					$data = array ();
				
						foreach ($this->edit_rules as $one) {
					
							$f = $one['field'];
					
							$data[$f] = $this->input->post ($f);
						}
					$this->db->where ($this->idkey, $id);
					$this->db->update ($this->table,$data);
				return true; 
				
				} else {
				return false;
				}		
			}
    
    /**
     * Р¤СѓРЅРєС†РёСЏ СѓРґР°Р»РµРЅРёСЏ
     */
	private function _del ($id) {
				$this->db->where ($this->idkey, $id);
				$this->db->delete($this->table);
				return true;
			}
    
		/**
     * ????????? ??????
     */
	public function get($id='') {
			if($id!='')$this->db->where($this->idkey,$id);
			//$this->db->where('public',1);
			$query = $this->db->get($this->table);
			$res=$query->row_array ();
			return $res;
			}
    
    
    /**
     * РџРѕР»СѓС‡РµРЅРёРµ СЃРїРёСЃРєР°
     */
	public function getlist ($start_from = FALSE){
			
			//РЎС‚Р°РІРёРј СЃРїРёСЃРѕРє СЃРѕСЂС‚РёСЂРѕРІРєРё
			$sort_by = $this->session->userdata ('sort_by');
			$sort_dir = $this->session->userdata ('sort_dir');
			
			//Р•СЃР»Рё РЅРµ РїСѓСЃС‚С‹Рµ Р·РЅР°С‡РµРЅРёСЏ - СЃС‚Р°РІРёРј СЃРѕСЂС‚РёСЂРѕРІРєСѓ
			if (!empty ($sort_by)) {
				$this->db->order_by($sort_by,$sort_dir);			
			}
		
		//Р”Р»СЏ РїРѕРёСЃРєР°
		$search = $this->session->userdata ('search');		
		$search_by = $this->session->userdata ('search_by');

		//Р•СЃР»Рё РЅРµ РїСѓСЃС‚С‹Рµ Р·РЅР°С‡РµРЅРёСЏ - СЃС‚Р°РІРёРј РїРѕРёСЃРє
		if (!empty ($search)) {
			$this->db->like($search_by,$search);			
		}

		

    	if ($start_from !== FALSE) {
    		$this->db->limit($this->config->item ('cms_per_page'), $start_from);
			//РћРіСЂР°РЅРёС‡РµРЅРёРµ    		
    	}
    	
    	$query = $this->db->get ($this->table);
    	return $query->result_array ();
    }
	
} 
?>