<h2 class="first">Editing Answer</h2>

<?php echo render('answers/_form'); ?>
<br />
<p>
<?php echo Html::anchor('answers/view/'.$answer->id, 'View'); ?> |
<?php echo Html::anchor('answers', 'Back'); ?></p>
