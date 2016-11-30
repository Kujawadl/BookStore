<?php

class Model_Book extends \Orm\Model
{
  public function AvgRating()
  {
    $Sum = 0;
    $Num = $this->NumRatings();

    foreach($this->Reviews as $Review)
    {
      $Sum += $Review->Rating;
    }

    if ($Num > 0)
    {
      return $Sum / $Num;
    } else {
      return 0;
    }
  }

  public function NumRatings()
  {
    $Num = 0;
    foreach($this->Reviews as $Review)
    {
      $Num++;
    }
    return $Num;
  }

  protected static $_properties = array(
    'id',
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
    'PubDate' => array(
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

  // Each book has exactly one supplier.
  protected static $_has_one = array(
    'Supplier' => array(
      'key_from'       => 'Supplier',
      'model_to'       => 'Model_Supplier',
      'key_to'         => 'id',
      'cascade_save'   => true,
      'cascade_delete' => false
    )
  );

  // Each book may have many reviews.
  // Each book may be ordered many times.
  protected static $_has_many = array(
    'Reviews' => array(
      'key_from'       => 'id',
      'model_to'       => 'Model_BookReview',
      'key_to'         => 'book',
      'cascade_save'   => true,
      'cascade_delete' => true
    ),
    'Orders' => array(
      'key_from'         => 'id',
      'model_to'         => 'Model_OrderItem',
      'key_to'           => 'book',
      'cascade_save'     => false,
      'cascade_delete'   => false
    )
  );

  // Each book may have many authors.
  // Each author may have many books.
  //
  // Each book may have many categories.
  // Each category may have many books.
  protected static $_many_many = array(
    'Authors' => array(
      'key_from'         => 'id',
      'key_through_from' => 'Book',
      'table_through'    => 'book_authors',
      'key_through_to'   => 'Author',
      'model_to'         => 'Model_Author',
      'key_to'           => 'id',
      'cascade_save'     => false,
      'cascade_delete'   => false
    ),
    'Categories' => array(
      'key_from'         => 'id',
      'key_through_from' => 'Book',
      'table_through'    => 'book_categories',
      'key_through_to'   => 'Category',
      'model_to'         => 'Model_Category',
      'key_to'           => 'id',
      'cascade_save'     => false,
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

  protected static $_table_name = 'books';
}
