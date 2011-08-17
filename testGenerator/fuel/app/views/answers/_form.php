<?php echo Form::open(); ?>

    <?php
        if(isset($question_id)){ $q_id = $question_id; }else{ $q_id = null; }
        if(isset($ask_id)){ $ask_id = $ask_id; }else{ $ask_id = null; }
        echo Form::hidden('question_id', Input::post('question_id', isset($answer) ? $answer->question_id : $q_id));
        echo Form::hidden('ask_id', Input::post('ask_id', isset($answer) ? $answer->ask_id : $ask_id)); 
    ?>

	<p>
		<?php echo Form::label('Answer', 'answer'); ?>
<?php echo Form::input('answer', Input::post('answer', isset($answer) ? $answer->answer : '')); ?>
	</p>
	<p>
		<?php echo Form::label('Points', 'points'); ?>
<?php echo Form::input('points', Input::post('points', isset($answer) ? $answer->points : '')); ?>
	</p>
	<p>
		<?php echo Form::label('Is correct', 'is_correct'); ?>
<?php echo Form::input('is_correct', Input::post('is_correct', isset($answer) ? $answer->is_correct : '')); ?>
	</p>

	<div class="actions">
		<?php echo Form::submit(); ?>	</div>

<?php echo Form::close(); ?>
