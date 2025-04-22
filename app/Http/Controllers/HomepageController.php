<?php

namespace App\Http\Controllers;
use App\Models\Categories;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    public function index(){
        $categories = Categories::all(); 
        $title = "homepage";
        return view('web.homepage',['title' => $title], ['categories' => $categories]);
    }

    public function products(){
        $categories = Categories::all(); 
        $title = "products";
        return view('web.products',['title' => $title], ['categories' => $categories]);
    }

    public function product($slug){
        return view('web.product', ['slug' => $slug]);
    }
    
    public function categories(){
        return view('web.categories');
    }

    public function category($slug){
        return view('web.category_by_slug', ['slug' => $slug]);
    }

    public function cart(){
        return view('web.cart');
    }
    
    public function checkout(){
        return view('web.checkout');
    }
       
}