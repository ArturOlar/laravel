<?php

namespace App\Console\Commands;

use App\Http\Controllers\Admin\Parser\ParserCronController;
use Illuminate\Console\Command;

class StartParse extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start_parser';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $parserController = new ParserCronController();
        $parserController->parser112();
    }
}
