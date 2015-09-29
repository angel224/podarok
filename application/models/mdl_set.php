<?php

/*
 * �������� �����: ������ �������� �������� 

 */

if (!defined('BASEPATH')) exit('No direct script access allowed');

class mdl_set extends CI_Model {
	
	
	function __construct(){
		parent::__construct();
		
		$this->load_config (); 
	}
	
	//������ ���������
	function load_config () {
		
		//�������� ���������� �� �������
  		if (!$this->db->table_exists('nastroika')) {
			$this->install ();
		} else {
			$this->load->library ('session');
		}
		
        $query = $this->db->get('nastroika');
        
        $sets = $query->result ();
        
        foreach ($sets as $row) {   
            $val = $row->znachenie;
            if (is_numeric ($val)) {
                $val = $val + 0;
            }                     
            $this->config->set_item ($row->name,$val);
        }
		
	}
	
	
	
	
}


?>