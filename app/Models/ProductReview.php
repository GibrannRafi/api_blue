<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class ProductReview extends Model
{
    use UUID;

    protected $fillable = [
        'product_id',
        'transaction_id',
        'rating',
        'review',
    ];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public function transaction(){
        return $this->belongsTo(Transaction::class);
    }
}
