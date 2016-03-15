
<div id="reset_form">
    <?php print_r($user);?>

    <h1>Reset password</h1>
    <?php

    echo form_open('login/resetpass');
    echo form_input(array('name'=>'password','id'=>'password','type'=>'password','placeholder'=>'Password'));
    echo form_input(array('name'=>'passconf','id'=>'passconf','type'=>'password','placeholder'=>'Repetir Password'));
    echo form_input(array('name'=>'email','id'=>'email','type'=>'hidden','value'=>$user));
    echo form_input(array('name'=>'key','id'=>'key','type'=>'hidden','value'=>$key));
    echo form_submit('submit', 'Restablecer Contraseña');
    echo form_close();

    ?>


</div><!-- end login_form-->

