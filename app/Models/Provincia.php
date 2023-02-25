<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Provincia extends Model
{
    use HasFactory;


    public function municipios()
    {
        return $this->hasMany(Municipio::class);
    }

    public static function getProvinciaName($id){
        return Provincia::select('provincia')->where('id', $id)->get()->value('provincia');
    }
    public static function getAll(){
        return Provincia::get();
    }
}
