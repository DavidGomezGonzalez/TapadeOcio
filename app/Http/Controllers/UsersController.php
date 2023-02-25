<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\Provincia;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Validator;
use Laravel\Jetstream\Jetstream;
use Illuminate\Validation\Rule;

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

        $validatedData = Request::validate([
            'name'      => ['required', 'string', 'max:255'],
            'email'     => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($id)],
            'provincia' => 'required|integer',
            'municipio' => 'required|integer',
        ]);
        
        $model->name      = $validatedData['name'];
        $model->email     = $validatedData['email'];
        $model->provincia = $validatedData['provincia'];
        $model->municipio = $validatedData['municipio'];
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
