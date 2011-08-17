<p>
	<strong>Question id:</strong>
	<?php echo $ask->question_id; ?></p>
<p>
	<strong>Ask:</strong>
	<?php echo $ask->ask; ?></p>

<?php echo Html::anchor('asks/edit/'.$ask->id, 'Edit'); ?> | 
<?php echo Html::anchor('asks', 'Back'); ?>