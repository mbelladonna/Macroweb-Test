<?if (!$this->session->userdata('logged_in')) { ?>
<div id="login">
    <? echo form_open('/clubcontenidos/login', array('method' => 'post', 'id'=>'form1')); ?>
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

    
        
        
            <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
                   <td align="center" class="estilo2">LOGIN DE USUARIO</td>
                 </tr>
                 <tr>
                   <td height="15" align="center"></td>
                 </tr>
                 <tr>
                   <td align="center">
                        <label>
                            <? echo form_input(array('name'=>'data[movil]', 'class'=>'estilo1', 'id'=>'textfield_movil', 'value'=>'Usuario')); ?>
                            
                        </label>
                    </td>
                 </tr>
                 <tr>
                   <td height="8" align="center"></td>
                 </tr>
                 <tr>
                    
                    <td align="center">
                        <label>
                         <? echo form_password(array('name'=>'data[password]', 'class'=>'estilo1', 'id'=>'textfield_password','maxlength'=>'10', 'value'=>'Contraseña')); ?>
                        </label>
                    </td>
                 </tr>
                 <tr>
                   <td height="10" align="center"></td>
                 </tr>
                 <tr>
                   <td align="center">
                        <label>
                            <? echo form_submit(array('name'=>'submit', 'class'=>'estilo_boton', 'value'=>'Ingresar')); ?>
                        </label>
                    
                   </td>
                 </tr>
           </table>
        
       
        
     </form>
</div> 

 <? } ?>
