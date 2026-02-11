<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;

class Transaction extends Model
{
    use UUID;

    protected $fillable = [
        'code',
        'buyer_id',
        'store_id',
        'address',
        'address_id',
        'city',
        'postal_code',
        'shipping',
        'shipping_type',
        'shipping_cost',
        'tax',
        'grand_total',
        'payment_status'
    ];

    protected $cast = [
        'shipping_cost' => 'decimal:2',
        'tax' => 'decimal:2',
        'grand_total' => 'decimal:2',
    ];

    public function scopeSearch($query, $search)
    {
        return $query->where('code', 'like', '%' .$search . '%');
    }
    public function buyer (){
        return $this->belongsTo(Buyer::class);
    }

    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function transactionDetails(){
        return $this->hasMany(TransactionDetail::class);
    }


    public function productReviews(){
        return $this->hasMany(ProductReview::class);
    }
}
