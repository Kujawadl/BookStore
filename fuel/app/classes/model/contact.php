<?php

class Model_Contact extends \Orm\Model
{
  protected static $_properties = array(
    'id'
  );

  protected static $_has_many = array(
    'Phones' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Phone',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Emails' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Email',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Addresses' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact_Address',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => true
    );
  );

  protected static $_observers = array(
    'Orm\Observer_CreatedAt' => array(
			'events'          => array('before_insert'),
			'mysql_timestamp' => false,
		),
		'Orm\Observer_UpdatedAt' => array(
			'events'          => array('before_update'),
			'mysql_timestamp' => false,
		),
  );

  protected static $_table_name = 'contact';
}

class Model_Contact_Phone extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Phone'
  );

  protected static $_belongs_to = array(
    'Contact' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact',
      'key_to'         => 'id',
      'cascade_save'   => true,
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
  );

  protected static $_table_name = 'contact_phone';
}

class Model_Contact_Email extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Email'
  );

  protected static $_belongs_to = array(
    'Contact' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact',
      'key_to'         => 'id',
      'cascade_save'   => true,
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
  );

  protected static $_table_name = 'contact_email';
}

class Model_Contact_Address extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Street',
    'City',
    'State',
    'Zip'
  );

  protected static $_belongs_to = array(
    'Contact' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Contact',
      'key_to'         => 'id',
      'cascade_save'   => true,
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
  );

  protected static $_table_name = 'contact_address';
}
