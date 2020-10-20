<?php

use Dcat\Admin\Extension\Crontab\Http\Controllers;

Route::resource('crontab', Controllers\CrontabController::class);
Route::resource('crontabLog', Controllers\CrontabLogController::class);