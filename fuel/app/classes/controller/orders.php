<?php

class Controller_Orders extends Controller_Template
{
  public function before()
  {
    parent::before();
    if (!Auth::check())
    {
      Response::redirect('/Account/SignIn');
    }
  }

  public function action_index()
  {
    return self::action_list();
  }

  public function action_view($OrderId = NULL)
  {
    if ($OrderId == NULL)
    {
      Response::redirect('/Orders/List');
    } else {

    }
    $UserId = Auth::get_user_id()[1];

    $Query = Model_Order::query()
              ->where('id', '=', $OrderId)
              ->where('date', 'IS NOT', NULL);
    if (! Auth::member(100))
    {
      $Query = $Query->where('customer', '=', $UserId);
    }
    
    if ($Query->count() == 1) {
      // Get the current cart
      $Order = $Query->get_one();
      $data['Order'] = $Order;

      $this->template->title    = "Order #$OrderId";
      $this->template->subtitle = $Order->Date;
      $this->template->content  = View::forge('lists/items', $data);
    } else {
      Session::set_flash('error', 'Order #' . $OrderId . ' not found...');
      $this->template->content = '';
    }
  }

  public function action_list()
  {
    $UserId = Auth::get_user_id()[1];

    $Orders = Model_Order::query()
                ->where('date', 'IS NOT', NULL)
                ->where('customer', '=', $UserId)
                ->order_by('date', 'desc')
                ->get();

    $Rows = array();
    foreach ($Orders as $Order)
    {
      $rowdata['Order'] = $Order;
      array_push($Rows, View::forge('lists/rows/orders', $rowdata));
    }
    $data['Rows'] = $Rows;

    $this->template->title   = "Order History";
    $this->template->content = View::forge('lists/list', $data);
  }
}
