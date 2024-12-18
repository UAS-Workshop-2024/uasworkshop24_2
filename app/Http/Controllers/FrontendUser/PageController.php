<?php

namespace App\Http\Controllers\FrontendUser;

use App\Http\Controllers\Controller;
use App\Models\Products;
use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PageController extends Controller
{
    public function index()
    {
        $products = Products::active()->get();
        $slides = Slides::active()->orderBy('position', 'ASC')->get();;

        return view('frontend.homepage', compact('products', 'slides'));
    }
}
