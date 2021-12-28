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
        'price'
    ];

    public function productTransaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
