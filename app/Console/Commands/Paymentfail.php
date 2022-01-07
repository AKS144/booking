<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class Paymentfail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Paymentfail';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Deleteing failed payment booking';

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
        DB::table('tickets')->where('payment','=',NUll)->where('created_at','<=',Carbon::now()->subSecond(10))->delete();
        $this->info('Fail payment deleted Successfully!');
    }
}
