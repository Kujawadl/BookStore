<?php

namespace Fuel\Migrations;

class Authors
{

    function up()
    {
      \DBUtil::create_table('authors',
        array(
            'id' => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
            'fname' => array('type' => 'varchar', 'constraint' => 30),
            'lname' => array('type' => 'varchar', 'constraint' => 30),
            'gender' => array('type' => 'char'),
            'dob' => array('type' => 'date'),
            'contact' => array('type' => 'int', 'unsigned' => true),
        ),
        array('id'),
        true,
        'InnoDB',
        'utf8_unicode_ci',
        array()
      );
    }

    function down()
    {
       \DBUtil::drop_table('authors');
    }
}
