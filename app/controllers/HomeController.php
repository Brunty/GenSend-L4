<?php

/**
 * Class HomeController
 */
class HomeController extends BaseController {

    protected $layout = 'layouts.main';

    /**
     *
     */
    public function __construct() { }

    /**
     * @return \Illuminate\View\View
     */
    public function index() {
        return View::make('Home.index');
    }

    /**
     * @param null $id
     *
     * @return null
     */
    public function showId($id = null) {
        return $id;
    }
}