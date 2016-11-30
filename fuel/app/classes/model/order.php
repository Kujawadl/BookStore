<?php

class Model_Order extends \Orm\Model
{
  public function Value()
  {
    $Value = 0.0;
    $Items = Model_OrderItem::query()
              ->related('Book')
              ->where('order', '=', $this->id)
              ->get();

    foreach ($Items as $Item) {
      $Value += ($Item->Book->Price * $Item->Quantity);
    }

    return $Value;
  }

  protected static $_properties = array(
    'id',
    'Customer' => array(
      'data_type'  => 'int',
      'validation' => 'required'
    ),
    'Ship_To' => array(
      'data_type'  => 'int'
    ),
    'Date' => array(
      'data_type'  => 'date',
      'label'      => 'Order Date',
      'form'       => array(
        'type'       => 'text',
        'attributes' => array('class' => 'datepicker')
      )
    )
  );

  // Each order is for exactly one customer.
  // Each order ships to exactly one address.
  protected static $_belongs_to = array(
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
      'model_to'         => 'Model_OrderItem',
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
		)
	);

  protected static $_table_name = 'orders';
}
