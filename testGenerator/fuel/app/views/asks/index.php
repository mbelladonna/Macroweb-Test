<h2 class="first">Listing Asks</h2>

<table cellspacing="0">
	<tr>
		<th>Question id</th>
		<th>Ask</th>
		<th></th>
	</tr>

	<?php foreach ($asks as $ask): ?>	<tr>

		<td><?php echo $ask->question_id; ?></td>
		<td><?php echo $ask->ask; ?></td>
		<td>
			<?php echo Html::anchor('asks/view/'.$ask->id, 'View'); ?> |
			<?php echo Html::anchor('asks/edit/'.$ask->id, 'Edit'); ?> |
			<?php echo Html::anchor('asks/delete/'.$ask->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>		</td>
	</tr>
	<?php endforeach; ?></table>

<br />

<?php echo Html::anchor('asks/create', 'Add new Ask'); ?>