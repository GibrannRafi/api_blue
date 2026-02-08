<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class StoreBallanceHistory extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'store_ballance_id',
        'type',
        'reference_id',
        'reference_type',
        'amount',
        'remarks',
    ];

    protected $casts = [
        'amount' => 'decimal:2',
    ];

    // Store ballance history belongs to one store
    public function storeBallance(){
        return $this->belongsTo(StoreBallance::class);
    }
}
