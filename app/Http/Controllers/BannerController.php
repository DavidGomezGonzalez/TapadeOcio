<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Municipio;
use App\Models\Provincia;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::with(['category', 'municipio'])->get();
        return view('banners.index', compact('banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories     = Category::all();
        $municipalities = Municipio::all();
        $provincias     = Provincia::all();
        return view('banners.create', compact('categories', 'municipalities', 'provincias'));
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
            'province'     => 'required',
            'municipality' => 'required',
            'latitud'      => 'nullable|string',
            'longitud'     => 'nullable|string',
            'start_time'   => 'required|date',
            'end_time'     => 'required|date',
            'place'        => 'nullable'
        ]);

        $model->title        = $validatedData['title'];
        $model->content      = $validatedData['content'];
        $model->category_id  = $validatedData['category_id'];
        $model->province     = $validatedData['province'];
        $model->municipality = $validatedData['municipality'];
        $model->latitud      = $validatedData['latitud'];
        $model->longitud     = $validatedData['longitud'];
        //$model->start_time   = cambiarFormatoFecha($validatedData['start_time']);
        //$model->end_time     = cambiarFormatoFecha($validatedData['end_time']);
        $model->start_time   = $validatedData['start_time'];
        $model->end_time     = $validatedData['end_time'];
        $model->place        = $validatedData['place'];

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data = file_get_contents($image);
            $base64 = base64_encode($data);
            $model->image = $base64;
            $model->save();
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
        $categories     = Category::all();
        $municipalities = Municipio::all();
        $provincias     = Provincia::all();

        return view('banners.edit', compact('banner', 'categories', 'municipalities', 'provincias'));
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
            'image'        => 'nullable',
            'title'        => 'required',
            'content'      => 'required',
            'category_id'  => 'required',
            'province'     => 'required',
            'municipality' => 'required',
            'latitud'      => 'nullable|string',
            'longitud'     => 'nullable|string',
            'start_time'   => 'required|date',
            'end_time'     => 'required|date',
            'place'        => 'required'
        ]);

        $banner->title           = $request->title;
        $banner->content         = $request->content;
        $banner->category_id     = $request->category_id;
        $banner->province        = $request->province;
        $banner->municipality    = $request->municipality;
        $banner->latitud         = $request->latitud;
        $banner->longitud        = $request->longitud;
        //$banner->start_time      = cambiarFormatoFecha($request->start_time);
        //$banner->end_time        = cambiarFormatoFecha($request->end_time);
        $banner->start_time      = $request->start_time;
        $banner->end_time        = $request->end_time;
        $banner->place           = $request->place;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $data = file_get_contents($image);
            $base64 = base64_encode($data);
            $banner->image = $base64;
            $banner->save();
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


    public function search_geolocation(Request $request)
    {

        $datos  = array();
        //$q = '1600 Pennsylvania Ave NW, Washington, DC 20500';
        $q      = $request->input('address');
        $client = new Client();

        $response = $client->request('GET', 'https://nominatim.openstreetmap.org/search', [
            'query' => [
                'q' => $q,
                'format' => 'json',
                'addressdetails' => 5,
                'limit' => 5
            ]
        ]);

        $body   = $response->getBody();
        $result = json_decode($body, true);

        foreach ($result as $k => $v) {
            $datos['label'] = $v['display_name'];
            $datos['lat']   =  $v['lat'];
            $datos['lon']   =  $v['lon'];
            $datos['all']   =  $v;
        }

        echo json_encode($datos);
    }

    public function deleteImage(Banner $banner)
    {
        $banner->image = null;
        $banner->save();

        return response()->json(['success' => true]);
    }
}
