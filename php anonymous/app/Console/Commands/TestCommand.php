<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Artisan;

class TestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'myproject:refresh';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'this command to refresh project';

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
     * @return mixed
     */
    public function handle()
    {
      // when you write php artisan $signature will run this function
      Artisan::call('view:clear');//like php artisan view:clear
      Artisan::call('mirgate:fresh');
    }
}
