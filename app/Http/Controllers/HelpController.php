<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class HelpController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function tnc()
    {
        return view('tnc');
    }

    public function aboutus()
    {
        return view('aboutus');
    }

    public function policy()
    {
        return view('policy');
    }
}
