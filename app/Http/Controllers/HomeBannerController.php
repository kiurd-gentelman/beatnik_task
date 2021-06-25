<?php

namespace App\Http\Controllers;

use App\Models\HomeBanner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeBannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $homeBanners = HomeBanner::paginate(5);

        return view('home_banner.index', compact('homeBanners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('home_banner.create', compact('products'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner_content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required',
        ]);

        $home_banner = new HomeBanner();
        $home_banner->content = $request->banner_content;
        if ($request->hasFile('image')) {
            $home_banner->image = $request->file('image')->store('public/home_banner_image');
        }
        $home_banner->product_id = $request->product_id;
        $home_banner->save();

        return redirect()->to(route('home-banner.index'))->with('message', 'create operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $home_banner = HomeBanner::find($id);

        return view('home_banner.show', compact('home_banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::get();
        $home_banner = HomeBanner::find($id);
        return view('home_banner.edit',compact('home_banner','products'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'banner_content' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'product_id' => 'required',
        ]);

        $home_banner = HomeBanner::find($id);
        $home_banner->content = $request->banner_content;
        if ($request->hasFile('image')) {
            $this->unlink_file($home_banner->image);
            $home_banner->image = $request->file('image')->store('public/home_banner_image');
        }
        $home_banner->product_id = $request->product_id;
        $home_banner->save();

        return redirect()->to(route('home-banner.index'))->with('message', 'update operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ( $home_banner = HomeBanner::find($request->id)) {
            $this->unlink_file($home_banner->image);
            $home_banner->delete();
            return redirect()->to(route('home-banner.index'))->with('message', 'delete operation successful');
        }
    }

    public function unlink_file($path)
    {
        if($path){
            Storage::delete($path);
        }
        return true;
    }
}
