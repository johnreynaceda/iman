<?php

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.index');
        })->name('admin.dashboard');
        Route::get('/assets', function () {
            return view('admin.asset');
        })->name('admin.asset');
        Route::get('/requested-assets', function () {
            return view('admin.requests');
        })->name('admin.requests');

        Route::get('/ledger', function () {
            return view('admin.ledger');
        })->name('admin.ledger');
        Route::get('/requested-assets/{id}', function () {
            return view('admin.open-request');
        })->name('admin.open-request');

        Route::get('/requested-assets/preview-request/{id}', function () {
            return view('admin.preview-request');
        })->name('admin.preview-request');

        Route::get('/borrowed-assets', function () {
            return view('admin.borrowed');
        })->name('admin.borrowed');

        Route::get('/borrowers', function () {
            return view('admin.borrower');
        })->name('admin.borrower');
        Route::get('/profile-information', function () {
            return view('admin.profile');
        })->name('admin.profile');

        Route::get('/reports', function () {
            return view('admin.report');
        })->name('admin.reports');
    });
