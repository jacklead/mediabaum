<?php

class Admin extends MX_Controller 
{
	function __construct()
	{
	
		if($this->_is_admin() != true)
		{
			redirect('site/members_area');		
		}
		$this->load->helper('url');
		/*$this->load->section('sidebar', 'ci_simplicity/sidebar');*/
		$this->output->set_common_meta('Panel de control', 'Dashboard Admin', 'Admin');
        $this->output->set_template('default');
	}

	function index()
	{

		$this->admin_area();
		
	}

	function admin_area()
	{
		$this->load->model('usuarios_model');
		$data['usuarios'] = $this->usuarios_model->get_users();
		$this->load->view('admin_area', $data);
	}
	

	function admin_profile() 
	{
		if($this->input->post('update') == 1)
		{
			$this->edit_admin();
			
		}
		else
		{
			$this->load->model('usuarios_model');
			$data['admin'] = $this->usuarios_model->admin_profile();		
			$this->load->view('admin_profile',$data);
		}
		
		
	}

	function activate_user()
	{
		

		$data = array(
				'id' => $this->input->post('id'),
				'status' => $this->input->post('status'),
			);

		$this->load->model('usuarios_model');
	    $update = $this->usuarios_model->activate_user($data);
        $user = $this->usuarios_model->get_user($this->input->post('id'));
        if($user[0]['status'])
        {
            $this->usuarios_model->send_mail($this->usuarios_model->make_unique(),$user[0]['email']);
        }



	}

	function delete_user()
	{
		$data = array(
				'id' => $this->input->post('id'),

			);

		$this->load->model('usuarios_model');
	    $update = $this->usuarios_model->delete_user($data);
	    if($update)
	    {
	    	echo 'Usuario '.$this->input->post('id').' Eliminado';
	    }
	}

	function create_member()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules

		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required|is_unique[usuarios.dni]');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email|is_unique[usuarios.email]');
		$this->form_validation->set_rules('fecha_nacimiento', 'Fecha de nacimiento', 'trim|required');
		$this->form_validation->set_rules('ciudad_nacimiento', 'Ciudad de nacimiento', 'trim|required');
		$this->form_validation->set_rules('edad', 'Edad', 'trim|required');
		$this->form_validation->set_rules('genero', 'Genero', 'trim|required');
		$this->form_validation->set_rules('carrera', 'Carrera', 'trim|required');
		$this->form_validation->set_rules('recursa', 'Recursa', 'trim|required');
	
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->view('signup_form');
		}
		
		else
		{			
			$this->load->model('usuarios_model');
			
			if($query = $this->usuarios_model->create_member())
			{
				/*$data['main_content'] = 'signup_successful';
				$this->load->view('includes/template', $data);*/
				$this->load->view('signup_successful');
			}
			else
			{
				$this->load->view('signup_form');			
			}
		}
		
	}

	function edit_admin()
	{
		$this->load->library('form_validation');
		
		// field name, error message, validation rules

		$this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
		$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
		$this->form_validation->set_rules('dni', 'DNI', 'trim|required');
		$this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[32]');
		$this->form_validation->set_rules('repetir_password', 'Repetir Password', 'trim|matches[password]');


	
		
		if($this->form_validation->run() == FALSE)
		{
			$this->load->model('usuarios_model');
			$data['admin'] = $this->usuarios_model->admin_profile();		
			$this->load->view('admin_profile',$data);;
		}
		
		else
		{			
			$this->load->model('usuarios_model');
			
			if($query = $this->usuarios_model->edit_admin())
			{

				$this->load->view('admin_successful_update');
			}
			else
			{
				$this->load->view('admin_profile');			
			}
		}
	}
	
	function _is_admin()
	{
		
		return $_is_admin = $this->session->userdata('_is_admin');
		
	/*	if($is_admin != true)
		{
			redirect('site/members_area');		
		}		
*/
	}



	

}