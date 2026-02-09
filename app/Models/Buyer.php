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
       return $query->where(function($q) use ($search) {
        $q->where('user_id', 'like', '%' . $search . '%')
          ->orWhereHas('user', function($userQuery) use ($search) {
              $userQuery->where('name', 'like', '%' . $search . '%');
          });
    });
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
