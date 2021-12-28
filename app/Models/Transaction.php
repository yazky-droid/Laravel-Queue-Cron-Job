<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ['quantity', 'status', 'user_id', 'product_id', 'expired_at'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
