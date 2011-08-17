<h2 class="first">Nueva Pregunta</h2>

<?php echo render('asks/_form', array('question_id' => $question_id)); ?>
<br />
<p><?php echo Html::anchor('questions/create', 'Atras'); ?></p>
