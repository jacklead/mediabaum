
<div id="login_form">

  <h1>Datos de ingreso</h1>
    <?php 
  echo form_open('login/validate_credentials');
  echo form_input(array('name'=>'dni','id'=>'dni','type'=>'text','placeholder'=>'DNI'));
  echo form_password(array('name'=>'password','id'=>'password','type'=>'password','placeholder'=>'Password'));
  echo form_submit('submit', 'Login');
  echo anchor('login/signup', 'Crear Cuenta');
  echo anchor(array('login/forgot_pass', '?reset=0'), 'Olvidé Contraseña');

  echo form_close();
  ?>
  <?php if(isset($error) && $error!=''): ?>
      <span class="label label-important"><?php echo $error; ?></span>
  <?php endif ?>
  

</div><!-- end login_form-->

