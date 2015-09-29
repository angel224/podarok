<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Vievs extends CI_Controller {
	 function __construct()
	 {
	 parent::__construct();
	//$this->load->model('Viev',TRUE);
	  }

	
	function index()
	{
	//$this->load->model('CRUD',TRUE);
	//$this->db->where('name', 'index');	
	//$query = $this->db->get('menu');
	//$this->load->model('Viev',TRUE);
   	$this->Viev->get(1);
	//$res=$query->row_array ();
	  // $description = $this->Viev->res['description'];
	  // $title =$this->Viev->res['title'];
	  // $key12 =$this->Viev->res['key'];
	// $data = array('description'=>$description, 'title'=>$title,'key12'=>$key12);
	 
	 //$data = array('description'=>$description, 'title'=>$title,'key12'=>$key12);
	print_r ($this-post->input($res););
	 //$this->load->view('heder',$data);
	//$this->load->view('foter');
	}
}



/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */