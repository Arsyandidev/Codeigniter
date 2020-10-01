<?php 

namespace App\Controllers;

class User extends BaseController
{
	public function index()
	{
		$data = [
			'title' => 'Voting Page | Micro IT'
		];

		return view('pages/user/home', $data);
	}

	//--------------------------------------------------------------------

}
