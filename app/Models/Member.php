<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'members';
    protected $fillable = [
        'user_id', 'name', 'place_of_birth', 'date_of_birth',
        'gender', 'phone', 'address',
        'image', 'is_active' 
    ];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function perform()
    {
        return $this->belongsToMany(Perform::class, 'member_meeting')->withTimestamps();
    }
}
