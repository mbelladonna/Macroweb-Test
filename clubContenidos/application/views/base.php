<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><? if(!isset($title)) : ?>:: Clubita ::<? else: ?><?=$title?><?php endif;?></title>
    <link href="<?php echo base_url();?>assets/css/estilo_clubita.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/jquery-1.5.1.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/jquery.validate.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/custom-rules.js"></script>
    <script type="text/javascript" src="<?php echo base_url();?>assets/js/validator/localization/messages_es.js"></script>
</head>

<body>

<div id="contenedor">

    <div class="estilo1" id="telefono"> 
        <?if ($this->session->userdata('logged_in')) { ?> Telefono: <? echo $this->session->userdata('username');?>
            <? echo anchor('clubcontenidos/logout', 'Salir'); ?>
        <? } ?>
    </div>
    <div id="navegacion">
  
        <div id="logo">
            <?echo img(array('src'=>'/assets/img/logo_clubita.png', 'width'=>'252', 'height'=>'47', 'alt'=>'clubita'));?>
        </div>
      
        <div id="buscador">
            <? echo form_open(current_url(), array('method' => 'get', 'id'=>'form_nuevo')); ?>
                <? echo form_input(array('type'=>'text', 'class'=>'estilo1', 'value'=>'Buscar')); ?>

                <?echo img(array('src'=>'/assets/img/lupa.png', 'width'=>'32', 'height'=>'34', 'alt'=>'buscar',  'align'=>'absmiddle'));?>
                
            </form>
        </div>
      
        <div class="estilo_botonera" id="botonera">
            <?echo anchor('/', 'Home')?> |
            <?echo anchor('clubcontenidos/quienesSomos', 'Qui&#233nes Somos')?> |
            <?echo anchor('clubcontenidos/servicios', 'Servicios')?> | 
            <?echo anchor('clubcontenidos/productos', 'Productos')?> |
            <?echo mailto('info@clubita.com', 'Contacto')?> 
        </div>
      
        <div id="cabecera">
            <?echo img(array('src'=>'/assets/img/cabecera.png', 'alt'=>'cabecera'));?>
        </div>
      
        <div id="centro">
      
            <div id="centro_izq">
            
                <?=$content?> 
                
                <div class="estilo_titulos" id="titulo_izq_fondos">Fondos de Escritorio</div>
               
                <div id="fondos">
               
                    <div id="caja_fondo">
                 
                        <div id="caja_img">
                            <?echo img(array('src'=>'/assets/img/img1.jpg', 'alt'=>'messi'));?>
                        </div>
                        <div class="estilo_titulos_img" id="titulo_img">Messi Barcelona FC</div>
                        <div class="estilo_titulos_img" id="resolucion_img">1024x768</div>
                 
                    </div>
                 
                    <div class="estilo_mas" id="mas_fondos">
                        <?echo anchor('/clubcontenidos/masFondos', 'Mas Fondos de Escritorio --&gt')?>
                    </div>
                    
                </div>
               
                <div class="estilo_titulos" id="titulo_izq_videos">Videos</div>
               
                <div id="videos">
               
                    <div id="caja_video">
                 
                        <div id="caja_img_video">
                            <?echo img(array('src'=>'/assets/img/video1.jpg', 'alt'=>'shakira'));?>
                        </div>
                        <div class="estilo_titulos_img" id="artista_video">Shakira</div>
                        <div class="estilo_titulos_img" id="nombre_video">Sale el Sol</div>
                    </div>
             
                    <div id="mas_videos" class="estilo_mas">
                        <?echo anchor('/clubcontenidos/masVideos', 'Mas Videos --&gt')?>
                    </div>
           
                </div>
          
            </div>
          
            <div id="centro_der">
          
                <?=$contentlogin?> 
               
				<?=$contenttopdesc?>
               
            </div>
        </div>
      
        <div id="pie">
      
            <div id="logo_pie">
                <?echo img(array('src'=>'/assets/img/logo2.png', 'alt'=>'logo_clubita'));?>
                
            </div>
          
            <div class="estilo1" id="botonera_pie">
                <?echo anchor('/', 'Home')?> |
                <?echo anchor('clubcontenidos/quienesSomos', 'Qui&#233nes Somos')?> |
                <?echo anchor('clubcontenidos/servicios', 'Servicios')?> | 
                <?echo anchor('clubcontenidos/productos', 'Productos')?> |
                <?echo mailto('info@clubita.com', 'Contacto')?> 
                <br />
                <br />
                <?echo img(array('src'=>'/assets/img/face.png', 'width'=>'16', 'height'=>'16', 'alt'=>'face',  'align'=>'absmiddle'));?>
                <?echo img(array('src'=>'/assets/img/twit.png', 'width'=>'16', 'height'=>'16', 'alt'=>'face',  'align'=>'absmiddle'));?>
                Contactanos
            </div>
  
   
        </div>

    </div>
     
</div>


</body>
</html>
