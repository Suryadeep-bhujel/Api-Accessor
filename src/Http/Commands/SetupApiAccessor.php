<?php
namespace Bhujel\SecretHeader\Http\Commands; 
// namespace App\Console\Commands;

use Illuminate\Console\Command;
use Bhujel\SecretHeader\Http\Helpers\AddEnvColumn;
class SetupApiAccessor extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'install:api_accessor';

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
     * @return int
     */
    public function handle()
    {
        // dd("./../public");
        AddEnvColumn::checkForColumn();
        if (!file_exists(public_path('/api-accessor/css/styles.css'))) {
            copy("./../public",public_path('/api-accessor'));
        }
    }
}
