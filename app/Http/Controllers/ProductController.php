<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::with('category')->paginate(10);

        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('product.create', compact('categories'));
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
            'name' => 'required',
            'category_id' => 'required',
            'upload_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required',
        ]);

        $product = new Product();
        $product->name = $request->name;
        if ($request->hasFile('image')) {
            $product->image = $request->file('image')->store('public/product_image');
        }
        $attribute_name_array = [];
        $attribute_value_array = [];
        $counter = count($request->attribute_name);
        for ($i = 0 ; $i<$counter; $i++){
            $attribute_name_array[] = $request->attribute_name[$i];
            $attribute_value_array[$request->attribute_name[$i]] = $request->attribute_value[$i];
        }
        $product->attribute_name = json_encode($attribute_name_array);
        $product->attribute_value = json_encode($attribute_value_array);
//        dump(($attribute_name_array));
//        dump(($product->attribute_name));
//        dump(($attribute_value_array));
//        dd(json_decode($product->attribute_value , true));
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->save();

        return redirect()->to(route('product.index'))->with('message', 'create operation successful');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::find($id);

        return view('product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categories = Category::all();
        $product = Product::find($id);
        return view('product.edit',compact('product','categories'));
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
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
        ]);

        $product = Product::find($id);
        $product->name = $request->name;
        if ($request->hasFile('image')) {
            $this->unlink_file($product->image);
            $product->image = $request->file('image')->store('public/category_image');
        }
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->save();

        return redirect()->to(route('product.index'))->with('message', 'update operation successful');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ( $product = product::find($request->id)){
            $product->delete();
            return redirect()->to(route('product.index'))->with('message', 'delete operation successful');
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
