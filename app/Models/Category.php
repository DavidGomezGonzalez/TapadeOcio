<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'description', 'icon_id', 'is_main', 'order'
    ];

    public function subcategories()
    {
        return $this->hasMany(Subcategory::class);
    }

    public function icon()
    {
        return $this->belongsTo(Icon::class);
    }


    /*public function icons()
    {
        return $this->belongsTo(Icon::class);
    }*/
}
