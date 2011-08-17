<h2 class="first">Editing Ask</h2>

<?php echo render('asks/_form'); ?>
<br />
<p>
<?php echo Html::anchor('asks/view/'.$ask->id, 'View'); ?> |
<?php echo Html::anchor('asks', 'Back'); ?></p>
