<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		phpinfo();
		return view('welcome_message');
	}
}
