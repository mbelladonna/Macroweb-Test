 <div id="top_descargas">
               
	<div class="estilo_top" id="titulo_top_descargas">TOP DESCARGAS</div>
    <? foreach ($categresult as $row) { ?>
           <div class="estilo_tops" id="top_des1"><? echo $row->name; ?> </div>
           <div id="top_rank2" class="estilo_titulos_img">
            - Productos de esta categoria<br /> <br /> <br /> <br /> <br /> <br /> <br /> <br />
           </div>
            <div id="linita1">
		<?echo img(array('src'=>'/assets/img/linita.png'));?>
	</div>
    <?  } ?>
    
   
</div>