<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\DetailsBanner;
use App\Models\HomeBanner;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
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
    public function index()
    {
        $categories = Category::with('product')->get();
        $home_banner = HomeBanner::get();
        return view('welcome',compact('categories','home_banner'));
    }

    public function view_details($id){
        $product = Product::find($id);
        $details_banner = DetailsBanner::all()->toArray();
        $chunk_data = array_chunk($details_banner , 1);
        $v0 = $chunk_data[0];
        $v1 = $chunk_data[1];
        $v2 = $chunk_data[2];
        $v3 = $chunk_data[3];
//        dump($v[0]['id']);
//        dd($chunk_data);
        return view('view_details',compact('product','v0','v1','v2','v3'));
    }

    public function getCategoryByProduct(){
        $categories = Category::with('limit_product')->get();
        return view('home.category_display',compact('categories'));
    }
}
