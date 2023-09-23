<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MemberController;


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
// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });



Route::post('register', [MemberController::class, 'store']);
Route::post('login', [MemberController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::resource('members', MemberController::class)->except(['create', 'edit']);
});
// Route::resource('members', MemberController::class);


// GET /members           - index (show all members)
// GET /members/create    - create (show the form for creating a member)
// POST /members          - store (store a new member)
// GET /members/{id}      - show (show a specific member)
// GET /members/{id}/edit - edit (show the form for editing a member)
// PUT /members/{id}      - update (update a specific member)
// DELETE /members/{id}   - destroy (delete a specific member)
