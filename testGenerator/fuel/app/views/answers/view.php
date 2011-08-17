<p>
	<strong>Question id:</strong>
	<?php echo $answer->question_id; ?></p>
<p>
	<strong>Ask id:</strong>
	<?php echo $answer->ask_id; ?></p>
<p>
	<strong>Answer:</strong>
	<?php echo $answer->answer; ?></p>
<p>
	<strong>Points:</strong>
	<?php echo $answer->points; ?></p>
<p>
	<strong>Is correct:</strong>
	<?php echo $answer->is_correct; ?></p>

<?php echo Html::anchor('answers/edit/'.$answer->id, 'Edit'); ?> | 
<?php echo Html::anchor('answers', 'Back'); ?>