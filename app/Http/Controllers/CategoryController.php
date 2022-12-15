<?php

namespace App\Http\Controllers;

use DataTables;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
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
        $category = [];
        if ($request->ajax()) {
            $category = Category::select('id', 'name', 'category_icon')->where('user_id', $this->user_id)->get();
            return DataTables::of($category)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<div class="form-group">
                    <a href="' . route('category.edit', $row->id) . '" class="link btn btn-outline-success">Edit</a> <a href="javascript:void(0)" data-id="' . $row->id . '" class="link btn btn-outline-danger delete_category">Delete</a>
                    </div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('category.index')->with('category', $category);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
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
            'name' => 'required|unique:categories,name,'.$this->user_id,
            'category_icon' => 'required|mimes:ico,svg',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('errors', $validator->errors());
        } else {
            if ($request->hasFile('category_icon')) {
                $image = $request->file('category_icon');
                $path = public_path('category_icons');
                $name = time() . rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $name);
            }
            $category = new Category();
            $category->user_id = $this->user_id;
            $category->name = $request->name;
            $category->category_icon = $name;
            $category->save();
        }
        return redirect()->route('category.index')->with('success', 'Category Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('category.edit')->with('category', $category);
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
            // 'name' => 'unique:categories,name,'. $this->user_id,
            'name' => ['required', Rule::unique('categories', 'user_id',)->ignore($this->user_id)],
            'category_icon' => 'mimes:svg,ico',
        ];
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return redirect()->back()->withInput()->with('errors', $validator->errors());
        } else {
            $category = Category::find($id);
            $category->user_id = $this->user_id;
            $category->name = $request->name;
            if ($request->hasFile('category_icon')) {
                $image = $request->file('category_icon');
                $path = public_path('category_icons');
                $name = time() . rand(1, 99999) . "." . $image->getClientOriginalExtension();
                $image->move($path, $name);
                $category->category_icon = $name;
            }
            $category->save();
        }
        return redirect()->route('category.index')->with('success', 'Category Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::join('products', 'products.category_id', '=', 'categories.id')->where('products.category_id', $id)->get()->toArray();
        if (empty($category)) {
            $category = Category::where('id', $id)->delete();
            return redirect()->route('category.index')->with('success', 'Category Deleted Successfully');
        } else {
            return response()->json(['category' => "First delete this category products"]);
        }
    }

    public function validateCategory(Request $request)
    {
        if(isset($request->id)){
            $category = Category::where('name', $request->name)->where('id', '!=', $request->id)->where('user_id', $this->user_id)->first('name', 'id', 'user_id');
            if (empty($category)) {
                $return =  true;
            } else {
                $return = false;
            }
        } else {
            $category = Category::where('name', $request->name)->where('user_id', $this->user_id)->first('user_id', 'name');
            if ($category) {
                $return =  false;
            } else {
                $return = true;
            }
        }
        echo json_encode($return);
        exit;
    }
}
