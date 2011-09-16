<?php echo '<?xml version="1.0"?>'; ?> 
<!DOCTYPE html PUBLIC "-//WAPFORUM//DTD XHTML Mobile 1.0//EN" "http://www.wapforum.org/DTD/xhtml-mobile10.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><? if(!isset($page_title)) : ?>Pornoxmovil.com<? else: ?><?=$page_title?><?php endif;?></title>
		<link href="<?php echo base_url();?>assets/css/estilo.css" rel="stylesheet" type="text/css" />
		<meta http-equiv="Content-Type" content="application/xhtml+xml;charset=utf-8" />
		<meta http-equiv="Cache-Control" content="max-age=86400"/>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/custom-rules.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/localization/messages_es.js"></script>
    </head>
    <body>
        <div id="logo">
            <? echo anchor(base_url(), img(array('src'=>base_url().'assets/img/logo.jpg','width'=>'320','height'=>'141'))); ?>
        </div>
        
        <div id="user_toolbar">
        <? if ($this->session->userdata('logged_in')) : ?>
            <? echo anchor('pornoxmovil/logout', 'Logout'); ?>
        <? else : ?>
            <? echo anchor('pornoxmovil/authorizeSubscription', 'Regístrate'); ?> | <? echo anchor('pornoxmovil/login', 'Login'); ?>
        <? endif; ?>
        </div>

		<div class="estilo1" id="ultimos">::. <?=$sub_title?> .::</div>
		
        <div id="contenedor"> 
            <?=$content?>
        </div>
		
		<?=$paginador?>

		<div class="estilo_pie" id="pie">
			<?echo anchor('/', 'Inicio')?> |
            <?echo anchor('pornoxmovil/avisoContenido', 'Aviso de Contenido')?> |
            <?echo anchor('pornoxmovil/tratamientoDatos', 'Tratamiento de Datos')?> | 
            <br />
            <?echo anchor('pornoxmovil/miembros', 'Miembros')?> |
            <?echo anchor('pornoxmovil/condiciones', 'Condiciones de Uso')?> | 
            <?echo mailto('info@pornoxmovil.com', 'Contacto')?> 
                
        </div>
        
        
    </body>
</html>
