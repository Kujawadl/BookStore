<?php

class Model_Customer extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Contact',
    'FName' => array(
      'data_type'  => 'varchar',
      'label'      => 'First Name',
      'validation' => array('required'),
      'form'       => array('type' => 'text')
    ),
    'LName' => array(
      'data_type'  => 'varchar',
      'label'      => 'Last Name',
      'validation' => array('required'),
      'form'       => array('type' => 'text')
    )
  );

  // Each author has exactly one contact information record.
  protected static $_has_one = array(
    'Contact' => array(
      'key_from'       => 'Contact',
      'model_to'       => 'Model_Contact',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => true
    )
  );

  // Each author may have many books.
  // Each book may have many authors.
  protected static $_has_many = array(
    'Author' => array(
      'key_from'         => 'id',
      'model_to'         => 'Model_Order',
      'key_to'           => 'customer',
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

	protected static $_table_name = 'customers';
}
