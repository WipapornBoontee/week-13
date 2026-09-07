<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/index', function () {
    return view('index');
})->name('index');

Route::get('/abouts', function () {
    $name = "Wipaporn Boontee";
    $date = date("Y-m-d");
    return view('abouts', compact('name', 'date')); 
})->name('abouts');

// กลุ่มเส้นทางของนักเขียน (Route Prefix: author) ตามใบงานที่ 13
Route::prefix('author')->group(function () {
    Route::get('/about', function () {
        $name = "Wipaporn Boontee";
        $date = date("Y-m-d");
        return view('abouts', compact('name', 'date'));
    })->name('about');

    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/create', [AdminController::class, 'create'])->name('blog.create');
    Route::post('/insert', [AdminController::class, 'insert'])->name('blog.insert');
    Route::get('/edit/{id}', [AdminController::class, 'edit'])->name('blog.edit');
    Route::post('/update/{id}', [AdminController::class, 'update'])->name('blog.update');
    Route::match(['get', 'delete'], '/delete/{id}', [AdminController::class, 'delete'])->name('blog.delete');
    Route::get('/change/{id}', [AdminController::class, 'change'])->name('blog.change');
    Route::get('/view/{id}', [AdminController::class, 'view'])->name('blog.view');
});

// คง alias เดิมไว้เพื่อป้องกัน redirect error
Route::get('/blogs', function() {
    return redirect('/author/blog');
})->name('blogs');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
