<script type="text/javascript">
   $(document).ready(function(){
        $("#form_nuevo").validate();
        $("#destino_subno").rules("add", reglas_telefono);
        $("#origen_subno").rules("add", reglas_telefono);        
        $("#message").rules("add", reglas_mensaje);    
        $("#term_check").rules("add", reglas_terminos);    
        $("#form_registrado").validate();
        $("#registrado_origen_subno").rules("add", reglas_telefono);
        $("#registrado_password").rules("add", reglas_password);
   });
</script>

<div id="titular">
    Date de alta por 1,42&#8364/ sms recibido, consigue creditos para enviar sms<br /> a tu amigos.  Solo por darte de alta 500 sms gratis.
</div>

<?                      
    if (isset($error)) :
?>
    <div class="error">
        <?echo img(array('src'=>'/assets/img/alert.png', 'width'=>'16', 'height'=>'16', 'align'=>'absmiddle', 'alt'=>'alerta'));?>
        <?echo $error?>
    </div>
<?
    unset($error);
    endif;
?>

<?                      
    if (isset($status_message)) :
?>
    <div class="message">
        <?echo img(array('src'=>'/assets/img/ok.png', 'width'=>'16', 'height'=>'16', 'align'=>'absmiddle', 'alt'=>'message'));?>
        <?echo $status_message?>
    </div>
<?
    unset($status_message);
    endif;
?>

<div id="caja_izq">
    <?echo img(array('src'=>'/assets/img/izq.png', 'alt'=>'imagen_sms', 'width'=>'449', 'height'=>'404')); ?>
</div>

<div id="caja_der"> 
    
    <? echo form_open(current_url(), array('method' => 'post', 'id'=>'form_nuevo')); ?>
            
        <div id="caja1">
            <div id="texto_msjes">
                <label>Enviar mensaje a: </label>
                <? echo form_input(array('name'=>'datanuevo[destino_subno]', 'type'=>'text', 'class'=>'estilo_numeracion', 'id'=>'destino_subno', 'maxlength'=>'9')); ?>
            </div>
        </div>
           
        <div id="caja2">
            <div id="texto_msjes2">
                <label>Introduce tu movil: </label>
                <? echo form_input(array('name'=>'datanuevo[origen_subno]', 'type'=>'text', 'class'=>'estilo_numeracion', 'id'=>'origen_subno', 'maxlength'=>'9')); ?>
            </div>
        </div>

        <div id="caja3">
            <div id="texto_msjes3">
                <label>Escribe el texto del mensaje: </label>
                 <br />
                <? echo form_textarea(array('name'=>'datanuevo[message]', 'rows'=>'4', 'cols'=>'45', 'value'=>'', 'class'=>'estilo_numeracion', 'id'=>'message', 'maxlength'=>'300')); ?>
                <br />
            </div>
        </div>
        
        <div id="acepto">
            <? echo form_checkbox(array('name'=>'checkbox', 'id'=> 'term_check','checked'=> FALSE) ) ?>
             Acepto los Términos y Condiciones del servicio de suscripción, ver a pie de página. Coste 1,42 euros por mensaje recibido.
            
        </div>

        <div id="lugar_boton">
            <? echo form_submit(array('name'=>'button', 'type'=>'submit', 'class'=>'boton', 'id'=>'button')); ?>
        </div>

    </form>
    
</div>

<div id="terminos">
     Términos y  Condiciones: Servicio de suscripción prestado por [Querox S.L] prestado a través de un servicio de tarificación adicional de suscripción ofrecido por EG TELECOM, S.A. C/ Agustín de Foxá 25, 9ª Planta, 28036 Madrid, España. Coste 1,42 euros por SMS recibido IVA incluido. Máximo 25 SMS/mes. Para cancelar el servicio envía BAJA al 795266. Num. Atn. Clte. 902599231. Soporte sms@egtelecom.es Al introducir el PIN enviado a tu Terminal aceptas los Términos Legales del servicio. El presente Sitio Web, el servicio de descargas y los contenidos ofrecidos en el mismo son responsabilidad exclusiva de [Querox S.L] Servicio reservado a mayores de 18 años.
</div>    
 
<div id="caja_ayuda">
    <? echo form_open(current_url(), array('method' => 'post', 'id' => 'form_registrado')); ?>
        <span class="estilo_ingreso">Si ya estas registrado o enviaste un sms accede desde aqui:</span><br />
        <span class="estilo_ingreso">Tu Movil:</span>
        <? echo form_input(array('name'=>'dataregistrado[origen_subno]', 'class'=>'estilo_contenido', 'id'=>'registrado_origen_subno', 'maxlength'=>'9')); ?>
        
        <span class="estilo_ingreso">Tu Password:</span>
        <? echo form_password(array('name'=>'dataregistrado[password]', 'class'=>'estilo_contenido', 'id'=>'registrado_password', 'size'=>'08', 'maxlength'=>'6')); ?>
                
        <? echo form_submit(array('name'=>'button2', 'class'=>'estilo_2', 'id'=>'button2', 'value'=>'Entrar')); ?>
    </form>
</div>

<div id="caja_registrado">Si tienes problemas para enviar sms click <?echo anchor('smsender/problemas', 'aqu&#237')?>.</div>
