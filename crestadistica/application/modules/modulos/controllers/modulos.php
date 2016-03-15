<?php

class Modulos extends MX_Controller
{
    function __construct()
    {


        $this->load->helper('url');
        /*$this->load->section('sidebar', 'ci_simplicity/sidebar');*/
        $this->output->set_common_meta('Panel de control', 'Dashboard Admin', 'Admin');
        $this->output->set_template('default');

    }

    public function index()
    {
        if(modules::run('admin/_is_admin') != true)
        {
            redirect('site/members_area');
        }
        $this->crear_modulo();
    }

    public function listadomodulos()
    {

        $this->load->model('modulos_model');
        $data['modulos'] = $this->modulos_model->get_modulos();
        $this->load->view('listadomodulos',$data);

    }

    function delete_modulo()
    {
        $data = array(
            'id' => $this->input->post('id'),

        );

        $this->load->model('modulos_model');
        $update = $this->modulos_model->delete_modulo($data);
        if($update)
        {
            echo 'Módulo '.$this->input->post('id').' Eliminado';
        }
    }

    function edit_modulo()
    {

        $this->load->model('modulos_model');
        $data['modulo'] = $this->modulos_model->modulo_edit();
        $this->load->view('modulo_edit',$data);


    }

    function update_modulo()
    {

        if($this->input->post('modulo_id'))
        {
            $this->load->library('form_validation');

            if($this->input->post('material') !=3)
            {
                if(empty($_FILES["material_data"]["name"]))
                {
                    $this->form_validation->set_rules('material_data', 'Archivo', 'required');
                }
                else{
                    $this->do_upload();
                }
            }



            $data['error'] = '';

            $this->form_validation->set_rules('year', 'Año', 'required');
            $this->form_validation->set_rules('cuatrimestre', 'Cuatrimestre', 'trim|required');
            $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('title', 'Título', 'trim|required');
            $this->form_validation->set_rules('description', 'Descripción', 'trim|required');
            $this->form_validation->set_rules('date', 'Fecha', 'trim|required');
            $this->form_validation->set_rules('material', 'Material', 'trim|required');
            $this->form_validation->set_rules('type', 'Tipo', 'trim|required');



            if($this->form_validation->run() !== FALSE)
            {

                $data['success'] = 'Se editó el módulo correctamente.';
                $this->load->model('modulos_model');
                if($this->modulos_model->update_modulo())
                {
                    redirect('modulos/listadomodulos');
                }


            }
            else
            {
                $data['error'] = 'Todos los campos son obligatorios';
                $this->load->view('modulo_edit',$data);
            }


            //$this->load->view('crear_modulo');
        }
        else
        {
            redirect('modulos/listadomodulos');
        }
    }

    function crear_modulo()
    {
        if($this->input->post('set_modulo'))
        {



            $this->load->library('form_validation');

            if($this->input->post('material') !=3)
            {
                if(empty($_FILES["material_data"]["name"]))
                {
                    $this->form_validation->set_rules('material_data', 'Archivo', 'required');
                }
                else{
                    $this->do_upload();
                }
            }

            $data['error'] = '';


            $this->form_validation->set_rules('year', 'Año', 'required');
            $this->form_validation->set_rules('cuatrimestre', 'Cuatrimestre', 'trim|required');
            $this->form_validation->set_rules('name', 'Nombre', 'trim|required');
            $this->form_validation->set_rules('title', 'Título', 'trim|required');
            $this->form_validation->set_rules('description', 'Descripción', 'trim|required');
            $this->form_validation->set_rules('date', 'Fecha', 'trim|required');
            $this->form_validation->set_rules('material', 'Material', 'trim|required');
            $this->form_validation->set_rules('type', 'Tipo', 'trim|required');


            if($this->form_validation->run() !== FALSE)
            {
                $data['success'] = 'Se creó el módulo correctamente.';
                $this->load->model('modulos_model');
                if($this->modulos_model->create_modulo())
                {
                    redirect('modulos/listadomodulos');
                }


            }
            else // incorrect username or password
            {
                $data['error'] = 'Todos los campos son obligatorios';
                $this->load->view('crear_modulo',$data);
            }


            //$this->load->view('crear_modulo');
        }
        else
        {
            $this->load->view('crear_modulo');
        }

    }

    function do_upload()
    {


        $config['upload_path'] = dirname($_SERVER["SCRIPT_FILENAME"])."/uploads/";
        $config['allowed_types'] = '*';
        $config['upload_url'] = base_url()."uploads/";
        $config['encrypt_name'] = TRUE ;
        $config['overwrite'] = TRUE ;



        $this->load->library('upload', $config);


        if ( ! $this->upload->do_upload("material_data"))
        {


            $data['error'] = 'error al subir el archivo';
            $this->load->view('crear_modulo',$data);

        }
        else
        {
            $data = array('upload_data' => $this->upload->data());

            $this->load->view('crear_modulo', $data);
        }
    }

}

?>