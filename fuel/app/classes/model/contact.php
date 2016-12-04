<?php

class Model_Contact extends \Orm\Model
{
  protected static $_properties = array(
    'id'
  );

  // Each contact information record may have many phone numbers.
  // Each contact information record may have many email address.
  // Each contact information record may have many addresses.
  protected static $_has_many = array(
    'Phones' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Phone',
      'key_to'         => 'contact',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Emails' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Email',
      'key_to'         => 'contact',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Addresses' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Address',
      'key_to'         => 'contact',
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

  protected static $_table_name = 'contact';
}
