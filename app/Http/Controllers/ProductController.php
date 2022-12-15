<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    protected $user_id;

    public function __construct()
    {   
        $this->middleware(function($request,$next){
            $this->user_id = Auth::user()->id;
            return $next($request);
        });
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = [];
        if($request->ajax()){
            $products = Product::select('products.id', 'products.product_icon', 'products.prodname', 'products.price', 'products.product_image', 'categories.name')->join('categories', 'categories.id', '=', 'products.category_id')->where('products.user_id', $this->user_id)->get();
            return DataTables::of($products)
                ->addIndexColumn()
                ->addColumn('action', function($row) {
                    $btn = '<div class="form-group">
                    <a href="'.route('products.show',$row->id).'" class="link btn btn-outline-warning text-black">View</a>  <a href="'.route('products.edit',$row->id).'" class="link btn btn-outline-success">Edit</a> <a href="#" data-id="'.$row->id.'" class="link btn btn-outline-danger delete_product">Delete</a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        //  <button id="showUser" data-id="' .$row->id. '" class="btn btn-outline-warning text-black" title="view" data-toggle="modal" data-target="#product_modal">View</button>
        return view('products.index')->with('products', $products);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('user_id', $this->user_id)->get();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        $rules = [
            'product_name' => 'required',
            'product_icon' => 'required|mimes:ico,svg',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_image' => 'required|mimes:png,jpg,jpeg,svg',
            'category_id' => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->first());
        } else {
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $path = public_path('product_images');
                $product_image = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $product_image);
            }
            if ($request->hasFile('product_icon')) {
                $image = $request->file('product_icon');
                $path = public_path('product_icons');
                $product_icon = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $product_icon);
            }
            $product = new Product();
            $product->user_id = $this->user_id;
            $product->category_id = $request->category_id;
            $product->prodname = $request->product_name;
            $product->price = $request->product_price;
            $product->prod_desc = $request->product_description;
            $product->product_icon = $product_icon;
            $product->product_image = $product_image;
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Product::select('products.id', 'products.product_icon', 'products.prodname', 'products.price', 'products.prod_desc', 'products.product_image', 'categories.name')->join('categories', 'categories.id', '=', 'products.category_id')->where('products.id', $id)->get();
        return view('products.view')->with(['products' => $products]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $products = Product::find($id);
        $categories = Category::where('user_id', $this->user_id)->get();

        return view('products.edit')->with(['products' => $products, 'categories' => $categories]);
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
        $input = $request->all();
        $rules = [
            'product_name' => 'required',
            'product_icon' => 'mimes:svg,ico',
            'product_price' => 'required|numeric',
            'product_description' => 'required',
            'product_image' => 'mimes:png,jpg,jpeg,svg',
            'category_id' => 'required',
        ];
        $validator = Validator::make($input, $rules);
        if($validator->fails()){
            return redirect()->back()->withInput()->withErrors($validator->errors()->first());
        } else {
            $product = Product::find($id);
            $product->user_id = $this->user_id;
            $product->category_id = $request->category_id;
            $product->prodname = $request->product_name;
            $product->price = $request->product_price;
            $product->prod_desc = $request->product_description;
            if ($request->hasFile('product_image')) {
                $image = $request->file('product_image');
                $path = public_path('product_images');
                $product_image = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $product_image);
                $product->product_image = $product_image;
            }
            if ($request->hasFile('product_icon')) {
                $image = $request->file('product_icon');
                $path = public_path('product_icons');
                $product_icon = time().rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $product_icon);
                $product->product_icon = $product_icon;
            }
            $product->save();
        }
        return redirect()->route('products.index')->with('success', 'Product Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $products = Product::where('id', $id)->delete();
        return redirect()->route('products.index')->with('success', 'Product Deleted Successfully');
    }
}
