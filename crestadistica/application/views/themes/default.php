<html lang="es">
	<head>
		<title><?php echo $title; ?></title>
		<meta name="resource-type" content="document" />
		<meta name="robots" content="all, index, follow"/>
		<meta name="googlebot" content="all, index, follow" />
    <meta charset="utf-8">
	<?php
	/** -- Copy from here -- */
	if(!empty($meta))
	foreach($meta as $name=>$content){
		echo "\n\t\t";
		?><meta name="<?php echo $name; ?>" content="<?php echo $content; ?>" /><?php
			 }
	echo "\n";

	if(!empty($canonical))
	{
		echo "\n\t\t";
		?><link rel="canonical" href="<?php echo $canonical?>" /><?php

	}
	echo "\n\t";

	foreach($css as $file){
	 	echo "\n\t\t";
		?><link rel="stylesheet" href="<?php echo $file; ?>" type="text/css" /><?php
	} echo "\n\t";

	foreach($js as $file){
			echo "\n\t\t";
			?><script src="<?php echo $file; ?>"></script><?php
	} echo "\n\t";

	/** -- to here -- */
?>

    <!-- Le styles -->
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/hero_files/bootstrap-responsive.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/general.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/themes/default/css/custom.css" rel="stylesheet"> 
    <link href="<?php echo base_url(); ?>css/style.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url().'css/datepicker.css'?>"/>
    <link rel="stylesheet/less" type="text/css" href="<?php echo base_url().'less/datepicker.less'?>" />

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/themes/default/images/favicon.png" type="image/x-icon"/>
	<meta property="og:image" content="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png"/>
	<link rel="image_src" href="<?php echo base_url(); ?>assets/themes/default/images/facebook-thumb.png" />
  <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
	
</head>

  <body>

    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <!--<img src="<?php //echo base_url(); ?>assets/themes/default/images/logo.png" style="float:left;margin-top:5px;z-index:5" alt="logo"/>-->
          <a class="brand" href="<?php echo site_url(); ?>">&nbsp;&nbsp;CRESTADISTICA</a>
          <div style="height: 0px;" class="nav-collapse collapse">
            <ul class="nav">  
              <li class="active"><a href="<?php echo site_url(); ?>">Home</a></li>
              <?php if($this->session->userdata('_is_admin') != false):?>
                <li><a href="<?php echo site_url('admin'); ?>">Administrar usuarios</a></li>
                <li><a href="<?php echo site_url('admin/admin_profile'); ?>">Perfil Admin</a></li>
                <li><a href="<?php echo site_url('modulos'); ?>">Módulos</a></li>
                <li><a href="<?php echo site_url('modulos/listadomodulos'); ?>">Listado Módulos</a></li>
                <!--<li><a href="<?php //echo site_url('modulos/novedades'); ?>">Módulos Novedades</a></li>-->
              <?php endif;?>
                <?php if($this->session->userdata('_is_user') != false):?>
                    <li><a href="<?php echo site_url('modulos/listadomodulos'); ?>">Módulos</a></li>
                <li><a href="<?php echo site_url('users').'/'.$this->session->userdata('dni'); ?>">Perfil Usuario</a></li>
              <?php endif;?>
              <?php if($this->session->userdata('is_logged_in')):?>
                <li><a href="<?php echo site_url('login/logout'); ?>">Desconectarse</a></li>
              <?php else:?>
                <li><a href="<?php echo site_url('login'); ?>">Conectarse</a></li>
              <?php endif;?>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">
    <?php if($this->load->get_section('text_header') != '') { ?>
    	<h1><?php echo $this->load->get_section('text_header');?></h1>
    <?php }?>
    <div class="row">
	    <?php echo $output;?>
		<?php echo $this->load->get_section('sidebar'); ?>
    </div>
      <hr/>

      <footer>
      	<div class="row">
	        <div class="span6 b10">
				Copyright &copy; Crestadistica
	        </div>
        </div>
      </footer>
      <script src="<?php echo base_url().'js/bootstrap-datepicker.js'?>"></script>
      <script src="<?php echo base_url().'/js/locales/bootstrap-datepicker.es.js'?>" charset="UTF-8"></script>
      <script type="text/javascript" charset="utf-8">
          $("#datepicker").datepicker();         
      </script>

      <script src="<?php echo base_url(); ?>js/app.js" ></script>


    </div> <!-- /container -->
</body></html>
