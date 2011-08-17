<?php

class Model_Answer extends Orm\Model {
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array('before_insert'),
		'Orm\Observer_UpdatedAt' => array('before_save'),
	);
}

/* End of file answer.php */