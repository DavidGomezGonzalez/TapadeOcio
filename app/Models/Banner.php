<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'content', 'category_id', 'province', 'municipality', 'latitud', 'longitud', 'start_time', 'end_time', 'place'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class);
    }

}
