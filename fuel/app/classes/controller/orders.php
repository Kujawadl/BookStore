<?php

class Controller_Orders extends Controller_Template
{
  /**
   * Ensures user is logged in before trying to view their orders.
   */
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

  /**
   * Returns details about a specific order.
   *
   * @param integer OrderId The database id of the order to view.
   */
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
              ->where('date', 'IS NOT', NULL)
              ->where('customer', '=', $UserId);
    if ($Query->count() == 1) {
      // Get the current cart
      $data['Order'] = $Query->get_one();
      $this->template->title    = "Order #$OrderId";

      $data['Language'] = 'php';
      $data['Code'] = var_export($data['Order']);
      $this->template->content  = View::forge('debug/codesnippet', $data);
      //$this->template->subtitle = $Query->Date;
      //$this->template->content  = View::forge('lists/items', $data);
    } else {
      Session::set_flash('error', 'Order #' . $OrderId . ' not found...');
      $this->template->content = '';
    }
  }

  /**
   * Returns a list of the user's order history, sorted by date, newest first.
   *
   * @param integer PageNum the page number to view.
   */
  public function action_list($PageNum = 1)
  {
    $Orders = Model_Order::query()
               ->where('customer', '=', Auth::get_user_id()[1])
               ->get();

    // @TODO Render the view.
  }
}
