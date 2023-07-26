<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Icon;
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
        $icons = Icon::whereDoesntHave('category')->get();
        return view('categories.create', compact('icons'));
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
            'icon_id' => 'nulleable',
            'is_main' => 'nullable|boolean',
            'order' => 'required|integer',
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
        $icons = Icon::whereDoesntHave('category')
            ->orWhere('id', $category->icon_id)
            ->get();
        return view('categories.edit', ['category' => $category, 'subcategories' => $subcategories, 'icons' => $icons]);
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
        $request->validate([
            // Agrega aquí tus otras reglas de validación...
            'name' => 'required|max:255',
            'is_main' => 'nullable|boolean',
            'order' => 'required|integer|min:0',
        ]);

        $category->name = $request->name;
        $category->is_main = $request->has('is_main');
        $category->order = $request->order;

        $category->save();

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
