<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerBandwidth extends Model
{
    use HasFactory;
    protected $table = 'customer_bandwidths';
    protected $fillable = [
        'customer_id', 'package_id', 'ip_radio', 'ip_access'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(Package::class);
    }
}
