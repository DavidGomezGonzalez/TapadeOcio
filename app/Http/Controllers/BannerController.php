<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::with(['category', 'municipality'])->get();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $municipalities = Municipio::all();
        $provincias = Provincia::all();
        return view('banners.create', compact('categories', 'municipalities','provincias'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = new Banner;

        $validatedData = $request->validate([
            'image'        => 'nullable',
            'title'        => 'required',
            'content'      => 'required',
            'category_id'  => 'required',
            'municipality' => 'required',
            'start_date'   => 'required|date',
            'end_date'     => 'required|date',
            'place'        => 'nullable'
        ]);

        $model->title        = $validatedData['title'];
        $model->content      = $validatedData['content'];
        $model->category_id  = $validatedData['category_id'];
        $model->municipality = $validatedData['municipality'];
        $model->start_date   = $validatedData['start_date'];
        $model->end_date     = $validatedData['end_date'];
        $model->place        = $validatedData['place'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            $model->image = 'storage/images/' . $filename;
        }

        $model->save();
        return redirect()->route('banners.edit', $model)->with('success', trans('Banner created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        return view('banners.show', compact('banner'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit(Banner $banner)
    {
        $categories = Category::all();
        $municipalities = Municipio::all();
        return view('banners.edit', compact('banner', 'categories', 'municipalities'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            //'image' => 'required|image',
            'title' => 'required',
            'content' => 'required',
            'category_id' => 'required',
            'municipality' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'place' => 'required'
        ]);

        $banner->title = $request->title;
        $banner->content = $request->content;
        $banner->category_id = $request->category_id;
        $banner->municipality_id = $request->municipality_id;
        $banner->start_date = $request->start_date;
        $banner->end_date = $request->end_date;
        $banner->place = $request->place;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $image->storeAs('public/images', $filename);
            $banner->image = 'storage/images/' . $filename;
        }

        $banner->save();

        return redirect()->route('banners.edit', ['banner' => $banner])->with('success', trans('Banner successfully modified.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('banners.index');
    }
}
