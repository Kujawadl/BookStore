<?php

namespace Fuel\Migrations;

class Customers
{
  function up()
  {
    \DBUtil::create_table('customers',
      array(
          'id'      => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
          'contact' => array('type' => 'int', 'unsigned' => true),
          'fname'   => array('type' => 'varchar', 'constraint' => 30),
          'lname'   => array('type' => 'varchar', 'constraint' => 30),
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
     \DBUtil::drop_table('customers');
  }
}
