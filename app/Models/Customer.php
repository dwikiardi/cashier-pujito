<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'phone', 'address', 'image', 'is_active'
    ];

    public function customer_bandwidth()
    {
        return $this->belongsTo(CustomerBandwidth::class, 'id', 'customer_id');
    }
}
