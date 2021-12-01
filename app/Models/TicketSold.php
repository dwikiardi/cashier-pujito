<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TicketSold extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id', 'ticket_id', 'sale_date', 'discount'
    ];

    public function ticket()
    {
        return $this->hasOne(Ticket::class, 'id', 'ticket_id');
    }
    
    public function soldBy()
    {
        return $this->hasOne(Admin::class, 'id', 'admin_id');
    }
}
