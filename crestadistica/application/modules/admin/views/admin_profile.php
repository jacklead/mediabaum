<h1>Crear cuenta</h1>
<fieldset>
<legend>Informac&iacuteon Personal</legend>
<?php

echo form_open('admin/admin_profile');
echo form_input(array('name'=>'nombre','id'=>'nombre', 'value'=>$admin[0]['nombre']));
echo form_input(array('name'=>'apellido','id'=>'apellido', 'value'=>$admin[0]['apellido']));
echo form_input(array('name'=>'email','id'=>'email', 'value'=>$admin[0]['email']));
echo form_input(array('name'=>'dni','id'=>'dni', 'value'=>$admin[0]['dni']));
echo form_input(array('name'=>'password','id'=>'password', 'type'=>'password','placeholder'=>'Ingresar nueva contraseña'));
echo form_input(array('name'=>'repetir_password','id'=>'repetir_password', 'type'=>'password','placeholder'=>'Repetir contraseña'));
echo form_input(array('name'=>'fecha_nacimiento','id'=>'fecha_nacimiento', 'type'=>'hidden','value'=>$admin[0]['fecha_nacimiento'],));
echo form_input(array('name'=>'ciudad_nacimiento','id'=>'ciudad_nacimiento', 'type'=>'hidden','value'=>$admin[0]['ciudad_nacimiento'],));
echo form_input(array('name'=>'genero','id'=>'genero', 'type'=>'hidden','value'=>$admin[0]['genero'],));
echo form_input(array('name'=>'carrera','id'=>'carrera', 'type'=>'hidden','value'=>$admin[0]['carrera'],));
echo form_input(array('name'=>'edad','id'=>'edad', 'type'=>'hidden','value'=>$admin[0]['edad'],));
echo form_input(array('name'=>'id','id'=>'id', 'type'=>'hidden','value'=>$admin[0]['id'],));
echo form_input(array('name'=>'update','id'=>'update', 'type'=>'hidden','value'=>1,));

echo '<br>'.form_submit('submit', 'Enviar');
?>


<?php echo validation_errors('<p class="label label-important">'); ?>
</fieldset>
