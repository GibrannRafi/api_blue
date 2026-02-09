<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\UUID;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Buyer extends Model
{
    use UUID, HasFactory;

    protected $fillable = [
        'user_id',
        'profile_picture',
        'phone_number',
    ];


    public function scopeSearch($query, $search)
    {
        return $query->where('user', 'like', '%' . $search . '%')
            ->orWhere('phone', 'like', '%' . $search . '%');
    }

    // Buyer is associated with one user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function transactions(){
        return $this->hasMany(Transaction::class);
    }
}
