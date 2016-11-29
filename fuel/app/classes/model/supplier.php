<?php

class Model_Supplier extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Name',
    'Reps',
    'Books'
  );

  // Each supplier may have many representatives.
  // Each supplier may have many books.
  protected static $_has_many = array(
    'Reps' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Supplier_Rep',
      'key_to'         => 'supplier',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Books' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Book',
      'key_to'         => 'supplier',
      'cascade_save'   => true,
      'cascade_delete' => true
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

  protected static $_table_name = 'suppliers';
}

class Model_Supplier_Rep extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Supplier',
    'Contact',
    'FName',
    'LName'
  );

  // Each representative has exactly one contact information record.
  protected static $_has_one = array(
    'Supplier' => array(
      'key_from'       => 'Supplier',
      'model_to'       => 'Model_Supplier',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => false
    ),
    'Contact' => array(
      'key_from'       => 'Contact',
      'model_to'       => 'Model_Contact',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => true
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

  protected static $_table_name = 'supplier_reps';
}
