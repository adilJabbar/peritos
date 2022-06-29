<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class RefreshTestDdbb extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'refresh:test';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Refreshing test database from production';

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
        $ds = DIRECTORY_SEPARATOR;

        $username = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $database = env('DB_DATABASE');
        $test_database = env('DB_DATABASE_TEST');

        $ts = time();
        $path = database_path().$ds.'backups'.$ds.date('Y', $ts).$ds.date('m', $ts).$ds.date('d', $ts).$ds;
        $file = date('Y-m-d-His', $ts).'-dump-'.$database.'.sql';

        $command = sprintf('mysqldump -u %s '.($password ? ' -p\''.$password.'\'' : '').' %s > %s', $username, $database, $path.$file);

        if (! is_dir($path)) {
            mkdir($path, 0755, true);
        }
        exec($command);
        $this->info("Production database file '".$file."' has been created.");

//        $hasDb = DB::connection('mysql')->select("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '". $test_database . "'");
//        $this->info($hasDb);
//
//        if(empty($hasDb)) {
//            DB::connection('mysql')->select('CREATE DATABASE '. $test_database);
//            $this->info("Database '" . $test_database . "' created.");
//        }
//        else {
//
//        }

        $secondCommand = sprintf('mysql -u %s '.($password ? ' -p\''.$password.'\' ' : ' ').' %s < %s ', $username, $test_database, $path.$file);

        exec($secondCommand);
        $this->info('Backup copied to test database');
    }
}
