<script type="text/javascript">
   $(document).ready(function(){
        $("#form_subscription").validate();
        $("#textfield_telefono").rules("add", reglas_telefono);
        $("#ckeck_terminos").rules("add", reglas_terminos); 
       });
</script>
<? echo form_open(current_url(), array('method' => 'post', 'id'=>'form_subscription')); ?>
    <?                      
        if (isset($error)) :
    ?>
        <div class="error">
            <?echo $error?>
        </div>
    <?
        unset($error);
        endif;
    ?>

    <table width="320" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center"><form id="form1" method="post" action="">
                <table width="280" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td width="63" class="estilo3">Teléfono Movil:</td>
                        <td width="217">
                            <label>
                                <? echo form_input(array('name'=>'data[movil]', 'class'=>'estilo3', 'id'=>'textfield_telefono', 'maxlength'=>'9')); ?>
                            </label>
                        </td>
                     
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="63" class="estilo3">Operador:</td>
                        <td width="217">
                            <label>
                                <? echo form_dropdown('data[operador]',$lista_operadores,$operador_default); ?>
                            </label>
                        </td>
                     
                    </tr>
                    <tr>
                        <td height="10" colspan="2"></td>
                    </tr>
                    <tr>
                        <td colspan="2" class="estilo_terminos">
                            <? echo form_checkbox(array('name'=>'checkbox', 'id'=> 'ckeck_terminos','checked'=> FALSE) ) ?>
                            Acepto los Términos y Condiciones del servicio de suscripción, ver a pie de página. Coste 1,42 euros por mensaje recibido.
                        </td>
                    </tr>
                    <tr>
                      <td height="10" colspan="2"></td>
                    </tr>
                    <tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <label>
                                <? echo form_submit(array('name'=>'submit', 'class'=>'estilo4', 'value'=>'Aceptar')); ?>
                            </label>
                            
                        </td>
                        
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td class="estilo_terminos">
                <div>
                    <strong>Términos y  Condiciones:</strong>
                    <br />
                    Servicio de suscripción prestado por Querox S.L prestado a través de un servicio de tarificación adicional de suscripción ofrecido por EG TELECOM, S.A. C/ Agustín de Foxá 25, 9ª Planta, 28036 Madrid, España. Coste 1,42 euros por SMS recibido IVA incluido. Máximo 25 SMS/mes. Para cancelar el servicio envía BAJA al 795266. Num. Atn. Clte. 902599231. Soporte sms@egtelecom.es Al introducir el PIN enviado a tu Terminal aceptas los Términos Legales del servicio. El presente Sitio Web, el servicio de descargas y los contenidos ofrecidos en el mismo son responsabilidad exclusiva de Querox S.L Servicio reservado a mayores de 18 años.
                </div>
            </td>
        </tr>
    </table>
</form>
