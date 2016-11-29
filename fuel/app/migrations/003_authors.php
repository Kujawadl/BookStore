<?php

namespace Fuel\Migrations;

class Authors
{
  function up()
  {
    \DBUtil::create_table('authors',
      array(
          'id'      => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'contact' => array('type' => 'int', 'unsigned' => true),
          'fname'   => array('type' => 'varchar', 'constraint' => 30),
          'lname'   => array('type' => 'varchar', 'constraint' => 30),
          'gender'  => array('type' => 'char'),
          'dob'     => array('type' => 'date')
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'contact',
          'reference' => array(
            'table'   => 'contact',
            'column'  => 'id'
          )
        )
      )
    );
  }

  function down()
  {
     \DBUtil::drop_table('authors');
  }
}
