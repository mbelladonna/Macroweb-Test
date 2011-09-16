<div id="franjavideos">
    <div class="estilo3" id="masvideos">
        <? 
            for ($i=1; $i<=3; $i++) : 
                if ($i == $pagina) :
        ?>
	            <span class="estilo4">
                    <?echo anchor("?page=$i", $i == 1 ? $i : " - $i", array('class' => 'estilo4'))?>
	            </span>
        <?      
                else :
                    echo anchor("?page=$i", $i == 1 ? $i : " - $i", array('class' => 'estilo3'));                
                endif;
            endfor;
            $nextpage = $pagina == 3 ? 1 : ++$pagina;
            echo anchor("?page=$nextpage", 'Siguiente&gt;&gt;', array('style'=>'margin-left: 5px;'));
        ?>
    </div>
</div>		
<div class="estilo3" id="volverarriba">
	<a href="#logo" class="estilo_volver_arriba">Volver arriba</a>
</div>
<div id="franja_moviles">
    <div class="estilo3" id="moviles">
        <strong>Terminos y Condiciones:</strong> Servicio de suscripción ofrecido por Querox S.L. mediante la utilización de la plataforma de EG Telecom, Apdo. 61010 CP 28036 Madrid. Coste máximo semanal, dependiendo de su operador, 5 euros más IVA. <br />
        Si desea cancelar el servicio debe comunicarse con atención al cliente de su operador de telefonía móvil y solicitar la baja del mismo.<br />
        <br />
        <strong>Móviles Compatibles:</strong> El contenido móvil de Pornoxmovil.com es compatible con modelos smartphone, que utilizen SO Android e Iphone. Tu teléfono móvil ha de tener acceso a Internet y poder visualizar videos flash o similares.</div>

    </div>
</div>
