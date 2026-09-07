<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login-process', function (Request $request) {
    $username = $request->input('username');  
    return redirect()->route('index')->with('user_logged_in', $username);
});

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/logout', function () {
    return redirect()->route('login');
})->name('logout');

Route::get('/form_add_blogs', function () {
    return view('form_add_blogs'); 
})->name('form_add_blogs');


Route::get('/abouts', function () {
    $name = "Wipaporn Boontee";
    $date = date("Y-m-d");
    return view('abouts', compact('name', 'date')); 
})->name('abouts');

Route::get('/blogs', [AdminController::class, 'blog'])->name('blogs');
Route::get('/blogs/create', [AdminController::class, 'create'])->name('blog.create');
Route::post('/blogs/store', [AdminController::class, 'store'])->name('blog.store');
Route::get('/blogs/{id}/edit', [AdminController::class, 'edit'])->name('blog.edit');
Route::put('/blogs/{id}/update', [AdminController::class, 'update'])->name('blog.update');
Route::delete('/blogs/{id}/delete', [AdminController::class, 'destroy'])->name('blog.destroy');
Route::get('/blogs/{id}/view', [AdminController::class, 'view'])->name('blog.view');



Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
