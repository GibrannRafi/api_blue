<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
class Buyer extends Model
{
    use UUID;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'phone_number',
    ];

    // Buyer is associated with one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
