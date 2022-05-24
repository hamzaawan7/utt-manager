<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
