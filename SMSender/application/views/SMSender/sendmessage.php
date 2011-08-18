<?                      
    if (isset($error)) :
?>
    <div class="error"><?echo $error?></div>
<?
    unset($error);
    endif;
?>

<div class="form">
        <? echo " Pin ingresado correctamente - Enviar mensaje <br>"; ?>
        
        <a href="<?php echo base_url();?>"> Inicio </a>
</div>