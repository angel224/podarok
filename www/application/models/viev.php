<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Viev extends CI_Model {
 
	 function __construct(){
	 parent::__construct();
	 //$table=;
	 //$data= new array();
	 }


function index($table)
	{
	$query = $this->db->get($table);
   	$res=$query->row_array();
	$description = $res['description'];
	$title = $res['title'];
	$key12 = $res['key'];
	$name=$res['name'];
	$data = array('description'=>$description, 'title'=>$title,'key12'=>$key12);
	}






}