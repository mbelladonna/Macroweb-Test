<div id="titular22">
    Bienvenido <span class="estilo_bienvenido"><? echo $request->origen_subno; ?></span>, Podrás enviar hasta 2 sms por día.
</div>

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

<div id="caja_izq"> 
    <?echo img(array('src'=>'/assets/img/sms2.png', 'alt'=>'imagen_sms', 'width'=>'449', 'height'=>'404')); ?>
</div>

<div id="caja_der">

    <? echo form_open(current_url(), array('method' => 'post')); ?>
    
        <div id="caja1">
            <div id="texto_msjes">
                Enviar Mensaje a:         
                <label>
                    <? echo form_input(array('name'=>'dataregistrado[destino_subno]', 'class'=>'estilo_numeracion')); ?>
                </label>
            </div>
        </div>
       
        <div id="caja2_3">
            <div id="texto_msjes3">Escribe el texto del mensaje:<br />
                <br />
                <? echo form_textarea(array('name'=>'dataregistrado[message]', 'rows'=>'2', 'cols'=>'45', 'value'=>'', 'class'=>'estilo_numeracion')); ?>
                <br />
                <label></label>
            </div>
        </div>
       
        <div id="acepto">
            <label>
                <? echo form_checkbox(array('name'=>'checkbox', 'id'=> 'checkbox','checked'=> TRUE) ) ?>
            </label>
            Al pulsar el botón acepto los Términos y Condiciones del Servicio <br /> y la Política de Privacidad y Protección de Datos
        </div>
          
        <div id="lugar_boton2">
            <label>
                <? echo form_submit(array('name'=>'button', 'type'=>'submit', 'class'=>'boton', 'value'=>' ')); ?>
            </label>
        </div>
        
        <div id="caja_cancelar">
            <? echo form_submit(array('name'=>'cancel', 'class'=>'boton_cancelar', 'value'=>' ')); ?>
        </div>

        <div id="caja_precio">Coste por Alerta recibida 1,42€</div>
     
    </form>

</div>

<div id="terminos">Condiciones de uso: Terminos y Condiciones: Servicio de suscripción ofrecido por EG Telecom, Apdo. 61010 CP 28036 Madrid. Coste 1,42 euros por SMS recibido IVA incluido. Movistar: 15 SMS/mes. Otros: 25 SMS/mes. Para cancelar el servicio envía BAJA al 795266. Num. Atn. Clte. 902 052 846, sms@egtelecom.es</div>  
<div id="caja_registrado2">Si tienes problemas para enviar sms click aquí.</div>
<div id="botonera_horizontal">Quiénes Somos | Cómo Funciona | Aviso Legal | Condiciones de Uso | Ayuda | Contactar</div>
