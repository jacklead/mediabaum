
<fieldset>


<?php

if($modulo[0]['tipo'] == 1)
{
    $checked_si = 1;
    $checked_no = 0;
}
else
{
    $checked_si = 0;
    $checked_no = 1;

}
$novedades= array(
    'name'        => 'type',
    'id'          => 'type',
    'value'       => 1,
    'checked'     => $checked_si,
);
$generico = array(
    'name'        => 'type',
    'id'          => 'type',
    'value'       => 0,
    'checked'     => $checked_no,

);

/**
 * cuatrimestre
 */

$primero = array(
    'name'        => 'cuatrimestre',
    'id'          => 'cuatrimestre',
    'value'       => 1,
    'checked'     => $modulo[0]['cuatrimestre'] == 1 ? 1 : 0,
);
$segundo = array(
    'name'        => 'cuatrimestre',
    'id'          => 'cuatrimestre',
    'value'       => 2,
    'checked'     => $modulo[0]['cuatrimestre'] == 2 ? 1 : 0,

);

?>

<div id="crear_modulo_form">
<br><br>
    <h1>Editar Modulo</h1>
    <?php
    echo form_open_multipart('modulos/update_modulo');
    echo '<span> Módulo novedades </span>';
    echo form_radio($novedades);
    echo '<span> Módulo Genérico </span>';
    echo form_radio($generico);
    ?>
    <div class="input-append date" id="datepickerM" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
        <input class="span2" name="year" id="year" size="16" type="text" readonly="" value="<?php echo $modulo[0]['anio'] ?>" placeholder="Elija un año">
        <span class="add-on"><i class="icon-th"></i></span>
    </div>
    <?php
    echo form_radio($primero);
    echo '<span>1er Cuatrimestre</span>';
    echo form_radio($segundo);
    echo '<span>2do Cuatrimestre</span>';

    echo form_input(array('name'=>'name','id'=>'name','type'=>'text','placeholder'=>'Nombre','value'=>$modulo[0]['nombre']));
    echo form_input(array('name'=>'title','id'=>'title','type'=>'text','placeholder'=>'Título','value'=>$modulo[0]['titulo']));
    echo form_textarea(array('name'=>'description','id'=>'description','rows'=>'5','cols'=>'5','type'=>'textarea','placeholder'=>'Descripción','value'=>$modulo[0]['descripcion']));


    ?>
    <div class="input-append date" id="datepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
        <input class="span2" name="date" id="date" size="16" type="text" readonly="" placeholder="Fecha" value="<?php echo $modulo[0]['fecha'] ?>">
        <span class="add-on"><i class="icon-th"></i></span>
    </div>

    <?php

    echo form_radio(array('name'=>'material','class'=>'material','id'=>'pdf','type'=>'radio', 'value'=>1, 'checked' => $modulo[0]['material'] == 1 ? 1 : 0));
    echo '<span>PDF</span>';
    echo form_radio(array('name'=>'material','class'=>'material','id'=>'image','type'=>'radio', 'value'=>2, 'checked'=>$modulo[0]['material'] ==2? true: false));
    echo '<span>Imagen</span>';
    echo form_radio(array('name'=>'material','class'=>'material','id'=>'link','type'=>'radio', 'value'=>3, 'checked'=>$modulo[0]['material'] ==3? true: false));
    echo '<span>Link</span>';
    echo '<br>';

    ?>
    <div class="material-box">

    </div>
    <?php

    echo form_input(array('name'=>'modulo_id','id'=>'modulo_id','type'=>'hidden','value'=>$modulo[0]['id']));
    echo form_input(array('name'=>'material_checked','id'=>'material_checked','type'=>'hidden','value'=>$modulo[0]['material']));

    echo form_submit('submit', 'Editar Módulo');



    echo form_close();
    ?>
    <?php if(isset($error) && $error!=''): ?>
        <span class="label label-important"><?php echo $error; ?></span>
    <?php endif ?>


</div><!-- end login_form-->

</fieldset>
<script>
    $('document').ready(function(){

        var valueMaterial = '<?php echo $modulo[0]['archivo'] ?>';
        var dirPath = '<?php echo "/uploads/";?>';

        $('.material-box').hide();
        $("#datepickerM").datepicker( {
            format: " yyyy", // Notice the Extra space at the beginning
            viewMode: "years",
            minViewMode: "years"
        });

        $('.material').click(function(){
            var id = $(this).attr('id');
            var html = '';

            switch(id)
            {
                case 'pdf':
                    html+='<label>Cargue un PDF</label><input type="file" id="material_data" name="material_data" />';
                    break;
                case 'image':
                    html+='<label>Cargue una imagen</label><input type="file" id="material_data" name="material_data" />';
                    break;
                case 'link':
                    html+='<label>Ingrese un link</label><input type="text" id="material_link" name="material_link" value="" placeholder="Copie aquí el link"/>';
                    break;
            }

            $('.material-box').empty();
            $('.material-box').append(html);
            $('.material-box').show();



        });

        if($('.material').is(':checked'))
        {
            var id = $('#material_checked').val();

            var html = '';

            switch(id)
            {
                case '1':
                    html+='<label>Cargue un PDF</label><input type="file" id="material_data" name="material_data" /> <a href="'+dirPath+valueMaterial+'">'+valueMaterial+'</a>';
                    break;
                case '2':
                    html+='<label>Cargue una imagen</label><input type="file" id="material_data" name="material_data" /> <img src="'+dirPath+valueMaterial+'">';
                    break;
                case '3':
                    html+='<label>Ingrese un link</label><input type="text" id="material_link" name="material_link" value="'+valueMaterial+'" placeholder="Copie aquí el link"/>';
                    break;
            }



            $('.material-box').empty();
            $('.material-box').append(html);
            $('.material-box').show();
        }

    });
</script>