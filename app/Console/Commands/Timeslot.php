<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;

class Timeslot extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Timeslot';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add Timeslot';

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
        /* $slot = new Timeslot();
         $slot->time_slot = '08:00 AM - 09:00 AM';
         $slot->book_date = Carbon::now()->addDays(7)->toDateString();//Carbon:;now()->
            //$weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
         $slot->save();/*

         $slot = [
            [
                'id'             => 1,
                'time_slot'      => '08:00 AM - 09:00 AM',
                'book_date'      => Carbon::now()->addDays(),
            ],
        ];

        Timeslot::insert($slot);*/
    }
}
