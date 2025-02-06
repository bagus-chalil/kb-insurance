<?php

namespace App\Controllers;

class CoverageController extends BaseController
{
	public function index()
	{
		return view('apps/coverage/create');
	}
}
