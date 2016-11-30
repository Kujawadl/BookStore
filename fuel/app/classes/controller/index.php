<?php
class Controller_Index extends Controller_Template
{
	public function action_index()
	{
    $this->template->title = "Book Store";
		$this->template->content = View::forge('index/index');
	}

  public function action_license()
  {
    $this->template->title = "Book Store License";
    $this->template->content = View::forge('index/license');
  }
}
