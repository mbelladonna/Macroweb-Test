
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

 <div id="titular">
    Date de alta por 1,42&#8364/ sms recibido,
consigue creditos para enviar sms<br /> 
a tu amigos.
  Solo por darte de alta 500 sms gratis.
</div>

<div id="caja_izq"> <img src="img/izq.png" alt="imagen_sms" width="449" height="404" /></div>

<div id="caja_der"> 
    
        <? echo form_open(current_url(), array('method' => 'post')); ?>
            
            <div id="caja1">
                <div id="texto_msjes">
                    <label>Enviar mensaje a: </label>
                    <? echo form_input(array('name'=>'datanuevo[destino_subno]', 'type'=>'text', 'class'=>'estilo_numeracion', 'id'=>'textfield')); ?>
                </div>
            </div>
           
            <div id="caja2">
                <div id="texto_msjes2">
                    <label>Introduce tu n&#250mero: </label>
                    <? echo form_input(array('name'=>'datanuevo[origen_subno]', 'type'=>'text', 'class'=>'estilo_numeracion', 'id'=>'textfield2')); ?>
                </div>
            </div>
            <div id="caja3">
                <div id="texto_msjes3">
                    <label>Escribe el texto del mensaje: </label>
                     <br />
                    <? echo form_textarea(array('name'=>'datanuevo[message]', 'rows'=>'2', 'cols'=>'45', 'value'=>'', 'class'=>'estilo_numeracion')); ?>
                    <br />
                </div>
            </div>
            <div id="acepto">
                <? echo form_checkbox(array('name'=>'checkbox', 'id'=> 'checkbox','checked'=> TRUE) ) ?>
                Al pulsar el bot&#243n acepto los T&#233rminos y Condiciones del Servicio<br />
y la Pol&#237tica de Privacidad y Protecci&#243n de Datos
            </div>
            <div id="lugar_boton">
                <? echo form_submit(array('name'=>'button', 'type'=>'submit', 'class'=>'boton', 'id'=>'button')); ?>
            </div>
            <div id="caja_precio">
                Coste por Alerta recibida 1,42&#8364
            </div>
        </form>
    
</div>

<div id="terminos">
    Condiciones de uso: Terminos y Condiciones: Servicio de suscripci&#243n ofrecido por EG Telecom, Apdo. 61010 CP 28036 Madrid. Coste 1,42 euros por SMS recibido IVA incluido. Movistar: 15 SMS/mes. Otros: 25 SMS/mes. Para cancelar el servicio env&#237a BAJA al 795266. Num. Atn. Clte. 902 052 846, sms@egtelecom.es 
</div>  
 
<div id="caja_ayuda">
    <? echo form_open(current_url(), array('method' => 'post')); ?>
        <span class="estilo_ingreso">Si ya estas registrado o enviaste un sms accede desde aqui:</span><br />
        <span class="estilo_ingreso">Tu Movil:</span>
        <? echo form_input(array('name'=>'dataregistrado[origen_subno]', 'class'=>'estilo_contenido', 'id'=>'textfield4')); ?>
        
        <span class="estilo_ingreso">Tu Pin:</span>
        <? echo form_password(array('name'=>'dataregistrado[password]', 'class'=>'estilo_contenido', 'id'=>'textfield5', 'size'=>'08', 'maxlength'=>'4')); ?>
                
        <? echo form_submit(array('name'=>'button2', 'class'=>'estilo_2', 'id'=>'button2', 'value'=>'Entrar')); ?>
    </form>
</div>

<div id="caja_registrado">Si tienes problemas para enviar sms click aqu&#237. </div>
<div id="botonera_horizontal">Qui&#233nes Somos | C&#243mo Funciona | Aviso Legal | Condiciones de Uso | Ayuda | Contactar</div>   

