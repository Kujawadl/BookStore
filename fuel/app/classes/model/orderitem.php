<?php

class Model_OrderItem extends \Orm\Model
{
  protected static $_properties = array(
    'Order'    => array('data_type' => 'int'),
    'Book'     => array('data_type' => 'int'),
    'Quantity' => array('data_type' => 'float')
  );

  protected static $_primary_key = array('Order', 'Book');

  // Each order item has exactly one order.
  // Each order item represents a quantity of a single book record.
  protected static $_belongs_to = array(
    'Order' => array(
      'key_from'       => 'order',
      'model_to'       => 'Model_Order',
      'key_to'         => 'id',
      'cascade_save'   => false,
      'cascade_delete' => false
    ),
    'Book' => array(
      'key_from'       => 'book',
      'model_to'       => 'Model_Book',
      'key_to'         => 'id',
      'cascade_save'   => false,
      'cascade_delete' => false
    )
  );

  protected static $_observers = array(
		'Orm\Observer_CreatedAt' => array(
			'events' => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events' => array('before_update'),
			'mysql_timestamp' => false,
		),
    'Orm\Observer_Validation' => array(
      'events' => array('before_save')
    )
	);

  protected static $_table_name = 'order_items';
}
