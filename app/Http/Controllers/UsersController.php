<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //
    public function edit($id)
    {
        $municipios = Municipio::all();
        return view('users.update', ['model' => User::find($id), 'municipios' => $municipios]);
    }

    public function update(Request $request, $id)
    {
        $model = User::find($id);
        $model->name = $request->input('name');
        $model->email = $request->input('email');
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
