<p>
	<strong>Title:</strong>
	<?php echo $question->title; ?></p>
<p>
	<strong>Url:</strong>
	<?php echo $question->url; ?></p>
<p>
	<strong>Description:</strong>
	<?php echo $question->description; ?></p>

<?php echo Html::anchor('questions/edit/'.$question->id, 'Edit'); ?> | 
<?php echo Html::anchor('questions', 'Back'); ?>