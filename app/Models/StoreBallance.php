<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class StoreBallance extends Model
{
    use UUID;

    protected $fillable = [
        'store_id',
        'balance',
    ];

    protected $cast = [
        'balance' => 'decimal:2'
    ];

    // Store ballance is owned by one store
    public function storeBallance ( ){
        return $this->belongsTo(StoreBallance::class);
    }

    public function storeBalanceHistories(){
        return $this->hasMany(StoreBallanceHistory::class);
    }

    public function withdrawals(){
        return $this->hasMany(withdrawal::class);
    }
}
