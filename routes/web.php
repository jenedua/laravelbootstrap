<?php

use App\Http\Controllers\EnviarSmsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

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

//Para me autenticar com servicos exteno no laravel

Route::get('/auth/{provider}/redirect', function (string $provider) {
    return Socialite::driver($provider)->redirect();
});
 
Route::get('/auth/{provider}/callback', function (string $provider) {
    $providerUser = Socialite::driver($provider)->user();
   // dd($providerUser);

    $user = User::updateOrCreate([
        'email' => $providerUser->getEmail(),
    ], [
        'name' => $providerUser->getName(),
        'provider_id' => $providerUser->getId(),
        'provider_avatar' => $providerUser->getAvatar(),
        'provider_name' => $provider,
    ]);


    Auth::login($user);
    return redirect('/dashboard');

});

Route::get('/users', [UserController::class, 'users'])->name('users')->middleware('auth');

Route::get('/', function () {
    return view('site.home');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/enviar', [EnviarSmsController::class, 'enviarSms'])->name('enviar-sms.index');

require __DIR__.'/auth.php';
