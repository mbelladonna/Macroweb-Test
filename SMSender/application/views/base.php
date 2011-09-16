<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link href="<?php echo base_url();?>assets/css/estilo_500.css" rel="stylesheet" type="text/css" media="screen"/>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.5.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/jquery.validate.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/custom-rules.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/localization/messages_es.js"></script>
        <title><? if(!isset($page_title)) : ?>Envia 500 SMS<? else: ?><?=$page_title?><?php endif;?></title>
    </head>
    <body>
        <div id="contenedor"> 
            <?=$content?>
            <div id="botonera_horizontal">
                <?echo anchor('/', 'Inicio')?> |
                <?echo anchor('smsender/quienesSomos', 'Qui&#233nes Somos')?> |
                <?echo anchor('smsender/comoFunciona', 'C&#243mo Funciona')?> | 
                <?echo anchor('smsender/aviso', 'Aviso Legal')?> |
                <br />
                <?echo anchor('smsender/condiciones', 'Condiciones de Uso')?> | 
                <?echo anchor('smsender/ayuda', 'Ayuda')?> |
                <?echo mailto('info@500smsgratis.com', 'Contactar')?> |
                <?echo anchor('smsender/tratamientoDatos', 'Tratamiento de Datos')?> |
            </div>
        </div>
    </body>
</html>
