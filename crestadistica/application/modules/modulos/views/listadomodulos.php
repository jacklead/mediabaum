<!DOCTYPE html>

<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <title>Listado de Módulos</title>
</head>
<body>
<p>Administrador.</p>
<h3>Listado de Módulos</h3>
<div class="ajaxMensaje"></div>
<ul>
    <?php

        foreach ($modulos AS $key => $modulo):

           switch ($modulo['material']) {

                case 1:
                    $material = 'PDF';
                    break;
                case 2:
                   $material = 'Imagen';
                   break;

                default:
                    $material = 'Link';
                    break;
            }
        ?>

        <li class="modulo_<?php echo $modulo['id'];?>">


            <?php  $modulo['tipo'] == 0 ? $tipo = 'Común' : $tipo = 'Novedades'; ?>
            <?php  $modulo['material'] != 3 ? $archivo = base_url().'uploads/'.$modulo['archivo'] : $archivo = $modulo['archivo']; ?>
            <div><?php echo 'Nombre: '. $modulo['nombre']; ?></div>
            <div><?php echo 'Título: '. $modulo['titulo']; ?></div>
            <div><?php echo 'Descripción: '. $modulo['descripcion']; ?></div>
            <div><?php echo 'Año: '. $modulo['anio']; ?></div>
            <div><?php echo 'Cuatrimistre: '. $modulo['cuatrimestre']; ?></div>
            <div><?php echo 'Material: '. $material; ?></div>
            <div><?php echo 'Archivo: <a href="'.$archivo.'" target="_BLANK"> '. $modulo['archivo'].'</a>'; ?></div>
            <div><?php echo 'Tipo: '. $tipo ?></div>
            <div><?php echo 'Fecha: '. $modulo['fecha']; ?></div>

            <?php if($this->session->userdata('_is_admin') != false):?>
            <div><a class ="modificar" href="<?php echo base_url(); ?>modulos/edit_modulo/<?php echo $modulo['id'];?>">Modificar</a></div>
            <div><a id="eliminar_modulo" class ="elimina_<?php echo $modulo['id'];?>" data-modulo-id ="<?php echo $modulo['id'];?>"href="<?php echo base_url(); ?>modulos/delete_modulo">Eliminar</a></div>
            <?php endif;?>

            <hr/>
        </li>
    <?php endforeach;?>
</ul>
</body>
</html>	