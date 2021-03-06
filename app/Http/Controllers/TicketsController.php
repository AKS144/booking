<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Ticket;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Timeslot;

class TicketsController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
    /*$this->validate($request, [
            'name'       => 'required|regex:/^[a-zA-ZÑñ\s]+$/|max:120',
            'time_slot'  => 'required',
            'email'      => ''required|email|max:120,
            'category'   => 'required',
            'mobile'     => 'required|digits:10|numeric',
        ]);*/

            $slot = DB::table('timeslots')->select('seats')->where('book_date','=',$request->book_date)
                                       ->where('time_slot','=',$request->time_slot)->first();
            $ticket             =   new Ticket();
            $ticket->name       =   $request->name;
            $ticket->email      =   $request->email;
            $ticket->mobile     =   $request->mobile;
            $ticket->ticket_id  =   strtoupper(Str::random(7));
            $ticket->time_slot  =   $request->time_slot;
            $ticket->book_date  =   $request->book_date;
            $ticket->category   =   $request->category;
           //$ticket->qty        =   $request->qty;
            $ticket->total      =   $request->total;//($ticket->category * $ticket->qty);

            if($request->category == '70')
            {
                $total_seats = $request->qty*7;
                $ticket->qty = $total_seats;
                if($ticket->qty > $slot->seats)
                {//dd($ticket);
                    return redirect()->back()->with('status','Requested seats are not available');
                }//dd($ticket);
                elseif($ticket->qty <= $slot->seats)
                {
                   //dd($ticket);
                   $ticket->save();
                   DB::table('timeslots')->where('book_date','=',$request->book_date)
                                  ->where('time_slot','=',$request->time_slot)
                                  ->where('seats','>',0)
                                  ->update([
                                        'seats' => DB::raw('seats-'.$total_seats),
                                        'updated_at' => Carbon::now()
                            ]);
                }
            }
            elseif($request->category == '10')
            {
                $ticket->qty = $request->qty;
                if($ticket->qty > $slot->seats)
                {//dd($ticket);
                    return redirect()->back()->with('status','Requested seats are not available');
                }//dd($ticket);
                elseif($ticket->qty <= $slot->seats)
                {
                    $ticket->save();
                    DB::table('timeslots')->where('book_date','=',$request->book_date)
                                      ->where('time_slot','=',$request->time_slot)
                                      ->update([
                                            'seats' => Db::raw('seats-'.$ticket->qty),
                                            'updated_at' => Carbon::now()
                                      ]);//->where('seats','>',0)
                                      //->decrement('seats',$ticket->qty);
                    //dd($ticket);
                }
            }

            return redirect()->back()->with('ticket',$ticket)->with("status", "Your booking ID: #$ticket->ticket_id.");
        }
}
