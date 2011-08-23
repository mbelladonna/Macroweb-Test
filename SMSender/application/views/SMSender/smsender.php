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
            <? echo form_input(array('name'=>'datanuevo[destino_subno]')); ?>
        </div>
        <div class="input">
            <div>
                <label>Introduce tu número:</label>
            </div>
            <? echo form_input(array('name'=>'datanuevo[origen_subno]')); ?>
        </div>
        <div class="input">
            <div>
                <label>Escribe el texto del mensaje: </label>
            </div>
            <? echo form_textarea(array('name'=>'datanuevo[message]', 'rows'=>'5', 'cols'=>'100', 'value'=>'')); ?>
        </div>           
        <div class="input">
            <? echo form_submit('submit', 'Enviar sms'); ?>
        </div>
    </form>
</div>

<div class="form">
    <? echo form_open(current_url(), array('method' => 'post')); ?>
        <div>
            <label>Si ya estas registrado o enviaste un sms accede desde aqui:</label>
        </div>
        <div class="input">
            <div>
                <label>Tu movil:</label>
            </div>
            <? echo form_input(array('name'=>'dataregistrado[origen_subno]')); ?>
        </div>
        <div class="input">
            <div>
                <label>Tu Pin:</label>
            </div>
            <? echo form_password(array('name'=>'dataregistrado[password]')); ?>
        </div>         
        <div class="input">
            <? echo form_submit('submit', 'Entrar'); ?>
        </div>
    </form>
</div>   
