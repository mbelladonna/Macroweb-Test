<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
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
        </div>
    </body>
</html>
