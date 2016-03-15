<h1>Crear cuenta</h1>
<fieldset>
<legend>Informac&iacuteon Personal</legend>
    <pre>
<?php


if($user[0]['recursa'] == 1)
{
    $recursa = 'Sí';
    $checked_si = 1;
    $checked_no = 0;
}
else
{
    $recursa = 'No';
    $checked_si = 0;
    $checked_no = 1;

}
$recursa_si = array(
    'name'        => 'recursa',
    'id'          => 'recursa',
    'value'       => 1,
    'checked'     => $checked_si,
);
$recursa_no = array(
    'name'        => 'recursa',
    'id'          => 'recursa',
    'value'       => 0,
    'checked'     => $checked_no,

);
$carrera =array(

    'Arquitectura'      	=> 'Arquitectura',
    'Medicina'     			=> 'Medicina',

);

$user[0]['recursa'] == 1 ? $recursa = 'Sí' : $recursa = 'No';

echo form_open('users/user_profile');
echo form_label('Nombre', 'nombre');
echo form_input(array('name'=>'nombre','id'=>'nombre', 'value'=>$user[0]['nombre']));
echo form_label('Apellido', 'apellido');
echo form_input(array('name'=>'apellido','id'=>'apellido', 'value'=>$user[0]['apellido']));
echo form_label('E-mail', 'email');
echo form_input(array('name'=>'email','id'=>'email', 'value'=>$user[0]['email']));
echo form_label('DNI', 'dni');
echo form_input(array('name'=>'dni','id'=>'dni', 'value'=>$user[0]['dni']));
echo form_label('Fecha de Nacimiento', 'fecha_nacimiento');
?>
<div class="input-append date" id="datepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
    <input class="span2" name="fecha_nacimiento" id="fecha_nacimiento" size="16" type="text" readonly="" value="<?php echo $user[0]['fecha_nacimiento'] ?>">
    <span class="add-on"><i class="icon-th"></i></span>
</div>
<?php
echo form_label('Ciudad de nacimiento', 'ciudad_nacimiento');
echo form_input(array('name'=>'ciudad_nacimiento','id'=>'ciudad_nacimiento','value'=>$user[0]['ciudad_nacimiento'],));
echo form_label('Género', 'genero');
echo form_input(array('name'=>'genero','id'=>'genero','value'=>$user[0]['genero'],));
echo form_label('Carrera', 'carrera');
echo form_dropdown('carrera', $carrera, $user[0]['carrera']);
echo form_label('Recursa', 'recursa');
echo '<br>Recursa Sí '. form_radio($recursa_si).' No '. form_radio($recursa_no);
echo form_label('Edad', 'edad');
echo form_input(array('name'=>'edad','id'=>'edad', 'value'=>$user[0]['edad'],));
echo form_input(array('name'=>'id','id'=>'id', 'type'=>'hidden','value'=>$user[0]['id'],));
echo form_input(array('name'=>'update','id'=>'update', 'type'=>'hidden','value'=>1,));
echo form_label('Cambiar contraseña', 'password');
echo form_input(array('name'=>'password','id'=>'password', 'type'=>'password','placeholder'=>'Ingresar nueva contraseña'));
echo form_label('Repetir contraseña', 'repetir_password');
echo form_input(array('name'=>'repetir_password','id'=>'repetir_password', 'type'=>'password','placeholder'=>'Repetir contraseña'));

echo '<br>'.form_submit('submit', 'Enviar');
?>


<?php echo validation_errors('<p class="label label-important">'); ?>
</fieldset>
</pre>