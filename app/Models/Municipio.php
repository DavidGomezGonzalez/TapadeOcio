<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    public static function getMunicipioName($id){
        return Municipio::select('municipio')->where('id', $id)->get()->value('municipio');
    }

    public static function getAll(){
        return Municipio::get();
    }

}


