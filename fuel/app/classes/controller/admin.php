<?php

class Controller_Admin extends Controller_Template
{
  public function before()
  {
    parent::before();

    if ( ! (Auth::check() && Auth::member(100)))
    {
      throw new HttpNoAccessException;
    }
  }

  public function action_index()
  {
    return self::action_books();
  }

  public function action_books($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {

    // If ID is 'new' or 'add' then create a new author
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific author
    } else {
      switch ($action)
      {
        case 'view':
        {

        }

        case 'edit':
        {

        }

        case 'delete':
        {

        }
      }
    }
  }

  public function action_authors($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {

    // If ID is 'new' or 'add' then create a new author
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific author
    } else {
      switch ($action)
      {
        case 'view':
        {

        }

        case 'edit':
        {

        }

        case 'delete':
        {

        }
      }
    }
  }

  public function action_suppliers($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {

    // If ID is 'new' or 'add' then create a new supplier
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific supplier
    } else {
      switch ($action)
      {
        case 'view':
        {

        }

        case 'edit':
        {

        }

        case 'delete':
        {

        }
      }
    }
  }

  public function action_customers($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {

    // If ID is 'new' or 'add' then create a new customer
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific customer
    } else {
      switch ($action)
      {
        case 'view':
        {

        }

        case 'edit':
        {

        }

        case 'delete':
        {

        }
      }
    }
  }

  public function action_orders($id = NULL)
  {
    // If ID is null, use listview
    if ($id == NULL)
    {

    // Else get a specific order
    } else {

    }
  }
}
