<?php

class Model_Category extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Name' => array(
      'data_type'  => 'varchar',
      'label'      => 'Category',
      'validation' => array('required'),
      'form'       => array('type' => 'text')
    )
  );

  // Each book may have many categories.
  // Each category may have many books.
  protected static $_many_many = array(
    'Books' => array(
      'key_from'         => 'id',
      'key_through_from' => 'Category',
      'table_through'    => 'book_categories',
      'key_through_to'   => 'Book',
      'model_to'         => 'Model_Book',
      'key_to'           => 'id',
      'cascade_save'     => true,
      'cascade_delete'   => false
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

  protected static $_table_name = 'categories';
}
