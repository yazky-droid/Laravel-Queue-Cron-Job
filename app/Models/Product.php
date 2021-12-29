<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $date = [
        'created_at',
        'updated_at'
    ];

    protected $fillable = [
        'name',
        'price',
        'product_image_name',
        'product_image_url'
    ];

    public function productTransaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
