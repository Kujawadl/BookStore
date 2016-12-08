<?php

class Model_Order extends \Orm\Model
{
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

  public function Value()
  {
    $Value = 0.0;
    $Items = Model_OrderItem::query()
              ->where('order', '=', $this->id)
              ->get();

    foreach ($Items as $Item)
    {
      $Book = Model_Book::find($Item->Book);
      $Value += ($Book->Price * $Item->Quantity);
    }

    return $Value;
  }

  public function Quantity()
  {
    $Qty = 0;
    $Items = Model_OrderItem::query()
              ->where('order', '=', $this->id)
              ->get();

    foreach ($Items as $Item)
    {
      $Qty += $Item->Quantity;
    }

    return $Qty;
  }

  public function Address()
  {
    $Address = Model_Contact_Address::find($this->Ship_To);

    $CustomerId = Auth::get_profile_fields('CustomerId');
    $Customer = Model_Customer::find($CustomerId);

    return
      $Customer->FName . ' ' . $Customer->LName . "<br />" .
      $Address->Street . "<br />" .
      $Address->City . ", " . $Address->State . " " . $Address->Zip;
  }
}
