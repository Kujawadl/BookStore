<?php

class Controller_Account extends Controller_Template
{
  public function action_index()
  {
    return self::get_signin();
  }

  public function get_signin()
  {
    $this->template->title = 'Sign In';
    // @TODO Create signin view.
  }

  public function post_signin()
  {
    if (Auth::login())
    {
      Session::set_flash('success', 'Logged in successfully!');
      Response::redirect(Input::referrer());
    } else {
      Session::set_flash('error', 'Incorrect username or password');
    }
  }

  public function post_signout()
  {
    if (Auth::check())
    {
      Auth::logout();
      Session::set_flash('success', 'Logged out successfully!');
      Response::redirect('/');
    } else {
      Session::set_flash('error', 'Not logged in!');
      Response::redirect(Input::referrer());
    }
  }

  public function get_signup()
  {
    $this->template->title = 'Sign Up';
    // @TODO Create signup view.
  }

  public function post_signup()
  {
    try {
      $Contact = Model_Contact::forge();
      $Contact->save();

      $ContactEmail = Model_Contact_Email::forge();
      $ContactEmail->id = $Contact->id;
      $ContactEmail->Email = Input::post('email');
      $ContactEmail->save();

      $Customer = Model_Customer::forge();
      $Customer->FName = Input::post('firstname');
      $Customer->LName = Input::post('lastname');
      $Customer->Contact = $Contact;
      $Customer->save();

      $UserId = Auth::create_user(
        Input::post('username'),
        Input::post('password'),
        Input::post('email'),
        1,
        array(
          'CustomerId' => $Customer->id
        )
      );

      if ($UserId === false) {
        Session::set_flash('error', 'An error occurred while trying to sign up.');
      } else {
        Session::set_flash('success', 'Registered successfully!');

        Response::redirect('/');
      }
    } catch (SimpleUserUpdateException $ex) {
      Session::set_flash('error', $ex->getMessage());
    }

  }

  public function post_update()
  {
    // @TODO Implement customer info update.
  }
}
