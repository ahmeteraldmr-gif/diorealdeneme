<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

Artisan::command('dioreal:sync', function () {
    $cmd = new \App\Console\Commands\SyncDiorealContent();
    $cmd->setOutput($this->output);
    return $cmd->handle();
})->purpose('Automatically scrape and sync all new content, text and images from live dioreal.com');
