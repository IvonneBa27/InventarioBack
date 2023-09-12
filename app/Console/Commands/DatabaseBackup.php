<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Carbon\Carbon;
use File;

class DatabaseBackup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'database:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create copy of mysql dump for existing database.';

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
  
        $backupFileName = "C:\Users\BacaI\Desktop\backUP-BD\backup-" . Carbon::now()->format('Y-m-d') . ".sql";
        $dumpPath = env('DB_DUMP_PATH', 'mysqldump');
        $user = env('DB_USERNAME');
        $password = env('DB_PASSWORD');
        $host = env('DB_HOST');
        $database = env('DB_DATABASE');
       
        $command = "{$dumpPath} --user={$user} --password={$password} --host={$host} {$database} > {$backupFileName}";
           exec($command);
           $this->info("Database backup created");
    
       
    }
}
