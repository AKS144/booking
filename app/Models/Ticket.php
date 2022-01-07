<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'qty', 'category', 'ticket_id', 'email', 'mobile', 'time_slot', 'book_date', 'total'
    ];
}
