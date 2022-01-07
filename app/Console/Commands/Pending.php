<?php

namespace App\Console\Commands;

use Log;
use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Pending extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pending';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Pending status deleted';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //return 0;

        //DB::table('tickets')->where('id',3)->delete();
       $test = DB::table('tickets')->select('time_slot','book_date','qty')
                            ->where('payment','=',NUll)
                            ->where('created_at','<=',Carbon::now()->subSecond(10))
                            ->get()->each(function ($slot){
                                DB::table('timeslots')->where('book_date','=',$slot->book_date)
                                                      ->where('time_slot','=',$slot->time_slot)
                                                     ->update([
                                                         'seats' => DB::raw('seats+' .$slot->qty),
                                                         'updated_at' => Carbon::now(),
                                                        ]);

                            });
                           // $test->delete();

       /*$ticket = DB::table('tickets')->where('payment','=',NUll)->where('created_at','<=',Carbon::now()->subMinute(1))->get();

       if($ticket->delete()){
        DB::table('timeslots')->where('book_date','=',$ticket->book_date)->where('time_slot','=',$ticket->time_slot)->update([
            'seats' => DB::raw('seats+' .$ticket->qty),
            'updated_at' => Carbon::now(),
           ]);;
       }*/



      /*  $test = DB::table('tickets')->select('time_slot','book_date','qty')
                           ->where('payment','=',NUll)
                           ->where('created_at','<=',Carbon::now()->subMinute(10))
                           ->delete();*/
               /* if($test->delete())
                {
                    DB::table('timeslots')->where('book_date','=',$test->book_date)
                                                      ->where('time_slot','=',$test->time_slot)
                                                      ->increment('seats',$test->qty);
                }*/


       // DB::table('tickets')->where('payment','=',NUll)->where('created_at','<=',Carbon::now()->subMinute(10))->delete();
       //DB::table('timeslots')->where('book_date','=',$ticket->book_date)->where('time_slot','=',$ticket->time_slot)->decrement('seats',$ticket->qty);

       // $ticket = DB::table('tickets')->where('payment','=',NUll)->where('created_at','<=',Carbon::now()->subMinute(10))->get;
        //$ticket->delete();
       // $slot = DB::table('timeslots')->where('book_date', '=',$ticket->book_date)->where('time_slot','=',$ticket->time_slot)->increment('seats',$ticket->qty);
       //$ticket->->each->delete();
        $this->info('Pending payment deleted Successfully!');
    }
}

