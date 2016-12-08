<?php

namespace Fuel\Migrations;

class Suppliers
{
  function up()
  {
    \DBUtil::create_table('suppliers',
      array(
        'id'   => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
        'name' => array('type' => 'varchar', 'constraint' => 50)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array()
    );

    \DBUtil::create_table('supplier_reps',
      array(
        'id'         => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
        'supplier'   => array('type' => 'int', 'unsigned' => true),
        'contact'    => array('type' => 'int', 'unsigned' => true),
        'fname'      => array('type' => 'varchar', 'constraint' => 30),
        'lname'      => array('type' => 'varchar', 'constraint' => 30)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'supplier',
          'reference' => array(
            'table'   => 'suppliers',
            'column'  => 'id'
          )
        ),
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
    \DBUtil::drop_table('supplier_reps');
    \DBUtil::drop_table('suppliers');
  }
}
