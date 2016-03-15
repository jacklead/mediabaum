<?php

class Site extends MX_Controller 
{
	function __construct()
	{
		/*$this->is_logged_in();*/
		/*modules::run('login/is_logged_in') ;*/
		if(modules::run('login/is_logged_in') != true)
		{
			redirect('login');
		}
		$this->load->helper('url');
        $this->output->set_template('default');
	}

	function members_area()
	{
		$this->output->set_common_meta('Area de usuarios', 'Area de usuarios', 'Area de usuarios');
		$this->load->view('logged_in_area');
	}

	
	function another_page() // just for sample
	{
		echo 'good. you\'re logged in.';
	}
	
	/*function is_logged_in()
	{
		$is_logged_in = $this->session->userdata('is_logged_in');

		if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');
		}		
	}*/	

}
