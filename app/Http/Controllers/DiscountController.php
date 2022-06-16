<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * Class DiscountController
 * @package App\Http\Controllers
 */
class DiscountController extends Controller
{
    public function index()
    {
        return view('discount.discount_list');
    }
}
