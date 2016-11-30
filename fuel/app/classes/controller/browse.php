<?php

class Controller_Browse extends Controller_Template
{
  public function action_index()
  {
    return self::action_books();
  }

  public function action_search($SearchTerm = NULL)
  {
    // @TODO Render the view.
  }

  public function action_books($PageNum = 1)
  {
    $data['Books'] = Model_Book::find('all',
      array(
        'order_by' => array('title' => 'asc')
      )
    );

    $this->template->title   = 'Browse books';
    $this->template->content = View::forge('lists/books', $data);
  }

  public function action_authors($PageNum = 1)
  {
    $data['Authors'] = Model_Author::find('all',
      array(
        'order_by' => array(
          'lname' => 'asc',
          'fname' => 'asc'
        )
      )
    );

    $this->template->title   = 'Browse authors';
    $this->template->content = View::forge('lists/authors', $data);
  }

  public function action_categories($PageNum = 1)
  {
    $data['Categories'] = Model_Category::find('all',
      array(
        'order_by' => array('name' => 'asc')
      )
    );

    $this->template->title   = 'Browse categories';
    $this->template->content = View::forge('lists/categories', $data);
  }

  public function action_author($AuthorId = NULL)
  {
    if ($AuthorId == NULL)
    {
      Response::Redirect('/Browse/Authors');
    }

    $Author = Model_Author::find($AuthorId);

    $data['Books'] = $Author->Books;

    $this->template->title   = 'Browse books by ' . $Author->FName . ' ' . $Author->LName;
    $this->template->content = View::forge('lists/books', $data);
  }

  public function action_category($CategoryId = NULL)
  {
    if ($CategoryId == NULL)
    {
      Response::Redirect('/Browse/Categories');
    }

    $Category = Model_Category::find($CategoryId);

    $data['Books'] = $Category->Books;

    $this->template->title   = 'Browse ' . $Category->Name . ' books';
    $this->template->content = View::forge('lists/books', $data);
  }
}
