<?php

class Controller_Browse extends Controller_Template
{
  public function action_index()
  {
    return action_books();
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
    $this->template->content = View::forge('booklist', $data);
  }

  public function action_authors($PageNum = 1)
  {
    // @TODO Render the view.
  }

  public function action_categories($PageNum = 1)
  {
    // @TODO Render the view.
  }

  public function action_author($AuthorName = NULL)
  {
    if ($AuthorName == NULL)
    {
      Response::Redirect('/Browse/Authors');
    }

    // @TODO Render the view.
  }

  public function action_category($CategoryName = NULL)
  {
    if ($AuthorName == NULL)
    {
      Response::Redirect('/Browse/Categories');
    }

    // @TODO Render the view.
  }
}
