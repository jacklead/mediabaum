<?php

class Usuarios_Model extends CI_Model {

	private $tempPassword;

	public function __construct()
    {
        $this->tempPassword = '';
    }

	function validate()
	{
		$this->db->where('dni', $this->input->post('dni'));
		$this->db->where('password', md5($this->input->post('password')));
		$query = $this->db->get('usuarios');

		if($query->num_rows == 1)
		{

			$row = $query->row();

			if($row->rol == 1)
			{
				
				return $row->id;
			}

		   
			return true;
		}
		else
		{
			return false;
		}
		
	}
	function get_name($dni)
	{
		$this->db->where('dni', $dni);
		$query = $this->db->get('usuarios');
		$row = $query->row();
		return $row->nombre;
	}

	function get_users()
	{

		$query = $this->db->get('usuarios');
        return $query->result_array;

	}
    function check_email()
    {
        $this->db->where('email',$this->input->post('email') );
        $query = $this->db->get('usuarios');
        $row = $query->row();
        return $row;
    }
	
	function create_member()
	{
		$this->tempPassword = $this->make_unique();
		$this->load->helper('date');
		
		$new_member_insert_data = array(
			'nombre' => $this->input->post('nombre'),
			'apellido' => $this->input->post('apellido'),
			'dni' => $this->input->post('dni'),
			'email' => $this->input->post('email'),			
			'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),			
			'ciudad_nacimiento' => $this->input->post('ciudad_nacimiento'),			
			'edad' => $this->input->post('edad'),			
			'genero' => $this->input->post('genero'),			
			'carrera' => $this->input->post('carrera'),			
			'recursa' => $this->input->post('recursa'),			
			'status' => 0,			
			'rol' => 0
			/*'password' => md5($this->tempPassword)	*/
		);
		$this->db->set('fecha_ingreso', 'NOW()', FALSE);		
		$insert = $this->db->insert('usuarios', $new_member_insert_data);
		if($insert)
		{
			//$this->send_mail($this->tempPassword);
		}
		return $insert;
	}


	function forgot_pass()
	{
		$hash = $this->make_unique(12);
		$url_reset = base_url().'login/reset_pass?reset=1&email='.$this->input->post('email').'&key='.$hash;
		if($this->save_key($hash))
		{
			$this->send_key($url_reset);
			return true;
		}
		else
		{
			return false;
		}

		
	}

    function reset_pass($data)
    {
        $this->db->where('email', $data['email']);
        $this->db->where('hash', $data['key']);
        $query = $this->db->get('keys');
        $row = $query->row();

        if(time() >= strtotime($row->fecha_insercion) + 86400)
        {
            return false;
        }
        else
        {
            /*$pass = $this->make_unique();
            $update_user_data = array(
                'password' => md5($pass),
            );
            $this->db->where('email', $row->email);
            $this->db->set('fecha_actualizacion', 'NOW()', FALSE);
            $this->db->update('usuarios', $update_user_data);*/
            return true;

        }

    }
    function setPassReset()
    {

        $update_user_data = array(
            'password' => md5($this->input->post('password')),
        );
        $this->db->where('email', $this->input->post('email'));
        $this->db->set('fecha_actualizacion', 'NOW()', FALSE);
        if($this->db->update('usuarios', $update_user_data))
        {
            $this->delete_key($this->input->post('key'));
            return true;
        }


    }
    function delete_key($hash)
    {
        $this->db->where('hash', $hash);
        $this->db->delete('keys');

    }

	function save_key($hash)
	{
		$this->db->set('fecha_insercion', 'NOW()', FALSE);		
		$insert = $this->db->insert('keys', array('hash'=>$hash,'email'=>$this->input->post('email')));
		if($insert)
		{
			return true;
		}
		
	}

	function make_unique($length=8) {
		$salt       = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
		$len        = strlen($salt);
		$make_pass   = '';
		mt_srand(10000000*(double)microtime());
		for ($i = 0; $i < $length; $i++) {
		   $make_pass .= $salt[mt_rand(0,$len - 1)];
		}
		return $make_pass;
	}

	function send_key($url)
	{
		 $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'imagenialidad@gmail.com', // change it to yours
		  'smtp_pass' => 'cameltosis84', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'utf8',
		  'wordwrap' => TRUE
		);

	    $message = "Usted pidio un restablecimiento de contraseña  \n";
	    $message .= "Acceda al siguiente enlace y genera una nueva ".$url." \n";
	    $message .= "El mismo tiene una vigencia de 24 horas. ";
	    $this->load->library('email', $config);
		$this->email->set_newline("\r\n");
		$this->email->from('imagenialidad@gmail.com'); // change it to yours
		$this->email->to($this->input->post('email'));// change it to yours
		$this->email->subject('Restablecimiento de contraseña');
		$this->email->message($message);
		if($this->email->send())
		{
		echo 'Email sent.';
		}
		else
		{
		show_error($this->email->print_debugger());
		}

	}

	function send_mail($tempPass)
	{
        //DEVELOPMENT
	  /* $config = Array(
		  'protocol' => 'smtp',
		  'smtp_host' => 'ssl://smtp.googlemail.com',
		  'smtp_port' => 465,
		  'smtp_user' => 'imagenialidad@gmail.com', // change it to yours
		  'smtp_pass' => 'cameltosis84', // change it to yours
		  'mailtype' => 'html',
		  'charset' => 'utf8',
		  'wordwrap' => TRUE
		);

	    $message = "Su usuario es ".$this->input->post('dni')." \n";
	    $message .= "Su contraseña temporal es $tempPass";

        try
        {
            $this->load->library('email', $config);
            $this->email->set_newline("\r\n");
            $this->email->from('imagenialidad@gmail.com'); // change it to yours
            $this->email->to('imagenialidad@gmail.com');// change it to yours
            $this->email->subject('Resume from JobsBuddy for your Job posting');
            $this->email->message($message);
            $this->email->send();
            echo 'Email sent.';
        }
        catch(Exception $e)
        {
            log_message('error', 'Hubo un error al enviar el mail: '.$e->getMessage());
        }
*/



		//SERVER

		$to      = $this->input->post('email');
		$subject = 'the subject';
		$message = 'su usuario es '.$this->input->post('dni')." \n";;
		$message .= "password temporal $tempPass ";
		$headers = 'From: webmaster@mediabaum.com' . "\r\n" .
		    'Reply-To: webmaster@mediabaum.com' . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();



		if(mail($to, $subject, $message, $headers))
		{
		echo 'Email sent.';
		}
		else
		{
		show_error($this->email->print_debugger());
		}

	}
}