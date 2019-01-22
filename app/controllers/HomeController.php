<?php

class HomeController extends Controller {

    public function index($name = '') {
        $this->render('home/index');
    }

}