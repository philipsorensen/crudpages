<?php

namespace PhilipSorensen\CrudPages\Controllers;

use App\Http\Controllers\Controller;
use PhilipSorensen\CrudPages\Models\CrudPage;

class CrudPageController extends Controller
{
	public function show(string $slug)
	{
		$page = auth()->user() ? CrudPage::where('slug', $slug)->firstOrFail() : CrudPage::where('slug', $slug)->active()->firstOrFail();
		return view('crudpages::show')->with('page', $page);
	}

	public function show2(string $slug1, string $slug2)
	{
		return $this->show($slug1 . '/' . $slug2);
	}

	public function show3(string $slug1, string $slug2, string $slug3)
	{
		return $this->show($slug1 . '/' . $slug2 . '/' . $slug3);
	}
}