<?php

use App\Http\Controllers\AddressController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CampaignController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\CollectorController;
use App\Http\Controllers\DonorController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FieldController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\PhoneController;
use App\Http\Controllers\ReasonController;
use App\Http\Controllers\SourceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['guest']], function () {
    Route::post('login', [AuthController::class, 'login']);
});

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::apiResources([
        'addresses' => AddressController::class,
        'campaigns' => CampaignController::class,
        'cards' => CardController::class,
        'donors' => DonorController::class,
        'collectors' => CollectorController::class,
        'emails' => EmailController::class,
        'fields' => FieldController::class,
        'locations' => LocationController::class,
        'phones' => PhoneController::class,
        'reasons' => ReasonController::class,
        'sources' => SourceController::class,
    ]);
});
