<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AvailabilityController extends Controller
{
    public function index()
    {
        return view('booking.availability_list');
    }
}
