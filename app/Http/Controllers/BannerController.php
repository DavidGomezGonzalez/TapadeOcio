<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\Subcategory;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        $today = Carbon::today();

        $user = 0;
        $municipio = 0;
        if (Auth::guard()->check()) { //Loggueado
            //Obtener usuario
            $user = Auth::guard()->user();
            $municipio = $user->municipio;
        }

        $categories = Category::with('subcategories')->get();

        $todayBanners = Banner::whereDate('start_time', '=', $today);
        $upcomingBanners = Banner::whereDate('start_time', '>', $today);

        if ($user && $municipio) { // Si el usuario está autentificado y el municipio está relleno
            $todayBanners = $todayBanners->where('municipality', $municipio);
            $upcomingBanners = $upcomingBanners->where('municipality', $municipio);
        }

        $todayBanners = $todayBanners->whereIn('category_id', $categories->pluck('id')->toArray())->get();
        $upcomingBanners = $upcomingBanners->whereIn('category_id', $categories->pluck('id')->toArray())->get();

        return view('welcome', [
            'todayBanners' => $todayBanners,
            'upcomingBanners' => $upcomingBanners,
            'municipio' => $municipio,
            'categories' => $categories
        ]);
    }



    public function filter(Request $request)
    {
        $category_ids = $request->category_ids;

        if (is_null($category_ids)) {
            return response()->json(['message' => 'category_ids es nulo']);
        }

        $todayBanners = Banner::with(['category', 'municipio'])
            ->where('municipality', $request->municipio)
            ->whereDate('start_time', Carbon::today())
            ->whereIn('category_id', $category_ids)
            ->get();

        $upcomingBanners = Banner::with(['category', 'municipio'])
            ->where('municipality', $request->municipio)
            ->whereDate('start_time', '>', Carbon::today())
            ->whereIn('category_id', $category_ids)
            ->get();

        $view = view('banners.banners_partial', [
            'todayBanners' => $todayBanners,
            'upcomingBanners' => $upcomingBanners
        ])->render();

        return response()->json(['html' => $view]);
    }


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
        $subcategories  = Subcategory::all();
        return view('banners.create', compact('categories', 'municipalities', 'provincias', 'subcategories'));
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
            'subcategory_id'  => 'nullable',
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
        $model->subcategory_id  = $validatedData['subcategory_id'];
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
        $subcategories  = Subcategory::all();
        $municipalities = Municipio::all();
        $provincias     = Provincia::all();

        return view('banners.edit', compact('banner', 'categories', 'subcategories', 'municipalities', 'provincias'));
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
            'subcategory_id'  => 'nullable',
            'province'     => 'required',
            'municipality' => 'required',
            'latitud'      => 'nullable|string',
            'longitud'     => 'nullable|string',
            'start_time'   => 'required|date',
            'end_time'     => 'required|date',
            'place'        => 'nullable'
        ]);

        $banner->title           = $request->title;
        $banner->content         = $request->content;
        $banner->category_id     = $request->category_id;
        $banner->subcategory_id     = $request->subcategory_id;
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


    public function view($id)
    {
        $banner = Banner::with('category','subcategory','municipio', 'provincia')->findOrFail($id);

        return view('banners.view', ['banner' => $banner]);
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
