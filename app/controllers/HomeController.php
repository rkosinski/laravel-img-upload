<?php

class HomeController extends BaseController {

	public function index()
	{
		return View::make('main/index')
                    ->with('title', 'Strona główna')
                    ->with('images', Images::orderBy('created_at', 'desc')
                                            ->where('private', 0)
                                            ->limit(6)
                                            ->get());
	}
}