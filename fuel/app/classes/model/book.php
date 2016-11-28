<?php

class Model_Book extends \Orm\Model
{
  protected static $_properties = array(
    'id',
    'Author',
    'Categories',
    'ISBN' => array(
      'data_type'  => 'int',
      'label'      => 'ISBN',
      'validation' => array('required'),
      'form'       => array('type' => 'text')
    ),
    'Title' => array(
      'data_type'  => 'varchar',
      'label'      => 'Title',
      'validation' => array('required'),
      'form'       => array('type' => 'text')
    ),
    'Pubdate' => array(
      'data_type'  => 'date',
      'label'      => 'Publication Date',
      'validation' => array('required', 'valid_date'),
      'form'       => array(
        'type'       => 'text',
        'attributes' => array('class' => 'datepicker')
      )
    ),
    'Price' => array(
      'data_type'  => 'double',
      'label'      => 'Price',
      'validation' => array('required', 'numeric_min' => 0.01),
      'form'       => array(
        'type'       => 'number',
        'attributes' => array('min' => '0.01', 'step' => '0.01')
      )
    )
  );

  protected static $_has_one = array(
    'Author' => array(
      'key_from'       => 'Author',
      'model_to'       => 'Model_Author',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => false
    )
  );

  protected static $_has_many = array(
    'Categories' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Book_Category',
      'key_to'         => 'book',
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

  protected static $_table_name = 'books'
}

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

  protected static $_has_many = array(
    'Book_Categories' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_Book_Category',
      'key_to'         => 'category',
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

  protected static $_table_name = 'categories'
}

class Model_Book_Category extends \Orm\Model_Contact
{
  protected static $_properties = array(
    'Book',
    'Category'
  );

  protected static $_has_one = array(
    'Book' => array(
      'key_from'       => 'Book',
      'model_to'       => 'Model_Book',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => false
    ),
    'Category' => array(
      'key_from'       => 'Category',
      'model_to'       => 'Model_Category',
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

  protected static $_table_name = 'book_categories'
}
