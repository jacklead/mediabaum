<div id="login_form">

	<h1>Login, Fool!</h1>
    <?php 
	echo form_open('login/forgot_pass');
	echo form_input(array('name'=>'email','id'=>'email','type'=>'text','placeholder'=>'email'));
	echo form_input(array('name'=>'reset','id'=>'reset','type'=>'hidden','value'=>1));
	echo form_submit('submit', 'Login');
	echo form_close();

	?>
	<?php if(isset($error) && $error!=''): ?>
    	<span class="label label-important"><?php echo $error; ?></span>
	<?php endif ?>
	<?php if(isset($success) && $success!=''): ?>
    	<span class="label label-success"><?php echo $success; ?></span>
	<?php endif ?>
	

</div><!-- end login_form-->

