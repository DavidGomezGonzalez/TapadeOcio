<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function edit($id)
    {
        $model      = User::find($id);
        $provincias = Provincia::all();
        if($model->provincia)
            $municipios = Municipio::where('provincia_id', $model->provincia)->get();
        else
            $municipios = Municipio::all();
            
        return view('users.update', ['model' => $model, 'municipios' => $municipios, 'provincias' => $provincias]);
    }

    public function update(Request $request, $id)
    {
        $model = User::find($id);
        $model->name = $request->input('name');
        $model->email = $request->input('email');
        $model->provincia = $request->input('provincia');
        $model->municipio = $request->input('municipio');
        $model->save();
        
        return redirect()->route('users.update', ['id' => $model->id])->with('success', trans('Usuario actualizado'));
    }

    public function destroy(Request $request, $id)
    {
        $model = User::find($id);
        $model->delete();
        return redirect()->route('users.index');
    }
}
