<?php

class Model_Order extends \Orm\Model
{
  public function Value()
  {
    $Value = 0.0;
    $Items = Model_Order_Item::query()
              ->related('book')
              ->where('order', '=', $this->id)
              ->get();

    foreach ($Items as $Item) {
      $Value += ($Item->Book->Price * $Item->Quantity);
    }

    return $Value;
  }

  protected static $_properties = array(
    'id',
    'Customer',
    'Ship_To',
    'Items',
    'Date' => array(
      'data_type'  => 'date',
      'label'      => 'Order Date',
      'validation' => array('required', 'valid_date'),
      'form'       => array(
        'type'       => 'text',
        'attributes' => array('class' => 'datepicker')
      )
    )
  );

  // Each order is for exactly one customer.
  // Each order ships to exactly one address.
  protected static $_has_one = array(
    'Customer' => array(
      'key_from'       => 'customer',
      'model_to'       => 'Model_Customer',
      'key_to'         => 'id',
      'cascade_save'   => false,
      'cascade_delete' => false
    ),
    'Ship_To' => array(
      'key_from'       => 'ship_to',
      'model_to'       => 'Model_Contact_Address',
      'key_to'         => 'id',
      'cascade_save'   => false,
      'cascade_delete' => false
    )
  );

  // Each order may have many items.
  protected static $_has_many = array(
    'Items' => array(
      'key_from'         => 'id',
      'model_to'         => 'Model_Order_Item',
      'key_to'           => 'Order',
      'cascade_save'     => true,
      'cascade_delete'   => true
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

  protected static $_table_name = 'orders';
}

class Model_Order_Item extends \Orm\Model
{
  protected static $_properties = array(
    'Order'    => array('data_type' => 'int'),
    'Book'     => array('data_type' => 'int'),
    'Quantity' => array('data_type' => 'float')
  );

  // Each order item has exactly one order.
  // Each order item represents a quantity of a single book record.
  protected static $_has_one = array(
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
}
