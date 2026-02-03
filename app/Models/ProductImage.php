<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class ProductImage extends Model
{
    use UUID;

    protected $fillable = [
        'product_id',
        'image',
        'thumbnail',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }
    
}
