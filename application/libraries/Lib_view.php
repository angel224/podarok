<?php
 
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Lib_view {

public function __call($name,$data){
	if ($name=='admin_page'){
	$this-> admin_page($data[0],$data[1],$data[2]);
	}else {
	$this->lib_view->simple_page('login',array (),'���� ��������������');
	}
}
	
	
	//������� ���������� ��������� ������� �� ������ ������, ������ � ��������
public function admin_page($pagename, $data = array (), $title = '') {
		//������� ������� ����� - ��� ������� ������ ���������
		$d = array ();
		$d['title'] = $title;
		
		$CI = &get_instance(); //������ � CodeIgniter
		$CI->load->view('adm/heder.php',$d);
		
		//������ ������� ����� ���������
		$CI->load->view ('adm/'.$pagename.'.php', $data);
		
		//������ ��� ������
		$fdata = array();
		$fdata['validation_errors'] = validation_errors ();
		
		//����� ����� ������
		$CI->load->view ('adm/foter.php',$fdata);		
	}
	
		
	//������� ���������� ��������� �� ������ ������, ������ � �������� - �� �����
	function simple_page ($page, $data = array (), $title = '') {		
		
		$CI = &get_instance (); //������ � CodeIgniter
	
		//������� ������� ����� - ��� ������� ������ ���������
		$d = array ();
		$d['title'] = $title;
		$d['description'] = '���� � �������';
		$d['key'] = '������, �����';

		$CI->load->view ('heder.php',$d);		
		
		//���������		
		$CI->load->view ($page,$data);		
		
		//������ ��� ������
		$fdata = array();
		$fdata['validation_errors'] = validation_errors ();
		
		//����� ����� ������
		$CI->load->view ('foter.php',$fdata);		
		
	}	 
	
	
}


?>