<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Models\Offer\LuckyNumber;

use Illuminate\Support\Facades\DB;

class LuckyNumberGenerate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'luckynumer:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate nucky number daily.';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $randomNumber = rand(100,200);

        $ln = LuckyNumber::find(1);
 
        $ln->lucky_number = $randomNumber;       
        $ln->save();
    }
}
