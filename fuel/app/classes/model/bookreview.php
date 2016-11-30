<?php

class Model_BookReview extends \Orm\Model
{
  protected static $_properties = array(
    'Customer',
    'Book',
    'Rating' => array(
      'data_type'  => 'int',
      'label'      => 'Rating',
      'validation' => array('required', 'numeric_min' => 1, 'numeric_max' => 5),
      'form'       => array(
        'type'       => 'number',
        'attributes' => array('min' => '1', 'max' => '5', 'step' => '1')
      )
    ),
    'Review' => array(
      'data_type'  => 'varchar',
      'label'      => 'Review',
      'validation' => array(),
      'form'       => array('type' => 'text')
    )
  );

  protected static $_primary_key = array('Customer', 'Book');

  // Each review is written by one user.
  // Each review is written for one book.
  protected static $_belongs_to = array(
    'Customer' => array(
      'key_from'       => 'customer',
      'model_to'       => 'Model_Customer',
      'key_to'         => 'id',
      'cascade_save'   => false,
      'cascade_delete' => false
    ),
    'Book' => array(
      'key_from'       => 'Book',
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

	protected static $_table_name = 'book_reviews';
}
