<?php

class Model_Ask extends Orm\Model {
	protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array('before_insert'),
		'Orm\Observer_UpdatedAt' => array('before_save'),
	);
}

/* End of file ask.php */