<?                      
    if (isset($error)) :
?>
    <div class="error"><?echo $error?></div>
<?
    unset($error);
    endif;
?>

<?                      
    if (isset($status_message)) :
?>
    <div class="message"><?echo $status_message?></div>
<?
    unset($status_message);
    endif;
?>

<div class="form">
    <? echo form_open(current_url(), array('method' => 'post')); ?>
        <div class="input">
            <div>
                <label>Enviar mensaje a:</label>
            </div>
            <? echo form_input(array('name'=>'dataregistrado[destino_subno]')); ?>
        </div>
        <div class="input">
            <div>
                <label>Escribe el texto del mensaje: </label>
            </div>
            <? echo form_textarea(array('name'=>'dataregistrado[message]', 'rows'=>'5', 'cols'=>'100', 'value'=>'')); ?>
        </div>           
        <div class="input">
            <? echo form_submit('submit', 'Enviar sms'); ?>
        </div>
    </form>
</div>    

    

