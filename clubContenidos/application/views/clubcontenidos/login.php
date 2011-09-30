<script type="text/javascript">
   $(document).ready(function(){
        $("#formlogin").validate();
        $("#textfield_movil").rules("add", reglas_movil);
        $("#textfield_password").rules("add", reglas_password);
   });
    
    function clearText(thefield){
        if (thefield.defaultValue==thefield.value)
        thefield.value = ""
    }
    
    function setText(thefield){
        if (thefield.value=="")
        thefield.value = thefield.defaultValue
    }
</script>

<?if (!$this->session->userdata('logged_in')) { ?>
<div id="login">
    <? echo form_open('/clubcontenidos/login', array('method' => 'post', 'id'=>'formlogin')); ?>
          
            <table width="230" border="0" align="center" cellpadding="0" cellspacing="0">
                 <tr>
                   <td align="center" class="estilo2">LOGIN DE USUARIO</td>
                 </tr>
                 <?                      
                    if (isset($error)) :
                ?>
                <tr>
                   <td align="center" class="estilo2">
                        <div class="error">
                            <?echo $error?>
                        </div>
                    </td>
                </tr>
                <?
                    unset($error);
                    endif;
                ?>
                 <tr>
                   <td height="15" align="center"></td>
                 </tr>
                 <tr>
                   <td align="center">
                        <label>
                            <? echo form_input(array('name'=>'data[movil]', 'class'=>'estilo1', 'id'=>'textfield_movil', 'value'=>'Tu movil', 'maxlength'   => '9', 'onfocus'=>'clearText(this)', 'onblur'=>'setText(this)')); ?>
                            
                        </label>
                    </td>
                 </tr>
                 <tr>
                   <td height="8" align="center"></td>
                 </tr>
                 <tr>
                    
                    <td align="center">
                        <label>
                         <? echo form_password(array('name'=>'data[password]', 'class'=>'estilo1', 'id'=>'textfield_password','maxlength'=>'10')); ?>
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

