<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class User_model extends CI_Model{
	
	var $table = "users";
	
	function __construct(){
		parent::__construct();
	}
	
/*	function create($data){
		$str = $this->db->insert_string($this->table, $data);
		
		$query = $this->db->query($str);
		
		if($query){
			return true;
		}else{
			return false;
		}
		
	}
	
	function read(){
		$query = $this->db->query("SELECT * FROM $this->table");
		return $query->result();
	}
	
	function user_by_id($id){
		$query = $this->db->query("
			SELECT * 
			FROM $this->table
			WHERE id = $id
		");
		
		$query->row()->role = $this->get_role($id);
		$query->row()->role_name = $this->get_role_name($query->row()->role);
		
		if($query->num_rows > 0){
			return $query->row();
		}else{
			return false;
		}
	}
	
	function user_by_dni($dni){
		//Get ID
		$query = $this->db->query("SELECT id FROM $this->table WHERE dni = ?", $dni);
				
		if($query->num_rows > 0){
			return $this->user_by_id($query->row()->id);
		}else{
			return false;
		}
	}
	
	function update($userid, $userdata){
		$data = (array)$userdata;
		$where = "id = $userid"; 
		$str = $this->db->update_string($this->table, $data, $where);
		$query = $this->db->query($str);
		return $query;
	}
	
	*/
	function delete(){
		
	}

    function user_profile()
    {
        $this->db->select('*');
        $this->db->from('usuarios');
        $this->db->where('dni =', $this->uri->segment(2));
        $query = $this->db->get();
        return $query->result_array();
    }
    function edit_user()
    {
        $password = $this->input->post('password');


        $update_user_data = array(
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

        );
        if($password !='')
        {
            $update_user_data['password'] = md5($password);
        }

        $this->db->where('id', $this->input->post('id'));
        $this->db->set('fecha_actualizacion', 'NOW()', FALSE);
        $update = $this->db->update('usuarios', $update_user_data);

        return $update;
    }
	
/*	function get_role($user_id){
		$query = $this->db->query("SELECT role_id FROM users_roles WHERE user_id = $user_id");
		if($query->num_rows > 0){
			return (int)$query->row()->role_id;
		}else{
			return 0;
		}
	}
	function get_role_name($role_id){
		$query = $this->db->query("SELECT name FROM roles WHERE id = $role_id");
		if($query->num_rows > 0){
			return $query->row()->name;
		}else{
			return false;
		}
	}
	
	function validate($user_email, $password){
		$query = $this->db->query("SELECT * FROM $this->table WHERE user_email = '$user_email' AND user_pass = '$password'");
		if($query->num_rows === 1){
			return $query->row();
		}else{
			return false;
		}
	}
	*/
		
}

?>