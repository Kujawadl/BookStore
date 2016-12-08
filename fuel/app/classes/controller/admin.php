<?php

class Controller_Admin extends Controller_Hybrid
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

  public function get_books($id = NULL)
  {
    // If ID is null, use listview
    if ($id == NULL)
    {
      Response::redirect('/browse/books');
    // If ID is 'new' or 'add' then create a new author
    } elseif ($id == 'new' || $id == 'add') {
      $this->template->title = "Add a new book";
      $this->template->content = View::forge('forms/book');
    // Else get a specific author
    } else {

    }
  }

  public function post_books($id = NULL, $action = 'update')
  {
    try {
      $Query = Model_Book::query()->where('id', '=', $id);

      if ($Query->count() != 0)
      {
        $Book = $Query->get_one();
        if ($action == 'update')
        {
          $Book->Title = Input::post('Title');
          $Book->ISBN = Input::post('ISBN');
          $Book->Price = Input::post('Price');
          $Book->PubDate = Input::post('PubDate');
          $Book->Supplier = Input::post('Supplier');

          unset($Book->Authors);
          unset($Book->Categories);

          $Categories = (is_array( Input::post('Authors')) ? Input::post('Authors') : array(Input::post('Authors')));
          foreach ($Authors as $Author)
          {
            $Book->Authors[$Author] = Model_Author::find($Author);
          }

          $Categories = (is_array( Input::post('Categories')) ? Input::post('Categories') : array(Input::post('Categories')));
          foreach ($Categories as $Category)
          {
            $Book->Categories[$Category] = Model_Category::find($Category);
          }

          return $this->response(array('url' => Uri::create('/browse/book/' . $Book->id)));
        } elseif ($action == 'delete') {
          $Book->delete();
          return $this->response(array('url' => Uri::create('/browse/books')));
        } else {
          throw new HttpNotFoundException;
        }
      } else {
        // Create
        $Book = Model_Book::forge();
        $Book->save();

        $Book->Title = Input::post('Title');
        $Book->ISBN = Input::post('ISBN');
        $Book->Price = Input::post('Price');
        $Book->PubDate = Input::post('PubDate');
        $Book->Supplier = Input::post('Supplier');


        $Authors = (is_array( Input::post('Authors')) ? Input::post('Authors') : array(Input::post('Authors')));
        foreach ($Authors as $Author)
        {
          $Book->Authors[$Author] = Model_Author::find($Author);
        }

        $Categories = (is_array( Input::post('Categories')) ? Input::post('Categories') : array(Input::post('Categories')));
        foreach ($Categories as $Category)
        {
          $Book->Categories[$Category] = Model_Category::find($Category);
        }

        $Book->save();

        return $this->response(array('url' => Uri::create('/browse/book/' . $id)));
      }
    } catch(Exception $ex) {
      return $this->response(array(
        'message' => $ex->getMessage(),
        'stacktrace' => $ex->getTrace()
      ), 500);
    }
  }

  public function action_authors($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {
      Response::redirect('/browse/authors');
    // If ID is 'new' or 'add' then create a new author
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific author
    } else {
      switch ($action)
      {
        case 'view':
        {
          break;
        }

        case 'edit':
        {
          break;
        }

        case 'delete':
        {
          break;
        }

        default:
        {
          throw new HttpNotFoundException;
        }
      }
    }
  }

  public function get_suppliers($id = NULL)
  {
    // If ID is null, use listview
    if ($id == NULL)
    {
      $data['Rows'] = array();
      foreach (Model_Supplier::find('all', array('order_by' => 'Name')) as $Supplier)
      {
        array_push(
          $data['Rows'],
          View::forge('lists/rows/suppliers', array('Supplier' => $Supplier))
        );
      }
      $this->template->title = 'Browse suppliers';
      $this->template->content = View::forge('lists/list', $data);
    // If ID is 'new' or 'add' then create a new supplier
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific supplier
    } else {
      $Query = Model_Supplier::query()->where('id', '=', $id);

      if ($Query->count() == 0) { throw new HttpNotFoundException; }
      $Supplier = $Query->get_one();

      $data['Rows'] = array();
      foreach ($Supplier->Reps as $Representative)
      {
        array_push(
          $data['Rows'],
          View::forge('lists/rows/supplier_reps', array('Representative' => $Representative))
        );
      }
      $this->template->title = View::forge('editable', array(
        'Url'   => Uri::create('/admin/suppliers/' . $id),
        'Value' => $Supplier->Name,
        'Name'  => 'Name'
      ));
      $this->template->subtitle = View::forge('deletebutton', array(
        'action' => Uri::create('/admin/suppliers/' . $id . '/delete'),
        'confirmation' => 'This will remove not only the supplier, but all of their books and representatives. This action cannot be undone.',
        'redirect' => Uri::create('/admin/suppliers')
      ));
      $this->template->content = View::forge('lists/list', $data);
    }
  }

  public function post_suppliers($id = NULL, $action = 'edit')
  {
    $Query = Model_Supplier::query()->where('id', '=', $id);

    if ($Query->count() == 0) { throw new HttpNotFoundException; }
    $Supplier = $Query->get_one();

    if ($action == 'edit')
    {
      $Supplier->Name = Input::post('Name');
      $Supplier->save();
      return $this->response($Supplier->Name);
    } elseif ($action == 'delete') {
      try
      {
        $Supplier->delete();
      } catch(Exception $ex) {}
      return $this->response(true);
    }
  }

  public function action_customers($id = NULL, $action = 'view')
  {
    // If ID is null, use listview
    if ($id == NULL)
    {
      $data['Rows'] = array();
      foreach (Model_Customer::find('all', array('order_by' => array('FName', 'LName'))) as $Customer)
      {
        array_push(
          $data['Rows'],
          View::forge('lists/rows/customers', array('Customer' => $Customer))
        );
      }
      $this->template->title = 'Browse customers';
      $this->template->content = View::forge('lists/list', $data);
    // If ID is 'new' or 'add' then create a new supplier
    } elseif ($id == 'new' || $id == 'add') {

    // Else get a specific supplier
    } else {
      $Query = Model_Customer::query()->where('id', '=', $id);

      if ($Query->count() == 0) { throw new HttpNotFoundException; }
      $Supplier = $Query->get_one();

    }
  }

  public function action_orders()
  {
    $data['Rows'] = array();
    foreach (Model_Order::find('all', array(
      'where' => array(
        array('Date', 'Is Not', NULL),
        array('Ship_To', 'Is Not', NULL)
      ),
      'order_by' => array('Date' => 'Desc')
    )) as $Order)
    {
      array_push(
        $data['Rows'],
        View::forge('lists/rows/orders', array('Order' => $Order))
      );
    }
    $this->template->title = 'Browse orders';
    $this->template->content = View::forge('lists/list', $data);
  }
}
