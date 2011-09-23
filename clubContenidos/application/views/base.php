<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title><? if(!isset($title)) : ?>clubita.com<? else: ?><?=$title?><?php endif;?></title>
    </head>
    <body>
        <div align="center">
        <? if ($this->session->userdata('logged_in')) : ?> 
            <? echo anchor('clubcontenidos/logout', 'Logout'); ?>
        <? else : ?>
            <? echo anchor('clubcontenidos/register', 'Regístrate'); ?> | <? echo anchor('clubcontenidos/login', 'Login'); ?>
        <? endif; ?>
            
        </div>
        
        
        <div > 
            <?=$content?>
        </div>
		       
    </body>
</html>
