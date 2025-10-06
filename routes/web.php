<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\NewsletterController;
use App\Http\Controllers\Frontend\ProfileController;

Route::get('/', function () {
    return view('frontend.home');
})->name('home');

Route::middleware('auth')->group(function () {
    // newsletter routes
    Route::get('/newsletter', [NewsletterController::class, 'index'])->name('newsletter.index');
    Route::get('/newsletter/create', [NewsletterController::class, 'create'])->name('newsletter.create');
    Route::post('/newsletter/store', [NewsletterController::class, 'store'])->name('newsletter.store');
    Route::get('/newsletter/show', [NewsletterController::class, 'show'])->name('newsletter.show'); // user-specific
    Route::post('/newsletter/{id}/send', [NewsletterController::class, 'send'])->name('newsletter.send');
    Route::get('/newsletter/edit', [NewsletterController::class, 'edit'])->name('newsletter.edit'); // user-specific
    Route::put('/newsletter/update', [NewsletterController::class, 'update'])->name('newsletter.update'); // user-specific

    Route::post('/newsletter/send-all', [NewsletterController::class, 'sendNewsletters'])->name('newsletter.sendAll');


    // profile routes
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile/update', [ProfileController::class, 'update'])->name('profile.update');
    

});

require __DIR__.'/auth.php';
