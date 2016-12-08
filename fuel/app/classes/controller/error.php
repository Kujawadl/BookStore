<?php

class Controller_Error extends Controller_Template
{
  public function action_404()
  {
    $this->template->content = View::forge('error/404');
  }

  public function action_403()
  {
    $this->template->content = View::forge('error/403');
  }
}
