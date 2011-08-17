<?php

namespace Fuel\Migrations;

class Create_answers {

	public function up()
	{
		\DBUtil::create_table('answers', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'question_id' => array('constraint' => 11, 'type' => 'int'),
			'ask_id' => array('constraint' => 11, 'type' => 'int'),
			'answer' => array('constraint' => 255, 'type' => 'varchar'),
			'points' => array('constraint' => 11, 'type' => 'int'),
			'is_correct' => array('type' => 'smallint'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('answers');
	}
}