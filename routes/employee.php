<?php

Route::prefix('employee')
    ->middleware(['auth'])
    ->group(function () {
        Route::get('/dashboard', function () {
            return view('employee.index');
        })->name('employee.dashboard');
        Route::get('/requested-assets', function () {
            return view('employee.requested');
        })->name('employee.requested');
        Route::get('/transaction-history', function () {
            return view('employee.history');
        })->name('employee.history');
        Route::get('/profile', function () {
            return view('employee.profile');
        })->name('employee.profile');
    });
