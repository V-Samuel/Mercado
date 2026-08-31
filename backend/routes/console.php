<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Roda o comando de limpeza das contas demo automaticamente a cada 5 minutos
Schedule::command('demo:cleanup')->everyFiveMinutes();
