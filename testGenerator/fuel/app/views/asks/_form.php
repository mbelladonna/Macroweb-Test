<?php echo Form::open(); ?>
	<p>
        <?php if(isset($question_id)){ $q_id = $question_id; }else{ $q_id = null; }?>
        <?php echo Form::hidden('question_id', Input::post('question_id', isset($ask) ? $ask->question_id : $q_id)); ?>
	</p>
	<p>
		Pregunta <?php echo Form::input('ask', Input::post('ask', isset($ask) ? $ask->ask : '')); ?> <?php echo Form::submit(null, 'Agregar'); ?>
	</p>

<?php echo Form::close(); ?>
