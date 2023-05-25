<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $fillable = ['image', 'title', 'content', 'category_id', 'subcategory_id', 'province', 'municipality', 'latitud', 'longitud', 'start_time', 'end_time', 'place'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function subcategory()
    {
        return $this->belongsTo(subcategory::class);
    }

    public function provincia()
    {
        return $this->belongsTo(Provincia::class, 'province');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipality');
    }

}
