<?php
use App\Http\Controllers\ProdukController;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/produk',[ProdukController::class,'store']);
Route::get('/data-produk',[ProdukController::class,'show']);
Route::get('/produk/{id}',[ProdukController::class,'detail']);
Route::get('/produk/filter/{nama}', [ProdukController::class,'filter']);
Route::put('/produk/{id}',[ProdukController::class,'update']);
Route::delete('/produk/{id}', [ProdukController::class, 'delete']);