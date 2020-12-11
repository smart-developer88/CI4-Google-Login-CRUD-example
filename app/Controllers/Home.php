<?php namespace App\Controllers;

class Home extends BaseController
{
	public function index()
	{
		// if (!$this->google->isLoggedIn()) {
		// 	echo 'Login, please!';
		// 	return;
		// }
		return view('welcome_message');
	}

	//--------------------------------------------------------------------

}
