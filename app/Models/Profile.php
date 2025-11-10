<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    use HasFactory;

    protected $fillable = [
        'username',
        'profile_photo'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function link()
    {
        return $this->hasMany(Link::class);
    }
}
