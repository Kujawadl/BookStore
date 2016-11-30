<?php

class Controller_Cart extends Controller_Template
{
  public $Cart;

  /**
   * Gets the current user's cart, or creates one if none exists.
   * A cart is just an order without an order date (one that has not
   * been placed yet).
   *
   * This function runs before any of the below actions to ensure they have
   * a cart object to work with.
   */
  public function before()
  {
    parent::before();

    if (!Auth::check())
    {
      Response::Redirect('/Account/SignIn');
    } else {
      $UserId = Auth::get_user_id()[1];

      $Query = Model_Order::query()
                ->where('customer', '=', $UserId)
                ->where('date', '=', NULL)
                ->get();
      if (count($Query) == 0)
      {
        // Create a new cart
        $this->Cart = Model_Order::forge();
        $this->Cart->Customer = $UserId;
        $this->Cart->Save();
      } elseif (count($Query) == 1) {
        // Get the current cart
        $this->Cart = $Query;
      } else {
        Session::set_flash('error', 'Your cart could not be found...');
        // @TODO Delete all possible carts and notify user there was an error.
      }
    }
  }

  /**
   * Default action.
   *
   * @return action_view()
   */
  public function action_index()
  {
    return self::action_view();
  }

  /**
   * View items in the cart.
   */
  public function action_view()
  {
    $data['Cart'] = $this->Cart;
    $this->template->title   = "View Cart";
    $this->template->content = View::forge('lists/items', $data);
  }

  /**
   * Add an item to the cart.
   *
   * @param integer ItemId   The database ID of the book to Add
   * @param integer Quantity The number of items to add
   *
   * @example /Cart/Add/2893/3 adds 3 copies of book 2893 to the cart;
   *          if there were already 2 copies in the cart, the new quantity is 5.
   *
   * @return Redirects back to the previous view.
   */
  public function action_add($ItemId, $Quantity = 1)
  {
    isset($this->Cart) or Response::redirect('/cart/view');

    $Book = Model_Book::find($ItemId);

    if ($Book == NULL)
    {
      // @TODO: Item not found, throw error
    } else {
      $Item = Model_OrderItem::query()
               ->where('book', '=', $Book->id)
               ->where('order', '=', $this->Cart->id)
               ->get_one();
      if ($Item == NULL)
      {
        $Item = Model_OrderItem::forge();
        $Item->Order    = $this->Cart;
        $Item->Book     = $Book;
        $Item->Quantity = 0;
      }
      $Item->Quantity += $Quantity;
      $Item->save();
    }

    // @TODO Redirect to previous page.
  }

  /**
   * Update the quantity of an item in the cart.
   *
   * @param integer ItemId   The database ID of the book to update
   * @param integer Quantity The new quantity of books
   *
   * @example /Cart/Add/2893/3 sets the number of copies of book 2893 to 3;
   *          if there were already 2 copies in the cart, the new quantity is 3.
   *
   * @return Redirects back to the cart view.
   */
  public function action_update($ItemId, $Quantity = 1)
  {
    isset($this->Cart) or Response::redirect('/cart/view');

    $Book = Model_Book::find($ItemId);

    if ($Book == NULL)
    {
      // @TODO: Item not found, throw error
    } else {
      $Item = Model_OrderItem::query()
               ->where('book', '=', $Book->id)
               ->where('order', '=', $this->Cart->id)
               ->get_one();
      if ($Item == NULL)
      {
        $Item = Model_OrderItem::forge();
        $Item->Order = $this->Cart;
        $Item->Book  = $Book;
      }
      $Item->Quantity = $Quantity;
      $Item->save();
    }

    // @TODO Redirect to previous page.
  }

  /**
   * Remove some quantity of an item from the cart.
   *
   * @param integer ItemId   The database ID of the book to update
   * @param integer Quantity The quantity to remove (if null, remove all)
   *
   * @example /Cart/Remove/2893/3 removes 3 copies of book 2893 from the cart;
   *          if there are less than 3 copies in the cart, all are removed.
   * @example /Cart/Remove/2893 removes all copies of book 2893 from the cart;
   *          if there are no copies to remove, nothing happens
   *
   * @return Redirects back to the cart view.
   */
  public function action_remove($ItemId, $Quantity = NULL)
  {
    isset($this->Cart) or Response::redirect('/cart/view');

    $Book = Model_Book::find($ItemId);

    if ($Book == NULL)
    {
      // @TODO: Item not found, throw error
    } else {
      $Item = Model_OrderItem::query()
               ->where('book', '=', $Book->id)
               ->where('order', '=', $this->Cart->id)
               ->get_one();
      if ($Item != NULL)
      {
        if ($Quantity != NULL && $Item->Quantity > $Quantity)
        {
          $Item->Quantity -= $Quantity;
          $Item->save();
        } else {
          $Item->delete();
        }
      }
    }

    // @TODO Redirect to previous page.
  }

  /**
   * Places the order.
   *
   * This action sets the order date to the current day, effectively rendering
   * it as a completed transaction.
   *
   * @return Redirects to the order view.
   */
  public function action_place()
  {
    isset($this->Cart) or Response::redirect('/cart/view');

    // @TODO: Ask customer for shipping address

    // Using a SQL query, we can use the MySQL NOW() function, which ensures
    // that the we use the datetime in the MySQL server's timezone
    Model_Order::query('UPDATE TBLORDERS SET `DATE` = NOW() WHERE ID = ' + $this->id);
  }
}
