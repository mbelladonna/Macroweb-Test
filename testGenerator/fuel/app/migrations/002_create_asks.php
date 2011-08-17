<?php

namespace Fuel\Migrations;

class Create_asks {

	public function up()
	{
		\DBUtil::create_table('asks', array(
			'id' => array('constraint' => 11, 'type' => 'int', 'auto_increment' => true),
			'question_id' => array('constraint' => 11, 'type' => 'int'),
			'ask' => array('constraint' => 255, 'type' => 'varchar'),
			'created_at' => array('constraint' => 11, 'type' => 'int'),
			'updated_at' => array('constraint' => 11, 'type' => 'int'),
		), array('id'));
	}

	public function down()
	{
		\DBUtil::drop_table('asks');
	}
}