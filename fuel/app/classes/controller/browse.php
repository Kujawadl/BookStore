<?php

class Controller_Browse extends Controller_Template
{
  public function action_index()
  {
    return self::action_books();
  }

  /**
   * Searches for books.
   *
   * @param any SearchTerm May be title, author name, book id, category, etc.
   */
  public function action_search($SearchTerm = NULL)
  {
    if (!isset($SearchTerm) || $SearchTerm == '') {
      Response:redirect('/Browse/Books');
    }
    $Books = DB::query("
      SELECT DISTINCT
        tblbooks.*,
        MATCH (tblbooks.title)     AGAINST (:SearchTerm) AS title_relevance,
        MATCH (tblauthors.fname)   AGAINST (:SearchTerm) AS fname_relevance,
        MATCH (tblauthors.lname)   AGAINST (:SearchTerm) AS lname_relevance,
        MATCH (tblcategories.name) AGAINST (:SearchTerm) AS category_relevance
      FROM
        tblbooks,
        tblauthors,
        tblcategories,
        tblbook_authors,
        tblbook_categories
      WHERE
        tblbook_authors.book        = tblbooks.id AND
        tblbook_authors.author      = tblauthors.id AND
        tblbook_categories.book     = tblbooks.id AND
        tblbook_categories.category = tblcategories.id AND
        (
          MATCH (tblbooks.title)     AGAINST (:SearchTerm) OR
          MATCH (tblauthors.fname)   AGAINST (:SearchTerm) OR
          MATCH (tblauthors.lname)   AGAINST (:SearchTerm) OR
          MATCH (tblcategories.name) AGAINST (:SearchTerm)
        )
      ORDER BY
        title_relevance,
        lname_relevance,
        fname_relevance,
        category_relevance,
        title
    ")->param('SearchTerm', $SearchTerm)->as_object('Model_Book')->execute();

    $Rows = array();
    foreach ($Books as $Book)
    {
      $rowdata['Book'] = Model_Book::find($Book->id);
      array_push($Rows, View::forge('lists/rows/books', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title    = 'Search results';
    $this->template->subtitle = "'$SearchTerm'";
    $this->template->content  = View::forge('lists/list', $data);
  }

  /**
   * Lists all books.
   */
  public function action_books($PageNum = 1)
  {
    $Books = Model_Book::find('all',
      array(
        'order_by' => array('title' => 'asc')
      )
    );

    $Rows = array();
    foreach ($Books as $Book)
    {
      $rowdata['Book'] = $Book;
      array_push($Rows, View::forge('lists/rows/books', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title   = 'Browse books';
    $this->template->content = View::forge('lists/list', $data);
  }

  /**
   * Lists all authors.
   */
  public function action_authors($PageNum = 1)
  {
    $Authors = Model_Author::find('all',
      array(
        'order_by' => array(
          'lname' => 'asc',
          'fname' => 'asc'
        )
      )
    );

    $Rows = array();
    foreach ($Authors as $Author)
    {
      $rowdata['Author'] = $Author;
      array_push($Rows, View::forge('lists/rows/authors', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title   = 'Browse authors';
    $this->template->content = View::forge('lists/list', $data);
  }

  /**
   * Lists all categories.
   */
  public function action_categories($PageNum = 1)
  {
    $Categories = Model_Category::find('all',
      array(
        'order_by' => array('name' => 'asc')
      )
    );

    $Rows = array();
    foreach ($Categories as $Category)
    {
      $rowdata['Category'] = $Category;
      array_push($Rows, View::forge('lists/rows/categories', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title   = 'Browse categories';
    $this->template->content = View::forge('lists/list', $data);
  }

  /**
   * Lists all books by the given author.
   */
  public function action_author($AuthorId = NULL)
  {
    if ($AuthorId == NULL)
    {
      Response::Redirect('/Browse/Authors');
    }

    $Author = Model_Author::find($AuthorId);
    $Books = (isset($Author->Books) ? $Author->Books : array());

    $Rows = array();
    foreach ($Books as $Book)
    {
      $rowdata['Book'] = $Book;
      array_push($Rows, View::forge('lists/rows/books', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title   = 'Browse books by ' . $Author->FName . ' ' . $Author->LName;
    $this->template->content = View::forge('lists/list', $data);
  }

  /**
   * Lists all books in the given category.
   */
  public function action_category($CategoryId = NULL)
  {
    if ($CategoryId == NULL)
    {
      Response::Redirect('/Browse/Categories');
    }

    $Category = Model_Category::find($CategoryId);
    $Books = (isset($Category->Books) ? $Category->Books : array());

    $Rows = array();
    foreach ($Books as $Book)
    {
      $rowdata['Book'] = $Book;
      array_push($Rows, View::forge('lists/rows/books', $rowdata));
    }
    $data['Rows']    = $Rows;

    $this->template->title   = 'Browse ' . $Category->Name . ' books';
    $this->template->content = View::forge('lists/list', $data);
  }
}
