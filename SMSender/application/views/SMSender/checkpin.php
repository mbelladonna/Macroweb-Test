<?                      
    if (isset($error)) :
?>
    <div class="error"><?echo $error?></div>
<?
    unset($error);
    endif;
?>

<div class="message">Usuario no encontrado. PIN enviado a <? echo $request->origen_subno; ?></div>

<div class="form">
               
        <? echo form_open(current_url(), array('method' => 'post')); ?>
            <div class="input">
                <div>
                    <label>Ingresar el pin</label>
                </div>
                <? echo form_input(array('name'=>'data[pin_insert]')); ?>
            </div>
            <div class="input">
                <? echo form_submit('submit', 'Enviar'); ?>
                <? echo form_submit('cancel', 'Cancelar') ?>
            </div>
        </form>
</div>
