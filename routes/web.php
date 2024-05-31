<?php

use App\Http\Controllers\ProfileController;
use App\Models\User;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard', ['id' => auth()->user()->id]);
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/qrcode/{id}', function (int $id) {
    $url = route('payment')."/{$id}";

    $user = User::findOrFail($id);

    $qrSvg = (new \BaconQrCode\Writer(new \BaconQrCode\Renderer\ImageRenderer(
        new \BaconQrCode\Renderer\RendererStyle\RendererStyle(256),
        new \BaconQrCode\Renderer\Image\SvgImageBackEnd(),
    )))->writeString($url);

    $svg = trim(substr($qrSvg, strpos($qrSvg, "\n") + 1));

    return Inertia::render('QrCode',
    [
        'name' => $user->name,
        'svg' => $svg,
        'url' => $url,
    ]);


})->name('qrcode');

Route::get('/payment/{id}', function (int $id) {

    $url = route('payment', ['id' => $id]);

    $user = User::findOrFail($id);

    $qrSvg = (new \BaconQrCode\Writer(new \BaconQrCode\Renderer\ImageRenderer(
        new \BaconQrCode\Renderer\RendererStyle\RendererStyle(256),
        new \BaconQrCode\Renderer\Image\SvgImageBackEnd(),
    )))->writeString($url);

    $svg = trim(substr($qrSvg, strpos($qrSvg, "\n") + 1));

    return Inertia::render('Payment',
        [
            'name' => $user->name,
            'svg' => $svg,
            'url' => $url,
        ]);


});


Route::get('/payment', function () {
})->name('payment');

Route::get('/success', function () {
    return 'success';
})->name('success');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
