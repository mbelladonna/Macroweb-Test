<div class="form">
    <? echo form_open(current_url(), array('method' => 'post')); ?>
        <div class="input">
            <div>
                <label>Nro movil origen</label>
            </div>
            <? echo form_input(array('name'=>'origen_subno')); ?>
        </div>
        <div class="input">
            <div>
                <label>Nro movil destino</label>
            </div>
            <? echo form_input(array('name'=>'origen_subno')); ?>
        </div>
        <div class="input">
            <div>
                <label>Mensaje</label>
            </div>
            <? echo form_textarea(array('name'=>'message', 'rows'=>'5', 'cols'=>'100', 'value'=>'')); ?>
        </div>
        <div class="input">
            <? echo form_submit('submit', 'Enviar'); ?>
        </div>
    </form>
</div>
