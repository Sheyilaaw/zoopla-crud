<?php

class HomeController extends Controller {

    public function index() {
        $propertyListings = Property::all();
        $this->render('home/index', [
            'listings' => $propertyListings
        ]);
    }

}