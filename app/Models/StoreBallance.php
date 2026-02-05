<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class StoreBallance extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'store_id',
        'balance',
    ];

    protected $casts = [
        'balance' => 'decimal:2'
    ];


    // Query Didalam model store, akan cari ballance ini berdasarkan nama toko nya
    public function scopeSearch($query, $search)
    {
        return $query->whereHas('store', function ($q) use ($search) {
            $q->where('name', 'like', '%' . $search . '%');
        });
    }

    // Store ballance is owned by one store
    public function store(){
        return $this->belongsTo(Store::class);
    }

    public function storeBalanceHistories(){
        return $this->hasMany(StoreBallanceHistory::class);
    }

    public function withdrawals(){
        return $this->hasMany(withdrawal::class);
    }
}
