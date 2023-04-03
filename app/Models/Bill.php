<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'customer_id', 'is_paid', 'invoice_number'];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

}
