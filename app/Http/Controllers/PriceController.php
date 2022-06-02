<?php

namespace App\Http\Controllers;

/**
 * Class PriceController
 * @package App\Http\Controllers
 */
class PriceController extends Controller
{
    public function index()
    {
        return view('price.list');
    }
}
