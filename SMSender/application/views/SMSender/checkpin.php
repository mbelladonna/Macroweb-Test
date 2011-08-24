<div id="titular22">Para terminar con la operación, Introduce el número de PIN que has recibido en tu móvil.</div>

<?                      
    if (isset($error)) :
?>
    <div class="error"><?echo $error?></div>
<?
    unset($error);
    endif;
?>
  
<div id="caja_izq">
    <?echo img(array('src'=>'/assets/img/sms2.png', 'alt'=>'imagen_sms', 'width'=>'449', 'hiehgt'=>404));?>
</div>
   
<div id="caja_der">
    <? echo form_open(current_url(), array('method' => 'post')); ?>
        <div id="caja_pin">
            <div id="texto_msjes">
                <span class="estilo_pin">Introducir PIN:</span>        
                <label>
                    <? echo form_input(array('name'=>'data[pin_insert]', 'class'=>'estilo_pin', 'size'=>'10', 'maxlength'=>'4')); ?>
                </label>
            </div>
        </div>

        <div id="caja_vacia">
            <div id="texto_msjes222">
                <label>
                    <? echo form_submit(array('name'=>'submit', 'class'=>'boton', 'value'=>' ')); ?>
                </label>
            </div>
            <div id="caja_cancelar2">
                <? echo form_submit(array('name'=>'cancel', 'class'=>'boton_cancelar', 'value'=>' ')); ?>
            </div>
        </div>
    </form>
</div>
   
<div id="terminos">Condiciones de uso: Terminos y Condiciones: Servicio de suscripción ofrecido por EG Telecom, Apdo. 61010 CP 28036 Madrid. Coste 1,42 euros por SMS recibido IVA incluido. Movistar: 15 SMS/mes. Otros: 25 SMS/mes. Para cancelar el servicio envía BAJA al 795266. Num. Atn. Clte. 902 052 846, sms@egtelecom.es</div>
<div id="caja_registrado2">Si tienes problemas para enviar sms click aquí. </div>
<div id="botonera_horizontal">Quiénes Somos | Cómo Funciona | Aviso Legal | Condiciones de Uso | Ayuda | Contactar</div>
