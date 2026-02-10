<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductImage extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'product_id',
        'image',
        'thumbnail',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

}
