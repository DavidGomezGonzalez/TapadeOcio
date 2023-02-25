<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subcategories = Subcategory::all();
        return view('subcategories.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categories  = Category::all();
        $category_id = $request->input('category_id', '');
        return view('subcategories.create', ['categories' => $categories, 'category_id' => $category_id]);
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
            'name'        => 'required|max:255',
            'category_id' => 'required',
        ]);
    
        $subcategory = Subcategory::create($validatedData);
    
        return redirect()->route('subcategories.edit', $subcategory);
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function show(Subcategory $subcategory)
    {
        return view('subcategories.show', compact('subcategory'));
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function edit(Subcategory $subcategory)
    {
        $categories = Category::all();
        return view('subcategories.edit',  ['subcategory' => $subcategory, 'categories' => $categories]);
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param Category $category
     * @return void
     */
    public function update(Request $request, Subcategory $subcategory)
    {
        
        $validatedData = $request->validate([
            'name'        => 'required|max:255',
            'category_id' => 'required',
        ]);

        $subcategory->name        = $validatedData['name'];
        $subcategory->category_id = $validatedData['category_id'];
        $subcategory->save();

        return redirect()->route('subcategories.edit', ['subcategory' => $subcategory])->with('success', trans('Categoria actualizado'));
    }

    /**
     * Undocumented function
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return redirect()->route('subcategories.index');
    }
}
