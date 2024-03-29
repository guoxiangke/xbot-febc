<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\XbotHookController;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/webhook/xbot', XbotHookController::class);

Route::get('/test/log', function () {
    $file = '/tmp/laravel.log';
    file_put_contents($file, now() . PHP_EOL, FILE_APPEND);
    return file_get_contents($file);
});

Route::get('/test/php', function () {
    return phpinfo();
});

Route::get('/test/cache', function (){
    $cacheKey = 'cacheKey';
    $data = Cache::get($cacheKey, strtotime('tomorrow') - time());
    Cache::put($cacheKey, $data, strtotime('tomorrow') - time());
    return [$data];
});