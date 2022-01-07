<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timeslot extends Model
{
    use HasFactory;

    public $table = 'timeslots';

    public function scopeFilters($query)
    {
        return $query
            ->when(request()->input('time_slot'), function ($query) {
                $query->where('time_slot', request()->input('time_slot'));
            })
            ->when(request()->input('date'), function ($query) {
                $query->where('date', request()->input('date'));
            });
    }
}
