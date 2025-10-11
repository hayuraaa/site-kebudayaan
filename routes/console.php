<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Schedule;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Schedule command setiap 6 jam
Schedule::command('glam:refresh')
    ->everySixHours()
    ->withoutOverlapping()
    ->runInBackground();
