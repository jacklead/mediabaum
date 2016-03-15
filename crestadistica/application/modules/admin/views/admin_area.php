<!DOCTYPE html>

<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"> 
	<title>Panel de control</title>
</head>
<body>
<br><br>
<p>
	<h2>Welcome Back, <?php echo $this->session->userdata('name'); ?>!</h2>
     </p>
	<h3>Listado de usuarios</h3>
	<div class="ajaxMensaje"></div>
	<ul>
	<?php 
		foreach ($usuarios AS $key => $usuario): 
			$usuario['status'] == 0 ? $status = 'Inactivo' : $status = 'Activo';
			$usuario['recursa'] == 0 ? $recursa = 'No recursa' : $recursa = 'Recursa';
		

			switch ($usuario['rol']) {

				case 2:
					$rol = 'Tester';
					break;
				
				default:
					$rol = 'Estudiante';
					break;
			}
	?>
		<li class="usuario_<?php echo $usuario['id'];?>">
			<div><?php echo $usuario['nombre']; ?></div>
			<div><?php echo $usuario['apellido']; ?></div>
			<div><?php echo $usuario['dni']; ?></div>
			<div><?php echo $usuario['email']; ?></div>
			<div><?php echo $usuario['fecha_nacimiento']; ?></div>
			<div><?php echo $usuario['ciudad_nacimiento']; ?></div>
			<div><?php echo $usuario['edad']; ?></div>
			<div><?php echo $usuario['genero']; ?></div>
			<div><?php echo $usuario['carrera']; ?></div>
			<div><?php echo $recursa; ?></div>
			<div id="status_<?php echo $usuario['id'];?>" class="<?php echo strtolower($status); ?>"><?php echo $status; ?></div>
			<div><?php echo $rol; ?></div>
			<div>
				<a id="activar" class="activo_<?php echo $usuario['id'];?>"  data-usuario-status = "<?php echo $usuario['status'];?>" data-usuario-id ="<?php echo $usuario['id'];?>" href="<?php echo base_url(); ?>admin/activate_user"><?php  $usuario['status'] == 0?  $linkStatus = 'Activar': $linkStatus = 'Desactivar';  echo $linkStatus;?>
				</a>
			</div>
			<div><a class ="modificar" href="#">Modificar</a></div>
			<div><a id="eliminar" class ="elimina_<?php echo $usuario['id'];?>" data-usuario-id ="<?php echo $usuario['id'];?>"href="<?php echo base_url(); ?>admin/delete_user">Eliminar</a></div>
			<hr/>
		</li>
		
	<?php endforeach;?>	
	</ul>
	<h4><?php echo anchor('login/logout', 'Logout'); ?></h4>
</body>
</html>	