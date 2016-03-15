<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class Users extends MX_Controller{

    function __construct()
    {

        /*if($this->_is_user() != true)
        {
            redirect('site/members_area');
        }*/

        $this->load->helper('url');
        /*$this->load->section('sidebar', 'ci_simplicity/sidebar');*/
        $this->output->set_common_meta('Panel de control', 'Dashboard Usuario', 'Usuario');
        $this->output->set_template('default');
    }

    function index()
    {
        $this->user_profile();

    }
	
/*	function index(){
		$data["users"] = $this->user_model->read();
		$data['main_content'] = 'users';
		$this->load->view('page', $data);
	}*/
	
/*	function user($nicename){
		$data["user"] = $this->user_model->user_by_nicename($nicename);
		
		if($data["user"]){
			$data['main_content'] = 'user';
			$this->load->view('page', $data);
		}else{
			show_404();
		}
		
	}
	
	function signin(){
		//Redirect
		if($this->_is_logged_in()){
			redirect('');
		}
		
		if($_POST){
			//Data
			$user_email = $this->input->post('user_email', true);
			$password 	= $this->input->post('password', true);
			$userdata 	= $this->user_model->validate($user_email, md5($password));	
			
			//Validation
			if($userdata){
				if($userdata->status == 0){
					$data['error'] = "Not validated!";
					$data['main_content'] = 'signin';
					$this->load->view('page', $data);
				}else{
					$data['userid'] = $userdata->id;
					$data['logged_in'] = true;
					$this->session->set_userdata($data);
					redirect('');
				}				
			}else{
				$data['error'] = "You shall not pass!";
				$data['main_content'] = 'signin';
				$this->load->view('page', $data);
			}

			return;
		}
		$data['main_content'] = 'signin';
		$this->load->view('page', $data);
	}
	
	function signup(){
		if($_POST){
		
			$config = array(
				array(
					'field' => 'fullname',
					'label' => 'Full name',
					'rules' => 'trim|required',
				),
				array(
					'field' => 'username',
					'label' => 'User name',
					'rules' => 'trim|is_unique[users.user_nicename]',
				),
				array(
					'field' => 'email',
					'label' => 'E-mail',
					'rules' => 'trim|required|valid_email|is_unique[users.user_email]',
				),
				array(
					'field' => 'password',
					'label' => 'Password',
					'rules' => 'trim|required',
				)
			);
			
			$this->form_validation->set_rules($config);
			
			if($this->form_validation->run() === false){
				$data['error'] = validation_errors();
				$data['main_content'] = 'signup';
				$this->load->view('page', $data);
			}else{
				$data['user_login']		= $this->input->post('fullname',true);
				$data['user_pass']		= md5($this->input->post('password',true));
				$data['user_nicename']	= $this->input->post('username',true); 
				$data['user_email']		= $this->input->post('email',true);
				$data['activation_key']	= md5(rand(0,1000).'uniquefrasehere');
				
				$create = $this->user_model->create($data);
				
				if($create){
					
					//Send validation mail 
					
					$this->load->library('email');

					$this->email->from('noreply@yoursite.com', 'Site Name');
					$this->email->to($data['user_email']); 
					
					$this->email->subject('Confirmation');
					$this->email->message("Confirm your subscription <a href=''>Confirmar</a>".$data['activation_key']);	
					$this->email->send();
					
					
					$data['main_content'] = 'signup-success';
					$this->load->view('page', $data);
					
					
				
				}else{
					error_log("Un usuario no se pudo registrar");
				}
			}
			
			
			return;
		}
		$data['main_content'] = 'signup';
		$this->load->view('page', $data);
	}
	
	function logout(){
		$this->session->sess_destroy();
		redirect('');
	}
	
	function account(){
		//Redirect
		$this->_member_area();
		
		if($_POST){
			$userdata = new stdClass();
			$userdata->user_nicename 	= $this->input->post('nickname');
			$userdata->user_email 		= $this->input->post('email');
			$userdata->user_pass		= md5($this->input->post('password'));
			
			$insert = $this->user_model->update($this->session->userdata('userid'), $userdata);
			
			if($insert){
				$data['message'] = "Updated succesfully";
				$data['user'] = $this->user_model->user_by_id($this->session->userdata('userid'));
				$data['main_content'] = 'account';
				$this->load->view('page', $data);
			}
			return;
		}
		
		$data['user'] = $this->user_model->user_by_id($this->session->userdata('userid'));
		$data['main_content'] = 'account';
		$this->load->view('page', $data);
		
	}
	
//Hidden Methods not allowed by url request

	function _member_area(){
		if(!$this->_is_logged_in()){
			redirect('signin');
		}
	}*/

    function user_profile()
    {
        if($this->input->post('update') == 1)
        {
            $this->edit_user();

        }
        else
        {
            $this->load->model('user_model');
            $data['user'] = $this->user_model->user_profile();
            $this->load->view('user_profile',$data);

        }

    }
    function edit_user()
    {
        $this->load->library('form_validation');

        // field name, error message, validation rules

        $this->form_validation->set_rules('nombre', 'Nombre', 'trim|required');
        $this->form_validation->set_rules('apellido', 'Apellido', 'trim|required');
        $this->form_validation->set_rules('fecha_nacimiento', 'Fecha de Nacimiento', 'trim|required');
        $this->form_validation->set_rules('ciudad_nacimiento', 'Ciudad de Nacimiento', 'trim|required');
        $this->form_validation->set_rules('genero', 'Género', 'trim|required');
        $this->form_validation->set_rules('carrera', 'Carrera', 'trim|required');
        $this->form_validation->set_rules('recursa', 'recursa', 'trim|required');
        $this->form_validation->set_rules('edad', 'edad', 'trim|required');
        $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
        $this->form_validation->set_rules('dni', 'DNI', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|min_length[4]|max_length[32]');
        $this->form_validation->set_rules('repetir_password', 'Repetir Password', 'trim|matches[password]');




        if($this->form_validation->run() == FALSE)
        {
            $this->load->model('user_model');
            $data['user'] = $this->user_model->user_profile();
            $this->load->view('user_profile',$data);;
        }

        else
        {
            $this->load->model('user_model');

            if($query = $this->user_model->edit_user())
            {

                $this->load->view('user_successful_update');

                modules::run('login/logout');
            }
            else
            {
                $this->load->view('user_profile');
            }
        }
    }
/*
	function _is_logged_in(){
		if($this->session->userdata('logged_in')){
			return true;
		}else{
			return false;
		}
	}*/
    function _is_user(){
        return $_is_user = $this->session->userdata('_is_user');
	}
	
	/*function userdata(){
		if($this->_is_logged_in()){
			return $this->user_model->user_by_id($this->session->userdata('userid'));
		}else{
			return false;
		}
	}
	
	function _is_admin(){
		if(@$this->users->userdata()->role === 1){
			return true;
		}else{
			return false;
		}
	}*/
		
}

?>