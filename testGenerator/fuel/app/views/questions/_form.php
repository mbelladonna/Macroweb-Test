<?php echo Form::open(array('id' => 'createQuestionFrm')); ?>
	<p>
		<?php echo Form::label('Titulo', 'title'); ?>
<?php echo Form::input('title', Input::post('title', isset($question) ? $question->title : '')); ?>
	</p>
	<p>
		<?php echo Form::label('Url', 'url'); ?>
<?php echo Form::input('url', Input::post('url', isset($question) ? $question->url : '')); ?> 
<i><small><b>url</b> que se utilizara para el subdominio</i> ej: <b>testdeprueba</b>.sitio.com</small>
	</p>
	<p>
		<?php echo Form::label('Descripci&oacute;n', 'description'); ?>
<?php echo Form::textarea('description', Input::post('description', isset($question) ? $question->description : ''), array('rows' => 10, 'cols' => 70)); ?>

	</p>

	<div class="actions">
		<?php echo Form::submit(null, 'Crear'); ?>
    </div>
</form>
