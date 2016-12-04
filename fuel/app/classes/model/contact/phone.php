<?php

class Model_Contact_Phone extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Phone',
    'Type' => array(
      'data_type'  => 'varchar',
      'label'      => 'Type',
      'validation' => array('required'),
      'form'       => array(
        'type' => 'select',
        'options' => array(
          'Home',
          'Work',
          'Cell',
          'Other'
        )
      )
    )
  );

  // Each phone number belongs to one contact information record.
  protected static $_belongs_to = array(
    'Contact' => array(
      'key_from'       => 'contact',
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
    'Orm\Observer_Validation' => array(
      'events' => array('before_save')
    )
	);

  protected static $_table_name = 'contact_phone';
}
