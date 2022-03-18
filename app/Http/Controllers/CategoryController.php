<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Gate;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware(function($request, $next){
            if(Gate::allows('manage-categories')) return $next($request);
            abort('403', 'Anda tidak memiliki cukup hak akses');
        });
    }

    public function index(Request $request)
    {
        $categories = \App\Models\Category::paginate(10);
        
        $filterKeyword = $request->get("name");
        if ($filterKeyword) {
            $categories = \App\Models\Category::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view('categories.index', ["categories" => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        \Validator::make($request->all(), [
            "name" => "required|min:3|max:20"
        ])->validate();

        $name = $request->get("name");

        $new_category = new \App\Models\Category;
        $new_category->name = $name;
        $new_category->created_by = \Auth::user()->id;
        $new_category->slug = \Str::slug($name, "-");

        $new_category->save();

        return redirect()->route('categories.index')->with('status', 'Categories successfully created.');
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
        $category_to_edit = \App\Models\Category::findOrFail($id);

        return view('categories.edit', ['category' => $category_to_edit]);
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
        $category = \App\Models\Category::findOrFail($id);

        \Validator::make($request->all(), [
            "name" => "required|min:3|max:20",
            "slug" => [
                "required",
                Rule::unique("categories")->ignore($category->slug, "slug")
            ]
        ])->validate();

        $name = $request->get("name");
        $slug = $request->get("slug");


        $category->name = $name;
        $category->slug = $slug;

        $category->updated_by = \Auth::user()->id;
        $category->slug = \Str::slug($slug, "-");

        $category->save();

        return redirect()->route('categories.index')->with('status', 'Category successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Models\Category::findOrFail($id);

        $category->delete();

        return redirect()->route('categories.index')->with('status', 'Category successfully deleted');
    }

    public function trash()
    {
        $deleted_category = \App\Models\Category::onlyTrashed()->paginate(10);

        return view('categories.trash', ['categories' => $deleted_category]);
    }

    public function restore($id)
    {
        $categori = \App\Models\Category::withTrashed()->findOrFail($id);

        if($categori->trashed()){
            $categori->restore();
        } else {
            return redirect()->route('categories.index')->with('status', 'Category is not in trash');
        }

        return redirect()->route('categories.index')->with('status', 'Category successfully restored');
    }

    public function deletePermanent($id)
    {
        $categori = \App\Models\Category::withTrashed()->findOrFail($id);

        if(!$categori->trashed()){
            return redirect()->route('categories.index')->with('status', 'Can not delete permanent active category');
        } else {
            $categori->forceDelete();
        }

        return redirect()->route('categories.index')->with('status', 'Category permanently deleted');
    }

    public function ajaxSearch(Request $request)
    {
        $keyword = $request->get('q');
        $categories = \App\Models\Category::where("name", "LIKE", "%$keyword%")->get();

        return $categories;
    }
}
