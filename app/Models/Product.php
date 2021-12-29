<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Storage;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'img'];

    protected $appends = [
        'img_url',
    ];

    public function getImgUrlAttribute()
    {
        if (!is_null($this->img)) {
            return env('APP_URL') . Storage::url($this->img);
        }
    }

    public function transactions()
    {
        return $this->hasMany(Product::class);
    }
}
