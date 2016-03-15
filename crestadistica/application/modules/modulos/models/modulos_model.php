<?php
/*
Author: Daniel Gutierrez
Date: 9/18/12
Version: 1.0
*/

class Modulos_model extends CI_Model{


    function __construct(){
        parent::__construct();
    }



    function create_modulo()
    {

        $date = explode('-',$this->input->post('date'));

        if($_FILES["material_data"]["name"])
        {
            $archivo =  $_FILES["material_data"]["name"];
        }
        else
        {
            $archivo = $this->input->post('material_link');
        }

        $new_modulo_insert_data = array(
            'anio' => $this->input->post('year'),
            'cuatrimestre' => $this->input->post('cuatrimestre'),
            'nombre' => $this->input->post('name'),
            'titulo' => $this->input->post('title'),
            'tipo' => $this->input->post('type'),
            'descripcion' => $this->input->post('description'),
            'material' => $this->input->post('material'),
            'archivo' => $archivo,
            'fecha' => $date[2].'-'.$date[1].'-'.$date[0],
        );
        $this->db->set('fecha_creacion', 'NOW()', FALSE);
        $insert = $this->db->insert('modulos', $new_modulo_insert_data);

        return $insert;
    }

    function get_modulos()
    {

        $this->db->select('*');
        $this->db->from('modulos');
        $this->db->order_by('fecha','DESC');
        $query = $this->db->get();
        return $query->result_array();

    }

    function modulo_edit()
    {
        $this->db->select('*');
        $this->db->from('modulos');
        $this->db->where('id =', $this->uri->segment(3));
        $query = $this->db->get();
        return $query->result_array();
    }

    function update_modulo()
    {

        $date = explode('-',$this->input->post('date'));

        if($_FILES["material_data"]["name"])
        {
            $archivo =  $_FILES["material_data"]["name"];
        }
        else
        {
            $archivo = $this->input->post('material_link');
        }

        $update_modulo = array(
            'nombre' => $this->input->post('name'),
            'titulo' => $this->input->post('title'),
            'anio' => $this->input->post('year'),
            'descripcion' => $this->input->post('description'),
            'tipo' => $this->input->post('type'),
            'fecha' => $date[2].'-'.$date[1].'-'.$date[0],
            'material' => 1,
            'archivo' => $archivo,
        );

        $this->db->where('id', $this->input->post('modulo_id'));
        $this->db->set('fecha_actualizacion', 'NOW()', FALSE);
        $update = $this->db->update('modulos', $update_modulo);

        return $update;
    }

    function delete_modulo($data)
    {

        return $this->db->delete('modulos', array('id' => $data['id']));

    }
}

