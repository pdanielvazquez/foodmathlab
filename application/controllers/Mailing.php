<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mailing extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->helper('url');
		$this->load->library('session');
		$this->load->library('email');


	}

	function enviaCorreo(){

		$config = array();
		$config['protocol'] = 'smtp';
		$config['smtp_host'] = 'email-smtp.us-east-1.amazonaws.com';
		$config['smtp_user'] = 'AKIA2WEACUCFHGLNR6PI';
		$config['smtp_pass'] = 'BJ/4B7iI6ztwpN+LD6MOepfMIIpoeRaNUm+lWxB0JAUz';
		$config['smtp_port'] = 587;
		$this->email->initialize($config);
		$this->email->set_newline("\r\n");
		
	}
}