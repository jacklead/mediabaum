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

    $this->db->select('*');
    $this->db->from('usuarios');
    $this->db->where('rol !=', '1');
    $query = $this->db->get();
        return $query->result_array();

  }


    function get_user($id)
    {

        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('rol !=', '1');
        $this->db->where('id =', $id);
        $query = $this->db->get();

        //var_dump($query->result_array());
        return $query->result_array();

    }

  function activate_user($data)
  {

    $fields = array(
               'status' => $data['status'],
            );
    $this->db->where('id', $data['id']);
    return $this->db->update('usuarios', $fields);
      
  }

  function admin_profile()
  {
    $this->db->select('*');
    $this->db->from('usuarios');
    $this->db->where('rol =', '1');
    $query = $this->db->get();
        return $query->result_array();
  }

  function delete_user($data)
  {

    return $this->db->delete('usuarios', array('id' => $data['id'])); 
      
  }
  
  function create_member()
  {
    $this->tempPassword = $this->make_unique();
    
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
      'rol' => 0,      
      'password' => md5($this->input->post('password'))            
    );
    
    $insert = $this->db->insert('usuarios', $new_member_insert_data);
    if($insert)
    {
      $this->send_mail($this->tempPassword);
    }
    return $insert;
  }

  function edit_admin()
  {
    $password = $this->input->post('password');
     
    $update_admin_data = array(
      'nombre' => $this->input->post('nombre'),
      'apellido' => $this->input->post('apellido'),
      'dni' => $this->input->post('dni'),
      'email' => $this->input->post('email'),      
      'fecha_nacimiento' => $this->input->post('fecha_nacimiento'),      
      'ciudad_nacimiento' => $this->input->post('ciudad_nacimiento'),      
      'edad' => $this->input->post('edad'),      
      'genero' => $this->input->post('genero'),      
      'carrera' => $this->input->post('carrera'),      
      'status' => 1,      
      'rol' => 1,                
    );
    if($password !='')
    {
      $update_admin_data['password'] = md5($password);
    }
    
    $this->db->where('id', $this->input->post('id'));
    $this->db->set('fecha_actualizacion', 'NOW()', FALSE);    
    $update = $this->db->update('usuarios', $update_admin_data);

    return $update;
  }

  function make_unique($length=8) {
    $salt       = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
    $len        = strlen($salt);
    $makepass   = '';
    mt_srand(10000000*(double)microtime());
    for ($i = 0; $i < $length; $i++) {
       $makepass .= $salt[mt_rand(0,$len - 1)];
    }
    return $makepass;
  }


    function update_user($tempPass,$email)
    {
        $update_user_data = array();
        $update_user_data['password'] = md5($tempPass);
        $this->db->where('email', $email);
        $this->db->set('fecha_actualizacion', 'NOW()', FALSE);
        $update = $this->db->update('usuarios', $update_user_data);

        return $update;
    }

  function send_mail($tempPass,$email)
  {
        //Actualiza en la DB al usuario
    $this->update_user($tempPass,$email);

     /* $config = Array(
      'protocol' => 'smtp',
      'smtp_host' => 'ssl://smtp.googlemail.com',
      'smtp_port' => 465,
      'smtp_user' => 'imagenialidad@gmail.com', // change it to yours
      'smtp_pass' => 'cameltosis84', // change it to yours
      'mailtype' => 'html',
      'charset' => 'UTF-8',
      'wordwrap' => TRUE
    );

      $message = "Su contraseña temporal es $tempPass";
      $this->load->library('email', $config);
    $this->email->set_newline("\r\n");
    $this->email->from('imagenialidad@gmail.com'); // change it to yours
    $this->email->to($email);// change it to yours
    $this->email->subject('Activación de usuario');
    $this->email->message($message);
    if($this->email->send())
    {
        echo 'Email sent.';
            $this->update_user($tempPass,$email);
    }
    else
    {
    show_error($this->email->print_debugger());
    }*/



        //SERVER

        $to      = $email;
        $subject = 'Activación de usuario';
        $message = "su usuario es su DNI \n";
        $message .= "password temporal $tempPass ";
        $headers = 'From: webmaster@mediabaum.com' . "\r\n" .
            'Reply-To: webmaster@mediabaum.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";



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