<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Config;

class ClientPortalInstall extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'client-portal:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs client portal web application';

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
        // Create DB file if it not exists
        $db_params = Config::get('database.connections.sqlite');
        if (!$db_params) die('unable to get DB parameters. Stop executing');
        $db_file_path = $db_params['database'];
        if (!file_exists($db_file_path)) {
            echo 'Creating database file';
            $db_file = fopen($db_file_path, 'w');
            if (!$db_file) die("Unable to fopen DB file ($db_file_path). Stop executing");
            fclose($db_file);
        }

        $need_restart = (!getenv('TEST_SBJ_MODE')) ? true : false;
        putenv("TEST_SBJ_MODE=front");
        if ($need_restart) {
            Artisan::call('config:clear');
            Artisan::call('client-portal:install');
            die;
        }


        echo 'Run migrations' . PHP_EOL;
        Artisan::call('migrate', ['--force' => true]);
        echo 'Starting server' . PHP_EOL;
        Artisan::call('serve');
    }
}
