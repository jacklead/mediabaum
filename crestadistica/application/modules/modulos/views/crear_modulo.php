
<br><br><br>
<div id="crear_modulo_form">

    <h1>Crear Modulo</h1>
    <?php
    echo form_open_multipart('modulos/crear_modulo');
    echo form_input(array('name'=>'type','id'=>'type','type'=>'radio', 'value'=>1,));
    echo '<span>Módulo novedades</span>';
    echo form_input(array('name'=>'type','id'=>'type','type'=>'radio', 'value'=>0,));
    echo '<span>Módulo Genérico</span>';



    ?>
    <div class="input-append date" id="datepickerM" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
        <input class="span2" name="year" id="year" size="16" type="text" readonly="" value="dd-mm-yyyy" placeholder="Elija un año">
        <span class="add-on"><i class="icon-th"></i></span>
    </div>

    <?php
    echo form_input(array('name'=>'cuatrimestre','id'=>'primer','type'=>'radio', 'value'=>1,));
    echo '<span>1er Cuatrimestre</span>';
    echo form_input(array('name'=>'cuatrimestre','id'=>'segundo','type'=>'radio', 'value'=>2,));
    echo '<span>2do Cuatrimestre</span>';

    echo form_input(array('name'=>'name','id'=>'name','type'=>'text','placeholder'=>'Nombre'));
    echo form_input(array('name'=>'title','id'=>'title','type'=>'text','placeholder'=>'Título'));
    echo form_textarea(array('name'=>'description','id'=>'description','rows'=>'5','cols'=>'5','type'=>'textarea','placeholder'=>'Descripción'));


    ?>
    <div class="input-append date" id="datepicker" data-date="12-02-2012" data-date-format="dd-mm-yyyy" data-date-viewmode="years"  data-date-languedad="es">
        <input class="span2" name="date" id="date" size="16" type="text" readonly="" value="dd-mm-yyyy" placeholder="Fecha">
        <span class="add-on"><i class="icon-th"></i></span>
    </div>

    <?php

    echo form_input(array('name'=>'material','class'=>'material','id'=>'pdf','type'=>'radio', 'value'=>1,));
    echo '<span>PDF</span>';
    echo form_input(array('name'=>'material','class'=>'material','id'=>'image','type'=>'radio', 'value'=>2,));
    echo '<span>Imagen</span>';
    echo form_input(array('name'=>'material','class'=>'material','id'=>'link','type'=>'radio', 'value'=>3,));
    echo '<span>Link</span>';
    echo '<br>';

   ?>
    <div class="material-box">

    </div>
    <?php

    echo form_input(array('name'=>'set_modulo','id'=>'set_modulo','type'=>'hidden','value'=>1));

    echo form_submit('submit', 'Crear Módulo');



    echo form_close();
    ?>
    <?php if(isset($error) && $error!=''): ?>
        <span class="label label-important"><?php echo $error; ?></span>
    <?php endif ?>


</div><!-- end login_form-->

<script>
    $('document').ready(function(){

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

    });
</script>