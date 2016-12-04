<?php

class Controller_Error extends Controller_Template
{
  public function action_404()
  {
    $this->template->content = View::forge('error/404');
  }
}
