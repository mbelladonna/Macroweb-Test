<h2 class="first">Listing Answers</h2>

<table cellspacing="0">
	<tr>
		<th>Question id</th>
		<th>Ask id</th>
		<th>Answer</th>
		<th>Points</th>
		<th>Is correct</th>
		<th></th>
	</tr>

	<?php foreach ($answers as $answer): ?>	<tr>

		<td><?php echo $answer->question_id; ?></td>
		<td><?php echo $answer->ask_id; ?></td>
		<td><?php echo $answer->answer; ?></td>
		<td><?php echo $answer->points; ?></td>
		<td><?php echo $answer->is_correct; ?></td>
		<td>
			<?php echo Html::anchor('answers/view/'.$answer->id, 'View'); ?> |
			<?php echo Html::anchor('answers/edit/'.$answer->id, 'Edit'); ?> |
			<?php echo Html::anchor('answers/delete/'.$answer->id, 'Delete', array('onclick' => "return confirm('Are you sure?')")); ?>		</td>
	</tr>
	<?php endforeach; ?></table>

<br />

<?php echo Html::anchor('answers/create', 'Add new Answer'); ?>