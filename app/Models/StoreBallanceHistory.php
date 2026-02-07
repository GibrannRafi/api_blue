<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class StoreBallanceHistory extends Model
{
    use UUID;

    protected $fillable = [
        'store_ballance_id',
        'type',
        'reference_id',
        'reference_type',
        'amount',
        'remarks',
    ];

    // Store ballance history belongs to one store
    public function store(){
        return $this->belongsTo(StoreBallance::class);
    }
}
