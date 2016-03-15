<?php

class Login extends MX_Controller {

	function __construct()
	{
		$this->load->helper('url');
		$this->output->set_common_meta('Login', 'Login usuarios', 'Login');
        $this->output->set_template('default');
	}

	function index()
	{
		/*$data['main_content'] = 'login_form';
		$this->load->view('includes/template', $data);	*/
		if($this->is_logged_in() && modules::run('admin/_is_admin') )
		{
			redirect('admin');
		}
		else if($this->is_logged_in() && !modules::run('users/_is_user'))
		{
			redirect('site/members_area');
		}
		else
		{
			$this->load->view('login_form');	
		}
			
	}
	
	function validate_credentials()
	{		

		$data['error'] = '';
		$this->load->library('form_validation');

	    $this->form_validation->set_rules('dni', 'DNI', 'required');
	    $this->form_validation->set_rules('password', 'Password', 'required');


	    if($this->form_validation->run() !== FALSE)
    	{
			$this->load->model('usuarios_model');
			$query = $this->usuarios_model->validate();
		
			if($query) // if the user's credentials validated...
			{
				$name = $this->usuarios_model->get_name($this->input->post('dni'));
				$data = array(
					'dni' => $this->input->post('dni'),
					'is_logged_in' => true,
					'name' => $name,
				);

				if(is_numeric($query))
				{
					$data['_is_admin'] = true;
					$this->session->set_userdata($data);
					redirect('admin');
				}
				else
				{
                    $data['_is_user'] = true;
					$this->session->set_userdata($data);
					redirect('site/members_area');
				}

				
				
			}
			else // incorrect username or password
			{

				$this->load->view('login_form');
			}
		}
		else // incorrect username or password
		{
			$data['error'] = 'DNI o Password incorrectos';
			$this->load->view('login_form',$data);
		}


	}	
	
	function signup()
	{
		/*$data['main_content'] = 'signup_form';
		$this->load->view('includes/template', $data);*/
		$this->load->view('signup_form');
	}
    function set_pass()
    {

        $data['user'] = $this->session->flashdata('email');
        $data['key'] = $this->session->flashdata('key');
        $this->load->view('reset_pass',$data);
    }

    function resetpass()
    {
        $this->load->library('form_validation');

        $data['error'] = '';

      /*  $this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');*/

        $this->form_validation->set_rules('password', 'Password', 'required|matches[passconf]|min_length[6]');
        $this->form_validation->set_rules('passconf', 'Password Confirmation', 'required|min_length[6]');


        if($this->form_validation->run() !== FALSE)
        {

            echo $this->input->post('password');
            echo $this->input->post('passconf');
            echo $this->input->post('email');
            $this->load->model('usuarios_model');
            $reset = $this->usuarios_model->setPassReset();
            if($reset)
            {
                redirect('login');
            }
        }
        else
        {

            echo 'Ocurrió un error intente nuevamente.';


        }


    }

	function forgot_pass()
	{
		

		if($this->input->post('reset')==1)
		{
            $data = array();
			$this->load->library('form_validation');
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
            $this->load->model('usuarios_model');

            $existUsuario = $this->usuarios_model->check_email();

            if(count($existUsuario)>0 && $existUsuario->status > 0)
            {
                if($this->form_validation->run() == FALSE)
                {

                    $data['error'] = 'E-mail no valido';
                }
                else
                {
                    $reset = $this->usuarios_model->forgot_pass();

                    if($reset)
                    {
                        $data['success'] = 'Restablecimiento de contraseña enviado.';

                    }
                }

            }
            else
            {
                $data['error'] = 'El E-mail no se encuentra registrado en la Base de datos o no es un usuario activo.';
            }

            $this->load->view('forgot_pass',$data);



		}
		else
		{
			$this->load->view('forgot_pass');
		}
		
	}

    function reset_pass()
    {
        if($this->input->get('reset')==1)
        {
            if($this->input->get('email') !='' && $this->input->get('key') !='')
            {
                $data['email'] = $this->input->get('email');
                $data['key'] = $this->input->get('key');

                $this->load->model('usuarios_model');
                $reset = $this->usuarios_model->reset_pass($data);

                if($reset)
                {
                    $this->session->set_flashdata('email',$data['email'] );
                    $this->session->set_flashdata('key',$data['key'] );
                    redirect('login/set_pass');

                }
                else
                {
                    $this->session->set_flashdata('email',0 );
                    redirect('login/');
                }

                /*return '<a href="'.base_url().'login'.'">Ingrese</a> con la siguiente contraseña provisoria: '.$pass;
                'Código de validación vencido. <a href="'.base_url().'login'.'">Restablezca de nuevo su cuenta</a>';*/
            /*    $date1 = new DateTime("yesterday");
                $date2 = new DateTime($reset->fecha_insercion);*/

            /*    if(time() >= strtotime($reset->fecha_insercion) + 86400)
                {
                    echo 'mas de 24 horas';
                }*/

                /*var_dump($date1 < $date2);
                print_r($reset);*/

                /*if($reset)
                {

                    $data['success'] = array();
                    $data['success'] = 'Restablecimiento de contraseña enviado.';
                    $this->load->view('forgot_pass',$data);
                }*/
            }

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


	function is_logged_in()
	{
		return $is_logged_in = $this->session->userdata('is_logged_in');

		/*if(!isset($is_logged_in) || $is_logged_in != true)
		{
			redirect('login');
		}*/		
	}	
	
	function logout()
	{
		$this->session->sess_destroy();
		$this->index();
	}
	

}