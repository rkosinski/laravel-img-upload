<?php

class HomeController extends BaseController {

    /**
     * Show view of homepage with public images (latest 6 images).
     *
     * @return object View
     */
    public function index()
    {
        return View::make('main/index')
            ->with('title', 'Homepage')
            ->with('images', Images::orderBy('created_at', 'desc')
                                    ->where('private', 0)
                                    ->limit(6)
                                    ->get());
    }

}