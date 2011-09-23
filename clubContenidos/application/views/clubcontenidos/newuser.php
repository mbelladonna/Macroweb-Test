<? echo form_open(current_url(), array('method' => 'post', 'id'=>'login')); ?>
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
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>    
                    <td>&nbsp;</td>
                        <td >Usuario nuevo:</td>
                        
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td width="63" class="estilo3">Movil:</td>
                        <td width="217">
                            <label>
                                <? echo form_input(array('name'=>'data[movil]', 'class'=>'estilo3', 'id'=>'textfield_movil')); ?>
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td class="estilo3">Contraseña:</td>
                        <td>
                            <? echo form_password(array('name'=>'data[password]', 'class'=>'estilo3', 'id'=>'textfield_password','maxlength'=>'10')); ?>
                        </td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td>
                            <label>
                                <? echo form_submit(array('name'=>'submit', 'class'=>'estilo4', 'value'=>'Login')); ?>
                            </label>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</form>