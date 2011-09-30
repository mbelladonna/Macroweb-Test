<? foreach ($categresult as $row) { ?>
    <div class="estilo_titulos" id="titulo_izq_fondos">
        <? echo $row->name; ?> 
    </div>
                   
    <div id="fondos">
        <table border="0"  cellpadding="0" cellspacing="0">
             <tr>
                <? for ($i = 0; $i <= 3; $i++) { ?>
                
                    <td>
                        <div id="caja_fondo">
                            
                            <div id="caja_img">
                                <?echo img(array('src'=>'/assets/img_prod/'.$productos[$row->id_category][$i]->foto, 'alt'=> $productos[$row->id_category][$i]->text_alt, 'width' => '155',
          'height' => '100'));?>
                            </div>
                            <div class="estilo_titulos_img" id="titulo_img"><? echo $productos[$row->id_category][$i]->titulo; ?></div>
                            <div class="estilo_titulos_img" id="resolucion_img"><? echo $productos[$row->id_category][$i]->descripcion; ?></div>
                            
                             
                        </div>
               
                </td>
                <? } ?>
                
                
             </tr>
             <tr>
                <td> 
                    <br>
                    <br>
                    <br>
                    <br>
                </td>
             </tr>
        </table>
     
        <div class="estilo_mas" id="mas_fondos">
            <?echo anchor('/clubcontenidos/mas'.$row->name, 'Mas '.$row->name.' --&gt')?>
        </div>
        
    </div>
<?  } ?>
 

