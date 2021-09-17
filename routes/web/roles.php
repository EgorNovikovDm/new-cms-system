<?php
use Illuminate\Support\Facades\Route;
Route::get('/roles', [App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
Route::post('/roles/store', [App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
Route::delete('/role/{role}/destroy', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role.destroy');
Route::get('/role/{role}/edit', [App\Http\Controllers\RoleController::class, 'edit'])->name('role.edit');
Route::put('/role/{role}/update', [App\Http\Controllers\RoleController::class, 'update'])->name('role.update');
Route::put('/role/{role}/attach', [App\Http\Controllers\RoleController::class, 'attach'])->name('role.permission.attach');
Route::put('/role/{role}/detach', [App\Http\Controllers\RoleController::class, 'detach'])->name('role.permission.detach');


