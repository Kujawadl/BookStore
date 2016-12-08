<?php

namespace Fuel\Migrations;

class Orders
{
  function up()
  {
    \DBUtil::create_table('orders',
      array(
        'id'       => array('type' => 'int', 'auto_increment' => true, 'unsigned' => true),
        'customer' => array('type' => 'int', 'unsigned' => true),
        'ship_to'  => array('type' => 'int', 'unsigned' => true, 'null' => true),
        'date'     => array('type' => 'date', 'null' => true)
      ),
      array('id'),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'customer',
          'reference' => array(
            'table'   => 'customers',
            'column'  => 'id'
          )
        ),
        array(
          'key'       => 'ship_to',
          'reference' => array(
            'table'   => 'contact_address',
            'column'  => 'id'
          )
        )
      )
    );

    \DBUtil::create_table('order_items',
      array(
        'order' => array('type' => 'int', 'unsigned' => true),
        'book'  => array('type' => 'int', 'unsigned' => true),
        'quantity' => array('type' => 'int', 'unsigned' => true, 'default' => 1)
      ),
      array(),
      true,
      'InnoDB',
      'utf8_unicode_ci',
      array(
        array(
          'key'       => 'order',
          'reference' => array(
            'table'   => 'orders',
            'column'  => 'id'
          )
        ),
        array(
          'key'       => 'book',
          'reference' => array(
            'table'   => 'books',
            'column'  => 'id'
          )
        )
      )
    );
  }

  function down()
  {
    \DBUtil::drop_table('order_items');
    \DBUtil::drop_table('orders');
  }
}
