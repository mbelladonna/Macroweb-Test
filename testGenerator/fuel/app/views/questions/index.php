
<div style="float:right; margin-top:10px;">
    <?php echo Html::anchor('questions/create', 'Crear Cuestionario'); ?>
</div>

<h2 class="first">Listado de Cuestionarios</h2>

<table cellspacing="0">
	<tr>
        <th width="8%"><div align="left">ID</div></th>
		<th width="41%"><div align="left">Titulo</div></th>
		<th width="34%"><div align="left">Subdominio</div></th>
		<th width="19%"></th>
	</tr>

	<?php foreach ($questions as $question): ?>	<tr>

		<td><div align="left"><?php echo $question->id; ?></div></td>
		<td><div align="left"><?php echo $question->title; ?></div></td>
		<td><div align="left"><a href="#"><?php echo $question->url; ?></a></div></td>
		<td><span style="font-size:12px">
			<?php echo Html::anchor('questions/view/'.$question->id, 'Ver'); ?> |
			<?php echo Html::anchor('questions/edit/'.$question->id, 'Editar'); ?> |
			<?php echo Html::anchor('questions/delete/'.$question->id, 'Eliminar', array('onclick' => "return confirm('Esta seguro de eliminar este cuestionario?')")); ?>		</td>
            </span>
	</tr>
	<?php endforeach; ?></table>

<br />

