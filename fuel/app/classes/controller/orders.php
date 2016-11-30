<?php

class Controller_Orders extends Controller
{
  /**
   * Ensures user is logged in before trying to view their orders.
   */
  public function before()
  {
    if (!Auth::check())
    {
      Response::redirect('/Account/SignIn');
    }
  }

  public function action_index()
  {
    return action_list();
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
    }

    // @TODO Render the view.
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
