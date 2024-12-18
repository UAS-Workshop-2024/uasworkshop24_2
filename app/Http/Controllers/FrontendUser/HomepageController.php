<?php

namespace App\Http\Controllers\FrontendUser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slides;
use App\Models\Products;

class HomepageController extends Controller
{
    public function index()
    {
        $products = Products::active()->get();
        $slides = Slides::active()->orderBy('position', 'ASC')->get();;

        return view('user.frontend.homepage', compact('products', 'slides'));
    }
}
