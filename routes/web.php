<?php

use Illuminate\Support\Facades\Route;

Route::get('/health-check', fn() => response('OK', 200));