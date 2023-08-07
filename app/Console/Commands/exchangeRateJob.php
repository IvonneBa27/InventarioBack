<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;
use App\Models\exchangeRate;
use Illuminate\Support\Facades\Http;


class exchangeRateJob extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:getExchangeRate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Registro en la tabla exchangeRate desde la API';

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

      // $response = Http::get('http://10.150.80.252:8080//api/exchangeRate/getExchange');
        $response = Http::get('http://127.0.0.1:8000/api/exchangeRate/getExchange');


        // Procesar la respuesta de la API externa aquí
        $this->info('Tarea programada ejecutada con éxito');
    }
}
