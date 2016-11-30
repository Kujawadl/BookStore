<?php

class Model_Author extends \Orm\Model
{
  public function TopCategories()
  {
    return DB::query('
      SELECT Name
      FROM (
        SELECT
          COUNT(tblcategories.Name) AS `count`,
          tblcategories.Name
        FROM
          tblcategories,
          tblbook_authors,
          tblbook_categories
        WHERE
          tblbook_authors.author = :AuthorID
        AND
          tblbook_authors.book = tblbook_categories.book
        AND
          tblbook_categories.category = tblcategories.id
        GROUP BY tblcategories.Name
        ORDER BY `count` DESC
        LIMIT 5
      ) AS category_counts'
    )
      ->param('AuthorID', intval($this->id))
      ->execute();
  }

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
    ),
    'Gender' => array(
      'data_type'  => 'char',
      'label'      => 'Gender',
      'validation' => array('required'),
      'form'       => array(
        'type'     => 'select',
        'options'  => array(
          'm' => 'Male',
          'f' => 'Female'
        )
      )
    ),
    'DOB' => array(
      'data_type'  => 'date',
      'label'      => 'Date of Birth',
      'validation' => array('required', 'valid_date'),
      'form'       => array(
        'type'       => 'text',
        'attributes' => array('class' => 'datepicker')
      )
    )
  );

  // Each author has exactly one contact information record.
  protected static $_belongs_to = array(
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
  protected static $_many_many = array(
    'Books' => array(
      'key_from'         => 'id',
      'key_through_from' => 'Author',
      'table_through'    => 'book_authors',
      'key_through_to'   => 'Book',
      'model_to'         => 'Model_Book',
      'key_to'           => 'id',
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

	protected static $_table_name = 'authors';
}
