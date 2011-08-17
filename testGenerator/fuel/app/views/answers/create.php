<h2 class="first">New Answer</h2>

<?php echo render('answers/_form', array('question_id' => $question_id, 'ask_id' => $ask_id)); ?>
<br />
<p><?php echo Html::anchor('answers', 'Back'); ?></p>
