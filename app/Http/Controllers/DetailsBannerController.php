<?php

namespace App\Http\Controllers;

use App\Models\DetailsBanner;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DetailsBannerController extends Controller
{
    public function index()
    {
        $details_banner = DetailsBanner::paginate(5);

        return view('details_banner.index', compact('details_banner'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::get();
        return view('details_banner.create', compact('products'));
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

        $home_banner = new DetailsBanner();
        $home_banner->content = $request->banner_content;
        if ($request->hasFile('image')) {
            $home_banner->image = $request->file('image')->store('public/home_banner_image');
        }
        $home_banner->product_id = $request->product_id;
        $home_banner->save();

        return redirect()->to(route('details-banner.index'))->with('message', 'create operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $details_banner = DetailsBanner::find($id);

        return view('details_banner.show', compact('details_banner'));
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
        $details_banner = DetailsBanner::find($id);
        return view('details_banner.edit',compact('details_banner','products'));
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

        $home_banner = DetailsBanner::find($id);
        $home_banner->content = $request->banner_content;
        if ($request->hasFile('image')) {
            $this->unlink_file($home_banner->image);
            $home_banner->image = $request->file('image')->store('public/home_banner_image');
        }
        $home_banner->product_id = $request->product_id;
        $home_banner->save();

        return redirect()->to(route('details-banner.index'))->with('message', 'update operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ( $details_banner = DetailsBanner::find($request->id)) {
            $this->unlink_file($details_banner->image);
            $details_banner->delete();
            return redirect()->to(route('details-banner.index'))->with('message', 'delete operation successful');
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
