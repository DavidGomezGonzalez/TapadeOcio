<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
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
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
    
        $category = Category::create($validatedData);
    
        return redirect()->route('categories.edit', $category);
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function show(Category $category)
    {
        return view('categories.show', compact('category'));
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function edit(Category $category)
    {
        $subcategories = Subcategory::where('category_id', $category->id)->get();
        return view('categories.edit', ['category' => $category, 'subcategories' => $subcategories]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, Category $category)
    {
        $category->update($request->all());
        return redirect()->route('categories.edit', ['category' => $category])->with('success', trans('Categoria actualizado'));
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index');
    }
}
