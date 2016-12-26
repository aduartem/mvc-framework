<?php
namespace App\Controller;

class WelcomeController extends AppController
{
	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$this->layout(['VIEW' => 'welcome/index']);
	}

}
