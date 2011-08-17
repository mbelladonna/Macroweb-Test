<h2 class="first">Editing Question</h2>

<?php echo render('questions/_form'); ?>
<br />
<p>
<?php echo Html::anchor('questions/view/'.$question->id, 'View'); ?> |
<?php echo Html::anchor('questions', 'Back'); ?></p>
