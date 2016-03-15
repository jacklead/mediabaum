<?php //$this->load->view('includes/header'); ?>

<h1>Crear cuenta</h1>
<fieldset>
<legend>Informac&iacuteon Personal</legend>
<?php
   
echo form_open('login/create_member');

/*
 * Arrays user data
 */ 

$nombre = array(
	      	'name'			=> 'nombre',
	      	'id'        	=> 'nombre',
	      	'placeholder'   => 'Nombre',
        );
$apellido = array(
			'name'      	=> 'apellido',
			'id'        	=> 'apellido',
	        'placeholder'   => 'Apellido',
		);
$dni = array(
			'name'      	=> 'dni',
			'id'        	=> 'dni',
	        'placeholder'	=> 'DNI',
		);
$email =array(
			'name'      	=> 'email',
			'id'        	=> 'email',
	        'placeholder'   => 'E-mail',
		);
$fecha_nacimiento =array(
			'name'      	=> 'fecha_nacimiento',
			'id'        	=> 'fecha_nacimiento',
	        'placeholder'   => 'Fecha de nacimiento',
		);
$ciudad_nacimiento =array(
			'name'      	=> 'ciudad_nacimiento',
			'id'        	=> 'ciudad_nacimiento',
	        'placeholder'   => 'Ciudad de nacimiento',
		);
$edad =array(
			'name'      	=> 'edad',
			'id'        	=> 'edad',
	        'placeholder'   => 'Edad',
		);

$generoOptions = array(
                  'hombre'  => 'Hombre',
                  'mujer'   => 'Mujer',

                );
$carrera =array(

    'Arquitectura'      	=> 'Arquitectura',
    'Medicina'     			=> 'Medicina',
			
		);
$recursa_si = array(
    'name'        => 'recursa',
    'id'          => 'recursa',
    'value'       => 1,
    );
$recursa_no = array(
    'name'        => 'recursa',
    'id'          => 'recursa',
    'value'       => 0,
    );


echo form_input($nombre);
echo form_input($apellido);
echo form_input($dni);
echo form_input($email);
?>
<div class="input-append date" id="datepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
    <input class="span2" name="fecha_nacimiento" id="fecha_nacimiento" size="16" type="text" readonly="" value="dd-mm-aaaa">
    <span class="add-on"><i class="icon-th"></i></span>
    </div>
<?php
echo form_input($ciudad_nacimiento);
echo form_input($edad);
echo form_label('G&eacute;nero', 'genero');
echo form_dropdown('genero', $generoOptions, '');
echo form_label('Carrera', 'carrera');
echo form_dropdown('carrera', $carrera, 'Carrera');
echo '<br>Recursa Sí '. form_radio($recursa_si).' No '. form_radio($recursa_no);
echo '<br>'.form_submit('submit', 'Create Acccount');
?>


<?php echo validation_errors('<p class="label label-important">'); ?>
</fieldset>

<?php //$this->load->view('includes/tut_info'); ?>

<?php //$this->load->view('includes/footer'); ?>